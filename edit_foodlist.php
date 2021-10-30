<?php
 session_start();
 $id = $_SESSION['id'];

$connect = mysqli_connect("localhost", "root", "", "attachment");

 $name = $_POST["name"];
 $price = $_POST["price"];

 $query = "UPDATE food SET price='$price', name='$name'  where id='$id'";
 $result = mysqli_query($connect, $query);

 if($result)
 {
  header("location: add_food.php");
 }else{
 	echo "<script>
    alert('Error in editing!');
    window.location.href='add_food.php';
    </script>";
 }
?>