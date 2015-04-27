<?php   
  if (!isset($_SESSION['user'])) {
    session_start(); 
  }
?>


<!doctype html>
<html>
  <head>
  <meta charset="utf-8">

  <title>MCK | My College Kitchen</title>

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

  .search-bar-container {
    color: black;
    height: 420px;
    width: 100%;
    background-image: url('headerimage.jpg');
    background-size: cover;
    background-repeat: no-repeat;
  }

  .search-bar-container h1 {
    margin-top: 80px;
  }

  .search-bar-container p a {
    text-decoration: none;
  }

  .search-bar-container #search-bar {
    position: relative;
    width: 400px;
    height: 30px;
    text-align: center;
    border: 1px solid gray;
    margin: 0 auto;
  }

  .search-results-container {
    margin-left: 1in;
    margin-right: 1in;
    text-align: center;
  }

  #search-bar1,
  #search-bar2,
  #search-bar3 {
    border: 2px solid yellow;
  }
  </style>

  <script>

    function clear() {
      $('.search-results-container').html('');
    }

    $(document).ready(function() {
      $('#search').on("click", function() {

        clear();
          // make ajax call
        var apiKey = "dvxOPQNuVU3ist8Y9DsIRoHxRL3bB63K";
        var key1 = document.getElementById("search-bar1").value;
        var key2 = document.getElementById("search-bar2").value;
        var key3 = document.getElementById("search-bar3").value;
        var titleKeyword = key1 + " " + key2 + " " + key3;
        var url = "http://api.bigoven.com/recipes?pg=1&rpp=25&any_kw="
                  + titleKeyword
                  + "&api_key="+ apiKey;
        
        $.ajax({
            type: "GET",
            dataType: 'json',
            cache: false,
            url: url,
            success: function (data) {
              console.log(data);
            // append the results (in divs) to the search bar container

            $('.search-results-container').append("<br><h1>Search results for <span style='color: red;'>" + titleKeyword + '</span></h1><br>');
            for(var i = 0; i < data.Results.length; i++ ) { // scan through the results array of length 25
                
                var title = "";
                if (data.Results[i].Title != "null") {
                  title += data.Results[i].Title;
                } else {
                  title += "Unnamed";
                }

                $('.search-results-container').append('<div style="float:left; width:180px; height: 220px; overflow:hidden;">' + title + 
                    '<br><a href=' + data.Results[i].WebURL + '><img src=' + data.Results[i].ImageURL120 + '></a></div>');

              } // end for loop 
            } // end success case
        });
      });
    });


  </script>

  <style>
  .float-right {
    float: right;
  }
  </style>
  </head>


  <body>

  <div class="pure-menu pure-menu-horizontal">
    <a href="homepage.html" class="pure-menu-heading pure-menu-link">MCK</a>
    <ul class="pure-menu-list">
    <?php if (!isset($_SESSION['user'])) { 
        echo '<li class="pure-menu-item"><a href="login.php" class="pure-menu-link">Log In</a></li>';
        echo '<li class="pure-menu-item"><a href="signup.php" class="pure-menu-link">Sign Up</a></li>';
    } if (isset($_SESSION['user'])) {
      echo '<li class="pure-menu-item">Hello, '.$_SESSION['user'].'!</li>';
    }
    ?>
    </ul>
    <ul class="pure-menu-list float-right">
      <?php 
          if (isset($_SESSION['user'])) { 
            echo '<li><a href="logout.php" class="pure-menu-link">Log out</a></li>';
        } ?>
    </ul>
  </div>

  <div class="search-bar-container" id="search-bar-container">
    <br>
    <center><h1>My College Kitchen</h1></center>
    <center><input id="search-bar1" placeholder="ingredient No.1" type='text' autofocus>
    <input id="search-bar2" placeholder="ingredient No.2" type='text'>
    <input id="search-bar3" placeholder="ingredient No.3" type='text'></center>
    <br>
    <center><button class='pure-button' id="search">Search</button></center>

    <center><p>*recipes brought to you by <a href="http://www.bigoven.com/">BigOven</a></p></center>
  </div>

  <div class="search-results-container" id="search-results-container">
  </div>

  </body>

</html>