<?php 
session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../index.php");
   }else{

        if($_SESSION['user']=="ok"){
            $username=$_SESSION["username"];

        }

   }

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>

    <?php $url="http://".$_SERVER['HTTP_HOST']."\proyectosGitHub\WebPhP" ?> <!-- Este es el rediccionamiento de el boton see website  -->

            <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link active" href="#">Website Admin <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/home.php">Home</a>   <!-- prestar atencion a la etiqueta echo -->

                    <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/section/products.php">Books</a>
                    <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/section/close.php">Log Out</a>

                    <a class="nav-item nav-link" href="<?php echo $url; ?>" target="_blank">See Website</a>  <!--target="_blank" open link in a new tab-->
                </div>
            </nav>
     
        <div class="container">
        <br/><br/>
            <div class="row">