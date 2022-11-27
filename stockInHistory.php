<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$role = $rmf->roleChecker();
$users = $rmf->home();
$generate = $rmf->generateRefNo();
$stockInHistory = $rmf->stockInHistory();

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
                    <div class="justify-self-stretch mx-3 w-3/5 px-4 flex items-center">
                        <a href="stockEntry.php"><p class="text-[2rem] text-[#2986CC] font-bold ml-4 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">STOCK IN</p></a>
                        <p class="text-[2rem] text-[#2986CC] font-bold ml-4 outline outline-offset-1 outline-[#2986CC] rounded-md bg-[#67b0e7] p-2 text-white">STOCK IN HISTORY</p>
                    </div>
                    <div class="justify-self-stretch w-1/5 flex">
                        <a href="dashboard.php">
                            <button class="ml-10 text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/back.png" width="25" height="25" style="  display: block; margin-left: 47px; margin-right: auto;"><p>Back to Dashboard</p>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="w-100% flex h-[32rem]">
                    <div class="justify-self-start w-full bg-[#f0faff] px-5 rounded-bl-lg rounded-br-lg overflow-auto max-h-106">   
                        <table class="justify-self-stretch w-full m-auto ">
                                    <thead class="font-bold text-md bg-[#67b0e7] text-white sticky top-0">
                                        <td class="pl-2 rounded-tl-md py-2">#</td>
                                        <td class="py-2">Reference No.</td>
                                        <td class="py-2">PCode</td>
                                        <td class="py-2">Barcode</td>
                                        <td class="py-2">Description</td>
                                        <td class="py-2">Supplier</td>
                                        <td class="py-2">Stock In Date</td>
                                        <td class="py-2">Quantity</td>
                                        <td class="py-2">Stock In By</td>
                                        <td class="rounded-tr-md">Delete</td>
                                    </thead>
                                <?php if($stockInHistory){ $counter = 0; ?>
                                    <?php foreach($stockInHistory as $stockInHistory1): $counter += 1;?>
                                        <tr>
                                            <td class="py-2 pl-2"><?= $counter ?></td>
                                            <td><?= $stockInHistory1['stockin_id'];?></td>
                                            <td><?= $stockInHistory1['product_code'];?></td>
                                            <td><?= $stockInHistory1['barcode'];?></td>
                                            <td><?= $stockInHistory1['product_name'];?></td>
                                            <td><?= $stockInHistory1['supplier'];?></td>
                                            <td><?= $stockInHistory1['stock_date'];?></td>
                                            <td><?= $stockInHistory1['quantity'];?></td>
                                            <td><?= $stockInHistory1['stock_by'];?></td>
                                            <td><a href="stockInHistory.php?barcode=<?= $stockInHistory1['barcode'];?>&stockInID=<?=$stockInHistory1['stockin_id']?>" onclick="return confirm('Remove Transaction?')"><img src="static/icons/cancel.png" width="23" height="23"></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </table>

                            <?php if(!$stockInHistory1) {?>
                                    <div class="mt-[10rem] text-lg text-[#67b0e7] text-center"><p>NO TRANSACTION YET!</p></div>
                            <?php } ?>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'" onclick="return confirm('Are you sure you want to logout?')"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>