<?php
if (isset($_POST['password'])) {
  if ($_POST['password'] === '5572') {
    header('Location: /flag_D1752258C40DBB02.php');
    exit();
  } else {
    $status = FALSE;
  }
}
?>

<html>

<head>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script type="text/javascript" src="js/keyboard.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div id="container">
    <form action="/" method="POST">
      <input type="text" pattern="\d*" class="num_input" name="password" id="passwordInput" maxlength="4">
      <ul id="keyboard">
        <li class="letter" id="letter1">1</li>
        <li class="letter" id="letter2">2</li>
        <li class="letter" id="letter3">3</li>
        <li class="letter clearl" id="letter4">4</li>
        <li class="letter" id="letter5">5</li>
        <li class="letter" id="letter6">6</li>
        <li class="letter clearl" id="letter7">7</li>
        <li class="letter" id="letter8">8</li>
        <li class="letter" id="letter9">9</li>
        <li class="letter clearl" id="letter0">0</li>
        <button type="submit" class="delete lastitem">>>
      </ul>
    </div>
  </div>
  <script>
    document.getElementById("letter1").addEventListener("click", click1);
    document.getElementById("letter2").addEventListener("click", click2);
    document.getElementById("letter3").addEventListener("click", click3);
    document.getElementById("letter4").addEventListener("click", click4);
    document.getElementById("letter5").addEventListener("click", click5);
    document.getElementById("letter6").addEventListener("click", click6);
    document.getElementById("letter7").addEventListener("click", click7);
    document.getElementById("letter8").addEventListener("click", click8);
    document.getElementById("letter9").addEventListener("click", click9);
    document.getElementById("letter0").addEventListener("click", click0);

    function click1() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "1";
    }

    function click2() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "2";
    }

    function click3() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "3";
    }

    function click4() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "4";
    }

    function click5() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "5";
    }

    function click6() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "6";
    }

    function click7() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "7";
    }

    function click8() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "8";
    }

    function click9() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "9";
    }

    function click0() {
      if (document.getElementById("passwordInput").value.length < 4)
        document.getElementById("passwordInput").value += "0";
    }
  </script>
</body>

</html>