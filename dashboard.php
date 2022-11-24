<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();

date_default_timezone_set('Asia/Manila');
$date = date("Y-m-d");
$dateDay = date("l");
$time = date("h:i:sa");
$sales = $rmf->getMonthlySales();
$yearlySales = $rmf->getYearlySales();
$inventory = $rmf->getProductLine();
$stocks = $rmf->getStocksOnHand();
$criticalItems = $rmf->getCriticalItems();

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
        ['2019', 800000],
        ['2020', 1000000],
        ['2021', 1200000],

                <?php
                    echo "['2022',".$yearlySales."],";
                ?>

        ]);

        var options = {
        
        title: 'Yearly Sales'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    </script>
    
</head>
<body>
	<body>    	
        <div class="w-100% h-100% items-center bg-[#9ed5f0]">
            <div class="rounded-md p-20 pb-5 drop-shadow-2xl">
                <div class="bg-[#eaf8ff] flex rounded-t-lg p-5 divide-x-4 divide-[#67b0e7]">
                    <div class="justify-self-start w-1/5 flex items-center">
                        <div>
                            <img src="static/images/logo.png" height="80" width="80">
                        </div>
                        <div class="px-2">
                            <p class="text-lg font-bold"><?= $users['fname'];?> <?= $users['lname'];?></p>
                            <p class="text-sm"><?= $users['role'];?>/owner</p>
                        </div>
                    </div>
                    <div class="justify-self-stretch mx-3 w-3/5 px-4">
                        <p class="text-center text-[2rem]"><b>RITZ - RMF HARDWARE</b></p>
                        <p class="text-center"><b>INVENTORY AND POS SYSTEM</b></p>
                    </div>
                    <div class="justify-self-stretch w-1/5">
                    </div>
                </div>
                

                <div class="w-100% flex h-[32rem]">
                    <div class="justify-self-start w-full bg-[#f0faff] rounded-b-lg px-5 max-h-106 flex grid grid-rows-2">
                        <div class="flex w-full row-span-2 pt-4">
                            <div class="flex-1 bg-[#1bcb00] text-white rounded-md h-[8rem] mx-3 my-5 p-2 grid grid-cols-3"><div class="col-span-1 flex items-center justify-center"><img src="static/icons/peso.png" width="90" height="90"></div>
                                <div class="col-span-2 text-lg pr-5 pt-1 pl-2">
                                    <ul class="text-3xl text-left"><b><?= $sales ?></b></ul>
                                    <ul class="text-lg text-left"><b>MONTHLY SALES</b></ul> 
                                    <ul class="text-xs text-left">Total monthly sales recorded on database</ul> 
                                </div>
                            </div>

                            <div class="flex-1 bg-[#00b9e5] text-white rounded-md h-[8rem] mx-3 my-5 p-2 grid grid-cols-3"><div class="col-span-1 flex items-center justify-center pl-3"><img src="static/icons/productLine.png" width="85" height="85"></div>
                                <div class="col-span-2 text-lg pr-5 pt-1 pl-4">
                                    <ul class="text-3xl text-left"><b><?= $inventory ?></b></ul>
                                    <ul class="text-lg text-left"><b>PRODUCT LINE</b></ul> 
                                    <ul class="text-xs text-left">Total product line recorded on database</ul> 
                                </div>
                            </div>

                            <div class="flex-1 bg-[#f8de00] text-white rounded-md h-[8rem] mx-3 my-5 p-2 grid grid-cols-3"><div class="col-span-1 flex items-center justify-center pl-3"><img src="static/icons/stock.png" width="90" height="90"></div>
                                <div class="col-span-2 text-lg pt-1 pl-4">
                                    <ul class="text-3xl text-left"><b><?= $stocks ?></b></ul>
                                    <ul class="text-lg text-left"><b>STOCK ON HAND</b></ul> 
                                    <ul class="text-xs text-left">Total stocks recorded on database</ul> 
                                </div>
                            </div>

                            <div class="flex-1 bg-[#ff6363] text-white rounded-md h-[8rem] mx-3 my-5 p-2 grid grid-cols-3"><div class="col-span-1 flex items-center justify-center pl-3"><img src="static/icons/critical.png" width="90" height="90"></div>
                                <div class="col-span-2 text-lg pt-1 pl-4">
                                    <ul class="text-3xl text-left"><b><?= $criticalItems ?></b></ul>
                                    <ul class="text-lg text-left"><b>CRITICAL ITEMS</b></ul> 
                                    <ul class="text-xs text-left">Total critical items recorded on database</ul> 
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full grid grid-cols-4 flex justify-center">
                            <div class="grid grid-cols-3 w-full col-span-3 ml-5 p-16">
                                <a href="adminProducts.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center grid grid-cols-3"><div class="col-span-1 ml-5"><img src="static/icons/product.png" width="45" height="45"></div><div class="col-span-2 text-lg pr-5">Products</div></div></a>
                                <a href="suppliers.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center grid grid-cols-3"><div class="col-span-1 ml-5"><img src="static/icons/supplier.png" width="45" height="45"></div><div class="col-span-2 text-lg pr-5">Suppliers</div></div></a>
                                <a href="stockEntry.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center grid grid-cols-3"><div class="col-span-1 ml-5"><img src="static/icons/stockEntry.png" width="45" height="45"></div><div class="col-span-2 text-lg pr-5">Stock Entry</div></div></a></a>
                                <a href="topSelling.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center grid grid-cols-3"><div class="col-span-1 ml-5"><img src="static/icons/record.png" width="45" height="45"></div><div class="col-span-2 text-lg pr-5">Records</div></div></a></a>
                                <a href="salesHistory.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center grid grid-cols-3"><div class="col-span-1 ml-5"><img src="static/icons/sales.png" width="35" height="35"></div><div class="col-span-2 text-lg pr-5">Sales History</div></div></a></a>
                                <a href="userSettings.php"><div class="flex-1 items-center rounded-md h-[4rem] bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC] w-52 text-center grid grid-cols-3"><div class="col-span-1 ml-5"><img src="static/icons/settings.png" width="45" height="45"></div><div class="col-span-2 text-lg pr-2">User Settings</div></div></a></a>
                            </div>
                            <div class="flex justify-center w-full pb-8 pr-3">
                                <div id="piechart" style="width: 400px; height: 300px;"></div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>
</body>
 
</html>