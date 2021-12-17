<html>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div id="container">
    <div class='a'>
      <a href="/flag/flag.php">
        <img alt="monkey" src="./monkey.png" width="200px" height="auto">
      </a>
    </div>
    <div class='b'>
      <a href="/flag/fllag.php">
        <img alt="monkey" src="./monkey.png" width="200px" height="auto">
      </a>
    </div>
    <div class='c'>
      <a href="/flag/flllag.php">
        <img alt="monkey" src="./monkey.png" width="200px" height="auto">
      </a>
    </div>
    <div class='d'>
      <a href="/flag/fllllag.php">
        <img alt="monkey" src="./monkey.png" width="200px" height="auto">
      </a>
    </div>
    <div class='e'>
      <a href="/flag/flllllag.php">
        <img alt="monkey" src="./monkey.png" width="200px" height="auto">
      </a>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      animateDiv($('.a'));
      animateDiv($('.b'));
      animateDiv($('.c'));
      animateDiv($('.d'));
      animateDiv($('.e'));
    });

    function makeNewPosition($container) {

      // Get viewport dimensions (remove the dimension of the div)
      var h = $(window).height() - 100;
      var w = $(window).width() - 100;

      var nh = Math.floor(Math.random() * h);
      var nw = Math.floor(Math.random() * w);

      return [nh, nw];

    }

    function animateDiv($target) {
      var newq = makeNewPosition($target.parent());
      var oldq = $target.offset();
      var speed = calcSpeed([oldq.top, oldq.left], newq);

      $target.animate({
        top: newq[0],
        left: newq[1]
      }, speed, function() {
        animateDiv($target);
      });

    };

    function calcSpeed(prev, next) {

      var x = Math.abs(prev[1] - next[1]);
      var y = Math.abs(prev[0] - next[0]);

      var greatest = x > y ? x : y;

      var speedModifier = 0.1;

      var speed = Math.ceil(greatest / speedModifier);

      return speed;

    }
  </script>
</body>

</html>