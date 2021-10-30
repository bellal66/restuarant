<?php
  session_start();
   if($_SESSION["isLogin"]!=true){
       header("Location: index.php");
       die();
    }
    $customer_name=$_POST['customer_name'];
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
      width: 100%;
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
        <div style="position: absolute; left: 50px; top: 50px; width: 90%; height: 92%;">
            <div style="position: absolute; left: 60px; top: 17px;">
              Customer Name: <?php echo $customer_name; ?>
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

                 mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
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
                 $today = date("Y-m-d");
                 mysql_close();
              ?>

              <tfoot>
                <tr>
                  <th style="width: 30%">---</th>
                  <th style="width: 30%; padding-right: 100px; word-spacing: 60px;">Total= <?php echo $total; ?>$</th>
                  <th><?php echo $today; ?></th>
                </tr>
              </tfoot>

            </table>
            <button onclick="myFunction()" style="position: absolute; left: 800px; top: 10px;">p</button>
        </div>

  </div>

</body>
</html>

<script>
   function myFunction() {
     window.print();
   }
</script>
<?php
  $host="localhost"; 
  $username="root"; 
  $password=""; 
  $db_name="attachment"; 

  mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
  mysql_select_db("$db_name")or die("cannot select DB");

  $query = "INSERT INTO sale_history ( customer_name, amount, datee) VALUES ('$customer_name','$total','$today')";
  $result = mysql_query($query) or die(mysql_error());

  $result2= mysql_query("DELETE FROM sale") or die(mysql_error());
?>