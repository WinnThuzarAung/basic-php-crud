<?php

    $db=mysqli_connect('localhost:3308','root','','basic_php_crud');
if($db==false){
    die('Error: '.mysqli_connect_error($db));
}

?>