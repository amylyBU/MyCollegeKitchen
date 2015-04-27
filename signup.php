<?php   
  if (!isset($_SESSION['user'])) {
    session_start(); 
  } 
?>

<!doctype html>
<html>
  <head>
  <meta charset="utf-8">

  <title>MCK | Sign Up</title>

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

    $('#adduser').submit(function () {
     return false;
    });

    $('#adduser').on("click", function() {
      
      $.ajax({
        url: 'addUserToDB.php?' + $('form').serialize(),
        type: 'GET', // get info from the url
        success: function(res) {
          console.log(res);

          if (res.indexOf("success") != -1) {
            console.log("successfully stored user in the database");
            alert("Success! Welcome to My College Kitchen!");
            window.location.href="index.php";

          } else { //failure 
            alert("Sorry, that email already exists.");
            console.log("sorry");
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

<div class="contents">
  <form class="pure-form pure-form-aligned">
    <fieldset>
      <h1>Join My College Kitchen</h1>
        <div class="pure-control-group">
            <label for="fname">First Name</label>
            <input id="fname" type="text" placeholder="First Name" name='fname'>
        </div>
        <div class="pure-control-group">
            <label for="lname">Last Name</label>
            <input id="lname" type="text" placeholder="Last Name" name='lname'>
        </div>

        <div class="pure-control-group">
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Password" name='password'>
        </div>

        <div class="pure-control-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" placeholder="Email Address" name='email'>
        </div>

        <div class="pure-controls">
            <button type="button" class="pure-button" id="adduser">Submit</button>
        </div>
    </fieldset>
</form>

</div>

  </body>

</html>