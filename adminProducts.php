<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
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
            PART PROJECT
        </title>
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
                        <p class="text-[2rem] text-[#2986CC] font-bold ml-4">PRODUCTS</p>
                    </div>
                    <div class="justify-self-stretch w-1/5 flex">
                        <a href="dashboard.php">
                            <button class="ml-10 text-sm text-white rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]">
                                <img src="static/icons/cart.png" width="25" height="25" style="  display: block; margin-left: 42px; margin-right: auto;"><p>Back to Dashboard</p>
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
                                        <td class="rounded-tr-md">Select</td>
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
                                            <td><a href="adminProducts.php?productID=<?= $product['product_id'];?>"><img src="static/icons/cancel.png" width="23" height="23"></a></td>
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
                            <form method="post" action="adminProducts.php">
                                <input type="text" name="searchTag" placeholder="Search Barcode" class="w-32 outline outline-offset-2 outline-[#2986CC] rounded-md text-sm bg-transparent text-md text-[#2986CC]" required></input>
                                <button type="submit" name="searchProduct" class="ml-2 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm">Search</button>
                            </form>
                            <a href="adminProducts.php"><button class="w-full rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] mt-2 ">All</button></a>
                            
                        </div>
                        <div class="flex-1 items-center outline outline-offset-2 outline-[#2986CC] rounded-md h-[15rem] mb-4 p-2">
                            <form method="post" action="adminProducts.php">
                                <b><p class="text-[#2986CC] text-center">Product Details:</p></b>
                                <ul>
                                <p class="text-sm text-[#2986CC] mt-2"><b>Product ID: </b><?= $productDetails['product_id'];?></p>
                                <input type="text" name="productID" value = "<?= $productDetails['product_id'];?>" hidden>
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>PCode: </b></label>
                                <input type="text" name="productCode" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-4 px-2 mb-1" value = "<?= $productDetails['product_code'];?>">
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>Barcode: </b></label>
                                <input type="text" name="barcode" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-1 px-2 mb-1" value = "<?= $productDetails['barcode'];?>">
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>PName: </b></label>
                                <input type="text" name="prodName" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-3 px-2 mb-1" value = "<?= $productDetails['product_name'];?>">
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>Brand: </b></label>
                                <input type="text" name="prodBrand" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-4 px-2 mb-1" value = "<?= $productDetails['product_brand'];?>">
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>Price:</b></label>
                                <input type="number" name="price" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-4 px-2 mb-1" value = "<?= $productDetails['price'];?>">
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>Quantity: </b></label>
                                <input type="number" name="quantity" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-1 px-2 mb-1" value = "<?= $productDetails['quantity'];?>">
                                </ul>
                                <div class="my-7">
                                    <button name="removeProduct" type="submit" class="ml-1 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Remove</button>
                                    <button name="updateProduct" type="submit" class="ml-1 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Update</button>
                                    <?php if (!$productDetails['product_id']) { ?>
                                        <button name="addProduct" type="submit" class="ml-1 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Add</button>
                                    <?php } else {?>
                                        <button name="addProduct" type="submit" class="ml-1 rounded-lg text-white bg-[#cdcdcd] p-2 text-sm" disabled>Add</button>
                                    <?php }?>
                                </div>
                            </form>
                        </div>


                    </div>

                </div>
            </div>
            <p class="pb-2 bg-[#9ed5f0] pl-20 text-white text-lg"><b>Date: </b><?= $date ?> <?= $dateDay ?></p>
            <button class="ml-20 text-sm text-white mb-2 rounded-lg bg-[#67b0e7] p-2 text-white hover:bg-[#2986CC]"><a href="login.php?logout='1'"><img src="static/icons/logout.png" width="18" height="18"></a></button>
        </div>
    </body>

 
</html>