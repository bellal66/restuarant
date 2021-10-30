<?php

$connect = mysqli_connect("localhost", "root", "", "attachment");

  if (isset($_GET['id'])){

        $id = (int)$_GET['id'];
        $update_query = "DELETE FROM sale WHERE id=$id";
        $result =mysqli_query($connect, $update_query);
        if($result){
          header("Location: home.php");
        }
     }

?>
