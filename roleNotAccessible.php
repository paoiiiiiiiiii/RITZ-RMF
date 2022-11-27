<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
date_default_timezone_set('Asia/Manila');
$date = date("Y-m-d");
$dateDay = date("l");
$time = date("h:i:sa");
?>

<!DOCTYPE html>
<html>
<head>
    <title>
            RITZ-RMF HARDWARE
    </title>
    <link rel="icon" type="image/png" href="static/images/logo.png">
    <link rel="stylesheet" type="text/css"
            href="main.css">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
	<body>    	
        <div class="w-100% h-100% items-center bg-[#9ed5f0]">
            <div class="rounded-md p-20 pb-5 drop-shadow-2xl">
                <p>You do not have access to this page!</p>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
        </div>
    </body>
</body>

</html>