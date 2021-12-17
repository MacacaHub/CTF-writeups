<?php
if(isset($_POST['username']) && isset($_POST['password'])) {
    if($_POST['username'] === 'administrator' && $_POST['password'] === 'the_MoSt_SecUR3_P@ssW0Rd_5aa7e63c1b22') {
        setcookie("user","5aa7e63c1b22");
        header('Location: /flag.php');
        exit();
    }
    else {
        $status = FALSE;
    }
}
?>

<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="global-container">
	    <div class="card login-form">
	      <div class="card-body">
		      <h3 class="card-title text-center">Log In</h3>
		      <div class="card-text">
            <form action="/" method="POST">
              <div class="form-group">
                <label for="inputUsername">Username</label>
                <input type="text" class="form-control form-control-sm" name="username" id="inputUsername">
              </div>
              <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control form-control-sm" name="password" id="inputPassword">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
          </div>
          <div>
            <?php
            if(isset($status))
                echo '<div class="text-danger">Incorrect username or password</div>'
            ?>
          </div>
		  </div>
	  </div>      
  </body>
</html>
