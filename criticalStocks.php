<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
$role = $rmf->roleChecker();
$criticalStock= $rmf->criticalStocks();

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
                        <a href="topSelling.php" ><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">TOP SELLING</p></a>
                        <a href="soldItems.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">SOLD ITEMS</p></a>
                        <a href="criticalStocks.php"><p class="text-xs ml-3 text-[#2986CC] font-bold outline outline-offset-1 outline-[#2986CC] rounded-md bg-[#67b0e7] p-2 text-white">CRITICAL STOCKS</p></a>
                        <a href="inventoryList.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">INVENTORY LIST</p></a>
                        <a href="cancelledItems.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer ">CANCELLED ITEMS</p></a>
                        <a href="stockInRecord.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">STOCK IN HISTORY</p></a>
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
                    <div class="justify-self-start w-full bg-[#f0faff] px-5 rounded-bl-lg overflow-auto max-h-106">
                        <div class="mt-3 w-full flex">
                            <form class="w-4/5">
                            </form>

                            <div class="w-1/5">
                                <a href="criticalStocksPrint.php"><button class=" w-full rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Print</button></a>
                            </div>
                        </div>   


                        <table class="justify-self-stretch w-full m-auto mt-3">
                                    <thead class="font-bold text-md bg-[#67b0e7] text-white sticky top-0">
                                        <td class="pl-2 rounded-tl-md py-2">#</td>
                                        <td class="py-2">PCode</td>
                                        <td class="py-2">Barcode</td>
                                        <td class="py-2">Description</td>
                                        <td class="py-2">Brand</td>
                                        <td class="py-2">Re-order</td>
                                        <td class="py-2">Stock On Hand</td>
                                        <td class="rounded-tr-md">Classification</td>
                                    </thead>
                                <?php if($criticalStock){ $counter = 0; ?>
                                    <?php foreach($criticalStock as $criticalStocks): $counter += 1;?>
                                        <tr>
                                            <td class="py-2 pl-2"><?= $counter ?></td>
                                            <td><?= $criticalStocks['product_code'];?></td>
                                            <td><?= $criticalStocks['barcode'];?></td>
                                            <td><?= $criticalStocks['product_name'];?></td>
                                            <td><?= $criticalStocks['product_brand'];?></td>
                                            <td>50</td>
                                            <td class="text-[#f44336]" ><?= $criticalStocks['quantity'];?></td>
                                            <?php if ($criticalStocks['quantity'] == 0) { ?>
                                                <td><p class="text-[#f44336]">Out of Stock</p></td>
                                            <?php } else { ?>
                                                <td class="text-[#f44336]">Under Stock</td>
                                            <?php } ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                        </table>

                        <?php if(!$criticalStock) {?>
                            <div class="mt-[10rem] text-lg text-[#67b0e7] text-center"><p>NO CRITICAL STOCKS YET!</p></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'" onclick="return confirm('Are you sure you want to logout?')"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>