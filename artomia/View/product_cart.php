<?php
    include_once "../Model/functions.php";
    include_once "partials/header.php";

    $cartItems = getCartItems();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Artomia-Cart</title>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/functions.js"></script>
</head>
<body>
    <div class="nav-crumds" style="margin-top: 75px;">
        <ul>
            <  
            <li><a href="index.php" style="margin-left: 10px; margin-right: 10px";>Home </a></li>
                 /  
            <li><a href="product_list.php" style="margin-left: 10px; margin-right: 10px;">Gallery </a></li>
                 /  
            <li><a href="product_cart.php" style="margin-left: 10px; margin-right: 10px;">Cart</a></li> 
        </ul>
    </div>
    <hr class="spacer">
    </div>
    <div class="col-xs-12 col-md-8">
         <div class="container card flat">
            <div class="grid gap">
                <div class="col-xs-12 col-md-8">
                    <div class="subtitle2">Cart Items</div>
                    <div class="card flat">
                        <?php
                            for($i = 0; $i < count($cartItems); $i++) {
                                $item = $cartItems[$i];
                                echo "<div class='cart_item_lg'>" .
                                        "<div class='cart_image_lg'><img class='thumbnail_lg' src='" . $item->image . "'/></div>" . 
                                        "<div class='cart_info_lg'>" .
                                            "<strong class='product_title_lg'>" . $item->name . "</strong><br>" .
                                            "<label class='product_amount_lg'>" . "x" . $item->amount . "</label><br>" .
                                            "<label class='product_subtotal_lg'>" . "$" . $item->total . "</label>" .
                                        "</div>" .
                                    "</div><hr style='margin:0.8em; border: 1px solid #cfcfcf; opacity: 70%'>";
                            }
                         ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="subtitle2">Summary</div>
                    <div class="card flat">
                        <?= cartTotals() ?>
                        <div class="card-section1">
                            <a href="thankyou.php" class="form-button confirm">Place Order</a>
                            <a href="product_list.php" class="form-button confirm">Go Back</a>     
                        </div>      
                    </div>
                </div>
            </div>    
    </div>
    </div>      
</body>

<footer><? include_once "partials/footer.php"; ?></footer>
</html>