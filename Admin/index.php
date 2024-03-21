<?php
session_start();
if($_POST){                                     
    if(($_POST['user']=="Martin")&&($_POST['password']=="123")){          
                
        $_SESSION['user']="ok";
        $_SESSION['username']="Martin";
        header('Location:home.php');

   }else{
        $message="Error: wrong username or password";

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
      
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4">
<br/><br/><br/>
                    <div class="card">
                        <div class="card-header">
                            Login
                        </div>
                        <div class="card-body">

                        <?php if(isset($message)){ ?>    
                            <div class="alert alert-danger" role="alert">
                                <?php echo $message; ?>
                            </div>
                            <?php } ?>
                            <form method="POST">

                                <div class = "form-group">

                                    <label for="user">User</label>

                                    <input type="Text" class="form-control" name="user" placeholder="Enter your username">
                             
                                </div>

                                <div class="form-group"> 

                                    <label for="password">Password</label>

                                    <input type="password" class="form-control" name="password" placeholder="Enter your password">

                                </div>

                           
                                
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </form>
                            
                            
                    
                            
                        </div>
                        
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
   
  </body>
</html>