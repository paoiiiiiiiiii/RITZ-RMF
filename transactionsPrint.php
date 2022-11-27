<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
$role = $rmf->roleChecker();
$transactionHistory = $rmf->transactions();

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
                <a href="transactions.php"><button class="ml-10 mt-5 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm w-24">Back</button></a>
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
                <p class="text-center text-2xl font-bold">TRANSACTIONS</p></br>
                <p class="ml-10"><b>DATE:</b> <?= $date; ?>, <?= $dateDay; ?> <?= $time; ?></p>
            </div>
            <div class="mb-5 mx-10">
                <hr style="border-width: 1px; border-color:black; margin-bottom:20px;">
                    <table class="justify-self-stretch w-full m-auto mt-3">
                                <thead class="font-bold text-md">
                                        <td class="pl-2 rounded-tl-md py-2">Invoice No.</td>
                                        <td class="py-2">Date</td>
                                        <td class="py-2">Customer</td>
                                        <td class="py-2">Amount (Discounted)</td>
                                        <td class="py-2">Money</td>
                                        <td class="py-2">Discount</td>
                                        <td class="py-2">Change</td>
                                        <td class="rounded-tr-md">Cashier Name</td>
                                    </thead>
                                <?php if($transactionHistory){ $counter = 0; ?>
                                    <?php foreach($transactionHistory as $transacHistory): $counter += 1;?>
                                        <tr>
                                            <td class="py-2"><?= $transacHistory['transaction_id'];?></td>
                                            <td><?= $transacHistory['date'];?></td>
                                            <td><?= $transacHistory['soldTo'];?></td>
                                            <td><?= $transacHistory['amount'];?></td>
                                            <td><?= $transacHistory['moneyOfCustomer'];?></td>
                                            <td><?= $transacHistory['discount'];?></td>
                                            <td><?= $transacHistory['changeOfCustomer'];?></td>
                                            <td><?= $transacHistory['cashier_name'];?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                    </table>
                <hr style="border-width: 1px; border-color:black; margin-top:20px;">
            </div>

        </div>
    </body>
 
</html>