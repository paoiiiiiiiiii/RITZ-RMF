<?php 

require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->verification();

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
    <body class="bg-[#9ed5f0]">    	
        <div class="w-100% h-screen items-center bg-[#9ed5f0]">
            <div class="rounded-md p-20 pb-5 drop-shadow-2xl h-max">
                <div class="w-full flex h-[40rem]">
                    <div class="w-full bg-[#f0faff] rounded-md flex justify-center grid grid-cols-2">
                        <div class="flex justify-center items-center">
                            <img src="static/images/logo2.png" width="700" height="700">
                        </div>
                        <div class="flex justify-center items-center py-5">
                            <div class="bg-[#ffff] h-4/5 w-4/5 mx-8 rounded-lg px-20 py-5 drop-shadow-lg py-20">
                                <h2 class="text-center text-[#67b0e7] font-bold text-2xl mb-3">VERIFICATION</h2>
                                <p class="text-center text-[#545454] mb-5">One - Time Password (OTP) sent to : <b><?= $users ?></b></p>
                                <form method="post" action="verification.php">
                                    <div class="input-group">
                                        <ul><label class="text-center text-[#a8a8a8] text-md">ENTER OTP</label></ul>
                                        <input type="otp" name="otp" required class="bg-[#efefef] text-sm text-[#525252] w-full mb-2 p-1 rounded-lg">
                                    </div>
                                    <div class="flex justify-center">
                                        <button type="submit" name="verify_user" class="w-48 text-md text-white mb-2 rounded-full bg-[#67b0e7] px-4 py-2 text-white hover:bg-[#2986CC] mt-10">
                                            Verify
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
        </div>
    </body>
</html>
