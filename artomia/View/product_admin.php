<?
include_once "../Model/functions.php";
include_once "partials/header.php";

$empty_product = (object)[
    "name" => "Snowy days",
    "artist" => "May Fu",
    "price" => "100.00",
    "material" => "Watercolor",
    "description" => "This is a cool painting.",
    "image" => "img/id1.jpeg",
    "size" => "10x10inch",
    "quantity" => 23
];


// logic actions


try {
    // print_p([$_GET, $_POST]);
    $conn = connectToDB();
    $action = @$_GET['action'];
    if($action == "updateorinsert") {
        if($_GET['id'] == 'new') {
            $action = 'create';
        } else {
            $action = 'update';
        }
    }
    switch($action) {
        case "update":
        $statement = $conn->prepare("UPDATE
            `products`
            SET
            `name` =?,
            `artist` = ?,
            `price` = ?,
            `material`=?,
            `description`=?,
            `image`=?,
            `size`=?,
            `quantity`=?,
            `date`=NOW()
            WHERE `id`=?
            ");
        $statement->bind_param('sssssssss',
            $_POST['name'],
            $_POST['artist'],
            $_POST['price'],
            $_POST['material'],
            $_POST['description'],
            $_POST['image'],
            $_POST['size'],
            $_POST['quantity'],
            $_GET['id']);

        $statement->execute();

        

        header("location:{$_SERVER['PHP_SELF']}");
        break;

        case "create":

        $statement = $conn->prepare("INSERT INTO
            `products`
            (
                `name`,
                `artist`,
                `price`,
                `material`,
                `description`,
                `image`,
                `size`,
                `quantity`,
                `date`,
                `purchase`
            )
            VALUES (?,?,?,?,?,?,?,?,NOW(),?)
            ");
        $zero = 0;
        $statement->bind_param('sssssssss',
            $_POST['name'],
            $_POST['artist'],
            $_POST['price'],
            $_POST['material'],
            $_POST['description'],
            $_POST['image'],
            $_POST['size'],
            $_POST['quantity'],
            $zero);
        $statement->execute();
        $id = $conn->insert_id;

        header("location:{$_SERVER['PHP_SELF']}");
        break;

        case "delete":

        $statement = $conn->prepare("DELETE FROM `products` WHERE `id`=" . $_GET['id']);
        $statement->execute();

        header("location:{$_SERVER['PHP_SELF']}");

        default: break;
    }
} catch(PDOException $e) {
    die($e->getMessage());
}



/* TEMPLATES */

function makeListItemTemplate($carry,$item) {
    return $carry.<<<HTML
<div class='item-list'>
    <div class="flex-none" style="width:6em;">
        <div class="image-radius">
            <img src="$item->image" style="width: 100px; border-radius: 10px;">
        </div>
    </div>
    <div class="flex-stretch" style="margin-left: 4%;">
        <div><strong>$item->name</strong></div>
        <div>$item->material</div>
    </div>
    <div class="flex-none"  style='margin-left: auto;'>
        <div>[<a href='product_admin.php?id=$item->id'>edit</a>]</div>
        <!-- <div>[<a href="product_item.php?id=$item->id">visit</a>]</div> -->
    </div>
</div>
HTML;
}

function makeProductForm($o) {
    $id = $_GET['id'];
    $addoredit = $id=='new' ? 'Add' : 'Edit';
    $createorupdate = $id=='new' ? 'create' : 'update';

echo <<<HTML
<div class="display-flex" style="margin: 10% 10%;">
    <div class="flex-stretch subtitle2">
        <a href="product_admin.php">Back</a>
    </div>
    <div class="flex-none subtitle2">
        [<a href="product_admin.php?id=$id&action=delete">Delete</a>]
    </div>
</div>
<form class="card-basic" method="post" action="product_admin.php?id={$id}&action=updateorinsert" style="margin: 10% 10%;">
    <h2>$addoredit Product</h2>
    <div class="form-control">
        <label class="form-label" for="title">Title</label>
        <input class="form-input" id="name" name="name" type="text" value="$o->name">
    </div>
    <div class="form-control">
        <label class="form-label" for="artist">Artist</label>
        <input class="form-input" id="artist" name="artist" type="text" value="$o->artist">
    </div>
    <div class="form-control">
        <label class="form-label" for="price">Price</label>
        <input class="form-input" id="price" name="price" type="text" value="$o->price">
    </div>
    <div class="form-control">
        <label class="form-label" for="category">Material</label>
        <input class="form-input" id="material" name="material" type="text" value="$o->material">
    </div>
    <div class="form-control">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-input" id="description" name="description">$o->description</textarea>
    </div>
    <div class="form-control">
        <label class="form-label" for="main_image">Image</label>
        <input class="form-input" id="image" name="image" type="text" value="$o->image">
    </div>
    <div class="form-control">
        <label class="form-label" for="size">Size</label>
        <input class="form-input" id="size" name="size" type="text" value="$o->size">
    </div>
    <div class="form-control">
        <label class="form-label" for="quantity">Quantity</label>
        <input class="form-input" id="quantity" name="quantity" type="text" value="$o->quantity">
    </div>
    <div class="form-control">
        <input class="form-button" type="submit" value="Confirm">
    </div>
</form>
HTML;

}



/* layout */


$website_url = "/aau/wnm608/catanzaro.michael";
$root_url = "http://".$_SERVER['HTTP_HOST'].$website_url;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Admin</title>
    <!-- <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="../lib/css/styleguide.css">
    <link rel="stylesheet" href="../lib/css/gridsystem.css">
    <link rel="stylesheet" href="../css/storetheme.css">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="../lib/js/functions.js"></script>
    <script src="../js/templates.js"></script> -->
</head>
<body>
    <header class="nav">
        <div class="container display-flex">
            <div class="flex-stretch">
                <h1>Product Admin</h1>
            </div>
            <nav>
                <ul class="nav-pills">
                    <li><a href="./product_list.php">Store</a></li>
                    <li><a href="product_admin.php">List</a></li>
                    <li><a href="product_admin.php?id=new">Add New Product</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <div>
            <?
                if(isset($_GET['id'])) {
                    if($_GET['id']=="new") {
                        makeProductForm($empty_product);
                    } else {
                        $data = getData("SELECT * FROM `products` WHERE `id` = '{$_GET['id']}'");
                        makeProductForm($data[0]);
                    }
                } else {
                    ?>
                    <div class="subtitle1">Product List</div>
                    <div class="card-new">
                        <? 
                        $data = getData("SELECT * FROM `products`");
                        echo array_reduce($data,'makeListItemTemplate');
                        ?>

                    </div>
            <?
                }

            ?>

        </div>
    </div>
</body>
</html>