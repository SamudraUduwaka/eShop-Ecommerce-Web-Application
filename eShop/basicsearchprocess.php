<?php

session_start();
require "connection.php";

$searchtxt = $_POST["txt"];
$searchselect = $_POST["select"];

$page = $_POST["pg"];
$offset = 5 * ($page - 1);


if (!empty($searchtxt) && $searchselect == 0) {
    
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchtxt . "%' ");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchtxt . "%'  
    LIMIT 5 OFFSET " . $offset . "");

} elseif ($searchselect != 0 && empty($searchtxt)) {

    $AllResultset = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchselect . "' ");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $searchselect . "'
     LIMIT 5 OFFSET " . $offset . " ");

} elseif ($searchselect != 0 && !empty($searchtxt)) {

    $AllResultset = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchtxt . "%' AND `category_id` = '" . $searchselect . "'");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchtxt . "%' AND `category_id` = '" . $searchselect . "'
     LIMIT 5 OFFSET " . $offset . "");
}

$allProductnm = $AllResultset->num_rows;
$DividedNumber = $allProductnm / 5;
$PageNumbers = intval($DividedNumber);
if ($allProductnm % 5 != 0) {
    $PageNumbers = $PageNumbers + 1;
}
if ($page > $PageNumbers) {
    $page = 1;
}

?>
<div class="row justify-content-evenly">
    <?php
    for ($Value = 0; $Value < 4; $Value++) {
        $dataofproduct = $Resultset->fetch_assoc();
        if ($dataofproduct != null) {

    ?>
            <div class="card col-6 col-lg-2 mt-1 mb-1" style="width: 14rem;">

                <?php

                $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $dataofproduct["id"] . "'");

                $imggg;

                for ($z = 0; $z < $pimage->num_rows; $z++) {
                    $imgrow = $pimage->fetch_assoc();
                    if ($z == 0) {
                        $imggg = $imgrow['code'];
                    }
                }

                ?>
                <img src="<?php echo $imggg; ?>" class="card-img-top cardTopImg" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $dataofproduct["title"]; ?><span class="badge bg-info">New</span></h5>
                    <span class="card-text text-primary">Rs: <?php echo $dataofproduct['price']; ?>.00</span>
                    <br />

                    <?php

                    if ((int)$dataofproduct["qty"] > 0) {

                    ?>
                        <span class="card-text text-warning"><b>In Stock</b></span>
                        <br />
                        <input class="form-control" type="number" value="1" id="qtytxt<?php echo $dataofproduct["id"]; ?>" />
                        <a href="<?php echo "singleproductview.php?id=" . ($dataofproduct["id"]); ?>" class="btn btn-success d-grid">Buy Now</a>

                        <a href="#" class="btn btn-danger" onclick="addToCart(<?php echo $dataofproduct['id']; ?>);">Add To Cart</a>

                        <a href="#" onclick="addToWatchlist(<?php echo $dataofproduct['id']; ?>);" class="btn btn-secondary"><i class="bi bi-suit-heart-fill"></i></a>



                    <?php

                    } else {
                    ?>

                        <span class="card-text text-danger"><b>Out of Stock</b></span>
                        <br />
                        <input class="form-control" type="number" value="1" disabled />
                        <a href="#" class="btn btn-success d-grid disabled">Buy Now</a>

                        <a href="#" class="btn btn-danger disabled">Add To Cart</a>

                        <a href="#" class="btn btn-secondary disabled"><i class="bi bi-suit-heart-fill"></i></a>


                    <?php
                    }
                    ?>


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
<div class="row mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination d-flex justify-content-center col-gap">
            <li class="page-item <?php if ($page == 1) {
                                        echo "disabled";
                                    } else {
                                    } ?> "><button onclick="basicsearch('<?php echo $page - 1; ?>');" class="page-link">&laquo;</button></li>
            <?php if ((isset($backFPage)) || $page > 2) { ?><li class="page-item page-item-xs-none"><button class="page-link" onclick="basicsearch('1');">1</button></li>
                <li class="page-item <?php if ($page != 3) {
                                            echo "disabled";
                                        } else {
                                        } ?> page-item-xs-none"><button class="page-link" <?php if ($page == 3) { ?> onclick="basicsearch('2');" <?php } else {
                                                                                                                                                } ?>> <?php if ($page == 3) {
                                                                                                                                                                                                echo "2";
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo "...";
                                                                                                                                                                                            } ?></button></li><?php } ?>
            <?php for ($Pgn = $PgnStart; $Pgn <= $Pgnlimit; $Pgn++) { ?>
                <li class="page-item <?php if ($Pgn == $page) {
                                            echo "active point-none";
                                        } ?>"><button onclick="basicsearch('<?php echo $Pgn; ?>');" class="page-link"><?php echo $Pgn; ?></a></li>
            <?php } ?>
            <li class="page-item <?php if ($page == $PageNumbers) {
                                        echo "disabled";
                                    } else {
                                    } ?>"><button onclick="basicsearch('<?php echo $page + 1; ?>');" class="page-link">&raquo;</button></li>
        </ul>
    </nav>
</div>