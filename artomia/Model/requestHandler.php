<?php
	include_once "functions.php";

	//handle request
	if(!isset($_POST['request'])){
		echo "Request not defined.";
	}else{
		switch ($_POST['request']) {
			case 'getAllProducts':
				$result = getAllProducts();
				echo $result;
				break;
			case 'getProductWithId':
				$result = getProductWithId($_POST['id']);
				echo $result;
				break;
			case 'getAllProductsSortedByPrice':
				$result = getAllProductsSortedByPrice($_POST['order']);
				echo $result;
				break;
			case 'getAllProductsSortedByDate':
				$result = getAllProductsSortedByDate($_POST['order']);
				echo $result;
				break;
			case 'getAllProductsSortedByPurchase':
				$result = getAllProductsSortedByPurchase($_POST['order']);
				echo $result;
				break;
			case 'addToCart':
				$result = addToCart($_POST['id'], $_POST['image'], $_POST['name'], $_POST['amount'], $_POST['price']);
				echo $result;
				break;
			case 'getCartItems':
				$result = getCartItems();
				echo json_encode($result);
				break;
			case 'searchProducts':
				$result = searchProducts($_POST['keyword']);
				echo $result;
				break;
			case 'searchProducts':
				$result = addNewItem($_POST['title'], $_POST['image'], $_POST['artist'], $_POST['material'], $_POST['description'], $_POST['quantity'], $_POST['price']);
				echo $result;
				break;
			default:
				# code...
				break;
		}
	}


?>