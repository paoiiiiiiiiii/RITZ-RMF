<?php 
require_once('ritzrmfserver.php');
$rmf = new Hardware();
$products = $rmf->addCart();
$users = $rmf->home(); 
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
    <body>    	
        <div class="main-container" style="position:absolute;">
            <div class="navbar" style="background-color:#ADD8E6; position:absolute; width:100%; height:250px;">
                <p>RITZ - RMF HARDWARE</p>
                <p>WELCOME</p>
                <p>RITZ - RMF HARDWARE</p>
                <ul>
                    <li><?= $users['email'];?></li>
                    <li><?= $users['user_id'];?></li>
                    <li><?= $users['fname'];?></li>
                    <li><?= $users['lname'];?></li>
                    <li><?= $users['role'];?></li>
                    <li><a href="login.php?logout='1'">Click here to Logout</a></li>	    
                </ul>
            </div>
            <div class="main" style="position:relative; width:100%; margin-top:300px;">
                <a href="browseProducts.php">Back to Browse Products</a>
                <table>
                    <tr>
                        <th><?= $products['product_id'];?></th>
                        <th><?= $products['product_code'];?></th>
                        <th><?= $products['barcode'];?></th>
                        <th><?= $products['product_name'];?></th>
                        <th><?= $products['product_brand'];?></th>
                        <th><?= $products['price'];?></th>
                        <th><?= $products['quantity'];?></th>   
                    </tr>
                </table>
                <form method="post" action="addCart.php">
                    <div class="input-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" required>
                        <label>Discount</label>
                        <input type="number" name="discount" value="0">
                        <button type="submit" class="btn" name="addCart">
                            Add to Cart
                        </button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </body>

 
</html>