<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
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
            PART PROJECT
        </title>
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
                        <p class="text-[2rem] text-[#2986CC] font-bold ml-4 outline outline-offset-1 outline-[#2986CC] rounded-md bg-[#67b0e7] p-2 text-white">STOCK IN</p>
                        <a href="stockInHistory.php"><p class="text-[2rem] text-[#2986CC] font-bold ml-4 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">STOCK IN HISTORY</p></a>
                    </div>
                    <div class="justify-self-stretch w-1/5 flex">
                        <a href="dashboard.php">
                            <button class="ml-10 text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/cart.png" width="25" height="25" style="  display: block; margin-left: 42px; margin-right: auto;"><p>Back to Dashboard</p>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="bg-[#eaf8ff] flex p-2 px-5">
                    <div class="justify-self-start w-3/5 flex items-center grid grid-rows-4">
                        <div>
                            <form method="post" action="stockEntry.php">
                                <label class="text-[#2986CC] text-sm"><b>Reference No: </b></label>
                                <input type="text" name="refNo" class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-45 ml-3 px-2" value = "<?= $session?>" disabled>
                                <?php if (!$session) {?>
                                    <button class="w-20 text-sm text-white rounded-lg bg-[#67b0e7] p-1 mt-1 text-white hover:bg-[#2986CC]" type="submit" name="generate">Generate</button>
                                <?php } else { ?>
                                    <button class="w-20 text-sm text-white rounded-lg bg-[#67b0e7] p-1 mt-1 text-white" type="submit" name="generate" disabled>Generate</button>
                                <?php } ?>
                            
                        </div>

                        <div>
                            <label class="text-[#2986CC] text-sm"><b>Stock in by: </b></label>
                            <input type="text" name="name" class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-7 px-2" value = "<?= $users['fname'];?> <?= $users['lname'];?>" hidden>
                            <input type="text" name="show" class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-7 px-2" placeholder = "<?= $users['fname'];?> <?= $users['lname'];?>" disabled>
                            </form>
                        </div>

                        <div>
                            <a href="adminProducts.php"><button class="w-64 text-sm text-white rounded-lg bg-[#67b0e7] p-1 mt-1 ml-28 text-white hover:bg-[#2986CC]">View Products</button></a>
                        </div>
                        <div class="mt-2">
                            <form method="post" action="stockEntry.php">
                            <input type="text" name="pcode" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-1 px-2" placeholder="Product Code">
                            <input type="text" name="barcode" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-1 px-2" placeholder="Barcode">
                            <input type="text" name="desc" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-1 px-2" placeholder="Description">
                            <input type="number" name="quantity" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-1 px-2" placeholder="Quantity">
                            <button type="submit" name="addStock" class="w-24 text-sm text-white rounded-lg bg-[#67b0e7] p-1 text-white hover:bg-[#2986CC]">Add Product</button>                       
                        </div>
                    </div>

                    <div class="justify-self-stretch mx-3 w-2/5 px-4 flex items-center grid grid-rows-4">
                        <div>
                            <label class="text-[#2986CC] text-sm"><b>Supplier: </b></label>
                            <input type="text" name="supplier" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-14 px-2" value = "">
                        </div>

                        <div>
                            <label class="text-[#2986CC] text-sm"><b>Contact Person: </b></label>
                            <input type="text" name="contactPerson" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-2 px-2" value = "">
                        </div>

                        <div>
                            <label class="text-[#2986CC] text-sm"><b>Address: </b></label>
                            <input type="text" name="address" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-64 ml-14 px-2" value = "">
                        </div>
                            </form>

                        <div>
                            <form method="post" action="stockEntry.php">
                            <button class="w-24 text-sm text-white rounded-lg bg-[#67b0e7] p-1 text-white hover:bg-[#2986CC]" type="submit" name="save">Save</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="w-100% flex h-[22rem]">
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
                                            <td><a href="stockEntry.php?barcode=<?= $presentStockIn['barcode'];?>"><img src="static/icons/cancel.png" width="23" height="23"></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </table>

                            <?php if(!$presentStock) {?>
                                    <div class="mt-[10rem] text-lg text-[#67b0e7] text-center"><p>NO TRANSACTION YET!</p></div>
                            <?php } ?>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-2 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>