<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$role = $rmf->roleChecker();
$message = $rmf->message();
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
            <div class="rounded-md py-10 px-20 pb-5 drop-shadow-2xl">
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
                    <div class="justify-self-stretch w-1/5 flex items-center justify-center">
                        <a href="dashboard.php">
                            <button class="text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/back.png" width="25" height="25" style="  display: block; margin-left: 47px; margin-right: auto;"><p>Back to Dashboard</p>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="w-full flex h-[30rem]">
                    <div class="w-full bg-[#f0faff] px-5 rounded-bl-lg overflow-auto max-h-106 flex justify-center items-center grid grid-cols-4 grid-rows-2">
                        <div></div>
                        <div class="flex h-64 pt-10 mt-10 col-span-2 justify-center items-center">
                            <form class="grid grid-cols-2" method="post" action="userSettings.php">
                                    <label class="text-[#2986CC] text-lg"><b>Email: </b></label>
                                    <div class="px-1 py-1">
                                        <input type="email" name="email" required class="rounded-md bg-[#efefef] p-1 col-span-2 text-sm w-full"></input>
                                    </div>

                                    <label class="text-[#2986CC] text-lg"><b>Old Password:</b></label>
                                    <div class="px-1 py-1">
                                        <input type="password" name="oldPassword" required class="rounded-md bg-[#efefef] p-1 col-span-2 text-sm w-full"></input>
                                    </div>
                                    
                                    <label class="text-[#2986CC] text-lg"><b>New Password: </b></label>
                                    <div class="px-1 py-1">
                                        <input type="password" name="newPassword" minlength="8" required class="rounded-md bg-[#efefef] p-1 col-span-2 text-sm w-full" placeholder="(Min. of 8 characters)"></input>
                                    </div>

                                    <label class="text-[#2986CC] text-lg"><b>Re-type New Password: </b></label>
                                    <div class="px-1 py-1">
                                        <input type="password" name="newPassword1" minlength="8" required class="rounded-md bg-[#efefef] p-1 col-span-2 text-sm w-full" placeholder="(Min. of 8 characters)"></input>
                                    </div>   

                                    <div class="px-1 py-1 col-span-2 flex justify-center items-center">
                                        <button type="submit" name="save" class="text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-32">Save</button>
                                    </div>

                                </form>
                        </div>
                        <div>
                        </div>
                        <div>
                        </div>
                        <?php if ($message) { ?>
                            <?php if ($message == "CHANGE PASSWORD SUCCESSFUL!") {?>
                                <div class="col-span-2 bg-[#1bcb00] rounded-md pl-3 h-8 py-2 w-full flex justify-center">
                                    <p onclick="this.parentElement.style.display='none';" class="text-white cursor-pointer text-sm"><?= $message ?></p>                                            
                                </div>
                            <?php } else { ?>
                                <div class="col-span-2 bg-[#ff6363] rounded-md pl-3 h-8 py-2 w-full flex justify-center">
                                    <p onclick="this.parentElement.style.display='none';" class="text-white cursor-pointer text-sm"><?= $message ?></p>                                            
                                </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'" onclick="return confirm('Are you sure you want to logout?')"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>