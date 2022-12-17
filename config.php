<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'asianocean';

    // $servername = '194.195.116.19';
    // $username = 'hilltopa_asianoceanadmin';
    // $password = 'asianocean@@12345';
    // $db = 'hilltopa_asianocean';

    //create connection
    $conn = mysqli_connect($servername,$username,$password,$db);
            
    //check connection
    if(!$conn){
        die("connection faild".mysqli_connect_error());
    }

?>