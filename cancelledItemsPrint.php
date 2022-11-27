<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
$role = $rmf->roleChecker();
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
    <body>    	
        <div>
            <div class="flex">
                <a href="cancelledItems.php"><button class="ml-10 mt-5 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm w-24">Back</button></a>
                <button onClick="window.print()" class="ml-5 mt-5 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm w-24">Print</button>
                
            </div>

            <div class="items-center mb-4">
                <p class="text-center mt-5 text-2xl font-bold">RITZ - RMF HARDWARE</p>
                <p class="text-center text-lg">Barangay Sapa, Sto. Thomas</p>
                <p class="text-center">Pampanga City</p>
                <p class="text-center">Non-VAT Reg. TIN: ###-###-###-0000</p>
                <p class="text-center">Contact No.: ############</p>
            </div>

            <div>
                <p class="text-center text-2xl font-bold">CANCELLED ITEMS</p></br>
                <p class="ml-10"><b>DATE:</b> <?= $date; ?>, <?= $dateDay; ?> <?= $time; ?></p>
            </div>
            <div class="mb-5 mx-10">
                <hr style="border-width: 1px; border-color:black; margin-bottom:20px;">
                    <table class="justify-self-stretch w-full m-auto mt-3">
                            <thead class="font-bold text-md">
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
                <hr style="border-width: 1px; border-color:black; margin-top:20px;">
            </div>

        </div>
    </body>
 
</html>