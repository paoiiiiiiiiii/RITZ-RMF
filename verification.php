<?php 

require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->verification();

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
        <h2>VERIFY YOUR EMAIL</h2>
    </div>
      
    <form method="post" action="verification.php">
  
        <div class="input-group">
            <label>Enter OTP</label>
            <input type="otp" name="otp" required>
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="verify_user">
                Verify
            </button>
        </div>
    </form>
</body>
</html>