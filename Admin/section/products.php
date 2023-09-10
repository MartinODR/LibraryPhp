<?php include("../template/header.php") ?>
<?php 
       //condicion accion        si            no (vacio)                           
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";                             //validacion, condicion o if ternario lo que va a suceder si se cumple o no 
$txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";

$txtImage=(isset($_FILES['txtImage']['name']))?$_FILES['txtImage']['name']:"";

$action=(isset($_POST['action']))?$_POST['action']:"";

echo $txtID."<br/>";
echo $txtName."<br/>";
echo $txtImage."<br/>";
echo $action."<br/>";
                                                   //aca abajo es como se conecta con la base de datos SQL
$host="localHost";
$db="sitio";
$user="root";
$password="";

try {
          $connection=new PDO("mysql:host=$host;dbname=$db",$user,$password);
          if($connection){ echo "Connected... to system ";} // condicion if (si) y mensaje de confirmacion 

        } catch ( Exeption $ex) {                           //tomar info en caso de que exista una falla 
    
        echo $ex->getMessage();

}


switch($action){

        
        case"Add":

            //INSERT INTO `books` (`id`, `name`, `image`) VALUES (NULL, 'Book about PHP', 'image.jpg');
        $sentenciaSQL=$connection->prepare("INSERT INTO `books` (`id`, `name`, `image`) VALUES (NULL, 'Book about PHP', 'image.jpg');");
        $sentenciaSQL->execute();


            echo "Pressed Add button";
            break; 

        case"Modify":
            echo "Pressed Modify button";
            break;

        case"Cancel":
            echo "Pressed Cancel button";
            break;     


}






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
                        <input type="text" class="form-control" name="txtID" id="txtID"  placeholder="ID">
                        </div>

                            <div class = "form-group">
                            <label for="txtID">Name:</label>
                            <input type="text" class="form-control" name="txtName" id="txtName"  placeholder="Name of the Book">
                            </div>

                        <div class = "form-group">
                        <label for="txtID">Image:</label>
                        <input type="file" class="form-control" name="txtImage" id="txtImage"  placeholder="Choose the Book">
                        </div>

                    <div class="btn-group" role="group" aria-label="">                              <!-- b4-bgroup-default , primary -->
                        <button type="submit" name="action" value="Add" class="btn btn-success">Add</button>
                        <button type="submit" name="action" value="Modify" class="btn btn-warning">Modify</button>       <!-- type cambio de button a submit-->
                        <button type="submit" name="action" value="Cancel" class="btn btn-info">Cancel</button>
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

            <tr>
                <td>2</td>
                <td>Aprende PHP</td>                   <!--Datos-->
                <td>imagen.jpg</td>
                <td>Select | Delete</td>

            </tr>

        </tbody>
    </table>

</div>


<?php include("../template/footer.php") ?>