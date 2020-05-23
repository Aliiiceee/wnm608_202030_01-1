<?php
	require_once "../Controller/controller.php";

	/** View
	 *  Handles requests from javascript using ajax
	 */
	class View
	{
		function __construct() {
			$this->controller = new Controller();
		}

		function getAllProducts() {
			return json_encode($this->controller->getAllProducts());
		}
	}

	if(isset($_SESSION['view'])) {
		$view = $_SESSION['view'];
	} else {
		$view = new View();
		$_SESSION['view'] = $view;
	}

	if(isset($_POST['request'])){
	    switch ($_POST['request']) {
	        case "GetAllProducts":
	        	echo $view->getAllProducts();
	        	break;
	        default:
	            echo 'No such request.';
	            break;
	    }
	}
?>