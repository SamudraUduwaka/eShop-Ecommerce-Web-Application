<?php

require "connection.php";

$page = $_POST["pg"];

$k = $_POST["k"];
$c = $_POST["c"];
$b = $_POST["b"];
$m = $_POST["m"];
$con = $_POST["con"];
$clr = $_POST["clr"];
$pf = $_POST["pf"];
$pt = $_POST["pt"];
$sort = $_POST["sort"];

$offset = 2 * ($page - 1);

$AllResultset;
$Resultset;

// else {
//     echo "You must enter a keyword to search";
// }

if (isset($_POST["k"])) {

    $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'");

    $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
    LIMIT 2 OFFSET " . $offset . "");



    if (!empty($k) && $c != "0") {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `category_id`='" . $c . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `category_id`='" . $c . "' LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && $b != "0") {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `model_has_brand_id` IN (SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $b . "')");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `model_has_brand_id` IN (SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $b . "')  LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && $m != "0") {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `model_has_brand_id` IN (SELECT `id` FROM `model_has_brand` WHERE `model_id`='" . $m . "')");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `model_has_brand_id` IN (SELECT `id` FROM `model_has_brand` WHERE `model_id`='" . $m . "')
        LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && $con != "0") {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `condition_id` ='" . $con . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `condition_id` ='" . $con . "'
        LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && $clr != "0") {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `color_id` ='" . $clr . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `color_id` ='" . $clr . "'
        LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && $clr != "0" && $con != "0") {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `color_id` ='" . $clr . "' AND `condition_id` ='" . $con . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `color_id` ='" . $clr . "' AND `condition_id` ='" . $con . "'
        LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && $clr != "0" && $c != "0") {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `color_id` ='" . $clr . "' AND `category_id`='" . $c . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `color_id` ='" . $clr . "' AND `category_id`='" . $c . "'
        LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && $con != "0" && $c != "0") {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
         AND `condition_id` ='" . $con . "' AND `category_id`='" . $c . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
         AND `condition_id` ='" . $con . "' AND `category_id`='" . $c . "'
        LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && $clr != "0" && $c != "0" && $con != "0") {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `color_id` ='" . $clr . "' AND `condition_id` ='" . $con . "' AND `category_id`='" . $c . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `color_id` ='" . $clr . "' AND `condition_id` ='" . $con . "' AND `category_id`='" . $c . "'
        LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && !empty($pf)) {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `price`>'" . $pf . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `price`>'" . $pf . "'
        LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && !empty($pt)) {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `price`<'" . $pt . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `price`<'" . $pt . "'
        LIMIT 2 OFFSET " . $offset . "");
    } else if (!empty($k) && !empty($pf) && !empty($pt)) {

        $AllResultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `price`<'" . $pt . "' AND `price`>'" . $pf . "'");

        $Resultset = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%'
        AND `price`<'" . $pt . "' AND `price`>'" . $pf . "'
        LIMIT 2 OFFSET " . $offset . "");
    }
} 

// else 
//     if ($sort == "1") {
//     $AllResultset = Database::search("SELECT * FROM `product` ORDER BY `price` ASC");

//     $Resultset = Database::search("SELECT * FROM `product` ORDER BY `price` ASC
//         LIMIT 2 OFFSET " . $offset . "");
// } else if ($sort == "2") {
//     $AllResultset = Database::search("SELECT * FROM `product` ORDER BY `price` DESC");

//     $Resultset = Database::search("SELECT * FROM `product` ORDER BY `price` DESC
//         LIMIT 2 OFFSET " . $offset . "");
// }



$allProductnm = $AllResultset->num_rows;
$DividedNumber = $allProductnm / 2;
$PageNumbers = intval($DividedNumber);
if ($allProductnm % 2 != 0) {
    $PageNumbers = $PageNumbers + 1;
}
if ($page > $PageNumbers) {
    $page = 1;
}

?>
<div class="row justify-content-evenly">
    <?php
    for ($Value = 0; $Value < 2; $Value++) {
        $dataofproduct = $Resultset->fetch_assoc();
        if ($dataofproduct != null) {

    ?>
            <div class="col-6 card mb-3 mt-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 mt-4">
                        <?php

                        $images = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $dataofproduct["id"] . "'");
                        $in = $images->num_rows;

                        $imgg;
                        for ($z = 0; $z < $in; $z++) {
                            $ir = $images->fetch_assoc();
                            if ($z == 0) {
                                $imgg = $ir["code"];
                            }
                        ?>

                        <?php
                        }

                        ?>
                        <img src="<?php echo $imgg; ?>" class="img-fluid rounded-start" alt="...">
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $dataofproduct["title"]; ?></h5>
                                <span class="card-text">Price: Rs. <?php echo $dataofproduct["price"]; ?> .00</span>
                                <br />
                                <span class="card-text"><?php echo $dataofproduct["qty"]; ?> Items Left</span>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-6 d-grid">
                                        <a href="singleproductview.php?id=<?php echo $dataofproduct['id']; ?>" class="btn btn-success">Buy it</a>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-primary" onclick="addToCart(<?php echo $dataofproduct['id']; ?>);">Add Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>
<?php
$PgnStart = 1;
if ($PageNumbers > 4) {
    if ($page > $PageNumbers - 4) {
        $PgnStart = $PageNumbers - 4;
        $backFPage = "on";
    }
    if ($page <= $PageNumbers - 4) {
        $PgnStart = $page;
    }
    $Pgnlimit = $PgnStart + 4;
} else {
    $PgnStart = 1;
    $Pgnlimit = $PageNumbers;
}
?>

<div class="row my-3 mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination d-flex justify-content-center col-gap">
            <li class="page-item <?php if ($page == 1) {
                                        echo "disabled";
                                    } else {
                                    } ?> "><button onclick="advancedSearch('<?php echo $page - 1; ?>');" class="page-link">&laquo;</button></li>
            <?php if ((isset($backFPage)) || $page > 2) { ?><li class="page-item page-item-xs-none"><button class="page-link" onclick="advancedSearch('1');">1</button></li>
                <li class="page-item <?php if ($page != 3) {
                                            echo "disabled";
                                        } else {
                                        } ?> page-item-xs-none"><button class="page-link" <?php if ($page == 3) { ?> onclick="advancedSearch('2');" <?php } else {
                                                                                                                                                } ?>> <?php if ($page == 3) {
                                                                                                                                                            echo "2";
                                                                                                                                                        } else {
                                                                                                                                                            echo "...";
                                                                                                                                                        } ?></button></li><?php } ?>
            <?php for ($Pgn = $PgnStart; $Pgn <= $Pgnlimit; $Pgn++) { ?>
                <li class="page-item <?php if ($Pgn == $page) {
                                            echo "active point-none";
                                        } ?>"><button onclick="advancedSearch('<?php echo $Pgn; ?>');" class="page-link"><?php echo $Pgn; ?></a></li>
            <?php } ?>
            <li class="page-item <?php if ($page == $PageNumbers) {
                                        echo "disabled";
                                    } else {
                                    } ?>"><button onclick="advancedSearch('<?php echo $page + 1; ?>');" class="page-link">&raquo;</button></li>
        </ul>
    </nav>
</div>