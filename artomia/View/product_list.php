<?php
	include_once "../Model/functions.php";
	include_once "partials/header.php";

	if(isset($_GET['keyword'])) {
		echo '<script type="text/javascript">
			 	searchProducts("' . $_GET['keyword'] . '")' . 
			 '</script>';
	} else {
		echo '<script type="text/javascript">
			  	setUpProductListPage();
			  </script>';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width">
	<title>Artomia Gallery</title>
</head>
<body>
	<nav class="nav-crumds">
	  	<ul>
			<li><a href=" ">Back</a></li>
	   	</ul>
  	</nav>
	</div>
	<hr class="spacer">
	<div class="subtitle">
		<div style="text-align: center;">
			<label style="font-size: 50pt; font-weight: 900;">Original art for sale</label>
			<p>Art for your beautiful home. Connect with young artists on Artomia!</p>
		</div>
	</div>

	<div class="sorting">
		<div class="sorting-select">
			<button class="selected" onclick="changeSortingToPrice(); sortProducts();">price</button>
			<button onclick="changeSortingToDate(); sortProducts();">date</button>
			<button onclick="changeSortingToPopular(); sortProducts();">popular</button>
		</div>
		<button  class="sorting-order sorting-ascending" onclick="changeOrder(); sortProducts();" style="outline: none; border: none; background-color: white; margin-left: auto;">
		</button>
	</div>
	<div class="container-flex xs-small md-medium product product-list">
		<div class="column">
				
		</div>
		<div class="column">
				
		</div>
		<div class="column">
				
		</div>
		<div class="column">
				
		</div>
	</div>	  	
</body>

<footer><? include_once "partials/footer.php"; ?></footer>
</html>