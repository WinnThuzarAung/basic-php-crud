<?php 
ob_start();
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="card-title">Post list</div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                            <a href="postcreate.php" class="btn btn-primary ">+ Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                       <?php if(isset($_SESSION['successmsg'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['successmsg'];
                        unset($_SESSION['successmsg']);
                        ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif ?>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $query="SELECT * FROM post";
                            $result=mysqli_query($db,$query);
                            foreach($result as $row)
                            {
                        ?>
                           
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['description']; ?> </td>
                            <td>
                                <a href="postedit.php?postId=<?php echo $row['id']; ?>">Edit</a> |
                                <a href="index.php?postId=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        if(isset($_GET['postId'])){
            $post_id=$_GET['postId'];
            $query1="DELETE FROM post WHERE id=$post_id";
            mysqli_query($db,$query1);
           
            $_SESSION['successmsg']="A post is deleted successfully.";
            header('location:index.php');
            ob_end_flush();
            
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>