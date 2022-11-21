<?php 

require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->registerUser();

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
        <h2>Register</h2>
    </div>
      
    <form method="post" action="register.php">
  
        <div class="input-group">
            <label>Enter Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="input-group">
            <label>Enter Password</label>
            <input type="password" name="password_1" required>
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2" required>
        </div>
        <div class="input-group">
            <label>First Name</label>
            <input type="text" name="fname" required>
        </div>
        <div class="input-group">
            <label>Last Name</label>
            <input type="text" name="lname" required>
        </div>
        <div class="input-group">
            <label>Phone number</label>
            <input type="number" name="phoneNum" required>
        </div>
        <div class="input-group">
            <label>User Role</label>
            <select name="userRole" id="userRole">  
                <option value="admin">Admin</option>  
                <option value="staff">Staff</option>  
            </select>
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="register_user">
                Register
            </button>
        </div>

        <p>
            Already have an account?
            <a href="login.php">
                Login Here!
            </a>
        </p>
 
 
 
    </form>
</body>
</html>