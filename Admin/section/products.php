<?php include("../template/header.php") ?>  <!-- esto conecta e incluye la cabecera --> 
<?php 
       //condicion accion        si            no (vacio)                           
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";                             //validacion, condicion o if ternario lo que va a suceder si se cumple o no 
$txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";

$txtImage=(isset($_FILES['txtImage']['name']))?$_FILES['txtImage']['name']:"";

$action=(isset($_POST['action']))?$_POST['action']:"";

include("../config/db.php");  // esto conecta e incluye el contenido de db.php


                                          /*    echo $txtID."<br/>";
         imprime en pantalla                    echo $txtName."<br/>";
         para comprobar                         echo $txtImage."<br/>";
                                                echo $action."<br/>";    */



switch($action){

        
        case"Add":
            //INSERT INTO `books` (`id`, `name`, `image`) VALUES (NULL, 'Book about PHP', 'image.jpg'); son las instrucciones SQL copiadas de phpmyadmin
            // se obtienen de la seccion insertar o einfügen, se insertan los datos en los campos y luego de ok te da la linea de comandos 
        $sentenciaSQL= $connection->prepare("INSERT INTO books (name,image ) VALUES (:name,:image);"); // modificado comparar con el original, name e image son los parametros 
        $sentenciaSQL->bindParam(':name', $txtName);                                //parametros para insertar la informacion  
        
        $fecha= new DateTime();                      //esto se introduce por si coinciden los archivos se diferencian en fecha 
        $nombreArchivo=($txtImage!="")?$fecha->getTimestamp()."_".$_FILES["txtImage"]["name"]:"image.jpg";

        $tmpImage=$_FILES["txtImage"]["tmp_name"];

        if($tmpImage!="") {

           move_uploaded_file($tmpImage,"../../IMG/".$nombreArchivo); 
        }

           
        $sentenciaSQL->bindParam(':image', $nombreArchivo);
        $sentenciaSQL->execute();

        header("Location:products.php"); //redirecciona

           // mensaje de confirmacion de accion // echo "Pressed Add button";
            break; 

        case"Modify":

            $sentenciaSQL= $connection->prepare("UPDATE books SET name=:name WHERE id=:id");   
            $sentenciaSQL->bindParam(':name',$txtName);                     // tener cuidado con las variables, distinguen entre mayusculas y minusculas 
            $sentenciaSQL->bindParam(':id',$txtID);                         //
            $sentenciaSQL->execute();

            if($txtImage!=""){                //instruccion se cumple si txt es diferente de vacio

                $fecha= new DateTime();                       
                $nombreArchivo=($txtImage!="")?$fecha->getTimestamp()."_".$_FILES["txtImage"]["name"]:"image.jpg";
                $tmpImage=$_FILES["txtImage"]["tmp_name"];

                move_uploaded_file($tmpImage,"../../IMG/".$nombreArchivo); 

                $sentenciaSQL= $connection->prepare("SELECT image FROM books WHERE id=:id");     //instruccion de borrar pegada
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
                $book=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
                
                if( isset($book["image"]) &&($book["image"]!="image.jpg") ){        
                                                                                     
                    if(file_exists("../../IMG/".$book["image"])){
    
                        unlink("../../IMG/".$book["image"]);
                    }
    
                }

  
            $sentenciaSQL= $connection->prepare("UPDATE books SET image=:image WHERE id=:id");   //instruccion si tiene algo la imagen
            $sentenciaSQL->bindParam(':image',$nombreArchivo);                                        //que actualice la informacion
            $sentenciaSQL->bindParam(':id',$txtID);     
            $sentenciaSQL->execute();
            }
            header("Location:products.php");  //redirecciona 

            //echo "Pressed Modify button";
            break;

        case"Cancel":
            header("Location:products.php");
            // echo "Pressed Cancel button";
            break;     

        case"Select":
            
            $sentenciaSQL= $connection->prepare("SELECT * FROM books WHERE id=:id");      //aqui seleccionamos los registros de acuerdo a lo que nos envian
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $book=$sentenciaSQL->fetch(PDO::FETCH_LAZY);  

            $txtName=$book['name'];                          //aqui muestra o asigna los valores que se recuperaron de esa seleccion en db
            $txtImage=$book['image'];

            //echo "Pressed Cancel Select";
            break;
        
        case"Delete":

            $sentenciaSQL= $connection->prepare("SELECT image FROM books WHERE id=:id");   
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $book=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
            
            if( isset($book["image"]) &&($book["image"]!="image.jpg") ){        //si existe esa imagen buscala con el id y si es diferente
                                                                                //a image.jpg y si existe en la carpeta borrala 
                if(file_exists("../../IMG/".$book["image"])){

                    unlink("../../IMG/".$book["image"]);
                }

            }




         $sentenciaSQL= $connection->prepare("DELETE FROM books WHERE id=:id");            //instruccion SQL accion del boton en la db borrar id
            $sentenciaSQL->bindParam(':id',$txtID); 
            $sentenciaSQL->execute();
            header("Location:products.php");    //redirecciona
            //echo "Pressed Cancel Delete";
            break;     
}
// 1:aqui se ejecuta una instruccion SQL de seleccion de libros 
//2: ejecutame esa instruccion (php) 
//3: FetchAll recupera todos los registros para mostrar en la variable  
 $sentenciaSQL= $connection->prepare("SELECT * FROM books");
