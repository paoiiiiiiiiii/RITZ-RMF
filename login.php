<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$user = $rmf->loginUser();

date_default_timezone_set('Asia/Manila');
$date = date("Y-m-d");
$dateDay = date("l");
$time = date("h:i:sa");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            PART PROJECT
        </title>
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
                            <img src="static/images/logo.png" width="450" height="450">
                        </div>
                        <div class="flex justify-center items-center py-5">
                            <div class="bg-[#ffff] h-4/5 w-4/5 mx-8 rounded-lg px-20 py-5 drop-shadow-lg py-20">
                                <h2 class="text-center text-[#67b0e7] font-bold text-2xl mb-3">LOG IN</h2>
                                
                                <form method="post" action="login.php">
                                    <div class="input-group">
                                        <ul><label class="text-center text-[#a8a8a8] text-md">Email</label></ul>
                                        <input type="text" name="email" class="bg-[#efefef] text-sm text-[#525252] w-full mb-2 p-1 rounded-lg">
                                    </div>
                                    <div class="input-group">
                                        <ul><label class="text-center text-[#a8a8a8] text-md">Password</label></ul>
                                        <input type="password" name="password" class="bg-[#efefef] text-sm text-[#525252] w-full mb-2 p-1 rounded-lg">
                                    </div class="input-group">
                                    <div class="flex justify-center">
                                        <button type="submit" class="w-48 text-md text-white mb-2 rounded-full bg-[#67b0e7] px-4 py-2 text-white hover:bg-[#2986CC] mt-10" name="login_user">
                                            Login
                                        </button>
                                    </div>
                                    <div class="text-[#a8a8a8] pt-4 text-center">New here?
                                        <a href="register.php" class="hover:text-[#2986CC]">Click here to register!</a>
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