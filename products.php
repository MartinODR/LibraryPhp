<?php include("template/Header.php"); ?>
<?php 
include("admin/config/db.php");
$sentenciaSQL= $connection->prepare("SELECT * FROM books");
$sentenciaSQL->execute();
$BooksList=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>


<?php foreach($BooksList as $book ) { ?>

<div class="col-md-3">
    <div class="card">
        <img class="card-img-top" src="./IMG/<?php echo $book['image']; ?>" alt="">
            <div class="card-body">
                <h4 class="card-title"><?php echo $book['name']; ?></h4>
                <a name="" id="" class="btn btn-primary" href="#" role="button">More about</a> <!-- aqui en href agregar un enlace hacia una descripcion o hacer pagina del libro plantilla  -->
            </div>
    </div>
</div>    
<?php } ?>

  

<?php include("template/Footer.php"); ?>
