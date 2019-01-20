<?php

    include('leakyBucket.php');
    include_once('db.php');
    
    // Prevent hacker from bruteforcing our system with commonly used passwords.
    // A leakyBucket-algorithm is setup. It stores every ip, that tries to login. If count > 5, then the ip's in timeout in 30 seconds.
    $ip = getIP();
    $bucket = new DropInTheBucket($ip);
    $count = $bucket->getDropCount($ip);
    if($count < 5){
        
        //only run script if $_POST is set.
        if(isset($_POST['password']) && isset($_POST['username'])){
            
            $pass = htmlentities($_POST['password']);
            $user = htmlentities($_POST['username']);

            if(userExists($pass,$user)){
                
                
                $_SESSION['loggedin'] = 'TRUE';
                header('Location: protected.php');
                $bucket->emptyBucket($ip);

            }
            else {
                
                $_SESSION['error'] = "User dos not exist";
                header('Location: index.php');
            }
        }
        else{
            
            $_SESSION['error'] = "You need to login using the proper site";
            header('Location: index.php');
        }



    }
    else{
        echo $_SESSION['error'] = "Easy now, you need a timeout, server did sleep 10 secs";
        sleep(5);
        $bucket->leak(2,$ip);
        header('Location: index.php');
    }
       
    
    function userExists($pass, $user){

        $db = new db();
        $conn = $db->connect();

        if ( $conn ){
            $sql = "SELECT * FROM `user` WHERE username = '$user' AND password='$pass'";
            $sqlResult = $conn->query($sql);
            $resultArray = $sqlResult->fetch_assoc();
            if($resultArray){
                $_SESSION['username'] = $resultArray['username'];
                return true;
            }
            else return false;

        }
        else return false;

        return false;     

    }
    
    function getIP() {
        $IP = '';
        if (getenv('HTTP_CLIENT_IP')) {
          $IP =getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
          $IP =getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
          $IP =getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
          $IP =getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
          $IP = getenv('HTTP_FORWARDED');
        } else {
          $IP = $_SERVER['REMOTE_ADDR'];
        }
      return $IP;
      }
    

?>