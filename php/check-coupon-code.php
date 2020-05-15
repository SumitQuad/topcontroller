<?php

$link = mysqli_connect("localhost", "root", "", "thetopcontroller");

if (mysqli_connect_error()){
    die("<script>console.log('There is a problem with mysql connection')</script>");
}

if(isset($_POST['type']) == "check-coupon"){
    
    $data = array();  
    $coupon = $_POST['coupon'];
    
    $query = "SELECT `discount_in_percent` FROM `coupons` WHERE UPPER(`coupon`) = UPPER('$coupon')";
    
    if($result = mysqli_query($link, $query))  
    {  
        $queryResultArray = mysqli_fetch_array($result);
        if(!isset($queryResultArray['discount_in_percent'])){
            $data['status'] = 'invalid';
        } else {
            $data['status'] = $queryResultArray['discount_in_percent'];
        }
        echo json_encode($data);
    }  
    else  
    {  
       echo "<script>console.log('error','problem with query after signup1')</script>";
       echo $link -> error; 
    } 

}


?>
   