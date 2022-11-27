<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$message = $rmf->message();
$products = $rmf->browseProducts();
$users = $rmf->home();
$productAdd = $rmf->addCart();
// $transac = $rmf->newTransac();
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
                    <div class="justify-self-stretch mx-3 w-3/5 px-4 flex items-center">
                        <p class="text-[2rem] text-[#2986CC] font-bold ml-4">AVAILABLE PRODUCTS</p>
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
                    <div class="justify-self-start w-4/5 bg-[#f0faff] px-5 rounded-bl-lg rounded-br-lg overflow-auto max-h-106">   
                        <table class="justify-self-stretch w-full m-auto ">
                                    <thead class="font-bold text-md bg-[#67b0e7] text-white sticky top-0">
                                        <td class="pl-2 rounded-tl-md py-2">Product ID</td>
                                        <td class="py-2">Product Code</td>
                                        <td class="py-2">Bar Code</td>
                                        <td class="py-2">Description</td>
                                        <td class="py-2">Brand</td>
                                        <td class="py-2">Price</td>
                                        <td class="py-2">Quantity</td>
                                        <td class="rounded-tr-md">Add</td>
                                    </thead>
                                <?php if($products){ ?>
                                    <?php foreach($products as $product): ?>
                                        <tr>
                                            <td class="py-2 pl-2"><?= $product['product_id'];?></td>
                                            <td><?= $product['product_code'];?></td>
                                            <td><?= $product['barcode'];?></td>
                                            <td><?= $product['product_name'];?></td>
                                            <td><?= $product['product_brand'];?></td>
                                            <td><?= $product['price'];?></td>
                                            <td><?= $product['quantity'];?></td>
                                            <td><a href="browseProducts.php?productID=<?= $product['product_id'];?>"><img src="static/icons/add.png" width="23" height="23"></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </table>

                            <?php if(!$products) {?>
                                    <div class="ml-[20rem] mt-[10rem] text-lg text-[#67b0e7]"><p>PLEASE CHECK THE BARCODE!</p></div>
                            <?php } ?>
                    </div>

                    <div class="w-1/5 bg-[#eaf8ff] p-5 rounded-br-lg flex-initial">
                        <div class="flex-1 items-center outline outline-offset-2 outline-[#2986CC] rounded-md h-[5rem] mb-4 p-2">
                            <form method="post" action="browseProducts.php">
                                <input type="text" name="searchTag" placeholder="Search Barcode" class="w-32 outline outline-offset-2 outline-[#2986CC] rounded-md text-sm bg-transparent text-md text-[#2986CC]" required></input>
                                <button type="submit" name="searchProduct" class="ml-2 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm">Search</button>
                            </form>
                            <a href="browseProducts.php"><button class="w-full rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] mt-2 ">All</button></a>
                            
                        </div>
                        <div class="flex-1 items-center outline outline-offset-2 outline-[#2986CC] rounded-md h-[11rem] mb-4 p-2">
                            <p class="text-sm text-[#2986CC]"><b>Product ID: </b><?= $productAdd['product_id'];?></p>
                            <p class="text-sm text-[#2986CC]"><b>PCode: </b><?= $productAdd['product_code'];?></p>
                            <p class="text-sm text-[#2986CC]"><b>Barcode: </b><?= $productAdd['barcode'];?></p>
                            <p class="text-sm text-[#2986CC]"><b>Product Name: </b><?= $productAdd['product_name'];?></p>
                            <p class="text-sm text-[#2986CC]"><b>Product Brand: </b><?= $productAdd['product_brand'];?></p>
                            <p class="text-sm text-[#2986CC]"><b>Price per piece: </b><?= $productAdd['price'];?></p>
                            <p class="text-sm text-[#2986CC]"><b>Quantity Available: </b><?= $productAdd['quantity'];?></p>
                        </div>

                        <div class="flex-1 items-center outline outline-offset-2 outline-[#2986CC] rounded-md h-[10rem] my-4">
                            <div class="p-2">
                                <form method="post" action="browseProducts.php">
                                    <div class="input-group">
                                        <label class="text-[#2986CC] text-sm"><b>Quantity: </b></label>
                                        <input type="number" name="quantity" required min="1" max="<?= $productAdd['quantity'];?>" class="outline outline-offset-2 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-1">
                                        <!-- <label class="text-[#2986CC] text-sm"><b>Discount: </b></label>
                                        <input type="number" name="discount" value="0" step="0.01" class="outline outline-offset-2 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-1 mt-4"> -->
                                        <input type="number" name="addProd" value="<?= $productAdd['product_id'];?>" hidden ></input>
                                        <?php if ($session && $productAdd) { ?>
                                            <button type="submit" class="text-sm text-white mb-2 rounded-lg bg-[#67b0e7] p-2 my-3 text-white hover:bg-[#2986CC]" name="addCart">
                                                Add to Cart
                                            </button>
                                        <?php }?>
                                        <?php if ($message) {?>
                                            <div class="bg-[#1bcb00] rounded-md pl-3 h-10 py-2 my-10">
                                                <p onclick="this.parentElement.style.display='none';" class="text-white cursor-pointer text-sm"><?= $message ?></p>                                            
                                            </div>
                                        <?php } ?>
                                        
                                        </div>
                                    </div>
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