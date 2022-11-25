<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
$changePass= $rmf->changePassword();

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
        <div class="w-100% h-100% items-center bg-[#9ed5f0]">
            <div class="rounded-md p-20 pb-5 drop-shadow-2xl">
                <div class="bg-[#eaf8ff] flex rounded-t-lg p-5 pb-2 divide-x-4 divide-[#67b0e7]">
                    <div class="justify-self-start w-1/5 flex items-center">
                        <div>
                            <img src="static/images/logo.png" height="80" width="80">
                        </div>
                        <div class="px-2">
                            <p class="text-lg font-bold"><?= $users['fname'];?> <?= $users['lname'];?></p>
                            <p class="text-sm"><?= $users['role'];?></p>
                        </div>
                    </div>
                    <div class="justify-self-stretch mx-1 w-3/5 px-2 flex items-center">
                        <p class="text-[2rem] text-[#2986CC] font-bold ml-4">USER SETTINGS - CHANGE PASSWORD</p>
                    </div>
                    <div class="justify-self-stretch w-1/5 flex">
                        <a href="dashboard.php">
                            <button class="ml-10 text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/cart.png" width="25" height="25" style="  display: block; margin-left: 42px; margin-right: auto;"><p>Back to Dashboard</p>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="w-full flex h-[32rem]">
                    <div class="w-full bg-[#f0faff] px-5 rounded-bl-lg overflow-auto max-h-106 flex justify-center">
                        <div class="flex h-64 pt-10 mt-10">
                            <form class="grid grid-rows-4" method="post" action="userSettings.php">
                                <ul>
                                    <label class="text-[#2986CC] text-lg mr-40"><b>Email: </b></label>
                                    <input type="email" name="email" required class="outline outline-offset-2 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-1"></input>
                                </ul>
                                
                                <ul>
                                    <label class="text-[#2986CC] text-lg mr-20"><b>Old Password:</b></label>
                                    <input type="password" name="oldPassword" required class="outline outline-offset-2 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-3"></input>
                                </ul>

                                <ul>
                                    <label class="text-[#2986CC] text-lg mr-20"><b>New Password: </b></label>
                                    <input type="password" name="newPassword" required class="outline outline-offset-2 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-1"></input>
                                </ul>

                                <ul>
                                    <label class="text-[#2986CC] text-lg mr-2"><b>Re-type New Password: </b></label>
                                    <input type="password" name="newPassword1" required class="outline outline-offset-2 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-1"></input>
                                </ul>

                                <ul class="flex justify-center">
                                    <button type="submit" name="save" class="text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-32">Save</button>
                                </ul>
                                <ul><?= $changePass ?></ul>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-2 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>