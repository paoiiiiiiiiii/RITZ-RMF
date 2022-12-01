<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$role = $rmf->roleChecker();
$message = $rmf->message();
$products = $rmf->browseAdminProducts();
$users = $rmf->home();
$productDetails = $rmf->removeInventory();

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
                    <div class="justify-self-stretch mx-3 w-3/5 px-4 flex items-center">
                        <p class="text-[2rem] text-[#2986CC] font-bold ml-4">PRODUCTS</p>
                    </div>
                    <div class="justify-self-stretch w-1/5 flex items-center justify-center">
                        <a href="dashboard.php">
                            <button class="text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/back.png" width="25" height="25" style="  display: block; margin-left: 47px; margin-right: auto;"><p>Back to Dashboard</p>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="w-100% flex h-[30rem]">
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
                                        <td class="rounded-tr-md"></td>
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
                                            <td><a href="adminProducts.php?productID=<?= $product['product_id'];?>"><button class="ml-2 rounded-lg bg-[#1bcb00] text-white hover:bg-[#159d00] p-1 text-sm">Select</button></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </table>

                            <?php if(!$products) {?>
                                    <div class="ml-[20rem] mt-[10rem] text-lg text-[#67b0e7]"><p>PLEASE CHECK THE BARCODE!</p></div>
                            <?php } ?>
                    </div>

                    <div class="w-1/5 bg-[#eaf8ff] p-5 rounded-br-lg flex-initial">
                        <div class="flex-1 items-center rounded-md h-auto bg-[#67b0e7] p-2">
                            <form method="post" action="adminProducts.php" class="grid grid-cols-3">
                                <input type="text" name="searchTag" placeholder="Search Barcode" class="rounded-md bg-[#efefef] p-1 col-span-2 text-sm" required></input>
                                <button type="submit" name="searchProduct" class="ml-1 text-xs text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] col-span-1">Search</button>
                            </form>
                            <a href="adminProducts.php"><button class="w-full rounded-lg text-md text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] mt-2">All</button></a>
                            
                        </div>
                        <div class="flex-1 items-center rounded-md h-auto bg-[#67b0e7] p-2 mt-2">
                            <form method="post" action="adminProducts.php" class="grid grid-cols-2">
                                <div class="col-span-2"><b><p class="text-white text-center">Product Details:</p></b></div>
                                
                                <p class="text-sm text-white mt-2 mb-1"><b>Product ID: </b></p>
                                <p class="text-sm text-white mt-2"><?= $productDetails['product_id'];?></p>
                                <input type="text" name="productID" value = "<?= $productDetails['product_id'];?>" hidden>
                                
                            
                                <label class="text-white text-sm"><b>PCode: </b></label>
                                <input type="text" name="productCode" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "<?= $productDetails['product_code'];?>">
                                
                                <label class="text-white text-sm"><b>Barcode: </b></label>
                                <input type="number" name="barcode" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "<?= $productDetails['barcode'];?>">

                                <label class="text-white text-sm"><b>PName: </b></label>
                                <input type="text" name="prodName" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "<?= $productDetails['product_name'];?>">

                                <label class="text-white text-sm"><b>Brand: </b></label>
                                <input type="text" name="prodBrand" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "<?= $productDetails['product_brand'];?>">

                                <label class="text-white text-sm"><b>Price:</b></label>
                                <input type="number" step="0.01" name="price" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "<?= $productDetails['price'];?>">

                                <label class="text-white text-sm"><b>Quantity: </b></label>
                                <input type="number" name="quantity" required class="rounded-md bg-[#efefef] p-1 text-sm mb-1" value = "<?= $productDetails['quantity'];?>">

                                <div class="my-3 col-span-2 grid grid-cols-3">
                                    <button name="removeProduct" type="submit" class="rounded-lg text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] p-2 text-xs">Remove</button>
                                    <button name="updateProduct" type="submit" class="ml-1 rounded-lg text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] p-2 text-xs">Update</button>
                                    <?php if (!$productDetails['product_id']) { ?>
                                        <button name="addProduct" type="submit" class="ml-1 rounded-lg text-white bg-[#5094c8] rounded-md hover:bg-[#eaf8ff] hover:text-[#2986CC] p-2 text-xs">Add</button>
                                    <?php } else {?>
                                        <button name="addProduct" type="submit" class="ml-1 rounded-lg text-white bg-[#cdcdcd] p-2 text-xs" disabled>Add</button>
                                    <?php }?>
                                    <?php if ($message) {?>
                                        <div class="bg-[#1bcb00] rounded-md pl-3 mt-3 py-2 col-span-3">
                                            <p onclick="this.parentElement.style.display='none';" class="text-white cursor-pointer text-xs"><?= $message ?></p>                                            
                                        </div>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>


                    </div>

                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-6 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'" onclick="return confirm('Are you sure you want to logout?')"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>