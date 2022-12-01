<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
// $transac = $rmf->newTransac();
$message = $rmf->message();
$history = $rmf->showHistory();
$cancelHistory = $rmf->cancelHistory();

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
                <div class="bg-[#eaf8ff] flex rounded-t-lg p-5 divide-x-4 divide-[#67b0e7]">
                    <div class="justify-self-start w-1/5 flex items-center">
                        <div>
                            <img src="static/images/logo.png" height="80" width="80">
                        </div>
                        <div class="px-2">
                            <p class="text-lg font-bold"><?= $users['fname'];?> <?= $users['lname'];?></p>
                            <p class="text-sm"><?= $users['role'];?></p>
                        </div>
                    </div>
                    <div class="justify-self-stretch mx-3 w-3/5 px-4 flex items-center ">
                        <p class="text-[2rem] text-[#2986CC] font-bold ml-4">ORDER HISTORY</p>
                    </div>
                    <div class="justify-self-stretch w-1/5 flex items-center justify-center">
                        <a href="staffDashboard.php">
                            <button class="text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/cart.png" width="25" height="25" style="  display: block; margin-left: 21px; margin-right: auto;"><p>Back to Cart</p>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="w-100% flex h-[30rem]">
                    <div class="justify-self-start w-4/5 bg-[#f0faff] px-5 rounded-bl-lg overflow-auto max-h-106">
                        <table class="justify-self-stretch w-full m-auto ">
                                <thead class="font-bold text-md bg-[#67b0e7] text-white sticky top-0">
                                    <td class="pl-2 rounded-tl-md py-2">#</td>
                                    <td class="py-2">Product Code</td>
                                    <td class="py-2">Invoice</td>
                                    <td class="py-2">Product Description</td>
                                    <td class="py-2">Brand</td>
                                    <td class="py-2">Price</td>
                                    <td class="py-2">Quantity</td>
                                    <td class="rounded-tr-md"></td>
                                </thead>
                            <?php if($history){ $counter=0;?>
                                <?php foreach($history as $product): $counter += 1;?>
                                    <tr>
                                        <td class="py-2 pl-2"><?= $counter?></td>
                                        <td><?= $product['product_code'];?></td>
                                        <td><?= $product['transaction_id'];?></td>
                                        <td><?= $product['product_name'];?></td>
                                        <td><?= $product['product_brand'];?></td>
                                        <td><?= $product['total_price'];?></td>
                                        <td><?= $product['quantity_bought'];?></td>
                                        <td><a href="history.php?transId=<?= $product['trans_id'];?>"><img src="static/icons/cancel.png" width="25" height="25"></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php } ?>
                        </table>

                        <?php if(!$history) {?>
                            <div class="text-center mt-[10rem] text-lg text-[#67b0e7]"><p>NO TRANSACTIONS/CHECK PRODUCT ID!</p></div> 
                        <?php } ?>
                    </div>

                    <div class="w-1/5 bg-[#eaf8ff] px-5 rounded-br-lg flex-initial">
                        <div class="flex-1 items-center rounded-md h-auto bg-[#67b0e7] p-2">
                            <form method="post" action="history.php" class="grid grid-cols-3">
                                <input type="text" name="searchTag" placeholder="Product ID" class="rounded-md bg-[#efefef] p-1 col-span-2 text-sm" required></input>
                                <button type="submit" name="searchProduct" class="ml-1 text-xs text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] col-span-1">Search</button>
                            </form>
                            <a href="history.php"><button class="w-full rounded-lg text-md text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] mt-2">All</button></a>
                            
                        </div>

                        <div class="flex-1 items-center rounded-md h-auto bg-[#67b0e7] p-2 pb-5 mt-3">
                            <p class="text-white mb-3"><b>SOLD ITEM:</b></p>
                            <p class="text-white text-sm"><b>PCODE:</b> <?= $cancelHistory['product_code'];?></p>
                            <p class="text-white text-sm"><b>Description:</b> <?= $cancelHistory['product_desc'];?></p>
                            <p class="text-white text-sm"><b>Transaction No:</b> <?= $cancelHistory['transaction_id'];?></p>
                            <p class="text-white text-sm"><b>Quantity:</b> <?= $cancelHistory['quantity_bought'];?></p>
                            <p class="text-white text-sm"><b>Price:</b> <?= $cancelHistory['total_price'];?></p>
                        </div>

                        <div class="flex-1 items-center rounded-md h-auto bg-[#67b0e7] p-2 mt-3">
                            <div class="">
                                <form method="post" action="history.php">
                                    <p class="text-white mb-3"><b>CANCEL ITEM:</b></p>
                                    <p class="text-white text-sm mb-1"><b>Void by:</b> <?= $users['fname'];?> <?= $users['lname'];?></p>
                                    <label class="text-white text-sm mb-1"><b>Add to Inventory?</b> </label>
                                    <select name="action" id="action" class="rounded-md bg-[#efefef] text-sm text-[#2986CC] ml-1 mb-2">  
                                        <option value="Yes">Yes</option>  
                                        <option value="No">No</option>  
                                    </select>
                                    <label class="text-white text-sm"><b>Quantity:</b></label>
                                    <input type="number" name="quantityCancelled" required value="<?= $cancelHistory['quantity_bought'];?>" min="1" max="<?= $cancelHistory['quantity_bought'];?>" class="rounded-md bg-[#efefef] p-1 text-sm w-24 ml-2"></input>
                                    <input type="number" name="cancelledTrans" value="<?= $cancelHistory['trans_id'];?>" hidden></input>
                                    <?php if ($cancelHistory) { ?>
                                        <button type="submit" class="w-full rounded-lg text-md text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] mt-2 p-2" name="cancel_order">
                                            Cancel Order
                                        </button>
                                    <?php } ?>
                                    <?php if ($message) {?>
                                        <div class="bg-[#1bcb00] rounded-md pl-3 mt-2 py-2">
                                            <p onclick="this.parentElement.style.display='none';" class="text-white cursor-pointer text-sm"><?= $message ?></p>                                            
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'" onclick="return confirm('Are you sure you want to logout?')"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>