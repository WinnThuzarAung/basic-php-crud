<?php 
    session_start();
    require "connect.php";
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
    if(isset($_GET['postId'])){
        $post_id_to_update=$_GET['postId'];
        $posts=mysqli_query($db,"SELECT * FROM post WHERE id= $post_id_to_update");
        if(mysqli_num_rows($posts)==1){
            foreach($posts as $row){
                $id=$row['id'];
                $title=$row['title'];
                $des=$row['description'];
            }
        }
    }
    //update post
    if(isset($_POST['update'])){
        $postid=$_POST['id'];
       $title=$_POST['title'];
       $desc=$_POST['description'];
       $titleerror='';
       $deserror='';
       if(empty($title)){
        $titleerror="The title is required";
        }
        if(empty($desc)){
        $deserror="The description is required";
        }
        if(!empty($title) && !empty($desc)){
       $query="UPDATE post SET title='$title',description='$desc' WHERE id=$postid";
        mysqli_query($db,$query);
        $_SESSION['successmsg']='A new post was updated successfully.';
        header("location:index.php");
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
                            <div class="card-title">Edition Form</div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                            <a href="index.php" class="btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    
                    </div>
                    <form action="" method="POST">
                    <div class="card-body">
                    
                        <input type="hidden" name="id" class="form-control " value="<?php echo $id; ?>">
                 
                        <div class="form-group pt-3 pb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control <?php if(!empty($titleerror)): ?>is-invalid <?php endif ?>" placeholder="Enter post title" value="<?php echo $title; ?>">
                        <?php if(!empty($titleerror)) { ?>
                            <span class="text-danger"><?php echo $titleerror; ?></span>    
                    <?php } ?>
                        </div>
                        <div class="form-group pt-3 pb-3">
                        <label>Description</label>
                        <textarea name="description" id="" class="form-control <?php if(!empty($deserror)): ?>is-invalid <?php endif ?>" placeholder="Enter post description"><?php echo $des; ?></textarea>
                            <?php if(!empty($deserror)) { ?>
                            <span class="text-danger"><?php echo $deserror; ?></span>   
                            <?php } ?>
                        </div>

                    
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>