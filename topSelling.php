<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();
$topSelling = $rmf->topSelling();

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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],

                <?php
                    foreach ($topSelling as $topSellingProducts) {
                        echo "['".$topSellingProducts['product_name']."',".$topSellingProducts['total_sold']."],";
                    }
                ?>

            ]);

            var options = {
            title: 'Top Selling Products'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
        </script>
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
                        <p class="text-xs ml-3 text-[#2986CC] font-bold outline outline-offset-1 outline-[#2986CC] rounded-md bg-[#67b0e7] p-2 text-white">TOP SELLING</p>
                        <a href="stockInHistory.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">SOLD ITEMS</p></a>
                        <a href="stockInHistory.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">CRITICAL STOCKS</p></a>
                        <a href="stockInHistory.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">INVENTORY LIST</p></a>
                        <a href="stockInHistory.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">CANCELLED</p></a>
                        <a href="stockInHistory.php"><p class="text-xs text-[#2986CC] font-bold ml-3 outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent p-2 hover:bg-[#67b0e7] hover:text-white cursor-pointer">STOCK IN HISTORY</p></a>
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
                    <div class="justify-self-start w-3/5 bg-[#f0faff] px-5 rounded-bl-lg overflow-auto max-h-106">
                        <div class="m-auto mt-3">
                            <form>
                                <label class="text-md text-[#2986CC] mt-2">From</label>
                                <input type="date" name="from" class="ml-2 outline outline-offset-2 outline-[#2986CC] rounded-md"></input>
                                <label class="ml-2 text-md text-[#2986CC] mt-2">To</label>
                                <input type="date" name="to" class="ml-2 outline outline-offset-2 outline-[#2986CC] rounded-md"></input>
                                <button type="submit" name="betweenDates" class="ml-1 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Filter</button>
                            </form>
                        </div>   
                        <table class="justify-self-stretch w-full m-auto mt-3">
                                    <thead class="font-bold text-md bg-[#67b0e7] text-white sticky top-0">
                                        <td class="pl-2 rounded-tl-md py-2">#</td>
                                        <td class="py-2">PCode</td>
                                        <td class="py-2">Description</td>
                                        <td class="py-2">Brand</td>
                                        <td class="py-2">Price</td>
                                        <td class="py-2">Quantity Sold</td>
                                        <td class="rounded-tr-md">Total Sales</td>
                                    </thead>
                                <?php if($topSelling){ $counter = 0; ?>
                                    <?php foreach($topSelling as $topSellingProducts): $counter += 1;?>
                                        <tr>
                                            <td class="py-2 pl-2"><?= $counter ?></td>
                                            <td><?= $topSellingProducts['product_code'];?></td>
                                            <td><?= $topSellingProducts['product_name'];?></td>
                                            <td><?= $topSellingProducts['product_brand'];?></td>
                                            <td><?= $topSellingProducts['price'];?></td>
                                            <td><?= $topSellingProducts['total_sold'];?></td>
                                            <td><?= $topSellingProducts['total_sale'];?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                        </table>

                        <?php if(!$topSelling) {?>
                            <div class="mt-[10rem] text-lg text-[#67b0e7] text-center"><p>NO TRANSACTION YET!</p></div>
                        <?php } ?>
                    </div>

                    <div class="justify-self-start w-2/5 bg-[#f0faff] px-5 rounded-bl-lg rounded-br-lg overflow-auto max-h-106">
                        <div id="piechart" style="width: 600px; height: 600px;"></div>
                    </div>
                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-2 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>