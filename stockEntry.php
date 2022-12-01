<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
$role = $rmf->roleChecker();
$generate = $rmf->generateRefNo();
$session = $rmf->refSessionChecker();
$stock = $rmf->stockIn();
$presentStock = $rmf->presentStockIn();

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
            <div class="rounded-md py-5 px-20 pb-5 drop-shadow-2xl">
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
                        <p class="text-[2rem] text-[#2986CC] font-bold ml-4 outline outline-offset-1 outline-[#2986CC] rounded-md bg-[#67b0e7] p-2 text-white">STOCK IN</p>
                        <a href="stockInHistory.php"><p class="text-[2rem] text-[#2986CC] font-bold ml-4 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">STOCK IN HISTORY</p></a>
                    </div>
                    <div class="justify-self-stretch w-1/5 flex">
                        <a href="dashboard.php">
                            <button class="ml-10 text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/back.png" width="25" height="25" style="  display: block; margin-left: 47px; margin-right: auto;"><p>Back to Dashboard</p>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="bg-[#f0faff] p-2 px-5 ">
                <div class="bg-[#67b0e7] flex p-2 px-5 grid grid-cols-3 rounded-md">
                    <div class="col-span-2 flex items-center grid grid-rows-4">
                        <div class="">
                            <form method="post" action="stockEntry.php" class="grid grid-cols-6">
                                <label class="text-white text-sm"><b>Reference No: </b></label>
                                <input type="text" name="refNo" class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "<?= $session?>" disabled>
                                <?php if (!$session) {?>
                                    <button class="ml-1 text-xs text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] mb-1" type="submit" name="generate">Generate</button>
                                <?php } else { ?>
                                    <button class="ml-1 text-xs text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] mb-1" type="submit" name="generate" disabled>Generate</button>
                                <?php } ?>
                            
                        </div>

                        <div class="grid grid-cols-6">
                            <label class="text-white text-sm"><b>Stock in by: </b></label>
                            <input type="text" name="name" class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "<?= $users['fname'];?> <?= $users['lname'];?>" hidden>
                            <input type="text" name="show" class="rounded-md bg-[#efefef] p-1 text-sm mb-1 col-span-2" placeholder = "<?= $users['fname'];?> <?= $users['lname'];?>" disabled>
                            </form>
                        </div>

                        <div class="grid grid-cols-6 text-center">
                            <a href="adminProducts.php" class="col-span-3 text-sm text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] mb-1 p-1"><button class="">View Products</button></a>
                        </div>
                        <div class="">
                            <form method="post" action="stockEntry.php" class="grid grid-cols-6">
                            <input type="text" name="pcode" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" placeholder="Product Code">
                            <input type="text" name="barcode" required class="ml-1 rounded-md bg-[#efefef] p-1 text-sm mb-1" placeholder="Barcode">
                            <input type="text" name="desc" required class="ml-1 col-span-2 rounded-md bg-[#efefef] p-1 text-sm mb-1" placeholder="Description">
                            <input type="number" name="quantity" required class="ml-1 rounded-md bg-[#efefef] p-1 text-sm mb-1" placeholder="Quantity">
                            <button type="submit" name="addStock" class="ml-1 text-xs text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] mb-1">Add Product</button>                       
                        </div>
                    </div>

                    <div class="col-span-1 px-4 flex items-center grid grid-rows-4 grid-cols-2">
                            <label class="text-white text-sm"><b>Supplier: </b></label>
                            <input type="text" name="supplier" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "">

                            <label class="text-white text-sm"><b>Contact Person: </b></label>
                            <input type="text" name="contactPerson" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "">

                            <label class="text-white text-sm"><b>Address: </b></label>
                            <input type="text" name="address" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "">
                            </form>

                            <form method="post" action="stockEntry.php" class="col-span-2 grid grid-cols-3">
                                <div></div>
                                <div></div>
                                <button class="w-full rounded-lg bg-[#1bcb00] text-white hover:bg-[#159d00] p-1 text-sm" type="submit" name="save">Save</button>
                            </form>
                    </div>
                </div>
                </div>

                <div class="w-100% flex h-[20rem]">
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
                                <?php if($presentStock){ $counter = 0; ?>
                                    <?php foreach($presentStock as $presentStockIn): $counter += 1;?>
                                        <tr>
                                            <td class="py-2 pl-2"><?= $conter ?></td>
                                            <td><?= $presentStockIn['stockin_id'];?></td>
                                            <td><?= $presentStockIn['product_code'];?></td>
                                            <td><?= $presentStockIn['barcode'];?></td>
                                            <td><?= $presentStockIn['product_name'];?></td>
                                            <td><?= $presentStockIn['supplier'];?></td>
                                            <td><?= $presentStockIn['stock_date'];?></td>
                                            <td><?= $presentStockIn['quantity'];?></td>
                                            <td><?= $presentStockIn['stock_by'];?></td>
                                            <td><a href="stockEntry.php?barcode=<?= $presentStockIn['barcode'];?>" onclick="return confirm('Remove Transaction?')"><img src="static/icons/cancel.png" width="23" height="23"></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </table>

                            <?php if(!$presentStock) {?>
                                    <div class="mt-[6rem] text-lg text-[#67b0e7] flex text-center justify-center"><p>NO TRANSACTION YET!</p></div>
                            <?php } ?>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'" onclick="return confirm('Are you sure you want to logout?')"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>