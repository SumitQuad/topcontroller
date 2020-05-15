<?php


$link = mysqli_connect("localhost", "root", "", "thetopcontroller");

if (mysqli_connect_error()){
    die("<script>console.log('There is a problem with mysql connection')</script>");
}

if(isset($_POST['product_name']) == "check-coupon"){
    
    $data = array();  
    $coupon = $_POST['coupon'];
    $from_ip = $_SERVER['REMOTE_ADDR'];
    $from_browser = $_SERVER['HTTP_USER_AGENT'];
    date_default_timezone_set("Asia/Calcutta");
    $date_now = date("r");

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $country = $_POST['country'];
    $pin = $_POST['pin'];
    $product_name = $_POST['product_name'];
    $coupon = $_POST['coupon'];
    $amount = $_POST['amount'];

    if($phone == ""){
        $phone = 0;
    }
    if($amount == ""){
        $amount = 0;
    }
    if($pin == ""){
        $pin = 0;
    }

    $id = 0;

    $result = mysqli_query($link, "SELECT max(id) FROM `orders`");

    while ($row = mysqli_fetch_array($result)) {
        $id = $row[0];  
    }
    $id = $id + 1;

    $query = "INSERT INTO `orders` (`id`, `name`, `phone`, `email`, `address1`, `address2`, `country`, `pin`, `product_name`, `coupon`, `amount`, `time`, `from_ip`, `from_browser`, `status`) VALUES ($id,'$name', '$phone', '$email', '$address1', '$address2', '$country', $pin, '$product_name', '$coupon', $amount,'$date_now','$from_ip', '$from_browser','processing')";

    // echo $query;
    
    if($result = mysqli_query($link, $query))  
    {  
        $data['status'] = 201;
        $data['id'] = $id;
        echo json_encode($data);
    }  
    else  
    {  
        $data['status'] = 601;
        $data['error'] = $link -> error;
        echo json_encode($data);
    } 

}


?>
   