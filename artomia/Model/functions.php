<?php
	include_once "auth.php";

	session_start();

	function getRows($conn,$sql) {
	    $a = [];

	    $result = $conn->query($sql);

	    if($conn->errno) die($conn->error);

	    while($row = $result->fetch_object()) {
	        $a[] = $row;
	    }

	    return $a;
	}

	// 3. Return result
	function getAllProducts(){
		$conn = connectToDB();

		//2. Read form table
		$arr = array();
		$sql = "SELECT *
				FROM products";
		$result = $conn->query($sql);
		while ($row = $result->fetch_object()){
			$arr[] = $row;
		}
		return json_encode($arr);
	}

	function getProductWithId($id){
		$conn = connectToDB();

		//2. Read form table
		$arr = array();
		$sql = "SELECT *
				FROM products
				WHERE Id = '" . $id . "'";
		$result = $conn->query($sql);
		$product = $result->fetch_object();
	
		return json_encode($product);
	}

	function getAllProductsSortedByPrice($order){
		$conn = connectToDB();

		//2. Read form table
		$arr = array();
		$sql = "SELECT *
				FROM products
				ORDER BY price " . $order;
		$result = $conn->query($sql);
		$products = array();
		while ($row = $result->fetch_object()){
			$products[] = $row;
		}
	
		return json_encode($products);
	}

	function getAllProductsSortedByPurchase($order){
		$conn = connectToDB();

		//2. Read form table
		$arr = array();
		$sql = "SELECT *
				FROM products
				ORDER BY purchase " . $order;
		$result = $conn->query($sql);
		$products = array();
		while ($row = $result->fetch_object()){
			$products[] = $row;
		}
	
		return json_encode($products);
	}

	function getAllProductsSortedByDate($order){
		$conn = connectToDB();

		//2. Read form table
		$arr = array();
		$sql = "SELECT *
				FROM products
				ORDER BY date " . $order;
		$result = $conn->query($sql);
		$products = array();
		while ($row = $result->fetch_object()){
			$products[] = $row;
		}
	
		return json_encode($products);
	}

	function searchProducts($keyword) {
		$conn = connectToDB();

		//2. Read form table
		$arr = array();
		$sql = "SELECT *
				FROM products
				WHERE name LIKE '%" . $keyword . "%' OR 
					  artist LIKE '%" . $keyword . "%'";
		$result = $conn->query($sql);
		$products = array();
		while ($row = $result->fetch_object()){
			$products[] = $row;
		}
	
		return json_encode($products);
	}

	// CART FUNCTIONS

	// Array find loops an array looking for the first object that matches a boolean function
	function array_find($array, $fn) {
	    foreach($array as $o) if($fn($o)) return $o;
	    return false;
	}

	function getCart() {
	    return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
	}

	function addToCart($id, $image, $name, $amount, $price) {
	    $cart = getCart();
	    
	    $p = array_find(
	        $cart,
	        function($o) use ($id) { return $o->id==$id; }
	    );

	    if($p) {
	        $p->amount += $amount;
	    } else {
	        $_SESSION['cart'][] = (object)[
	            "id"=>$id,
	            "image"=>$image,
	            "name"=>$name,
	            "amount"=>$amount,
	            "price"=>$price
	        ];
	    }

	    return "success";
	}

	function getCartItems() {
	    $cart = getCart();

	    if(empty($cart)) return [];

	    $ids = implode(",",array_map(function($o){return $o->id;},$cart));
	    $data = getRows(connectToDB(),
	        "SELECT * FROM `products` WHERE `id` in ($ids)"
	    );

	    return array_map(function($o) use ($cart) {
	        $p = array_find($cart,function($co) use ($o){ return $co->id==$o->id; });
	        $o->amount = $p->amount;
	        $o->total = $p->amount * $o->price;
	        return $o;
	    },$data);
	}

	function getCartTotal($fn) {
	    $cart = isset($_SESSION['cart'])?$_SESSION['cart']:[];
	    return array_reduce($cart,function($r,$o) use ($fn) {return $fn($r,$o);},0);
	}
	function getCartTotalItems() {
	    return getCartTotal(function($r,$o){return $r+$o->amount;});
	}
	function  getCartTotalPrice() {
	    $cart = isset($_SESSION['cart'])?$_SESSION['cart']:[];
	    return array_reduce($cart,function($r,$o){return $r+($o->amount*$o->price);});
	}

	function cartTotals() {
		$cart = getCart();

		$cartprice = array_reduce($cart,function($r,$o){return $r + ($o->amount*$o->price);},0);


		$pricefixed = number_format($cartprice, 2, '.', '');
		$taxfixed = number_format($cartprice*0.0725, 2, '.', '');
		$taxedfixed = number_format($cartprice*1.0725, 2, '.', '');


		return '
		<div class="card-section">
		    <div class="display-flex">
		        <div class="flex-stretch">
		            <strong>Sub-Total</strong>
		        </div>
		        <div class="flex-none">&dollar;' . $pricefixed . '</div>
		    </div>
		    <div class="display-flex">
		        <div class="flex-stretch">
		            <strong>Taxes</strong>
		        </div>
		        <div class="flex-none">&dollar;' . $taxfixed . '</div>
		    </div>
		</div>
		<div class="card-section">
		    <div class="display-flex">
		        <div class="flex-stretch">
		            <strong>Total</strong>
		        </div>
		        <div class="flex-none">&dollar;' . $taxedfixed . '</div>
		    </div>
		</div>';
	}

	function getFileData($url) {
	    $file = file_get_contents($url);
	    $data = json_decode($file);
	    return $data;

	}

	function getData($sql) { // had wrong value in the parentheses
	    $conn = connectToDB();

	    $result = $conn->query($sql);

	    if($conn->errno) die($conn->error);

	    $arr = [];
	    while($row = $result->fetch_object()) $arr[] = $row;

	    $conn->close();

	    return $arr;
	}



?>