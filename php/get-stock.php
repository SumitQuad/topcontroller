<?php


$link = mysqli_connect("localhost", "root", "", "thetopcontroller");

if (mysqli_connect_error()){
    die("<script>console.log('There is a problem with mysql connection')</script>");
}

if(isset($_POST['product_name'])){

    $data = array();  
    $product_name = $_POST['product_name'];
    
    $query = "SELECT `left_inventory`, `total_inventory` FROM `inventory` WHERE `product_name` = '$product_name'";

    if($result = mysqli_query($link, $query))  
    { 
        while ($row = mysqli_fetch_array($result)) {
            $left_stock = $row[0]; 
            $total_stock = $row[1];
        } 
        $data['status'] = 'ok';
        $data['left_stock'] = $left_stock;
        $data['total_stock'] = $total_stock;
        echo json_encode($data);
    }  
    else  
    {  
       echo "<script>console.log('error','problem with query after signup1')</script>"; 
    } 

}

?>
   