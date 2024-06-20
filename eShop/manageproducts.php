<?php

session_start();

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>eShop | Admin | Manage Products</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="manage.css" />
    <link rel="stylesheet" href="font&hr.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 text-primary fw-bold">Manage All Products</label>
            </div>

            <div class="col-12 bg-light rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-10 col-lg-6">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" id="searchptxt" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-primary" onclick="searchproduct();">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="offset-0 offset-lg-1 col-2 col-lg-2">
                        <div class="row d-grid">
                            <button onclick="searchAllproducts();" class="btn btn-warning">All Products</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Product Image</span>
                    </div>
                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Title</span>
                    </div>
                    <div class="col-5 col-lg-2 bg-light pt-2 pb-2">
                        <span class="fs-4 fw-bold">Price</span>
                    </div>

                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                        <span class="fs-4 fw-bold text-white">Quantity</span>
                    </div>
                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 bg-white pt-2 pb-2">

                    </div>
                </div>
            </div>

            <?php

            if (isset($_SESSION["l"])) {
                $prod = $_SESSION["l"];

            ?>

                <div class="col-12 mt-3 mb-2">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                            <span class="fw-bold text-white fs-5">1</span>
                        </div>
                        <div class="col-2 bg-light d-none d-lg-block">
                            <?php

                            $imgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $prod["id"] . "'");
                            $img = $imgrs->fetch_assoc();

                            ?>
                            <img src="<?php echo $img["code"]; ?>" style="height: 70px; margin-left: 70px;" />
                        </div>
                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                            <span class="fw-bold text-white fs-5"><?php echo $prod["title"]; ?></span>
                        </div>
                        <div class="col-5 col-lg-2 bg-light pt-2 pb-2">
                            <span class="fw-bold fs-5"><?php echo $prod["price"]; ?></span>
                        </div>

                        <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                            <span class="fw-bold text-white fs-5"><?php echo $prod["qty"]; ?></span>
                        </div>
                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                            <span class="fw-bold fs-5"><?php $rd = $prod["datetime_added"];
                                                        $splitrd = explode(" ", $rd);
                                                        echo $splitrd[0];
                                                        ?></span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white pt-2 pb-2 d-grid">
                            <?php

                            $s = $prod["status_id"];

                            if ($s == "1") {
                            ?>
                                <button class="btn btn-danger" id="blockbtn<?php echo $prod["id"]; ?>" onclick="blockproduct('<?php echo $prod['id']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-success" id="blockbtn<?php echo $prod["id"]; ?>" onclick="blockproduct('<?php echo $prod['id']; ?>');">Unblock</button>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <?php
            } else {

                $productrs = Database::search("SELECT * FROM `product` ");
                $p = $productrs->num_rows;

                $row = $productrs->fetch_assoc();
                $results_per_page = 4;

                $number_of_pages = ceil($p / $results_per_page);

                // echo $nproducts;
                // echo $number_of_pages;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                // $offset = 6 * ($pageno-1);

                $page_first_result = ((int)$pageno - 1) * $results_per_page;

                $selectedrs = Database::search("SELECT * FROM `product` 
                LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");

                $srn = $selectedrs->num_rows;

                $c = "0";

                while ($srow = $selectedrs->fetch_assoc()) {

                    $c = $c + 1;

                ?>

                    <div class="col-12 mt-3 mb-2">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end" onclick="singleviewmodal(<?php echo $srow['id']; ?>);">
                                <span class="fw-bold text-white fs-5"><?php echo $c; ?></span>
                            </div>
                            <div class="col-2 bg-light d-none d-lg-block">
                                <?php

                                $imgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $srow["id"] . "'");
                                $img = $imgrs->fetch_assoc();

                                ?>
                                <img src="<?php echo $img["code"]; ?>" style="height: 70px; margin-left: 70px;" />
                            </div>
                            <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                                <span class="fw-bold text-white fs-5"><?php echo $srow["title"]; ?></span>
                            </div>
                            <div class="col-5 col-lg-2 bg-light pt-2 pb-2">
                                <span class="fw-bold fs-5"><?php echo $srow["price"]; ?></span>
                            </div>

                            <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                                <span class="fw-bold text-white fs-5"><?php echo $srow["qty"]; ?></span>
                            </div>
                            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                <span class="fw-bold fs-5"><?php $rd = $srow["datetime_added"];
                                                            $splitrd = explode(" ", $rd);
                                                            echo $splitrd[0];
                                                            ?></span>
                            </div>
                            <div class="col-2 col-lg-1 bg-white pt-2 pb-2 d-grid">
                                <?php

                                $s = $srow["status_id"];

                                if ($s == "1") {
                                ?>
                                    <button class="btn btn-danger" id="blockbtn<?php echo $srow["id"]; ?>" onclick="blockproduct('<?php echo $srow['id']; ?>');">Block</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-success" id="blockbtn<?php echo $srow["id"]; ?>" onclick="blockproduct('<?php echo $srow['id']; ?>');">Unblock</button>
                                <?php
                                }

                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- modal single product -->
                    <div class="modal fade" id="singleproductview<?php echo $srow['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $srow['title']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <!-- ///// -->
                                    <div class="text-center">
                                        <?php
                                        $imgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $srow["id"] . "'");
                                        $img = $imgrs->fetch_assoc();
                                        ?>
                                        <img src="<?php echo $img["code"];?>" style="height:250px; " class="img-fluid" />
                                    </div>
                                    <div>
                                        <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                        <span class="fs-5">Rs. <?php echo $srow['price']; ?> .00</span><br />
                                        <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                        <span class="fs-5"><?php echo $srow['qty']; ?> Items Left</span><br />
                                        <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                        <?php
                                        
                                        $s = $srow["user_email"];
                                        $sellerrs = Database::search("SELECT * FROM `user` WHERE `email`='".$s."'");
                                        $sr = $sellerrs->fetch_assoc();

                                        ?>
                                        <span class="fs-5"><?php echo $sr["fname"]." ".$sr["lname"];?></span><br />
                                        <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                        <p class="fs-5"><?php echo $srow['description']; ?></p>
                                        <!-- ///// -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>

                <div class="col-12 d-flex justify-content-center fs-5 fw-bold mt-3 mb-3">
                    <div class="pagination">
                        <a href="<?php
                                    if ($pageno <= 1) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($pageno - 1);
                                    }
                                    ?>">&laquo;</a>

                        <?php

                        for ($pagee = 1; $pagee <= $number_of_pages; $pagee++) {
                            if ($pagee == $pageno) {

                        ?>
                                <a href="<?php echo '?page=' . ($pagee) ?>" class="ms-1 active"><?php echo $pagee; ?></a>
                            <?php

                            } else {
                            ?>
                                <a href="<?php echo '?page=' . ($pagee) ?>" class="ms-1"><?php echo $pagee; ?></a>
                        <?php
                            }
                        }

                        ?>

                        <a href="<?php
                                    if ($pageno >= $number_of_pages) {
                                        echo "#";
                                    } else {
                                        echo "?page=" . ($pageno + 1);
                                    }
                                    ?>">&raquo;</a>

                    </div>
                </div>

            <?php
            }
            ?>
            <hr />

            <div class="col-12">
                <h3 class="text-primary">Manage Categories</h3>
            </div>

            <hr>

            <div class="col-12 mb-3">
                <div class="row g-1">

                    <?php

                    $categoryrs = Database::search("SELECT * FROM `category`");
                    $num = $categoryrs->num_rows;

                    for ($i = 0; $i < $num; $i++) {
                        $row = $categoryrs->fetch_assoc();
                    ?>
                        <div class="col-12 col-lg-3">
                            <div class="row g-1 px-1">
                                <div class="col-12 text-center bg-body border border-2 border-success shadow rounded">
                                    <label class="form-label fs-4 fw-bold py-3"><?php echo $row["name"]; ?></label>
                                </div>
                            </div>
                        </div>
                    <?php

                    }

                    ?>



                    <div class="col-12 col-lg-3">
                        <div class="row g-1 px-1">
                            <div class="col-12 text-center bg-body border border-2 border-danger shadow rounded">
                                <div class="row" onclick="addnewmodal();">
                                    <div class="col-3 mt-3 addnewimg"></div>
                                    <div class="col-9">
                                        <label class="form-label fs-4 fw-bold py-3 text-black-50">Add New Category</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="addnewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- ///// -->
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" id="categorytxt" />
                            <!-- ///// -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="savecategory();">Save Category</button>
                        </div>
                    </div>
                </div>
            </div>


            <?php require "footer.php"; ?>
        </div>
    </div>



    <script src="manage.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>