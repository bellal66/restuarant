<?php

$host="localhost";
$username="root"; 
$password=""; 
$db_name="attachment"; 

mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$name="b";
$password=5;
$cpassword=6;
$name=$_POST['username']; 
$password=$_POST['password'];
$cpassword=$_POST['confirm_password'];


  if ($password==$cpassword) {

      $insert= mysql_query("insert into user(username, password) values ('$name','$password')");
       
      if($insert){
	    echo "<script>
        alert('Successfully Added.');
        window.location.href='index.php';
        </script>";
      }else {
		echo "<script>
        alert('Error in adding....Try again!');
        window.location.href='index.php';
        </script>";
      }		
  }else{
    echo "<script>
    alert('Error in adding.Try again!');
    window.location.href='index.php';
    </script>";
  }	

?>