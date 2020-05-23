<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Artomia</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/styleguide.css">
	<link rel="stylesheet" href="css/gridsystem.css">
	<link rel="stylesheet" href="css/storetheme.css">
	<link href="https://fonts.googleapis.com/css2?family=Amaranth:ital,wght@1,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

	<script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="js/functions.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.cart').hover(function() {
				$('.nav-icon').show();	
			}, function() {
				$('.nav-icon').hide();	
			})
		});
	</script>
</head>
<div class="cover" style="position: absolute; width: 100%; height: 100%; z-index: -1; background-color: transparent;" onclick="hideCart();">
</div>
<div class="nav">
	<ul class="nav-pills">
		<li id="nav-logo">
		  	<img src='./img/artomia_logo.png' alt="artomia_logo">
		</li>  
		<li id="search-bar">
			<div class="searchbar-container">
  				<input type="text" placeholder="Search..." onchange="useKeywordFilter();">
 				<div class="search"></div>
			</div>
		</li>
		<div class="nav-li">
			<li><a href="index.php">Home</a></li>
			<li><a href="product_list.php">Gallery</a></li>
		    <li class="popup">
		    	<a class="cart" onclick="displayCart()">Cart<img class="nav-icon" src="img/icon/cart_inverted.svg" alt=""></a>
		    	<span style="display: none;" class="popuptext" id="myPopup">
		    	</span>
			</li>
			
			<li><a href="product_admin.php">Admin</a></li>	 
			<li class="menu-icon dropdown">
				<button class="dropbtn">
				</button>
				<div class="dropdown-content">
					<a href="index.php">Home</a>
					<a href="product_list.php">Gallery</a>
					<a href="">Cart</a>
					<a href="">Admin</a>
				</div>
			</li> 	
		</div>
	  	
  	</ul>
</div>
