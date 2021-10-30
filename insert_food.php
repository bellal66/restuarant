<?php
$connect = mysqli_connect("localhost", "root", "", "attachment");
if(isset($_POST["name"]))
{
 $name = mysqli_real_escape_string($connect, $_POST["name"]);
 $price = mysqli_real_escape_string($connect, $_POST["price"]);


 $query = "INSERT INTO food(name,price) VALUES('$name','$price')";
 $result = mysqli_query($connect, $query);
 if($result)
 {
  echo 'Data Inserted';
 }else{
 	echo "nothing";
 }
}
?>

