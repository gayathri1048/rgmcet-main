<?php    
    // include 'dbconnect.php';
    require('config.php');
    $conn = mysqli_init();
    mysqli_ssl_set($conn,NULL,NULL,$sslcert,NULL,NULL);
    if(!mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL)){
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }

    if($_SERVER['REQUEST_METHOD']=='POST')
      {
          $firstname=ucfirst($_POST["fname"]);
          $lastname=ucfirst($_POST["lname"]);
          $gender=$_POST['gender'];
          $collegeid=strtoupper($_POST["collegeid"]);
          $phoneno=$_POST["phone"];
          $email=$_POST["email"];
          $collegename=$_POST["collegename"];
          $branch=$_POST["dept"];
          $year=$_POST['year'];
          $event=$_POST['event'];
          if(!empty($firstname) && !empty($lastname) && !empty($collegeid) && !empty($phoneno) && !empty($email) && !empty($collegename) && !empty($branch) && !empty($year) && !empty($event))
          {
                $query = "SELECT `email` FROM `registrations` WHERE `events` = '$event' and `collegeid` = '$collegeid'";
                if($query_run = mysqli_query($mycon,$query))
                {
                    $num_rows = mysqli_num_rows($query_run);
                    if($num_rows == 1)
                    {
                        echo "<script>alert('User is already Registered for this event!')</script>";
                        // session_unset();
                         
                    
                        
                    }
                    else if($num_rows == 0){
                        $query = "INSERT INTO registrations VALUES ('$firstname','$lastname','$gender','$collegeid','$phoneno','$email','$collegename','$year','$branch','$event')";
                        if($query_run = mysqli_query($mycon,$query)){
                            echo "<script>alert('Successfully Registered')</script>";

                            // session_destroy();
                            header('Location: ../frontend/Successful.php');

                        }
                    }
                }
          }
        }

      
?>
