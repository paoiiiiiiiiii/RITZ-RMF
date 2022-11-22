<?php 
session_start();
Class Hardware {
	

	private $server = "mysql:host=localhost;dbname=ritz_rmf_db";
	private $user = "root";
	private $pass = "";
	private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	protected $con;

	public function openConnection(){

		try{

			$this->con = new PDO($this->server, $this->user, $this->pass, $this->options);
			return $this->con;

		}catch(PDOException $e) {

			echo "There is a problem in the connection: ". $e->getMessage();

		}
	}

	public function closeConnection(){

		$this->con = null;
	}

	public function loginUser(){
		$user = "";
		if (isset($_POST['login_user'])) {
			$email = $_POST['email'];
			$password = md5($_POST['password']);

			if (empty($email) or empty($password)){
				echo("PLEASE FILL UP ALL THE FIELDS");

			} else {
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM user WHERE email = '$email' AND password = '$password'");
				$sql->execute();
				$user = $sql->fetch();
				$userCount = $sql->rowCount();

				if($userCount == 1){
					echo("Successfully Logged in!");
					$_SESSION['authentication'] = 1;
					$_SESSION['id'] = $user['user_id'];
					$_SESSION['role'] = $user['role'];
					if ($_SESSION['role']=="admin"){
						header ('location:dashboard.php');
						// unset($_SESSION['total_price']);
						// unset($_SESSION['moneyOfCustomer']);
						// unset($_SESSION['transacNum']);
					} else {
						header ('location:staffDashboard.php');
					}
					
				} else {
					echo("INVALID CREDENTIALS");
					$user = null;
				}
			}
		}
		//logout
		if (isset($_GET['logout'])) {
			unset($_SESSION['id']);
			unset($_SESSION['role']);
			unset($_SESSION['authentication']);
			session_destroy();
			header("location: login.php");
		}
	}

	public function registerUser(){
		if (isset($_POST['register_user'])) {
			$email = $_POST['email'];
			$password1 = $_POST['password_1'];
			$password2 = $_POST['password_2'];
			$firstname = $_POST['fname'];
			$lastname = $_POST['lname'];
			$phoneNum = $_POST['phoneNum'];
			$userRole= $_POST['userRole'];

			$connection = $this->openConnection();
			$sql = $connection->prepare("SELECT * FROM user WHERE email = '$email'");
			$sql->execute();
			$user = $sql->fetchAll();
			$userCount = $sql->rowCount();		

			if ($userCount == 1){
				echo("Username/email already exists");
			} else {
				if (empty($email) or empty($password1) or empty($password2) or empty($firstname) or empty($lastname)or empty($phoneNum)or empty($userRole)) { 
					echo("PLEASE FILL UP ALL THE FIELDS"); 
				} else {
					if ($password1 == $password2){
						$password = md5($password1);
						$connection = $this->openConnection();
						$sql = $connection->prepare(
							"INSERT INTO user(email, password, role, phone_number, fname, lname) 
							VALUES('$email', '$password', '$userRole', '$phoneNum', '$firstname', '$lastname')");
						$sql->execute();

						header ('location:login.php');
					} else {
						echo("The two passwords do not match!");
					}
				}
			}
		}
	}

	public function changePassword(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				$message="";
				if (isset($_POST['save'])){
					$email = $_POST['email'];
					$oldPassword = md5($_POST['oldPassword']);
					$newPassword = $_POST['newPassword'];
					$newPassword1 = $_POST['newPassword1'];

					$activeUser = $_SESSION['id'];
					$connection = $this->openConnection();
					$sql = $connection->prepare("SELECT * FROM user WHERE user_id = '$activeUser'");
					$sql->execute();
					$userinfo = $sql->fetch();

					if ($newPassword == $newPassword1 ){
						if (($oldPassword == $userinfo['password']) && ($email == $userinfo['email'])){
							$newPassword = md5($newPassword1);
							$connection = $this->openConnection();
							$sql = $connection->prepare("UPDATE user SET password='$newPassword' WHERE user_id = '$activeUser'");
							$sql->execute();
							$message="Success!";

							return $message;
						} else {
							$message="Old Password or Email is incorrect!";
							return $message;
						}
					} else{
						$message = "The two Passwords do not match!";
						return $message;
					}
				}
			}
		} else {
			header ('location:login.php');
		}
	}

	public function home(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				//ADMIN
				$activeUser = $_SESSION['id'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM user WHERE user_id = '$activeUser'");
				$sql->execute();
				$userinfo = $sql->fetch();
				return $userinfo;

			} else if ($_SESSION['role']=="staff"){
				//STAFF/CASHIER
				$activeUser = $_SESSION['id'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM user WHERE user_id = '$activeUser'");
				$sql->execute();
				$userinfo = $sql->fetch();
				return $userinfo;

			}
		} else {
			header ('location:login.php');
		}

	}

	public function browseProducts(){
		if ($_SESSION['authentication']) {
			$connection = $this->openConnection();
			$sql = $connection->prepare("SELECT * FROM inventory WHERE quantity != '0'");
			$sql->execute();
			$productInfo = $sql->fetchAll();

			if (isset($_POST['searchProduct'])){
				$searchTag = $_POST['searchTag'];

				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM inventory WHERE barcode = '$searchTag'");
				$sql->execute();
				$productInfo = $sql->fetchAll();

				return $productInfo;
			} else {
				return $productInfo;
			}


		} else {
			header ('location:login.php');
		}
	}

	public function browseAdminProducts(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM inventory");
				$sql->execute();
				$productInfo = $sql->fetchAll();

				if (isset($_POST['searchProduct'])){
					$searchTag = $_POST['searchTag'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("SELECT * FROM inventory WHERE barcode = '$searchTag'");
					$sql->execute();
					$productInfo = $sql->fetchAll();

					return $productInfo;
				} else {
					return $productInfo;
				}
			}
		} else {
			header ('location:login.php');
		}
	}

	public function removeInventory(){
		if ($_SESSION['authentication']) {
			if (isset($_GET['productID'])) {
				$prod_id = $_GET['productID'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM inventory WHERE product_id = '$prod_id'");
				$sql->execute();
				$productInfo = $sql->fetch();

				return $productInfo;
			}

			if (isset($_POST['removeProduct'])){
				$product_id = $_POST['productID'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("DELETE FROM inventory WHERE product_id = '$product_id'");
				$sql->execute();
				
				header ('location:adminProducts.php');
			}

			if (isset($_POST['updateProduct'])){
				$product_id = $_POST['productID'];
				$product_name = $_POST['prodName'];
				$product_brand = $_POST['prodBrand'];
				$product_code = $_POST['productCode'];
				$barcode = $_POST['barcode'];
				$price= $_POST['price'];
				$quantity = $_POST['quantity'];

				$connection = $this->openConnection();
				$sql = $connection->prepare("UPDATE inventory SET 
					product_name = '$product_name', 
					product_brand = '$product_brand', 
					product_code = '$product_code',
					barcode = '$barcode',
					price = '$price',
					quantity = '$quantity'

					WHERE product_id = '$product_id'

					");

				$sql->execute();
				
				header ('location:adminProducts.php');
			}

			if (isset($_POST['addProduct'])){
				$product_name = $_POST['prodName'];
				$product_brand = $_POST['prodBrand'];
				$product_code = $_POST['productCode'];
				$barcode = $_POST['barcode'];
				$price= $_POST['price'];
				$quantity = $_POST['quantity'];

				$connection = $this->openConnection();
				$sql = $connection->prepare("INSERT INTO inventory(product_name, product_brand, product_code, barcode, price, quantity) 
					VALUES ('$product_name', '$product_brand', '$product_code', '$barcode','$price', '$quantity')");
				$sql->execute();
				
				header ('location:adminProducts.php');
			}

		} else {
			header ('location:login.php');
		}
	}

	public function browseSuppliers(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM supplier");
				$sql->execute();
				$supplierInfo = $sql->fetchAll();

				if (isset($_POST['searchSupplier'])){
					$searchTag = $_POST['searchTag'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("SELECT * FROM supplier WHERE product LIKE '%$searchTag%';");
					$sql->execute();
					$supplierInfo = $sql->fetchAll();

					return $supplierInfo;
				} else {
					return $supplierInfo;
				}
			}

		} else {
			header ('location:login.php');
		}
	}

	public function supplier(){
		if ($_SESSION['authentication']) {
			if (isset($_GET['supplierID'])) {
				$supplier_id = $_GET['supplierID'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM supplier WHERE supplier_id = '$supplier_id'");
				$sql->execute();
				$supplierInfo = $sql->fetch();

				return $supplierInfo;
			}

			if (isset($_POST['removeSupplier'])){
				$supplier_id = $_POST['supplierID'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("DELETE FROM supplier WHERE supplier_id = '$supplier_id'");
				$sql->execute();
				
				header ('location:suppliers.php');
			}

			if (isset($_POST['updateSupplier'])){
				$supplier_id = $_POST['supplierID'];
				$name = $_POST['name'];
				$address = $_POST['address'];
				$contactPerson = $_POST['contactPerson'];
				$contactNum = $_POST['contactNum'];
				$email= $_POST['email'];

				$connection = $this->openConnection();
				$sql = $connection->prepare("UPDATE supplier SET 
					product = '$name', 
					address = '$address', 
					contact_person = '$contactPerson',
					contact_no = '$contactNum',
					email = '$email'

					WHERE supplier_id = '$supplier_id'
					");
					
				$sql->execute();
				
				header ('location:suppliers.php');
			}

			if (isset($_POST['addSupplier'])){
				$name = $_POST['name'];
				$address = $_POST['address'];
				$contactPerson = $_POST['contactPerson'];
				$contactNum = $_POST['contactNum'];
				$email= $_POST['email'];

				$connection = $this->openConnection();
				$sql = $connection->prepare("INSERT INTO supplier(product, address, contact_person, contact_no, email) VALUES ('$name', '$address', '$contactPerson', '$contactNum','$email')");
				$sql->execute();
				
				header ('location:suppliers.php');
			}

			

		} else {
			header ('location:login.php');
		}
	}
	
	public function addCart(){
		if ($_SESSION['authentication']) {
			if (isset($_GET['productID'])) {
				$prod_id = $_GET['productID'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM inventory WHERE product_id = '$prod_id'");
				$sql->execute();
				$productInfo = $sql->fetch();

				return $productInfo;
			}

			if (isset($_POST['addCart'])){
				$quantity = $_POST['quantity'];
				$discount = $_POST['discount'];
				$product_id = $_POST['addProd'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM inventory WHERE product_id = '$product_id'");
				$sql->execute();
				$productInfo = $sql->fetch();
					
				if($productInfo['quantity'] < $quantity){
					echo("Provide Valid Quantity!");
				} else {
					$transac_num = $_SESSION['transacNum'];
					$total_price = ($quantity * $productInfo['price']) - $discount;
					$_SESSION['total_price'] += $total_price;
					$connection = $this->openConnection();
					$sql = $connection->prepare("
						INSERT INTO transaction(transaction_id, product_id, quantity_bought, discount, total_price)
						VALUES ('$transac_num', '$product_id', '$quantity', '$discount', '$total_price')");		
					$sql->execute();
					echo ("Succesfully added to cart!");
					header('location:browseProducts.php');
				}
			}

		} else {
			header ('location:login.php');
		}
	}
	
	public function newTransac(){
		if ($_SESSION['authentication']) {
			if(isset($_POST['newTransac'])){
				$_SESSION['total_price'] = 0;
				$activeUser = $_SESSION['id'];
				$soldTo = $_POST['soldTo'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("INSERT INTO transaction_num(date, soldTo, cashier_id) VALUES (now(), '$soldTo', '$activeUser')");
				$sql->execute();
				
				$sqlLatest = $connection->prepare("SELECT * FROM transaction_num ORDER BY transaction_id DESC LIMIT 1");
				$sqlLatest->execute();
				$sqlLatest1 = $sqlLatest->fetch();

				$_SESSION['transacNum'] = $sqlLatest1['transaction_id'];
				return $sqlLatest1;
				header('location:staffDashboard.php');
			} else {
				$transac_num = $_SESSION['transacNum'];
				$connection = $this->openConnection();
				$sqlLatest = $connection->prepare("SELECT * FROM transaction_num WHERE transaction_id = '$transac_num'");
				$sqlLatest->execute();
				$sqlLatest1 = $sqlLatest->fetch();

				return $sqlLatest1;
			}
		} else {
			header ('location:login.php');
		}
	}

	public function showCart(){
		if ($_SESSION['authentication']) {
			$transac_num = $_SESSION['transacNum'];
			$connection = $this->openConnection();
			$sql = $connection->prepare("SELECT *,CONCAT(inventory.product_name,' ',inventory.product_brand) AS product_desc, inventory.price FROM transaction INNER JOIN inventory ON transaction.product_id = inventory.product_id WHERE transaction_id = '$transac_num';");
			$sql->execute();
			$productInfo = $sql->fetchAll();

			return $productInfo;
		} else {
			header ('location:login.php');
		}
	}

	public function settlePayment(){
		if ($_SESSION['authentication']) {
			if (isset($_POST['settlePayment'])){
				$_SESSION['moneyOfCustomer'] = $_POST['money'];
				$_SESSION['discountOfCustomer'] = $_POST['discount'];
				$money = $_SESSION['moneyOfCustomer'];
				$discount = $_SESSION['discountOfCustomer'];
				$total_price = $_SESSION['total_price'] - $_SESSION['discountOfCustomer'];
				$change = $money - $total_price;

				if($money < $_SESSION['total_price']){
					echo ("INSUFFICIENT FUND");
				} else {
					header('location:settlePayment.php');
				}

			}

			if (isset($_POST['confirmTransac'])){
				$total_price = $_SESSION['total_price'];
				$money = $_SESSION['moneyOfCustomer'];
				$discount = $_SESSION['discountOfCustomer'];
				$change = $money + $discount - $total_price;
				$transac_num = $_SESSION['transacNum'];
				$total_price -= $discount;

				$connection = $this->openConnection();
				$sql = $connection->prepare("UPDATE transaction_num SET amount = '$total_price', moneyOfCustomer = '$money', changeOfCustomer = '$change', discount = '$discount', transacState = 'completed' WHERE transaction_id = '$transac_num';");
				$sql->execute();

				//
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT quantity_bought, product_id FROM transaction WHERE transaction_id = '$transac_num'");
				$sql->execute();
				$productBought = $sql->fetchAll();
				
				foreach ($productBought as $product_bought){
					$connection = $this->openConnection();
					$product_id = $product_bought['product_id'];
					$sql = $connection->prepare("SELECT * FROM inventory WHERE product_id = '$product_id' ");
					$sql->execute();
					$inventoryQuantity=$sql->fetch();

					$newQuantity = $inventoryQuantity['quantity'] - $product_bought['quantity_bought'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("UPDATE inventory SET quantity = '$newQuantity' WHERE product_id = '$product_id'");
					$sql->execute();
				}

				unset($_SESSION['total_price']);
				unset($_SESSION['moneyOfCustomer']);
				unset($_SESSION['transacNum']);
				unset($_SESSION['discountOfCustomer']);

				header('location:staffDashboard.php');
			}

		} else {
			header ('location:login.php');
		}
	}

	public function returnTotal(){
		return $_SESSION['total_price'];
	}

	public function sessionChecker(){
		if ($_SESSION['transacNum'] != null){
			return true;
		} else {
			return false;
		}
	}

	public function returnMoneyOfCustomer(){
		return $_SESSION['moneyOfCustomer'];
	}

	public function returnChangeOfCustomer(){
		return $_SESSION['moneyOfCustomer'] - ($_SESSION['total_price'] - $_SESSION['discountOfCustomer']);
	}

	public function returnDiscount(){
		return $_SESSION['discountOfCustomer'];
	}

	public function deleteItem(){
		if($_SESSION['authentication']){
			if (isset($_GET['deleteId'])) {
				$trans_id = $_GET['deleteId'];
				$transac_num = $_SESSION['transacNum'];
	
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT trans_id,total_price FROM transaction WHERE trans_id = '$trans_id'");
				$sql->execute();
				$deletedItem = $sql->fetch();
	

				$connection = $this->openConnection();
				$sql = $connection->prepare("DELETE FROM transaction WHERE trans_id = '$trans_id'");
				$sql->execute();
	
				$_SESSION['total_price'] -= $deletedItem['total_price'];


				header('location:staffDashboard.php');
			}

			if (isset($_GET['deleteAll'])){
				$transac_num = $_SESSION['transacNum'];

				$connection = $this->openConnection();
				$sql = $connection->prepare("DELETE FROM transaction WHERE transaction_id = '$transac_num'");
				$sql->execute();

				$_SESSION['total_price'] = 0;
				header('location:staffDashboard.php');
			}

		} else {
			header ('location:login.php');
		}
	}

	public function showHistory(){
		if ($_SESSION['authentication']) {
			$connection = $this->openConnection();
			$sql = $connection->prepare("SELECT *,inventory.product_name, inventory.product_brand, inventory.price, transaction_num.date FROM transaction INNER JOIN inventory ON transaction.product_id = inventory.product_id INNER JOIN transaction_num ON transaction.transaction_id = transaction_num.transaction_id WHERE quantity_bought != '0' ORDER BY transaction_num.transaction_id DESC;");
			$sql->execute();
			$productInfo = $sql->fetchAll();

			if (isset($_POST['searchProduct'])){
				$searchTag = $_POST['searchTag'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT *,inventory.product_name, inventory.product_brand, inventory.price, transaction_num.date FROM transaction INNER JOIN inventory ON transaction.product_id = inventory.product_id INNER JOIN transaction_num ON transaction.transaction_id = transaction_num.transaction_id WHERE quantity_bought != '0' AND barcode = '$searchTag' ORDER BY transaction_num.transaction_id DESC;");
				$sql->execute();
				$productInfo = $sql->fetchAll();

				return $productInfo;
			} else {
				return $productInfo;
			}

		} else {
			header ('location:login.php');
		}
	}

	public function cancelHistory(){
		if ($_SESSION['authentication']) {
			if (isset($_GET['transId'])){
				$trans_id = $_GET['transId'];
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT *,inventory.product_code,CONCAT(inventory.product_name,' ',inventory.product_brand) AS product_desc FROM `transaction` INNER JOIN inventory ON transaction.product_id = inventory.product_id WHERE trans_id = '$trans_id'");
				$sql->execute();
				$cancelProductInfo = $sql->fetch();
	
				return $cancelProductInfo;
			}

			if (isset($_POST['cancel_order'])) {
				$trans_id = $_POST['cancelledTrans'];
				$quantity = $_POST['quantityCancelled'];
				$action = $_POST['action'];
				$activeUser = $_SESSION['id'];

				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT *, inventory.barcode, inventory.product_name, inventory.product_brand, inventory.price FROM transaction INNER JOIN inventory ON transaction.product_id = inventory.product_id WHERE trans_id = '$trans_id'");
				$sql->execute();
				$cancelProductInfo = $sql->fetch();

				$sql = $connection->prepare("SELECT * FROM user WHERE user_id = '$activeUser'");
				$sql->execute();
				$user_info= $sql->fetch();

				$product_id = $cancelProductInfo['product_id'];
				$transac_num = $cancelProductInfo['transaction_id'];
				$barcode = $cancelProductInfo['barcode'];
				$name = $cancelProductInfo['product_name'];
				$brand = $cancelProductInfo['product_brand'];
				$price = $cancelProductInfo['price'];
				$quantityNew = $cancelProductInfo['quantity_bought'] - $quantity;
				$total_cancelled = $price * $quantity;
				$user = $user_info['fname'].' '.$user_info['lname'];
				$total_price = $cancelProductInfo['total_price'] - $total_cancelled;

				$sql = $connection->prepare("INSERT INTO cancelled_order(transaction_id, barcode, product_name, product_brand, price, quantity_cancelled, total_cancelled, date, void_by, action) 
					VALUES ('$transac_num', '$barcode', '$name', '$brand', '$price', '$quantity', '$total_cancelled', now(), '$user', '$action')");
				$sql->execute();

				$sql = $connection->prepare("UPDATE transaction SET quantity_bought = '$quantityNew' WHERE trans_id = '$trans_id'");
				$sql->execute();

				if ($action == "Yes"){
					$connection = $this->openConnection();
					$sql = $connection->prepare("UPDATE transaction SET total_price = '$total_price' WHERE trans_id = '$trans_id'");
					$sql->execute();

					$connection = $this->openConnection();
					$sql = $connection->prepare("SELECT * FROM inventory WHERE product_id = '$product_id'");
					$sql->execute();
					$product = $sql->fetch();

					$quantityInventory = $product['quantity'];
					$quantityInventory += $quantity;

					$sql = $connection->prepare("UPDATE inventory SET quantity = '$quantityInventory' WHERE product_id = '$product_id'");
					$sql->execute();
			
					header('location:history.php');
				}

			}

		} else {
			header ('location:login.php');
		}
	}

	public function getMonthlySales(){
		$month = date("m");
		$year = date('Y');

		$connection = $this->openConnection();
		$query = "SELECT date,amount FROM transaction_num WHERE EXTRACT(MONTH FROM date) = '$month' AND EXTRACT(YEAR FROM date) = '$year' AND transacState = 'completed';";
		$sql = $connection->prepare($query);
		$sql->execute();
		$sales = $sql->fetchAll();

		$query = "SELECT * FROM cancelled_order WHERE EXTRACT(MONTH FROM date) = '$month' AND EXTRACT(YEAR FROM date) = '$year';";
		$sql = $connection->prepare($query);
		$sql->execute();
		$cancelledSales = $sql->fetchAll();

		$monthlySales = 0;
		$monthlyCancelledSales = 0;

		foreach ($sales as $monthlySale){
			$monthlySales += $monthlySale['amount'];
		}

		foreach ($cancelledSales as $monthlyCancelledSale){
			$monthlyCancelledSales += $monthlyCancelledSale['total_cancelled'];
		}

		return $monthlySales-$monthlyCancelledSales;
	}

	public function getProductLine(){
		$connection = $this->openConnection();
		$sql = $connection->prepare("SELECT * FROM inventory;");
		$sql->execute();
		$inventory = $sql->fetchAll();
		$countInventory = count($inventory);

		return $countInventory;
	}

	public function getStocksOnHand(){
		$connection = $this->openConnection();
		$sql = $connection->prepare("SELECT * FROM inventory;");
		$sql->execute();
		$inventory = $sql->fetchAll();
		$stocks = 0;

		foreach ($inventory as $inventoryStocks){
			$stocks += $inventoryStocks['quantity'];
		}

		return $stocks;
	}

	public function getCriticalItems(){
		$connection = $this->openConnection();
		$sql = $connection->prepare("SELECT * FROM inventory WHERE quantity <= 50;");
		$sql->execute();
		$inventory = $sql->fetchAll();
		$criticalItems = count($inventory);

		return $criticalItems;
	}

	public function generateRefNo(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				if (isset($_POST['generate'])){
					$name = $_POST['name'];
					$connection = $this->openConnection();
					$sql = $connection->prepare("INSERT INTO stockin(stock_by) VALUES('$name');");
					$sql->execute();

					$sqlLatest = $connection->prepare("SELECT * FROM stockin ORDER BY stockin_id DESC LIMIT 1");
					$sqlLatest->execute();
					$sqlLatest1 = $sqlLatest->fetch();

					$_SESSION['stockin_id'] = $sqlLatest1['stockin_id'];
					return $sqlLatest1;
					header('location:stockEntry.php');
				}

				if (isset($_POST['save'])){
					unset($_SESSION['stockin_id']);
				}
			}

		} else {
			header ('location:login.php');
		}
	}

	public function stockIn(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				if (isset($_POST['addStock'])){
					$stockin_id = $_SESSION['stockin_id'];
					$pcode = $_POST['pcode'];
					$barcode = $_POST['barcode'];
					$pdesc= $_POST['desc'];
					$quantity= $_POST['quantity'];

					$supplier = $_POST['supplier'];
					$contactPerson = $_POST['contactPerson'];
					$address = $_POST['address'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("INSERT INTO 
						stock_in_history(stockin_id, product_code, barcode, product_name, supplier, stock_date, quantity, contact_person, address)
						VALUES ('$stockin_id', '$pcode', '$barcode', '$pdesc', '$supplier', now(), '$quantity', '$contactPerson', '$address')");
					$sql->execute();

					$connection = $this->openConnection();
					$sql = $connection->prepare("UPDATE inventory SET quantity = quantity + '$quantity' WHERE barcode = '$barcode'");
					$sql->execute();

					header('location:stockEntry.php');
				}

				if (isset($_GET['barcode'])){
					$barcode = $_GET['barcode'];
					$stockin_id = $_SESSION['stockin_id'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("SELECT * FROM stock_in_history WHERE stockin_id = '$stockin_id' AND barcode = '$barcode'");
					$sql->execute();
					$deleted = $sql->fetch();

					$quantity = $deleted['quantity'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("UPDATE inventory SET quantity = quantity - '$quantity' WHERE barcode = '$barcode'");
					$sql->execute();

					$connection = $this->openConnection();
					$sql = $connection->prepare("DELETE FROM stock_in_history WHERE stockin_id = '$stockin_id' AND barcode = '$barcode'");
					$sql->execute();

					header('location:stockEntry.php');
				}
			}

		} else {
			header ('location:login.php');
		}
	}

	public function presentStockIn(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				if ($_SESSION['stockin_id']) {	
					$stockin_id = $_SESSION['stockin_id'];

					$connection = $this->openConnection();
					$query = "SELECT *,stockin.stock_by FROM stock_in_history INNER JOIN stockin ON stock_in_history.stockin_id = stockin.stockin_id WHERE stock_in_history.stockin_id = '$stockin_id';";
					$sql = $connection->prepare($query);
					$sql->execute();
					$presentStockIn = $sql->fetchAll();

					return $presentStockIn;
					header('location:stockEntry.php');
				}
			}

		} else {
			header ('location:login.php');
		}
	}

	public function refSessionChecker(){
		return $_SESSION['stockin_id'];
	}

	public function stockInHistory(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){

				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT *,stockin.stock_by FROM stock_in_history INNER JOIN stockin ON stock_in_history.stockin_id = stockin.stockin_id ORDER BY stock_in_history.stockin_id DESC;");
				$sql->execute();
				$stockin = $sql->fetchAll();

				if (isset($_GET['barcode'])) {
					$barcode = $_GET['barcode'];
					$stockInID = $_GET['stockInID'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("SELECT * FROM stock_in_history WHERE stockin_id = '$stockInID' AND barcode = '$barcode'");
					$sql->execute();
					$deleted = $sql->fetch();

					$quantity = $deleted['quantity'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("UPDATE inventory SET quantity = quantity - '$quantity' WHERE barcode = '$barcode'");
					$sql->execute();

					$connection = $this->openConnection();
					$sql = $connection->prepare("DELETE FROM stock_in_history WHERE stockin_id = '$stockInID' AND barcode = '$barcode'");
					$sql->execute();

					header('location:stockInHistory.php');
				}

				return $stockin;
			}

		} else {
			header ('location:login.php');
		}
	}

	public function topSelling(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT SUM(transaction.quantity_bought) AS total_sold, SUM(transaction.total_price) AS total_sale, transaction.product_id, inventory.* FROM transaction INNER JOIN inventory ON transaction.product_id = inventory.product_id GROUP BY transaction.product_id ORDER BY SUM(transaction.quantity_bought) DESC LIMIT 5; ");
				$sql->execute();
				$topSelling = $sql->fetchAll();

				return $topSelling;
			}

		} else {
			header ('location:login.php');
		}
	}

	public function soldItems(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT SUM(transaction.quantity_bought) AS total_sold, SUM(transaction.total_price) AS total_sale, transaction.product_id, inventory.* FROM transaction INNER JOIN inventory ON transaction.product_id = inventory.product_id GROUP BY transaction.product_id ORDER BY SUM(transaction.quantity_bought) DESC; ");
				$sql->execute();
				$topSelling = $sql->fetchAll();

				return $topSelling;
			}

		} else {
			header ('location:login.php');
		}
	}

	public function criticalStocks(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM inventory WHERE quantity <= 50;");
				$sql->execute();
				$criticalStocks = $sql->fetchAll();

				return $criticalStocks;
			}

		} else {
			header ('location:login.php');
		}
	}

	public function cancelledItems(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT * FROM cancelled_order ORDER BY cancelled_id DESC;");
				$sql->execute();
				$cancelledItems = $sql->fetchAll();

				if (isset($_POST['searchProduct'])){
					$searchTag = $_POST['searchTag'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("SELECT * FROM cancelled_order WHERE barcode = '$searchTag'");
					$sql->execute();
					$cancelledItems = $sql->fetchAll();

					return $cancelledItems;
				} else {
					return $cancelledItems;
				}
			}

		} else {
			header ('location:login.php');
		}
	}

	public function stockInRecord(){
		if ($_SESSION['authentication']) {
			if ($_SESSION['role'] == "admin"){
				$connection = $this->openConnection();
				$sql = $connection->prepare("SELECT *,stockin.stock_by,inventory.product_brand FROM stock_in_history INNER JOIN stockin ON stock_in_history.stockin_id = stockin.stockin_id INNER JOIN inventory ON stock_in_history.barcode = inventory.barcode ORDER BY stock_in_history.stockin_id DESC;");
				$sql->execute();
				$stockInRecord = $sql->fetchAll();

				if (isset($_POST['searchProduct'])){
					$searchTag = $_POST['searchTag'];

					$connection = $this->openConnection();
					$sql = $connection->prepare("SELECT *,stockin.stock_by,inventory.product_brand FROM stock_in_history INNER JOIN stockin ON stock_in_history.stockin_id = stockin.stockin_id INNER JOIN inventory ON stock_in_history.barcode = inventory.barcode WHERE stock_in_history.barcode = '$searchTag' ORDER BY stock_in_history.stockin_id DESC");
					$sql->execute();
					$stockInRecord = $sql->fetchAll();

					return $stockInRecord;
				} else {
					return $stockInRecord;
				}
			}

		} else {
			header ('location:login.php');
		}
	}

	public function setUserProfile(){
		if ($_SESSION['authentication']) {
			//active user id
			$activeUser = $_SESSION['activeID'];

			if (isset($_POST['set_user_profile'])) {
				$connection = $this->openConnection();
				//get all the fields in html
				$firstname = $_POST['fname'];
				$lastname = $_POST['lname'];
				$displayedname = $_POST['dname'];
				$gender = $_POST['gender'];
				$genre = $_POST['genre'];
				$desc = $_POST['description'];
				//UPDATE USER PROFILE ADD GENDER GENRE ETC
				$sql = $connection->prepare("UPDATE userprofile SET displayed_name = '$displayedname', gender = '$gender', genre = '$genre', description = '$desc' WHERE id_user = '$activeUser'");
				$sql->execute();

				//UPDATE USER LNAME FNAME SA USER TABLE
				$sql = $connection->prepare("UPDATE user SET fname='$firstname', lname='$lastname' WHERE id = '$activeUser'");
				$sql->execute();
				echo("PROFILE UPDATED!");
			}
			//details ni user fname lname
			$connection = $this->openConnection();
			$sql = $connection->prepare("SELECT * FROM user WHERE id = '$activeUser'");
			$sql->execute();
			$user = $sql->fetch();
			//profile ni user
			$sql = $connection->prepare("SELECT * FROM userprofile WHERE id_user = '$activeUser'");
			$sql->execute();
			$userprofile = $sql->fetch();

			return $userinfo = array($user, $userprofile);
		} else {
			header ('location:login.php');
		}
	}

	public function addArtwork(){
		if ($_SESSION['authentication']) {
			$activeUser = $_SESSION['activeID'];
			$statusMsg = '';

			//file path
			$targetDir = "artworks/";


			if(isset($_POST['add_artwork'])){
				//fields from html
				$aTitle = $_POST['art_title'];
				$aPoem = $_POST['art_poem'];
				$aMaterials = $_POST['art_materials'];
				$aGenre = $_POST['art_genre'];
				$aDate = date("Y/m/d");

				//get file from html
				$fileName = basename($_FILES["art_file"]["name"]);

				// Check if meron parehas na name
				$connection = $this->openConnection();
			    $sql = $connection->prepare("SELECT * FROM artworks WHERE art_file = '$fileName'");
				$sql->execute();
				$artwork = $sql->fetchAll();
				$artworkCount = $sql->rowCount();
				if ($artworkCount > 0) {
					$artworkCount += 1;
					$fileName = $artworkCount.$fileName;
				}

				//set file path and directory
				$targetFilePath = $targetDir.$fileName;
				$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

				//accepted file formats
				$allowTypes = array('jpg','png','jpeg','gif','pdf');

				if(in_array($fileType, $allowTypes)){
			        // Upload file to server
			        if(move_uploaded_file($_FILES["art_file"]["tmp_name"], $targetFilePath)){
			            // Insert image file and details into database
			            $connection = $this->openConnection();
			            $sql = $connection->prepare("INSERT INTO artworks(artist_id, art_file, art_title, art_poem, art_materials, art_genre, date_uploaded) VALUES ('$activeUser', '$fileName', '$aTitle', '$aPoem', '$aMaterials', '$aGenre', '$aDate')");
						$sql->execute();

			            if($sql){
			                $statusMsg = "The artwork has been uploaded successfully.";
			            } else {
			                $statusMsg = "File upload failed, please try again.";
			            } 
			        } else {
			            $statusMsg = "Sorry, there was an error uploading your file.";
			        }
			    } else {
			        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
			    }
			    //add if para sa checking ng same filename ng arts
			}
			// Display status message
			echo $statusMsg;
		} else {
			header ('location:login.php');
		}
	}

	//views the artwork of all the users para sa newsfeed/home//PANG LAHATAN
	public function viewArtwork(){
		if ($_SESSION['authentication']) {
			$connection = $this->openConnection();
			$sql = $connection->prepare("SELECT *, userprofile.displayed_name FROM artworks INNER JOIN userprofile ON artworks.artist_id=userprofile.id_user");
			#$sql = $connection->prepare("SELECT * FROM artworks");
			$sql->execute();
			#$artworksQuery = $sql->fetchAll();

			if($sql->rowCount() > 0){
				$artworksQuery = $sql->fetchAll();
				return $artworksQuery;
			}

		} else {
			header ('location:login.php');
		}
	}

	//views the artwork of the active user in viewprofile//PANG ACTIVE USER
	public function viewUserArtworks(){
		if ($_SESSION['authentication']) {
			$activeUser = $_SESSION['activeID'];
			$connection = $this->openConnection();
			$sql = $connection->prepare("SELECT * FROM artworks WHERE artist_id = '$activeUser'");
			$sql->execute();

			if($sql->rowCount() > 0){
				$artworksQuery = $sql->fetchAll();
				return $artworksQuery;
			}

		} else {
			header ('location:login.php');
		}	
	}

	//fetches another artist's userinfo, userprofile
	public function viewArtistProfile(){
		if ($_SESSION['authentication']) {
			$artistID = $_GET['artistID'];
			$connection = $this->openConnection();
			//userinfo sa user table
			$sql = $connection->prepare("SELECT * FROM user WHERE id = '$artistID'");
			$sql->execute();
			$userinfo = $sql->fetch();
			//userprofile
			$sql = $connection->prepare("SELECT * FROM userprofile WHERE id_user = '$artistID'");
			$sql->execute();
			$userprofile = $sql->fetch();

			return $user = array($userinfo, $userprofile);	
		} else {
			header ('location:login.php');
		}	
	}

	//fetches another artist's artwork when clicked on the newsfeed//PANG IBANG ARTIST NA ARTWORKS
	public function viewArtistArtwork(){
		if ($_SESSION['authentication']) {
			$artistID = $_GET['artistID'];
			$connection = $this->openConnection();
			$sql = $connection->prepare("SELECT * FROM artworks WHERE artist_id = '$artistID'");
			$sql->execute();

			if($sql->rowCount() > 0){
				$artworksQuery = $sql->fetchAll();
				return $artworksQuery;
			}

		} else {
			header ('location:login.php');
		}	
	}
	

}
?>

<!-- npx tailwindcss -i input.css -o styles.css --watch -->
<!-- SELECT * FROM `transaction` ORDER BY quantity_bought DESC; -->
<!-- SELECT SUM(quantity_bought), SUM(total_price), product_id FROM transaction GROUP BY product_id; -->
<!-- SELECT SUM(quantity_bought), SUM(total_price), product_id FROM transaction GROUP BY product_id ORDER BY SUM(total_price) DESC; -->
<!-- SELECT SUM(quantity_bought), SUM(total_price), product_id FROM transaction GROUP BY product_id ORDER BY SUM(quantity_bought) DESC; -->
<!-- SELECT SUM(transaction.quantity_bought), SUM(transaction.total_price), transaction.product_id, inventory.* FROM transaction INNER JOIN inventory ON transaction.product_id = inventory.product_id GROUP BY transaction.product_id ORDER BY SUM(transaction.quantity_bought) DESC LIMIT 5; -->
<!-- SELECT SUM(transaction.quantity_bought) AS total_sold, SUM(transaction.total_price) AS total_sale, transaction.product_id, inventory.* FROM transaction INNER JOIN inventory ON transaction.product_id = inventory.product_id GROUP BY transaction.product_id ORDER BY SUM(transaction.quantity_bought) DESC LIMIT 5; -->
<!-- SELECT SUM(transaction.quantity_bought) AS total_sold, SUM(transaction.total_price) AS total_sale, transaction.product_id, inventory.* FROM transaction INNER JOIN inventory ON transaction.product_id = inventory.product_id GROUP BY transaction.product_id ORDER BY SUM(transaction.quantity_bought) DESC; -->
<!-- select Date, TotalAllowance from Calculation where EmployeeId = 1
             and Date between '2011/02/25' and '2011/02/27' -->