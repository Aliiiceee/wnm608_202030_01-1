/* index.php */
function setUpHomePage() {
	listGiftIdeas();
}

function listGiftIdeas() {

	$.post("../Model/requestHandler.php",
		{
			request:"getAllProducts"
		},

		function(data, status){
			// get all products
			var products = JSON.parse(data);

			//add to html
			for(var i = 0; i < 4; i++) {

				// Add ith image to ith img tag
				var src = products[i + 14].image;
				$('.gift_idea_image').eq(i).attr("src", src);

				var name = products[i + 14].name;
				$('.gift_idea_name').eq(i).text(name);

				var href = "product_item.php?id=" + products[i + 14].id;
				$('.gift_idea_link').eq(i).attr('href', href);
			}
		}
	);
}

/* product_item.php */
function setUpProductItemPage(id) {
	getProductWithId(id);
	listRecommendations();
}

function getProductWithId(id) {
	$.post("../Model/requestHandler.php",
		{
			request:"getProductWithId",
			id: id
		},
		function(data, status){
			// get first product
			var product = JSON.parse(data);

			//add to html
			$('.product_image').attr("src", product.image);
			$('.product_title').text(product.name);
			$('.product_artist').text(product.artist);
			$('.product_intro').text(product.description);
			$('.product_material').text(product.material);
			$('.product_size').text(product.size);
			$('.product_price').text(product.price);
		}
	);
}

/* product_list.php */
function setUpProductListPage(){
	$(document).ready(function() {
		sortProducts();
	})
}

function listRecommendations() {

	$.post("../Model/requestHandler.php",
		{
			request:"getAllProducts"
		},

		function(data, status){
			// get all products
			var products = JSON.parse(data);

			//add to html
			for(var i = 0; i < 8; i++) {

				// Add ith image to ith img tag
				var href = "product_item.php?id=" + products[i + 10].id;
				$('.product_link').eq(i).attr("href", href);

				var src = products[i + 10].image;
				$('.product_recommend').eq(i).attr("src", src);

				var name = products[i + 10].name;
				$('.recommend_title').eq(i).text(name);

				var author = products[i + 10].artist;
				$('.recommend_artist').eq(i).text(author);

				var intro = products[i + 10].description;
				$('.recommend_intro').eq(i).text(intro);

			}
		}
	);
}

function listAllProducts() {
	$.post("../Model/requestHandler.php",
		{
			request:"getAllProducts",
			
		},
		function(data, status){
			// get first product
			var products = JSON.parse(data);
			
			var numberOfProducts = products.length;

			//add to html
			var colCount = 0;
			$('.product-list .column').html('');
			for(var i = 0; i < numberOfProducts; i++) {
				// ith product
				var product = products[i];

				// build html template
				var htmlTemplate = buildProductTemplate(product);

				$('.product-list .column').eq(colCount).append(htmlTemplate);

				colCount += 1;
				if(colCount == 4) {
					colCount = 0;
				}
			}
		}
	);
}

function sortProducts() {
    var filter = $('.selected').text();
    if(filter == 'price') {
        sortProductsByPrice();
    } else if(filter == 'date') {
        sortProductsByDate();
    } else if(filter == 'popular') {
        sortProductsByPurchase();
    }
}

function sortProductsByPrice() {
	var order_arrow = $('.sorting-order').text();
	var order;
	if($('.sorting-order').hasClass('sorting-ascending')){
		order = "ASC";
	} 
	else if($('.sorting-order').hasClass('sorting-descending')){
        order = "DESC";
    }  
	$.post("../Model/requestHandler.php",
		{
			request:"getAllProductsSortedByPrice",
			order: order
			
		},
		function(data, status){
			// get first product
			var products = JSON.parse(data);

			
			var numberOfProducts = products.length;

			//add to html
			var colCount = 0;
			$('.product-list .column').html('');
			for(var i = 0; i < numberOfProducts; i++) {
				// ith product
				var product = products[i];

				// build html template
				var htmlTemplate = buildProductTemplate(product);

				$('.product-list .column').eq(colCount).append(htmlTemplate);

				colCount += 1;
				if(colCount == 4) {
					colCount = 0;
				}
			}
		}
	);
}

function sortProductsByDate() {
    var order_arrow = $('.sorting-order').text();
    var order;
    if($('.sorting-order').hasClass('sorting-ascending')){
        order = "ASC";
    } 
    else if($('.sorting-order').hasClass('sorting-descending')){
        order = "DESC";
    }  
    $.post("../Model/requestHandler.php",
        {
            request:"getAllProductsSortedByDate",
            order: order
            
        },
        function(data, status){
            // get first product
            var products = JSON.parse(data);

            var numberOfProducts = products.length;

            //add to html
            var colCount = 0;
            $('.product-list .column').html('');
            for(var i = 0; i < numberOfProducts; i++) {
                // ith product
                var product = products[i];

                // build html template
                var htmlTemplate = buildProductTemplate(product);

                $('.product-list .column').eq(colCount).append(htmlTemplate);

                colCount += 1;
                if(colCount == 4) {
                    colCount = 0;
                }
            }
        }
    );
}

function sortProductsByPurchase() {
    var order_arrow = $('.sorting-order').text();
    var order;
    if($('.sorting-order').hasClass('sorting-ascending')){
        order = "ASC";
    } 
    else if($('.sorting-order').hasClass('sorting-descending')){
        order = "DESC";
    }  
    $.post("../Model/requestHandler.php",
        {
            request:"getAllProductsSortedByPurchase",
            order: order
            
        },
        function(data, status){
            // get first product
            var products = JSON.parse(data);

            
            var numberOfProducts = products.length;

            //add to html
            var colCount = 0;
            $('.product-list .column').html('');
            for(var i = 0; i < numberOfProducts; i++) {
                // ith product
                var product = products[i];

                // build html template
                var htmlTemplate = buildProductTemplate(product);

                $('.product-list .column').eq(colCount).append(htmlTemplate);

                colCount += 1;
                if(colCount == 4) {
                    colCount = 0;
                }
            }
        }
    );
}

