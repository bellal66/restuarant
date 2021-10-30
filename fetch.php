<?php

$connect = mysqli_connect("localhost", "root", "", "attachment");

if(isset($_POST["view"]))
{
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE sale SET status=1 WHERE status=0";
  mysqli_query($connect, $update_query);
 }
 $query = "SELECT * FROM sale";
 $result = mysqli_query($connect, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  $value=0;
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
     <li>
      <div style=" top:'.$value.'px; left:0; width: 100%; height: 40px;">
        <strong>'.$row["name"].'</strong>
        <a href="delete_chooselist.php?id=' . $row['id'] . '"><b>X</b></a>
      </div>
     </li>
   ';
   $value = $value + 41;
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM sale WHERE status=0";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'  => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>