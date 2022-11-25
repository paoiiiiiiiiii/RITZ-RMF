<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
$transac = $rmf->newTransac();
$cart = $rmf ->showCart();
$settlePayment = $rmf->settlePayment();
$total = $rmf->returnTotal();
$money = $rmf->returnMoneyOfCustomer();
$change = $rmf->returnChangeOfCustomer();
$discount = $rmf->returnDiscount();
$totalWithDiscount = $total - $discount;

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
    <body>    	
        <div>
            <div class="flex">
                <button onClick="window.print()" class="ml-10 mt-5 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm">Print receipt</button>
                    <form method="POST" action="settlePayment.php">
                            <button type="submit" class="ml-4 mt-5 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm"
                                        name="confirmTransac">
                                Confirm Transaction
                            </button>
                    </form>
            </div>

            <div class="items-center mb-4">
                <p class="text-center mt-5 text-2xl font-bold">RITZ - RMF HARDWARE</p>
                <p class="text-center text-lg">Barangay Sapa, Sto. Thomas</p>
                <p class="text-center">Pampanga City</p>
                <p class="text-center">Non-VAT Reg. TIN: ###-###-###-0000</p>
                <p class="text-center">Contact No.: ############</p>
            </div>

            <div class="mx-10 mb-4">
                <p><b>Sold to: </b><?=$transac['soldTo'];?>
                <p><b>Address: </b></p>
                <p><b>Cashier: </b><?= $users['fname'];?> <?= $users['lname'];?></p>
                <p><b>Invoice #: </b><?= $transac['transaction_id'];?></p>
                <p><b>Total Price: </b><?= $total ?></p>
                <p><b>Date & Time: </b><?= $date; ?>, <?= $dateDay; ?> <?= $time; ?></p>
            </div>

            <div class="mb-5 mx-10">
                <hr style="border-width: 1px; border-color:black; margin-bottom:20px;">
                <table class="justify-self-stretch w-full m-auto ">
                    <thead>
                        <td class="font-bold">#</td>
                        <td class="font-bold">Product Desc</td>
                        <td class="font-bold">Price</td>
                        <td class="font-bold">Quantity</td>
                        <td class="font-bold">Discount</td>
                        <td class="font-bold">Total Price</td>
                    </thead>
                    <?php if($cart){ $counter=0;?>
                        <?php foreach($cart as $carts): $counter += 1;?>
                            <tr>
                                <td><?= $counter?></td>
                                <td><?= $carts['product_desc'];?></td>
                                <td><?= $carts['price'];?></td>
                                <td><?= $carts['quantity_bought'];?></td>
                                <td><?= $carts['discount'];?></td>
                                <td><?= $carts['total_price'];?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php } else { echo("THERE ARE NO PRODUCTS IN THE CART YET!");}?>
                </table>
                <hr style="border-width: 1px; border-color:black; margin-top:20px;">
            </div>

            <div class="mb-5 mx-10 text-left">
                <table class="w-96">
                    <tr>
                        <td><p class="flex-auto text-lg">Total price</td>
                        <td><p class="flex-auto text-lg"><?= $total ?></td>
                    </tr>
                    <tr>
                        <td><p class="flex-auto text-lg">Discount </td>
                        <td><p class="flex-auto text-lg"><?= $discount?></td>
                    </tr>
                    <tr>
                        <td><p class="flex-auto text-lg"><b>Total Sales</b> </td>
                        <td><p class="flex-auto text-lg"><?= $totalWithDiscount ?></td>
                    </tr>
                    <tr>
                        <td><p class="flex-auto text-lg">Amount Tendered  </td>
                        <td><p class="flex-auto text-lg"><?= $money ?></td>
                    </tr>
                    <tr>
                        <td><p class="flex-auto text-lg">Change </td>
                        <td><p class="flex-auto text-lg"><?= $change?></td>
                    </tr>
                <table>
                <p class="text-center text-2xl my-5"><b>THANK YOU!</b></p>
            </div>

        </div>
    </body>
 
</html>