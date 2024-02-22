<?php
    require('config.php');
    $conn = mysqli_init();
    mysqli_ssl_set($conn,NULL,NULL,$sslcert,NULL,NULL);
    if(!mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL)){
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }
    // else{
    //     echo "Connected to MySQL";
    // }

    $res = mysqli_query($conn, "SHOW TABLES LIKE 'registrations'");

    if (mysqli_num_rows($res) <= 0) {
        //Create table if it does not exist
        $sql = file_get_contents("registrations.sql");
        if(!mysqli_query($conn, $sql)){
            die('Table Creation Failed');
        }
    }

?>