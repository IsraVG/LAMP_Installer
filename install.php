<?php
    //Arreglo que contiene los comandos de paquetes a instalar
    require("./commands.php");
    echo "___________Proyecto Implantacion y Mantenimiento de Sistemas___________\n";
    echo "__________________________Instalación ERP__________________________\n";
    sleep(2);

    /*
        Muestra un menú que permite escoger al usuario el tipo de instalación
        1. Instalación desatendida
        2. Instalación personalizada 
        0. Abortar instalación
    */
    echo "Indique el tipo de instalación a realizar:\n1. Minima\n2. Personalizada\n0. Salir\n";
    do{
        /* Guarda la elección del usuario */
        $input = readline("\nEscribir respuesta: ");
        /* Salir de la instalación */
        if($input == "0"){
            die();
        }
        /* Mensaje en caso de una entrada no valida */
        if (!($input == "1" || $input == "2")) {
            echo "Respuesta invalida\n";
        }
        
    }while(!($input == "1" || $input == "2"));
    
    /* 
        Instalación Personalizada
        Se le informa al usuario los paquetes adicionales (no requeridos)
        y se le pregunta si desea incluirlos a la instalación.
    */
    if($input == "2"){
        /* Arreglo temporal */
        $new_commands = array();
        foreach($commands as $command){
            /* El paquete no es necesario pero pregunta si se quiere añadir */
            if($command['required'] == 0){
                do{
                    $response = strtolower(readline($command['ask']));
                    /* Valida respuesta del usuario */
                    if(!($response == "s" || $response == "n")){
                        echo "Respuesta invalida\n";
                    }
                }while(!($response == "s" || $response == "n"));
                
                /* Cambia bandera de no requerido (0) a requerido (1) */
                if($response == "s"){
                    $command['required'] = 1;
                }

                
            }
            /* Insertar el paquete a la lista */
            array_push($new_commands, $command);
        }
        $commands = $new_commands;
    }


    /*
        Abre el archivo packages.sh donde se guardan los paquetes 
        requeridos por parte de la aplicación y del usuario 
    */
    $file = fopen("packages.sh", "wb");
    
    /* Inicio bash */
    fwrite($file, "#!/bin/bash");
    
    foreach($commands as $command){
        
        if($command['required'] == 1){
            /* Comentario del paquete */
            fwrite($file, PHP_EOL . "echo " . $command['description']);
            /* Comando: sudo apt-get install -y *paquete* */
            fwrite($file, PHP_EOL . $command['command']);
            /* Alerta de paquete instalado */
            fwrite($file, PHP_EOL . "echo Tarea terminada");
        }

    }
    /* Llamado a la configuración de mysql */
    fwrite($file, PHP_EOL . "sudo php mysql_config.php");

    /* cerrar el archivo */
    fclose($file);



     
?>
