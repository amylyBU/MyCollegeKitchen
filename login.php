<?php   
  if (!isset($_SESSION['user'])) {
    session_start(); 
  } 
?>


<!doctype html>
<html>
  <head>
  <meta charset="utf-8">

  <title>MCK | Log In</title>

  <script src="http://code.jquery.com/jquery-2.1.3.js"></script>
  <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
  <link href="http://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">

  <style>
  * { 
    font-family: Raleway; 
  }

  fieldset h1 {
    color: skyblue;
  }

  .contents {
    text-align: center;
  }

  </style>


  <script>
  $(document).ready(function() {

    $('#getuser').submit(function () {
     return false;
    });

    $('#getuser').on("click", function() {
      $.ajax({
        type: 'POST',
        url: 'getUserFromDB.php?' + $('form').serialize(),
        success: function(res) {
          console.log(res);
          if (res.indexOf("failure") != -1) { // failure
            alert("Sorry, please try again");
          } else {
            console.log("welcome");
            console.log(res);
            alert("Welcome back to My College Kitchen!");
            window.location.href="index.php";
          }
        }
      }); // end ajax call
    }); // end button on-click
  }); // end document ready

  </script>
  </head>

  <body>

  <div class="pure-menu pure-menu-horizontal">
    <a href="index.php" class="pure-menu-heading pure-menu-link">MCK</a>
    <ul class="pure-menu-list">
      <li class="pure-menu-item"><a href="login.php" class="pure-menu-link">Log In</a></li>
      <li class="pure-menu-item"><a href="signup.php" class="pure-menu-link">Sign Up</a></li>
    </ul>
  </div>

<div class='contents'>
    <form class="pure-form">
      <fieldset>
        <h1>Welcome back to My College Kitchen!</h1>
          <input id='email' name="email" type="email" placeholder="Email">
          <input id='password' name="password" type="password" placeholder="Password"><br><br>
          <button type="button" class="pure-button" id="getuser">Sign in</button>
      </fieldset>
    </form>
  </div>
  </body>

</html>