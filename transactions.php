<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$role = $rmf->roleChecker();
$users = $rmf->home();
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
                        <a href="salesHistory.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer ">SALES HISTORY</p></a>
                        <a href="transactions.php" ><p class="text-xs ml-3 text-[#2986CC] font-bold outline outline-offset-1 outline-[#2986CC] rounded-md bg-[#67b0e7] p-2 text-white ">TRANSACTION HISTORY</p></a>
                    </div>
                    <div class="justify-self-stretch w-1/5 flex">
                        <a href="dashboard.php">
                            <button class="ml-10 text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/back.png" width="25" height="25" style="  display: block; margin-left: 47px; margin-right: auto;"><p>Back to Dashboard</p>
                            </button>
                        </a>
                    </div>
                </div>

                <div class="w-full flex h-[32rem]">
                    <div class="justify-self-start w-full bg-[#f0faff] px-5 rounded-bl-lg overflow-auto max-h-106">
                        <div class="mt-3 w-full flex">
                            <form class="w-2/5" method='post' action='transactions.php'>
                                <label class="text-md text-[#2986CC] mt-2">From</label>
                                <input type="date" name="from" class="ml-2 outline outline-offset-2 outline-[#2986CC] rounded-md" required></input>
                                <label class="ml-2 text-md text-[#2986CC] mt-2">To</label>
                                <input type="date" name="to" class="ml-2 outline outline-offset-2 outline-[#2986CC] rounded-md" required></input>
                                <button type="submit" name="betweenDates" class="ml-1 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Filter</button>
                            </form>
  
                            <form method="post" action="transactions.php" class="w-1/5">
                                <input type="text" name="searchTag" placeholder="Search Invoice" class="w-32 outline outline-offset-2 outline-[#2986CC] rounded-md text-sm bg-transparent text-md text-[#2986CC]" required></input>
                                <button type="submit" name="searchProduct" class="ml-2 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm">Search</button>
                            </form>

                            <div class="w-1/5">
                                <a href="transactions.php"><button class="w-24 ml-2 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm">All</button></a>
                            </div>
                            <div class="w-1/5">
                                <a href="transactionsPrint.php"><button class=" w-24 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Print</button></a>
                            </div>
                        </div>   


                        <table class="justify-self-stretch w-full m-auto mt-3">
                                    <thead class="font-bold text-md bg-[#67b0e7] text-white sticky top-0">
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

                        <?php if(!$transactionHistory) {?>
                            <div class="mt-[10rem] text-lg text-[#67b0e7] text-center"><p>NO TRANSACTIONS!</p></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'" onclick="return confirm('Are you sure you want to logout?')"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>