function changeOrder() {
    if($('.sorting-order').hasClass('sorting-ascending')) {
        $('.sorting-order').removeClass('sorting-ascending').addClass('sorting-descending');
    } else if ($('.sorting-order').hasClass('sorting-descending')) {
        $('.sorting-order').removeClass('sorting-descending').addClass('sorting-ascending');
    }
}

function changeSortingToPrice() {
    $('.sorting-select button').removeClass();
    $('.sorting-select button').eq(0).addClass('selected');
}
function changeSortingToDate() {
    $('.sorting-select button').removeClass();
    $('.sorting-select button').eq(1).addClass('selected');
}
function changeSortingToPopular() {
    $('.sorting-select button').removeClass();
    $('.sorting-select button').eq(2).addClass('selected');
}

/* search related */
function useKeywordFilter(){
	var keyword = $('#search-bar input').val();

	window.location.replace("product_list.php?keyword=" + keyword);
}

function searchProducts(keyword) {
	$.post("../Model/requestHandler.php",
        {
            request:"searchProducts",
            keyword: keyword
            
        },
        function(data, status){
            // get first product
            var products = JSON.parse(data);

            var numberOfProducts = products.length;

            //add to html
            var colCount = 0;
            $('.product-list .column').html('');
            for(var i = 0; i < numberOfProducts; i++) {
                // ith product
                var product = products[i];

                // build html template
                var htmlTemplate = buildProductTemplate(product);

                $('.product-list .column').eq(colCount).append(htmlTemplate);

                colCount += 1;
                if(colCount == 4) {
                    colCount = 0;
                }
            }
        }
    );
}

/* cart related */
function addToCart(id){
    var name = $('.product_title').text();
    var image = $('.product_image').attr('src');
	var amount = $('select[name="amount"] option:selected').text();
	var price = $('.product_price').text();
	var image = $('.product_image').attr("src");
	var name = $('.product_title').text();

	$.post("../Model/requestHandler.php",
		{
			request:"addToCart",
			id: id,
			image: image,
			name: name,
			amount: amount,
			price: price
		},
		function(data, status){
			// todo: add to cart animation
			displayCart();
			setTimeout(function(){
				hideCart();
				}, 2000);
			
		}
	);
}

function hideCart() {
	$('.popuptext').hide('fast');

	$('.cover').css('z-index', -1);
}

// When the user clicks on div, open the popup
function displayCart() {
	// get cart items
	$.post("../Model/requestHandler.php",
		{
			request:"getCartItems"

		},
		function(data, status){
			// get first product
			var items = JSON.parse(data);

			// todo: add to cart animation
			$('.popuptext').html('');
			var total = 0;
			for(var i = 0; i < items.length; i++) {
				total = total + items[i].total;

				// templatize
				var htmlTemplate = buildCartItemTemplate(items[i]);

				$('.popuptext').append(htmlTemplate);
			}

			var cartTotalXs = "<div>" +
							  "<strong>Total: </strong>" +
							  "<label>$" + total + "</label>" +
							  "</div>" +
							  "<button class='form-button-xs' " +
							  		  "onclick='window.location.href=\"product_cart.php\"'>Check Out" +
						  	  "</button>";
			$('.popuptext').append(cartTotalXs);


			var popup = document.getElementById("myPopup");
			popup.classList.toggle("show");

			$('#myPopup').show('fast');

			$('.cover').css('z-index', 3);
		}
	);
}

/* templates */
function buildProductTemplate(product) {
	// TODO: build html template for product
	var template = '<div>' + 
						'<a href="product_item.php?id=' + product.id + '">' +
				  			'<img class="product_recommend" src="' + product.image + '" alt="">' + 
				  			'<div class="product_recommend_info">' +
					  			'<p class="recommend_title">' + product.name + '</p>' +
					  			'<p class="recommend_artist">' + product.artist + '</p>' +
					  			'<p class=recommend_intro">' + product.description + '</p>' +
				  			'</div>' +
			  			'</a>' +
			  		'</div>'; 		
	return template;
}

function buildCartItemTemplate(item) {
	return "<div class='cart_item_xs'>" + 
				"<div class='cart_image_xs'><img class='thumbnail_xs' src='" + item.image + "'/></div>" + 
				"<div class='cart_info_xs'>" +
					"<strong class='product_title_xs'>" + item.name + "</strong><br>" + 
					"<label class='product_amount_xs'>" + "x" + item.amount + "</label><br>" + 
					"<label class='product_subtotal_xs'>" + "$" + item.total + "</label>" + 
				"</div>" +
		   "</div>" +
		   "<hr style='margin:0.8em; border: 1px solid #CAC8FF; opacity: 70%'>";
}

function addNewItem() {
	var title = $('.title').val();
	var artist = $('.artist').val();
	var material = $('.material').val();
	var description = $('.description').val();
	var quantity = $('.quantity').val();
	var price = $('.price').val();
	var image = $('.image').val();

	$.post("../Model/requestHandler.php",
		{
			request:"addNewItem",
			title: title,
			artist: artist,
			material: material,
			description: description,
			quantity: quantity,
			price: price,
			image: image

		},
		function(data, status){
			// get first product
			alert(data);
		}
	);
}
