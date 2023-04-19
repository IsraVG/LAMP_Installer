<?php 
    /* En este archivo se describen los paquetes requeridos y opcionales
        id
        comando a ejecutar en bash
        descripción de lo que se instala
        pregunta (paquetes opcionales)
        requerido  
    */

    $commands = array(
        array(
            "id" => 1,
            "command" => "sudo apt-get install -y php-cli php-fpm php-json php-pdo php-mysql php-zip php-gd  php-mbstring php-curl php-xml php-pear php-bcmath",
            "description" => "'\n__________Instalando librerias php__________\n'",
            "required" => 1
        ),
        array(
            "id" => 2,
            "command" => "sudo apt-get install -y mysql-server",
            "description" => "'\n______________Instalando mysql______________\n'",
            "required" => 1
        ),
        array(
            "id" => 3,
            "command" => "sudo apt-get -y install apache2",
            "description" => "'\n______________Instalando Servidor Apache______________\n'",
            "required" => 1
        ),
        array(
            "id" => 4,
            "command" => "sudo ufw allow 'Apache'",
            "description" => "'\n______________Configurando apache______________\n'",
            "required" => 1
        ),
        array(
            "id" => 5,
            "command" => "sudo service apache2 restart",
            "description" => "'\n______________Reiniciando Servidor Apache______________\n'",
            "required" => 1
        ),
        array(
            "id" => 6,
            "command" => "sudo apt-get install -y phpmyadmin",
            "description" => "'\n______________Instalando Phpmyadmin______________\n'",
            "ask" => "\n¿Instalar Phpmyadmin? s/n\n",
            "required" => 0
        ),
        array(
            "id" => 6,
            "command" => "sudo apt-get install clonezilla -y",
            "description" => "'\n______________Instalando Clonezilla______________\n'",
            "required" => 1
        )
    );

?>
