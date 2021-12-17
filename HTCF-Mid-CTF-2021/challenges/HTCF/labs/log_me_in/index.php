<?php
session_start();

include('connect.php');

if(isset($_POST['username']) && isset($_POST['password'])) {
  $sql = "SELECT * FROM Users WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'";
  $result = $conn->query($sql);
  if(mysqli_num_rows($result) == 0){
    $status = FALSE;
  }
  else{
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['username'];
    header('Location:flag.php');
    exit();
  }
}
?>

<html>
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="global-container">
	    <div class="card login-form form">
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
          <hr>
          <a id="magic">Magic</a>
		    </div>
        <article class="message is-link is-hidden is-size-4" id="hint">
          <div class="message-body is-family-monospace">
            SELECT * FROM Users WHERE username = '<span class="has-text-danger" id="cmd_username"></span>' AND password = '<span class="has-text-danger" id="cmd_password"></span>';
          </div>
        </article>
      </div>
    </div>
    <script>
        magic.onclick = () => hint.classList.toggle("is-hidden");
        window.onload = inputUsername.oninput = () => cmd_username.textContent = inputUsername.value;
        window.onload = inputPassword.oninput = () => cmd_password.textContent = inputPassword.value;
    </script> 
  </body>
</html>
