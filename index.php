<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Signin Template · Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }
1
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
    <body class="text-center">
        <div class="container">
        <?php 
            session_start();
            if(isset($_SESSION['error'])){
                echo '<div class="alert alert-danger" role="alert">';
                echo  $_SESSION['error'];        
                echo '</div>';
                unset($_SESSION['error']);

            }
            elseif(isset($_SESSION['msg'])){
                echo '<div class="alert alert-warning" role="alert">';
                echo  $_SESSION['msg'];        
                echo '</div>';
                unset($_SESSION['msg']);
            } 
            ?>
        <form class="form-signin" action="login.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="username" required autofocus>
            
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            
            <div class="row justify-content-around">          
                <button class="btn btn-sm btn-primary" type="submit">Sign in</button>
                <button class="btn btn-sm btn-success" type="submit">Create user</button>
            </div>
            <p class="mt-5 mb-3 text-muted">Loginsystem @ Rune Heidtmann</p>
        </form>
        </div>
    </body>
</html>
