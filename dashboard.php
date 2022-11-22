<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();

date_default_timezone_set('Asia/Manila');
$date = date("Y-m-d");
$dateDay = date("l");
$time = date("h:i:sa");
$sales = $rmf->getMonthlySales();
$inventory = $rmf->getProductLine();
$stocks = $rmf->getStocksOnHand();
$criticalItems = $rmf->getCriticalItems();
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
<body>
	<body>    	
        <div class="w-100% h-100% items-center bg-[#9ed5f0]">
            <div class="rounded-md p-20 pb-5 drop-shadow-2xl">
                <div class="bg-[#eaf8ff] flex rounded-t-lg p-5 divide-x-4 divide-[#67b0e7]">
                    <div class="justify-self-start w-1/5 flex items-center">
                        <div>
                            <img src="static/images/logo.png" height="80" width="80">
                        </div>
                        <div class="px-2">
                            <p class="text-lg font-bold"><?= $users['fname'];?> <?= $users['lname'];?></p>
                            <p class="text-sm"><?= $users['role'];?>/owner</p>
                        </div>
                    </div>
                    <div class="justify-self-stretch mx-3 w-3/5 px-4">
                        <p class="text-center text-[2rem]"><b>RITZ - RMF HARDWARE</b></p>
                        <p class="text-center"><b>INVENTORY AND POS SYSTEM</b></p>
                    </div>
                    <div class="justify-self-stretch w-1/5">
                    </div>
                </div>
                

                <div class="w-100% flex h-[32rem]">
                    <div class="justify-self-start w-full bg-[#f0faff] rounded-b-lg px-5 max-h-106 flex grid grid-rows-2">
                        <div class="flex w-full">
                            <div class="flex-1 items-center bg-[#1bcb00] text-white rounded-md h-[8rem] mx-3 my-5 text-center py-12">Monthly Sales <?= $sales ?></div>
                            <div class="flex-1 items-center bg-[#00b9e5] text-white rounded-md h-[8rem] mx-3 my-5 text-center py-12">Product Line <?= $inventory ?></div>
                            <div class="flex-1 items-center bg-[#f8de00] text-white rounded-md h-[8rem] mx-3 my-5 text-center py-12">Stocks on Hand <?= $stocks ?></div>
                            <div class="flex-1 items-center bg-[#ff6363] text-white rounded-md h-[8rem] mx-3 my-5 text-center py-12">Critical Items <?= $criticalItems ?></div>
                        </div>
                        <div class="grid grid-cols-3 w-4/5 ml-14">
                            <a href="adminProducts.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center py-5">Products</div></a>
                            <a href="suppliers.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center py-5">Suppliers</div></a>
                            <a href="stockEntry.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center py-5">Stock Entry</div></a>
                            <a href="topSelling.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center py-5">Records</div></a>
                            <a href="salesHistory.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center py-5">Sales History</div></a>
                            <a href="userSettings.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center py-5">User Settings</div></a>
                        </div>
                    </div>
                </div>
                
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>
</body>
 
</html>