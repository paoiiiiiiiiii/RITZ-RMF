<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$users = $rmf->home();

$supplier = $rmf->browseSuppliers();
$supplierDetails = $rmf->supplier();

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
                        <p class="text-[2rem] text-[#2986CC] font-bold ml-4">SUPPLIERS</p>
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
                                        <td class="pl-2 rounded-tl-md py-2">Supplier ID</td>
                                        <td class="py-2">Supplier</td>
                                        <td class="py-2">Address</td>
                                        <td class="py-2">Contact Person</td>
                                        <td class="py-2">Contact No.</td>
                                        <td class="py-2">Email</td>
                                        <td class="rounded-tr-md"></td>
                                    </thead>
                                <?php if($supplier){ ?>
                                    <?php foreach($supplier as $suppliers): ?>
                                        <tr>
                                            <td class="py-2 pl-2"><?= $suppliers['supplier_id'];?></td>
                                            <td><?= $suppliers['product'];?></td>
                                            <td><?= $suppliers['address'];?></td>
                                            <td><?= $suppliers['contact_person'];?></td>
                                            <td><?= $suppliers['contact_no'];?></td>
                                            <td><?= $suppliers['email'];?></td>
                                            <td><a href="suppliers.php?supplierID=<?= $suppliers['supplier_id'];?>"><button class="ml-2 rounded-lg bg-[#1bcb00] text-white hover:bg-[#159d00] p-1 text-sm">Select</button></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </table>

                            <?php if(!$supplier) {?>
                                    <div class="ml-[20rem] mt-[10rem] text-lg text-[#67b0e7]"><p>PLEASE CHECK THE NAME!</p></div>
                            <?php } ?>
                    </div>

                    <div class="w-1/5 bg-[#eaf8ff] p-5 rounded-br-lg flex-initial">
                        <div class="flex-1 items-center outline outline-offset-2 outline-[#2986CC] rounded-md h-[5rem] mb-4 p-2">
                            <form method="post" action="suppliers.php">
                                <input type="text" name="searchTag" placeholder="Search Product Name" class="w-32 outline outline-offset-2 outline-[#2986CC] rounded-md text-sm bg-transparent text-md text-[#2986CC]" required></input>
                                <button type="submit" name="searchSupplier" class="ml-2 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-1 text-sm">Search</button>
                            </form>
                            <a href="suppliers.php"><button class="w-full rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] mt-2 ">All</button></a>
                            
                        </div>
                        <div class="flex-1 items-center outline outline-offset-2 outline-[#2986CC] rounded-md h-[13rem] mb-4 p-2">
                            <form method="post" action="suppliers.php">
                                <b><p class="text-[#2986CC] text-center">Supplier Details:</p></b>
                                <ul>
                                <p class="text-sm text-[#2986CC] mt-2"><b>Supplier ID: </b><?= $supplierDetails['supplier_id'];?></p>
                                <input type="text" name="supplierID" value = "<?= $supplierDetails['supplier_id'];?>" hidden>
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>Supplier: </b></label>
                                <input type="text" name="name" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-4 px-2" value = "<?= $supplierDetails['product'];?>">
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>Address: </b></label>
                                <input type="text" name="address" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-1 px-2" value = "<?= $supplierDetails['address'];?>">
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>Contact Person: </b></label>
                                <input type="text" name="contactPerson" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-1 px-2" value = "<?= $supplierDetails['contact_person'];?>">
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>Contact No. </b></label>
                                <input type="text" name="contactNum" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-3 px-2" value = "<?= $supplierDetails['contact_no'];?>">
                                </ul>
                                <ul>
                                <label class="text-[#2986CC] text-sm"><b>Email: </b></label>
                                <input type="text" name="email" required class="outline outline-offset-1 outline-[#2986CC] rounded-md bg-transparent text-sm text-[#2986CC] w-24 ml-4 px-2" value = "<?= $supplierDetails['email'];?>">
                                </ul>
                                <div class="my-3">
                                    <button name="removeSupplier" type="submit" class="ml-1 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Remove</button>
                                    <button name="updateSupplier" type="submit" class="ml-1 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Update</button>
                                    <?php if (!$supplierDetails['supplier_id']) { ?>
                                        <button name="addSupplier" type="submit" class="ml-1 rounded-lg bg-[#67b0e7] text-white hover:bg-[#2986CC] p-2 text-sm">Add</button>
                                    <?php } else {?>
                                        <button name="addSupplier" type="submit" class="ml-1 rounded-lg text-white bg-[#cdcdcd] p-2 text-sm" disabled>Add</button>
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