<?php

include "baglan.php";

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM kitap WHERE ad like'%".$search."%'";
 $result = mysqli_query($con,$query);

 $response = array();
 while($row = mysqli_fetch_array($result) ){
   $response[] = array("value"=>$row['id'],"label"=>utf8_encode($row['ad']));
 }

 echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

exit;