<?php
  
  $host="localhost"; 
  $husername="root"; 
  $hpassword=""; 
  $db_name="attachment"; 

  mysql_connect("$host", "$husername", "$hpassword")or die("cannot connect"); 
  mysql_select_db("$db_name")or die("cannot select DB");

  if (isset($_GET['id'])){

      $id = (int)$_GET['id'];
      $name= $_GET['name'];


      $getprice = mysql_query("SELECT * FROM food where id=$id");
      $row = mysql_fetch_array($getprice);
      $price = $row['price'];

      
      $insert_query = "INSERT into sale(name,qty,price,status) VALUES('$name','1','$price','0')";
      $result =mysql_query($insert_query);
      if($result){
          header("Location: home.php");
       }
   }
  
?>
