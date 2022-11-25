<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
// $transac = $rmf->newTransac();
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
            <div class="rounded-md p-20 pb-5 drop-shadow-2xl">
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
                    <div class="justify-self-stretch w-1/5 flex">
                        <a href="staffDashboard.php">
                            <button class="ml-20 text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/cart.png" width="25" height="25" style="  display: block; margin-left: 21px; margin-right: auto;"><p>Back to Cart</p>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="w-100% flex h-[32rem]">
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
                            <div class="ml-[20rem] mt-[10rem] text-lg text-[#67b0e7]"><p>NO ORDERS YET!</p></div> 
                        <?php } ?>
                    </div>

                    <div class="w-1/5 bg-[#eaf8ff] p-5 rounded-br-lg flex-initial">
                        <div class="flex-1 items-center outline outline-offset-2 outline-[#2986CC] rounded-md h-[5rem] mb-4 p-2">
                            <form method="post" action="history.php">
                                <input type="text" name="searchTag" placeholder="Search Product ID" class="w-32 outline outline-offset-2 outline-[#2986CC] rounded-md text-sm bg-transparent text-md text-[#2986CC]" required></input>
                                <button type="submit" name="searchProduct" class="ml-2 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm">Search</button>
                            </form>
                            <a href="history.php"><button class="w-full rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] mt-2 ">All</button></a>
                            
                        </div>

                        <div class="flex-1 items-center outline outline-offset-2 outline-[#2986CC] rounded-md h-[12rem] mb-4 p-2">
                            <p class="text-[#2986CC] mb-3"><b>SOLD ITEM:</b></p>
                            <p class="text-[#2986CC] text-sm"><b>PCODE:</b> <?= $cancelHistory['product_code'];?></p>
                            <p class="text-[#2986CC] text-sm"><b>Description:</b> <?= $cancelHistory['product_desc'];?></p>
                            <p class="text-[#2986CC] text-sm"><b>Transaction No:</b> <?= $cancelHistory['transaction_id'];?></p>
                            <p class="text-[#2986CC] text-sm"><b>Quantity:</b> <?= $cancelHistory['quantity_bought'];?></p>
                            <p class="text-[#2986CC] text-sm"><b>Price:</b> <?= $cancelHistory['total_price'];?></p>
                        </div>

                        <div class="flex-1 items-center outline outline-offset-2 outline-[#2986CC] rounded-md h-[11rem] my-4">
                            <div class="p-2">
                                <form method="post" action="history.php">
                                    <p class="text-[#2986CC] mb-3"><b>CANCEL ITEM:</b></p>
                                    <p class="text-[#2986CC] text-sm mb-1"><b>Void by:</b> <?= $users['fname'];?> <?= $users['lname'];?></p>
                                    <label class="text-[#2986CC] text-sm mb-1"><b>Add to Inventory?</b> </label>
                                    <select name="action" id="action" class="outline outline-offset-2 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] ml-1">  
                                        <option value="Yes">Yes</option>  
                                        <option value="No">No</option>  
                                    </select>
                                    <label class="text-[#2986CC] text-sm"><b>Quantity:</b></label>
                                    <input type="number" name="quantityCancelled" required value="<?= $cancelHistory['quantity_bought'];?>" min="1" max="<?= $cancelHistory['quantity_bought'];?>" class="outline outline-offset-2 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-2 mt-2"></input>
                                    <input type="number" name="cancelledTrans" value="<?= $cancelHistory['trans_id'];?>" hidden></input>
                                    <?php if ($cancelHistory) { ?>
                                        <button type="submit" class="text-sm text-white mb-2 rounded-lg bg-[#67b0e7] p-2 my-3 text-white hover:bg-[#2986CC]" name="cancel_order">
                                            Cancel Order
                                        </button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>