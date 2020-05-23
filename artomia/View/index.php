<?php 
	include_once "../Model/functions.php";
	include_once "partials/header.php";
?>

<!DOCTYPE html>
<html lang="en">

<script type="text/javascript">
	setUpHomePage();
</script>

<body>
	<div class="video-container">

        <video loop autoplay muted>
            <source src="../Images/artomia_frontVideo1time.mov" type="video/mp4">
        </video>
    </div>

    <div class="new-section1">
    	<div>
    		<h1 style="text-align: center;">Popular</h1>
    	</div>
    	<div class="gift_ideas">
			<div class="gift_idea_item column1">
				<a class="gift_idea_link">
					<img class="gift_idea_image"/><br/>
					<p class="gift_idea_name"></p>
				</a>
			</div>
			<div class="gift_idea_item column1">
				<a class="gift_idea_link">
					<img class="gift_idea_image"/><br/>
					<p class="gift_idea_name"></p>
				</a>
			</div>
			<div class="gift_idea_item column1">
				<a class="gift_idea_link">
					<img class="gift_idea_image"/><br/>
					<p class="gift_idea_name"></p>
				</a>
			</div>
			<div class="gift_idea_item column1">
				<a class="gift_idea_link">
					<img class="gift_idea_image"/><br/>
					<p class="gift_idea_name"></p>
				</a>
			</div>
    	</div>
    </div>

	<div class="subtitle">
		<div style="text-align: center;">
			<label style="font-size: 50pt; font-weight: 900;">Original art for sale</label>
			<p>Art for your beautiful home. Connect with young artists on Artomia!</p>
		</div>
    </div>

</body>


<footer><? include_once "partials/footer.php"; ?></footer>

</html>