<?php                        // esto establece la conexion con la base de datos
$host="localHost";
$db="sitio";
$user="root";
$password="";

try {
          $connection=new PDO("mysql:host=$host;dbname=$db",$user,$password);
          // if($connection){ echo "Connected... to system ";} // condicion if (si) y mensaje de confirmacion para prueba

        } catch ( Exeption $ex) {                           //tomar info en caso de que exista una falla 
    
        echo $ex->getMessage();

}
?>
<!-- se separo la informacion para cuando se mueva el proyecto a otro servidor sea mas facil configurarlo
    simplemente se modifican los datos de conexion --> 