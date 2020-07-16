<?php
// Config and Connect
header('Access-Control-Allow-Origin: *');
error_reporting(E_ALL);
ini_set('display_errors', 'on');
$link = mysqli_connect('localhost', 'root', '', 'weather');
$arr = [];


// Checking Connection
if ($link -> ping()) {
    $arr['connected'] = true;
} else {
    $arr['connected'] = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arr['name'] = $_POST['name'];
    $arr['action'] = $_POST['action'];
}


// Response to GET action 

if($arr['action']=='GET'){
    $sqlget = $link->prepare("SELECT * FROM `city` c JOIN `temp` t on t.t_city_id=c.c_id JOIN `wind` w on w.w_city_id=c.c_id WHERE c.c_city_name= '".$arr['name']."'");
    $sqlget -> execute();
    $result= $sqlget -> get_result();
    $data=[];
    if($result -> num_rows > 0){
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        $arr['response']=$data;
        }
}

// Response to ADD action

if($arr['action']=='ADD'){
    $arr['name']=$_POST['name'];
    $arr['datetime']=$_POST['datetime'];
    $arr['mintemp']=$_POST['mintemp'];
    $arr['maxtemp']=$_POST['maxtemp'];
    $arr['windspeed']=$_POST['windspeed'];

    // Query to add into table, If taken it Updates.
    
    $sql1= $link->prepare("INSERT INTO `city` (`c_id`, `c_city_name`, `created_at`, `updated_at`) VALUES (NULL, '".$arr['name']."' , current_timestamp(), current_timestamp())
    ON DUPLICATE KEY UPDATE `updated_at`=current_timestamp()");
    $sql1 -> execute();
    $arr['cityid']= mysqli_insert_id($link);
    $sql2= $link->prepare("REPLACE INTO `temp` (`t_id`, `t_temp_max`, `t_temp_min`, `t_date_time`, `t_city_id`) VALUES (NULL, '".$arr['mintemp']."', '".$arr['maxtemp']."','".$arr['datetime']."','".$arr['cityid']."' )");
    $sql2 -> execute();
    $sql3= $link->prepare("REPLACE INTO `wind` (`w_id`, `w_speed`, `w_city_id`) VALUES (NULL, '".$arr['windspeed']."', '".$arr['cityid']."' )");
    if($sql3 -> execute()){
        $arr['message']="Successfully Saved ! ";
    }else{
        $arr['message']="Something wrong..";
    }
    
}
echo json_encode($arr); ?>