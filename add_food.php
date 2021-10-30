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
  
  <title>Add Food</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="script.js"></script>
  <script src="script2.js"></script>
  <style>
    .row.content {
      position: absolute;
      height: 175.7%;
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
      height: 1100px;
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
  </style>
</head>

<body>

  
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <ul style="list-style: none;">
      </ul>
      
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="home.php">Foods</a></li>
        <li><a href="#">Add food</a></li>
        <li><a href="sale_history.php">Sale History</a></li>
      </ul><br>
   
    </div>
    

    <div class="main-body">
     <div class="col-sm-9">

       <div style="position: absolute; left: 10px; top: 10px; right: 10px; width: 98%; height: 98%;">
         <style>
            .box{
              width:1270px;
              padding:20px;
              background-color:#fff;
              border:1px solid #ccc;
              border-radius:5px;
              margin-top:25px;
              box-sizing:border-box;
              }
              #user_data {
                 font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                 border-collapse: collapse;
                 width: 100%;
               }
              #user_data td, #user_data th {
                 border: 1px solid #ddd;
               }
              #user_data tr:nth-child(even){background-color: #f2f2f2;}
              #user_data tr:hover {background-color: #ddd;}
         </style>

         <div class="container box" style="position: absolute; left: 10px; width: 98%; height: 900px;">
            
            <div align="right">
              <button type="button" name="add" id="add" class="btn btn-info">Add</button>
            </div>
            <br />
            <div id="alert_message"></div>
            <table id="user_data" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="color: green; font-size: 17px; width: 50%;"><b>Name</b></th>
                  <th style="color: green; font-size: 17px; width: 30%;"><b>price($)</b></th>
                  <th style="width: 8%;"></th>
                </tr>
              </thead>

              <?php 
                 $host="localhost"; 
                 $username="root"; 
                 $password=""; 
                 $db_name="attachment"; 

                 mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
                 mysql_select_db("$db_name")or die("cannot select DB");
                 $query  = "SELECT * from food";   
                 $result = mysql_query($query) or die(mysql_error());
                 while ($row= mysql_fetch_array($result)) {
                  $name=$row['name'];
                  $price=$row['price'];
                  $id=$row['id'];
               ?>

              <tbody>
                <tr>
                  <th><a href="food_detail.php?id=<?=$id?>"><?php echo $name; ?></a></th>
                  <th><?php echo $price; ?>$</th>
                  <th style="text-align: center;"><a href="delete_foodlist.php?id=<?=$id?>" class="btn btn-default">Delete</a></th>
                </tr>
              </tbody>

              <?php  
                 }   
                 mysql_close();
              ?>

            </table>
         </div>
       </div>

     </div>
    </div>

  </div>

</body>
</html>

<script type="text/javascript" language="javascript" >
  $(document).ready(function(){
    

    $('#add').click(function(){
      var html = '<tr>';
      html += '<td contenteditable id="data1"></td>';
      html += '<td contenteditable id="data2"></td>';
      html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
      html += '</tr>';
      $('#user_data').prepend(html);
    });
    
    $(document).on('click', '#insert', function(){
      var name = $('#data1').text();
      var price = $('#data2').text();
      if(name != '' && price != '')
      {
        $.ajax({
          url:"insert_food.php",
          method:"POST",
          data:{
            'name':name,
            'price':price,
          },
          success:function(data)
          {
            console.log(data);
            $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
            $('#user_data').DataTable().destroy();
          }
        });
        setInterval(function(){
          $('#alert_message').html('');
        }, 5000);
      }
      else
      {
        alert("Both Fields is required");
      }
    });
    
  });
</script>