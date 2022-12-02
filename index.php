<?php 
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
            <div class="rounded-md py-10 px-20 pb-5 drop-shadow-2xl h-max">
                <div class="w-full flex h-auto">
                    <div class="w-full bg-[#f0faff] rounded-md flex justify-center grid grid-cols-2">
                        <div class="flex justify-center items-center">
                            <img src="static/images/logo2.png" width="700" height="700">
                        </div>
                        <div class="flex justify-center items-center ">
                            <div class="bg-[#ffff] h-4/5 w-4/5 mx-8 rounded-lg px-20 py-4 drop-shadow-lg py-10">
                                <h2 class="text-center text-[#67b0e7] font-bold text-2xl mb-3">WELCOME!</h2>
                                <p class="text-[#525252] pt-2"><p class="font-bold text-[#67b0e7] text-lg">RITZ - RMF HARDWARE</p> aims to provide you all construction materials Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <!-- <a href="Register.php">Register</a> -->
                                <div class="flex justify-center">
                                    <a href="login.php"><button type="submit" class="w-64 text-md text-white mb-2 rounded-full bg-[#67b0e7] px-4 py-2 text-white hover:bg-[#2986CC] mt-3" name="login_user">
                                        Get Started
                                    </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
        </div>
    </body>
</html>