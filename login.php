<?php
session_start(); 

$host="localhost"; 
$username="root"; 
$password="";
$db_name="raihan_vai"; 

mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$username=$_POST['username']; 
$password=$_POST['password']; 

$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

$sql="SELECT * FROM user WHERE username='$username' and password='$password'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);

   if($count==1){

     $_SESSION['isLogin'] = true;
     $_SESSION['username'] = $username;
     header("location: home.php");
     
  }else {
    echo "<script>
    alert('Error in login.Try again!');
    window.location.href='index.php';
    </script>";
  }
?>
