<?php
  session_start();
   if($_SESSION["isLogin"]!=true){
       header("Location: index.php");
       die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Sale Food</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="script.js"></script>
  <script src="script2.js"></script>
  <style>
    .row.content {
      position: absolute;
      height: 150%;
      width: 500px;
    }
    .sidenav {
      background-color: #f1f1f1;
      height: 150%;
      width: 300px;
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
      height: 150%;
      width: 1068px;
    }
    .col-sm-9{
      background-color: white;
      position: absolute;
      top: 0;
      left: 15px;
      height: 99.5%;
      width: 97%;
    }
    table{
      border:1px solid #ddd;
      position: absolute;
      top:100px;
      left: 45px;
      width: 90%;
    }
    table td, th {
      border:1px solid #ddd;
      text-align: center;
      height: 30px;
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
     <div class="col-sm-9">
        <form action="sale_demo.php" method="post" target="_blank">
          <div style="position: absolute; left: 50px; top: 50px; width: 90%; height: 92%;">
            <div style="position: absolute; left: 60px; top: 17px;">
              Customer Name:
              <input style="width: 300px; height: 35px;" type="text" name="customer_name">
            </div>
            <table>
              <thead>
                <tr>
                  <th style="color: green; font-size: 17px; width: 30%;"><b>Name</b></th>
                  <th style="color: green; font-size: 17px; width: 30%;"><b>price</b></th>
                  <th style="width: 10%;">Date</th>
                </tr>
              </thead>

              <?php 
                 $host="localhost"; 
                 $username="root"; 
                 $password=""; 
                 $db_name="attachment"; 

                 $connect = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
                 mysql_select_db("$db_name")or die("cannot select DB");
                 $query  = "SELECT * from sale";   
                 $result = mysql_query($query) or die(mysql_error());

                 $total=0;
                 while ($row= mysql_fetch_array($result)) {
                  $name=$row['name'];
                  $price=$row['price'];
                  $total=$total+$price;
               ?>

              <tbody>
                <tr>
                  <th><?php echo $name; ?></th>
                  <th><?php echo $price; ?></th>
                </tr>
              </tbody>

              <?php  
                 }    
                 $today= date("Y-m-d"); 
                 mysql_close();
              ?>

              <tfoot>
                <tr>
                  <th style="width: 30%">---</th>
                  <th style="width: 30%; padding-right: 100px; word-spacing: 60px;">Total= <?php echo $total; ?>$</th>
                  <th><?php echo $today; ?></th>
                </tr>
                <tr>
                  <th>
                    <button type="Submit" name="submit_sale">Submit Sale</button>
                  </th>
                </tr>
              </tfoot>
              
            </table>
            
          </div>
        </form>
     </div>
    </div>

  </div>

</body>
</html>