<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->loginUser();
?> 

<!DOCTYPE html>
<html>
<head>
    <title>
        RITZ-RMF Hardware
    </title>
     
    <link rel="stylesheet" type="text/css"
            href="style.css">

    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="header">
        <h2>Login Here!</h2>
    </div>
      
    <form method="post" action="login.php">
  
        <div class="input-group">
            <label>Enter email</label>
            <input type="text" name="email" >
        </div>
        <div class="input-group">
            <label>Enter Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn"
                        name="login_user">
                Login
            </button>
        </div>
         
 
 
<p>
            New Here?
            <a href="register.php">
                Click here to register!
            </a>
        </p>
 
 
 
    </form>
</body>
 
</html>