<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
$transac = $rmf->newTransac();
$cart = $rmf ->showCart();
$payment = $rmf->settlePayment();
$deleteItem = $rmf->deleteItem();
$total = $rmf->returnTotal();
$session = $rmf->sessionChecker();

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
                    <div class="justify-self-stretch mx-3 w-3/5 px-4">
                        <p><b>Transaction Number:</b> <?= $transac['transaction_id'];?></p>
                        <p><b>Customer Name:</b> <?= $transac['soldTo'];?></p>
                        <p><b>Transaction Date:</b> <?= $transac['date'];?></p>
                    </div>
                    <div class="justify-self-stretch w-1/5">
                    <p class="ml-3 font-bold">Total Price: </p>
                    <p class="text-[2rem] text-[#2986CC] font-bold ml-4">PHP <?= $total ?></p>
                    </div>
                </div>
                <div class="w-100% flex h-[30rem]">
                    <div class="justify-self-start w-4/5 bg-[#f0faff] px-5 rounded-bl-lg overflow-auto max-h-106">
                        <table class="justify-self-stretch w-full m-auto ">
                            <thead class="font-bold text-md bg-[#67b0e7] text-white sticky top-0">
                                <td class="pl-2 rounded-tl-md py-2">#</td>
                                <td class="py-2">Product Desc</td>
                                <td class="py-2">Price</td>
                                <td class="py-2">Quantity</td>
                                <!-- <td class="py-2">Discount</td> -->
                                <td class="py-2">Total</td>
                                <td class="rounded-tr-md"></td>
                            </thead>
                            <?php if($cart){ $counter=0;?>
                                <?php foreach($cart as $carts): $counter += 1; ?>
                                    <tr>
                                        <td class="py-2"><?= $counter?></td>
                                        <td><?= $carts['product_desc'];?></td>
                                        <td><?= $carts['price'];?></td>
                                        <td><?= $carts['quantity_bought'];?></td>
                                        <!-- <td><?= $carts['discount'];?></td> -->
                                        <td><?= $carts['total_price'];?></td>
                                        <td><a href="staffDashboard.php?deleteId=<?= $carts['trans_id']?>"><img src="static/icons/cancel.png" width="25" height="25"><a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php }?>
                        </table>
                        <?php if(!$cart) {?>
                                <div class="mt-[10rem] text-lg text-[#67b0e7] text-center"><p>THERE ARE NO PRODUCTS IN THE CART YET!</p></div>
                        <?php } ?>
                        
                    </div>

                    <div class="w-1/5 bg-[#eaf8ff] p-5 rounded-br-lg flex-initial">
                        
                        <div class="flex-1 items-center rounded-md h-auto bg-[#67b0e7]">
                            
                            <div class="place-items-center">
                                <div class="pt-1 pb-2 px-2">
                                    <form action="staffDashboard.php" method="post">         
                                            <p class="text-white mb-1 text-sm">Customer Name:</p>
                                        <?php if (!$session) { ?>
                                            <input type="text" name="soldTo" required class="rounded-md bg-[#efefef] w-full p-1"> 
                                            <button type="submit" class="text-xs text-white bg-[#5094c8] p-2 mt-2 rounded-full hover:bg-[#eaf8ff] hover:text-[#2986CC] w-full" name="newTransac">New Transaction</button>
                                        <?php } else { ?>
                                            <input type="text" name="soldTo" required class="rounded-md bg-[#efefef] w-full p-1" placeholder="<?= $transac['soldTo']; ?>" disabled> 
                                            <button type="submit" class="text-xs text-white bg-[#5094c8] p-2 mt-2 rounded-full w-full" name="newTransac" disabled>New Transaction</button>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="my-3 h-[10rem] flex-1 mb-1">
                            <a href="browseProducts.php"><button class="w-full mb-3 rounded-full bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">BROWSE PRODUCTS</button></a>
                            <a href="staffDashboard.php?deleteAll='1'" onclick="return confirm('Are you sure you want to clear cart?')"><button class="w-full mb-3 rounded-full bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">CLEAR CART</button><a>
                            <a href="history.php"><button class="w-full mb-3 rounded-full bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">HISTORY</button><a>
                        </div>

                        <div class="flex-1 items-center rounded-md h-auto bg-[#67b0e7]">
                            <div class="pt-1 pb-2 px-2">
                                <form action="staffDashboard.php" method="post">
                                    <p class="text-white mb-1 text-sm">Enter Money: </p>
                                    <input type="number" name="money" step="0.01" class="rounded-md bg-[#efefef] w-full p-1" required>
                                    <p class="text-white mb-1 text-sm">Enter Discount: </p>
                                    <input type="number" name="discount" value="0" step="0.01" class="rounded-md bg-[#efefef] w-full p-1">
                                    <button type="submit" class="text-xs text-white bg-[#5094c8] p-2 mt-2 rounded-full hover:bg-[#eaf8ff] hover:text-[#2986CC] w-full" name="settlePayment">Settle Payment</button>
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

<!-- dark #2986CC -->
<!-- light #67b0e7-->
<!-- bg body #9ed5f0 -->
<!-- whitish #eaf8ff -->
<!-- table #f0faff -->