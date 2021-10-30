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
      height: auto;
      width: 1068px;
    }
    .topnav-centered {
        position: absolute;
        top: 50%;
        left: 80%;
        transform: translate(-50%, -50%);
     }
     ul{
      list-style: none;
     }
     .choose_list {
        width: 100%;
        height: 50px;
      }
     .close {
        cursor: pointer;
        right: 0%;
      }
     .close:hover {
      background: #bbb;
      }
  </style>
</head>

<body>


  <div class="row content">
    <div class="col-sm-3 sidenav">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#">Foods</a></li>
        <li><a href="add_food.php">Add food</a></li>
        <li><a href="sale_history.php">Sale History</a></li>
      </ul><br>
    </div>

    <div class="main-body">
      
       <nav class="navbar navbar-static-top navbar-dark bg-info">
         <ul class="nav navbar-nav topnav-left">
           <p style="font-family: cooper black; font-size: 17px;"><b><?php echo $username; ?></b></p>
         </ul>
         <ul class="nav navbar-nav topnav-centered">
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success count"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <ul class="dropdown-menu-list" style="width: 200px; height: 300px; overflow: auto;">
                </ul>
              </li>
              <div style="width: 100%; border-bottom: 1px solid black;"></div>
              <li style="text-align: center;"><a href="sale_food.php">See All</a></li>
            </ul>
          </li>
         </ul>
    </nav>
     <script>
       function myFunction() {
         var element = document.getElementById("food_div");
         element.remove("food_div");
        }
     </script>
     <?php 
        $host="localhost"; 
        $username="root"; 
        $password=""; 
        $db_name="attachment"; 

        mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
        mysql_select_db("$db_name")or die("cannot select DB");
        $query  = "SELECT * from food ";   
        $result = mysql_query($query) or die(mysql_error());
        
       $value=100;
       while ($row= mysql_fetch_array($result)) {
        $name=$row['name'];
        $price=$row['price'];
        $id=$row['id'];
      ?>

        <div id="food_main_div" style="position: absolute; top: <?php echo $value;echo "px"; ?>; left: 180px; width: 400px; height: 150px;">
          <div id="food_img_div" style="position: absolute; left: 0; width: 65%; height: 100%;cursor: pointer;">
            <a href="insert.php?id=<?=$id?> && name=<?=$name?>">
              <img src="<?php echo $name;echo".jpg"; ?>" style="position: absolute; width: 100%; height: 100%;">
            </a>
          </div>
          <div style="position: absolute; right: 0; width: 35%; height: 100%; background-color: #f2f2f2;">
            <h5 id="food_name" style="padding-left: 5px; font-family: copper black; font-size: 16px;"><b><?php echo $name;?></b></h5>
            <h6 style="padding-left: 30px; font-family: cooper black; font-size: 18px;"><b><?php echo $price;?>$</b></h6>
          </div>
        </div>

      <?php
      $value=$value+200;
         }
      ?>

 </div>
</div>

</body>
</html>
<script>
    var closebtns = document.getElementsByClassName("close");
    var i;

    for (i = 0; i < closebtns.length; i++) {
       closebtns[i].addEventListener("click", function() {
       this.parentElement.style.display = 'none';
      });
   }
</script>
<script type="text/javascript">
  $(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    console.log(data);
    $('.dropdown-menu-list').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
});
</script>