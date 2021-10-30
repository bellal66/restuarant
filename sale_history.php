<?php
  session_start();
   if($_SESSION["isLogin"]!=true){
       header("Location: index.php");
       die();
    }
    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="script.js"></script>
  <script src="script2.js"></script>
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <title>Statistics</title>
  <style>
    .content {
      position: absolute;
      height: 100%;
      width: 100%;
    }
    
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
      width: 285px;
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
      position: absolute;
      left: 285px; 
      top: 0;
      height: 100%;
      width: 1068px;
      background-color: gray; 
    }
     .col-sm-9{
      background-color: white;
      position: absolute;
      top: 5px;
      left: 15px;
      height: 98%;
      width: 97%;
    }
     td:hover {
        background-color: lightsalmon;
     }
     table{
      border:1px solid #ddd;
      position: absolute;
      top:130px;
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
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="home.php">Foods</a></li>
        <li><a href="add_food.php">Add food</a></li>
        <li><a href="sale_history.php">Sale History</a></li>
      </ul><br>
    </div>

    <div class="main-body">
      <div class="col-sm-9">
      	<form action="sale_history.php" method="post">
         <div style="position: absolute; left: 60px; top: 17px; word-spacing: 100px;">
           From-Date:<input style="width: 150px; height: 30px;" type="date" name="from_date">
           To-Date:<input style="width: 150px; height: 30px;" type="date" name="to_date">
           <input type="submit" name="submit" value="submit">
          </div>
         </form>
      	<table id="example" class="display" cellspacing="0" width="100%">
         <thead>
            <tr style="background-color: #eee">
                <th>From Date</th>
                <th>Customer Name</th>
                <th>Amount</th>
            </tr>
         </thead>

         <tbody>
            <?php 
                 $host="localhost"; 
                 $username="root"; 
                 $password=""; 
                 $db_name="attachment"; 

                 $connect = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
                 mysql_select_db("$db_name")or die("cannot select DB");

                 $total=0;
              if(isset($_POST['from_date'])){

              	 $from_date = $_POST['from_date'];
              	 $timee=$from_date;
              	 $from_date = strtotime($from_date);
              	 $to_date = $_POST['to_date'];
              	 $to_date = strtotime($to_date);
                   

                  for ($i=$from_date; $i<=$to_date; $i+=86400){

                     $time = (string)date("Y-m-d",$i);
                     $query  = "SELECT * from sale_history where datee='$time'";   
                     $result = mysql_query($query) or die(mysql_error());

                     while ($row= mysql_fetch_array($result)) {

                      $name=$row['customer_name'];
                      $amount=$row['amount'];
                      $dateee=$row['datee'];

                  $total=$total+$amount;
               ?>

              <tbody>
                <tr>
                  <th><?php echo $dateee; ?></th>
                  <th><?php echo $name; ?></th>
                  <th><?php echo $amount; ?></th>
                </tr>
              </tbody>

              <?php
                   }
                  }
                 }   
                 mysql_close();
              ?>
         </tbody>

         <tfoot>
            <tr style="background-color: #eee">
                <th>To Date</th>
                <th>Customer Name</th>
                <th style="width: 30%; padding-right: 100px; word-spacing: 60px;">Total= <?php echo $total; ?>$</th>
            </tr>
         </tfoot>
 
       </table>

      </div>
    </div>
 </div>
</div>

</body>
</html>
