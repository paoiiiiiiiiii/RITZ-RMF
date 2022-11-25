<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
$cancelledItem = $rmf->cancelledItems();

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
                        <a href="topSelling.php" ><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">TOP SELLING</p></a>
                        <a href="soldItems.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">SOLD ITEMS</p></a>
                        <a href="criticalStocks.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer ">CRITICAL STOCKS</p></a>
                        <a href="inventoryList.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">INVENTORY LIST</p></a>
                        <a href="cancelledItems.php"><p class="text-xs ml-3 text-[#2986CC] font-bold outline outline-offset-1 outline-[#2986CC] rounded-md bg-[#67b0e7] p-2 text-white ">CANCELLED ITEMS</p></a>
                        <a href="stockInRecord.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">STOCK IN HISTORY</p></a>
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
                    <div class="justify-self-start w-full bg-[#f0faff] px-5 rounded-bl-lg overflow-auto max-h-106">
                        <div class="mt-3 w-full flex">
                            <form class="w-2/5">
                                <label class="text-md text-[#2986CC] mt-2">From</label>
                                <input type="date" name="from" class="ml-2 outline outline-offset-2 outline-[#2986CC] rounded-md"></input>
                                <label class="ml-2 text-md text-[#2986CC] mt-2">To</label>
                                <input type="date" name="to" class="ml-2 outline outline-offset-2 outline-[#2986CC] rounded-md"></input>
                                <button type="submit" name="betweenDates" class="ml-1 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Filter</button>
                            </form>
  
                            <form method="post" action="cancelledItems.php" class="w-1/5">
                                <input type="text" name="searchTag" placeholder="Search Barcode" class="w-32 outline outline-offset-2 outline-[#2986CC] rounded-md text-sm bg-transparent text-md text-[#2986CC]" required></input>
                                <button type="submit" name="searchProduct" class="ml-2 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm">Search</button>
                            </form>

                            <div class="w-1/5">
                                <a href="cancelledItems.php"><button class="w-24 ml-2 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm">All</button></a>
                            </div>
                            <div class="w-1/5">
                                <a href=""><button class=" w-24 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Print</button></a>
                            </div>
                        </div>   


                        <table class="justify-self-stretch w-full m-auto mt-3">
                                    <thead class="font-bold text-md bg-[#67b0e7] text-white sticky top-0">
                                        <td class="pl-2 rounded-tl-md py-2">#</td>
                                        <td class="py-2">Trans No.</td>
                                        <td class="py-2">Barcode</td>
                                        <td class="py-2">Description</td>
                                        <td class="py-2">Brand</td>
                                        <td class="py-2">Price</td>
                                        <td class="py-2">Quantity</td>
                                        <td class="py-2">Total</td>
                                        <td class="py-2">Date</td>
                                        <td class="py-2">Void By</td>
                                        <td class="rounded-tr-md">Action</td>
                                    </thead>
                                <?php if($cancelledItem){ $counter = 0; ?>
                                    <?php foreach($cancelledItem as $cancelledItems): $counter += 1;?>
                                        <tr>
                                            <td class="py-2 pl-2"><?= $counter ?></td>
                                            <td><?= $cancelledItems['transaction_id'];?></td>
                                            <td><?= $cancelledItems['barcode'];?></td>
                                            <td><?= $cancelledItems['product_name'];?></td>
                                            <td><?= $cancelledItems['product_brand'];?></td>
                                            <td><?= $cancelledItems['price'];?></td>
                                            <td><?= $cancelledItems['quantity_cancelled'];?></td>
                                            <td><?= $cancelledItems['total_cancelled'];?></td>
                                            <td><?= $cancelledItems['date'];?></td>
                                            <td><?= $cancelledItems['void_by'];?></td>
                                            <td><?= $cancelledItems['action'];?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                        </table>

                        <?php if(!$cancelledItem) {?>
                            <div class="mt-[10rem] text-lg text-[#67b0e7] text-center"><p>NO PRODUCT!</p></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-2 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>