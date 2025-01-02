<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>basic php crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body{
            padding:50px;
        }
        
    </style>

</head>
<body>
    <?php
    require "connect.php";
    $titleerror='';
    $deserror='';

        if(isset($_POST['create'])){
           $title=$_POST['title'];
           $des=$_POST['description'];

            if(empty($title)){
                $titleerror="The title is required";
            }
            if(empty($des)){
                $deserror="The description is required";
            }
            if(!empty($title) && !empty($des)){

           $query="INSERT INTO post(title,description) VALUES ('$title','$des')";
           mysqli_query($db,$query);
           $_SESSION['successmsg']='A new post was created';
           header('location:index.php');
            }
           
        }

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-6">
                            <div class="card-title">Post Creation Form</div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                            <a href="index.php" class="btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    
                    </div>
                    <form action="postcreate.php" method="POST">
                    <div class="card-body">
                    
                       <div class="form-group pt-3 pb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control <?php if(!empty($titleerror)): ?>is-invalid <?php endif ?>" placeholder="Enter post title">
                        <span class="text-danger"><?php echo $titleerror; ?></span>    
                    </div>
                        <div class="form-group pt-3 pb-3">
                        <label>Description</label>
                        <textarea name="description" id="" class="form-control <?php if(!empty($deserror)): ?>is-invalid <?php endif ?>" placeholder="Enter post description"></textarea>
                        <span class="text-danger"><?php echo $deserror; ?></span>   
                        </div>
                    
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="create" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>