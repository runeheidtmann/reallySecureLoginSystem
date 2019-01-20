<?php
session_start();
echo $_SESSION['count'];
echo $_SESSION['username'];
echo $_SESSION['loggedin'];

if($_SESSION['loggedin'] === 'TRUE'){
    
    echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <h1> Du er nu logget ind!  </h1>';
        echo $_SESSION['count']; 
        echo '
        <form action="logout.php" method="get">

  <button type="submit">logud</button><br>
</form>
    </div>
</body>
</html>';
}
else{
            session_start();
            $_SESSION['error'] = "Du skal være logget ind";
          
            header('Location: index.php');
    }

?>