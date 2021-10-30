<?php
session_start();
if($_SESSION["isLogin"]!=true){
   header("Location: index.php");
   die();
  }
if(isset($_GET["id"]))
  {
    $id = (int)$_GET["id"];
  }      
  $_SESSION['id'] = $id;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Food Detail</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="script.js"></script>
  <script src="script2.js"></script>
  <style>
    .row.content {
      position: absolute;
      height: 100%;
      width: 500px;
    }
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
      width: 300px;
    }
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
        
    @media screen and (max-width: 500px) {
      .sidenav {
        height: auto;
      }
      .row.content {height: auto;} 
    }
    .col-sm-3{
      background-color: black;
    }
    .nav{
      padding: 10px 10px;
    }
    .main-body{
      background-color: gray;
      position: absolute;
      left: 285px; top: 0;
      height: 100%;
      width: 1068px;
    }
    .col-sm-9{
      background-color: white;
      position: absolute;
      top: 0;
      left: 15px;
      height: 97%;
      width: 97%;
    }
  </style>
</head>
<body>
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <ul style="list-style: none;">
      </ul>
      
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="home.php">Foods</a></li>
        <li><a href="add_food.php">Add food</a></li>
        <li><a href="sale_history.php">Sale History</a></li>
      </ul><br>
   
    </div>
    

    <div class="main-body">
     <div class="col-sm-9"><hr>
     	<div class="containerr">
          <?php 
            $host="localhost"; 
            $username="root"; 
            $password=""; 
            $db_name="attachment"; 

            mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
            mysql_select_db("$db_name")or die("cannot select DB");
            $query  = "SELECT * from food where id='$id'";  

            $result = mysql_query($query) or die(mysql_error());
            if (mysql_num_rows($result) > 0) {

              while($row =mysql_fetch_array($result)) {

          ?>

          <div style="width: 40%; padding: 7px; margin: 1px 0 1px 0; display: inline-block;border: none; background: #f1f1f1; font-size: 15px;">
            <label ><b>Product Name:</b></label>
            <?php echo $row['name']; ?>
          </div><br>

          
          <div style="width: 40%; padding: 7px; margin: 1px 0 1px 0; display: inline-block;border: none; background: #f1f1f1; font-size: 15px;">
            <label><b>Buying Price:</b></label>
            <?php echo $row['price']; ?>$
          </div>
          
          <?php 
              }
            }
          ?>
        </div><hr>
        <button  class="btn btn-default" data-toggle="modal" data-target="#modal-default">Edit Product</button>

        <!-- modal box -->
        <div class="modal fade" id="modal-default">
         <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
            </button>
           </div>
           <form action="edit_foodlist.php" method="post">
            <div class="modal-body">
              Name:
              <input type="text" name="name" required><br><br>
              Price:-
              <input type="text" name="price" placeholder="$" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
           </form>
          </div>
         </div>
        </div>

     </div>
    </div>
</body>
</html>