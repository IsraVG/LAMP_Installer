<?php
/* 
    Busca en el archivo /etc/mysql/debian.cnf
    la configuración que utiliza mysql para la instalación
    asi como para iniciar o detener el servicio.
    Con esa configuración creamos un archivo bash con 
    las consultas para modificar la contraseña del usuario root.

*/

/* Contraseña que tendrá el usuario root */
$new_password = 'unitec';

/* Guarda el en un arreglo el contenido de debian.cnf */
$lines=file('/etc/mysql/debian.cnf');

/* Itera las lineas hasta encontrar el password del usuario debian-sys-maint */
foreach($lines as $key => $line){

    if(strpos($line, 'password') === 0){

        /* separa el string password = *password* */
        $password = explode(" = ", $line);

    }
}
/* Se guarda la contraseña */
$password = trim($password[1]);

/* Consulta para asignar la contraseña al usuario root */
$query = '"ALTER USER ' . "'root'". "@'localhost'". ' IDENTIFIED WITH mysql_native_password BY ' . "'$new_password'". ';"';

/* Abre el archivo que contendrá las instrucciones en bash para la configuración de mysql */
$file = fopen("mysql_config.sh","wb");

/* Se escriben las lineas */
fwrite($file, "#!/bin/bash" );
fwrite($file, PHP_EOL . "sudo mysql -u debian-sys-maint -p" . $password . " -D mysql -e " . $query );
fwrite($file, PHP_EOL . "sudo mysql -u debian-sys-maint -p" . $password . " -e 'FLUSH PRIVILEGES;'");

/* Cerramos el archivo */
fclose($file);

/* Ejecutamos el script */
exec("sudo sh mysql_config.sh");

?>