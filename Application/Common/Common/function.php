<?php

function check_result($status,$message,$data=array()){
    $result['status']=$status;
    $result['message']=$message;
    $result['data']=$data;

    die(json_encode($result));

}

