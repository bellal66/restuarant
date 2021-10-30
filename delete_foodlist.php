<?php

$connect = mysqli_connect("localhost", "root", "", "attachment");

  if (isset($_GET['id'])){

        $id = (int)$_GET['id'];
        $delete_query = "DELETE FROM food WHERE id=$id";
        $result =mysqli_query($connect, $delete_query);
        if($result){
          header("Location: add_food.php");
        }
     }

?>