$sentenciaSQL->execute();
$BooksList=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);  // PDO::FETCH_ASSOC asocia los datos de la tabla y los nuevos datos



?>

<div class="col-md-5">                       <!-- b4-grid-col  , el md son los espacios de un total de 12 -->
    
    <div class="card">                       <!-- b4-card-head-foot -->
            <div class="card-header">
                Book data
            </div>

            <div class="card-body">
   
                <form method="POST" enctype="multipart/form-data">  <!-- aqui se especifica el metodo y la forma de envio del formulario,importante -->
                                           <!-- !crt-form-login , formulario de agregar libros -->
                        <div class = "form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID"  placeholder="ID">
                        </div>              <!-- required:necesario para proseguir ,readonly entonces el campo solo se puede leer -->

                            <div class = "form-group">
                            <label for="txtName">Name:</label>
                            <input type="text" required class="form-control" value="<?php echo $txtName; ?>" name="txtName" id="txtName"  placeholder="Name of the Book">
                            </div>

                        <div class = "form-group">
                        <label for="txtName">Image:</label>
                        
                        <br>    <!-- este br baja la imagen --> 
                       <!-- <?php echo $txtImage; ?> comentado no se nota, esto muestra el nombre de la imagen junto a-->

                        <?php if($txtImage!=""){ ?>

                            <img class="img-thumbnail rounded" src="../../IMG/<?php echo $txtImage;?>" width="150" alt="" srcset="">

                        <?php   }   ?>                     

                        <input type="file" class="form-control" name="txtImage" id="txtImage"  placeholder="Choose the Book">
                        </div>

                    <div class="btn-group" role="group" aria-label="">                              <!-- b4-bgroup-default , primary -->
                        <button type="submit" name="action" <?php echo ($action=="Select")?"disabled":""; ?> value="Add" class="btn btn-success">Add</button>
                        <button type="submit" name="action" <?php echo ($action!="Select")?"disabled":""; ?> value="Modify" class="btn btn-warning">Modify</button>       <!-- type cambio de button a submit-->
                        <button type="submit" name="action" <?php echo ($action!="Select")?"disabled":""; ?> value="Cancel" class="btn btn-info">Cancel</button>
                    </div>

                </form>

            </div>

        
    </div>




    
     

</div>
<div class="col-md-7">
    
    <table class="table table-bordered">        <!-- b4-table-default -->
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>               <!--columna--> 
                <th>Image</th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($BooksList as $book) { ?>        
                <tr>
                    <td><?php echo $book['id']; ?></td>
                    <td><?php echo $book['name']; ?></td>                   <!--Datos,se repite conforme a los datos que se van consultando-->
                    <td>

                    <img class="img-thumbnail rounded" src="../../IMG/<?php echo $book['image']; ?>" width="70" alt="" srcset="">
                        
                    
                
                </td>

                    <td>
                
                    
                 <!--  Select | Delete --> 

                    <form method="post">

                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $book['id'] ?>"/>

                    <input type="submit" name="action" value="Select" class="btn btn-primary" />

                    <input type="submit" name="action" value="Delete" class="btn btn-danger" />


                    </form>
                
                </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>


<?php include("../template/footer.php") ?>