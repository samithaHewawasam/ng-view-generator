<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" content="1024px, initial-scale=1.0" name="viewport">
  <link href="library/css/bootstrap.min.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="library/css/bootstrap-modal.css" rel="stylesheet">
  <link href="library/css/bootstrap-responsive.css" rel="stylesheet">
  <script src="library/js/jquery.js"></script>
  <script src="library/js/bootstrap.min.js"></script>
  <style type="text/css">
body { 
  background: url(images/bg1.png) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

#center {
margin:50px auto;
}

#date{
position:fixed;
top:10px;
right:10px;
font-size:28px;
}
footer.white {
    background: none repeat scroll 0 0 white;
    height: 50px;
    padding-top: 20px;
    text-align: center;
}
    </style>
   <title>eSoft Computer Studies</title>
</head>

  <body>
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a href="http://www.esoft.lk" class="brand"><img alt="esoft metro campus" src="images/logo.png"></a>
        </div>
      </div>
    </div>
<div id="login-wraper">
            <form class="form login-form" action="loginCheck.php" method="post">
                <legend><span class="blue"><h3>Front Office</h3></span></legend>
            
                <div class="body">
                    <label>Username</label>
                    <input type="text" name="user" autocomplete="off">
                    
                    <label>Password</label>
                    <input type="password" name="pass" autocomplete="off">
                </div>
            
                <div class="footer">
             <button class="btn btn-success" type="submit">Login</button>
                </div>
            
            </form>
        </div>
<footer class="white navbar-fixed-bottom">
      Need a help? <a href="http://www.esoft.lk" class="brand"> Visit our Documentation</a>
    </footer>
  </body>
</html>
