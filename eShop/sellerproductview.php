<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"];

    $pageno;

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop | Seller's Product View</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="sellerproductview.css" />
        <link rel="stylesheet" href="font&hr.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body style="background-color: #F9EBEE;">

        <div class="container-fluid">
            <div class="row">

                <!-- head -->
                <div class="col-12 bg-primary">
                    <div class="row">

                        <div class="col-4">
                            <div class="row">
                                <div class="col-1 col-lg-4 mt-1 mb-1">
                                    <?php

                                    $profileimg = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user['email'] . "'");
                                    $nprofileimg = $profileimg->num_rows;
                                    if ($nprofileimg == 1) {
                                        $pr = $profileimg->fetch_assoc();
                                    ?>
                                        <img class="rounded-circle" width="90px" height="90px" src="<?php echo $pr['code']; ?>" />
                                    <?php
                                    } else {
                                    ?>
                                        <img class="rounded-circle" width="90px" height="90px" src="resources/demoProfileImg.jpg" />
                                    <?php
                                    }

                                    ?>

                                </div>

                                <div class="col-12 col-lg-8">
                                    <div class="row">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span class="fw-bold">
                                                <?php
                                                echo $user["fname"] . " " . $user["lname"];
                                                ?>
                                            </span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-white">
                                                <?php
                                                echo $user["email"];
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <h1 class="text-white fw-bold offset-4 offset-lg-2">My Products</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- head -->

                <div class="col-12">
                    <div class="row">

                        <!-- sortings -->
                        <div class="col-12 col-lg-2 mx-0 mx-lg-3 my-3 rounded bg-body border border-primary">
                            <div class="row">
                                <div class="col-12 mt-3 ms-0 ms-lg-2 fs-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Filters</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-9">
                                                    <input class="form-control" type="text" placeholder="Search..." id="s" />
                                                </div>
                                                <div class="col-3">
                                                    <label class="form-label fs-4 bi bi-search"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" name="flexRadioDefault" id="n">
                                                <label class="form-check-label fs-5" for="n">
                                                    Newer to Oldest
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" name="flexRadioDefault" id="o">
                                                <label class="form-check-label fs-5" for="o">
                                                    Oldest to Newer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" name="flexRadioDefault" id="l">
                                                <label class="form-check-label fs-5" for="l">
                                                    Low to High
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" name="flexRadioDefault" id="h">
                                                <label class="form-check-label fs-5" for="h">
                                                    High to Low
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" name="flexRadioDefault" id="b">
                                                <label class="form-check-label fs-5" for="b">
                                                    Brand New
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input fs-5" type="radio" name="flexRadioDefault" id="u">
                                                <label class="form-check-label fs-5" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                        <div class="offset-0 offset-lg-1 col-12 col-lg-8 mt-3 mb-3">
                                            <div class="row">
                                                <button class="col-12 d-grid btn btn-success fw-bold mb-3" onclick="addFilters();">Search</button>
                                                <button class="col-12 d-grid btn btn-primary">Clear Filters</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- sortings -->

                        <!-- product -->

                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-white border border-primary">
                            <div class="row">

                                <div class="col-10 offset-1 text-center">
                                    <div class="row"  id="mainbox">

                                        <?php


                                        $products = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user['email'] . "'");
                                        $nproducts = $products->num_rows;
                                        if ($nproducts > 0) {
                                            $row = $products->fetch_assoc();
                                            $results_per_page = 6;

                                            $number_of_pages = ceil($nproducts / $results_per_page);

                                            // echo $nproducts;
                                            // echo $number_of_pages;

                                            if (isset($_GET["page"])) {
                                                $pageno = $_GET["page"];
                                            } else {
                                                $pageno = 1;
                                            }

                                            // $offset = 6 * ($pageno-1);

                                            $page_first_result = ((int)$pageno - 1) * $results_per_page;

                                            $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "'
                                        LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");

                                            $srn = $selectedrs->num_rows;

                                            while ($srow = $selectedrs->fetch_assoc()) {

                                                // for ($i = 0; $i < $srn; $i++) {
                                                //     $srow = $selectedrs->fetch_assoc();

                                        ?>
                                                <div class="card mb-3 col-12 col-lg-6 mt-3">
                                                    <div class="row g-0">

                                                        <?php

                                                        $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $srow["id"] . "'");
                                                        $pir = $pimgrs->fetch_assoc();


                                                        ?>

                                                        <div class="col-md-4 mt-4">
                                                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title fw-bold"><?php echo $srow["title"]; ?></h5>
                                                                <span class="card-text text-primary fw-bold">Rs. <?php echo $srow["price"]; ?>.00</span>
                                                                <br />
                                                                <span class="card-text text-success fw-bold"><?php echo $srow["qty"]; ?> items left</span>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" id="check" onchange="changeStatus(<?php echo $srow['id']; ?>);" <?php

                                                                                                                                                                                    if ($srow["status_id"] == 2) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    }

                                                                                                                                                                                    ?>>

                                                                    <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $srow['id']; ?>">
                                                                        <?php
                                                                        if ($srow["status_id"] == 2) {
                                                                            echo "Make Your Product Active";
                                                                        } else {
                                                                            echo "Make Your Product Deactive";
                                                                        }
                                                                        ?>
                                                                    </label>

                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg-6">
                                                                            <a href="#" class="btn btn-success d-grid" onclick="sendid(<?php echo $srow['id']; ?>);">Update</a>
                                                                        </div>
                                                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                                                            <a href="#" class="btn btn-danger d-grid" onclick="deletemodal(<?php echo $srow['id']; ?>);">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal<?php echo $srow['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-bolder text-warning" id="exampleModalLabel">Warning...</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are You Sure You Want To Delete This Product?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                                                <button type="button" class="btn btn-danger" onclick="deleteproduct(<?php echo $srow['id']; ?>);">Yes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->

                                        <?php

                                            }
                                        }


                                        ?>
                                    </div>
                                </div>
                                <!-- pagination -->
                                <div class="col-12 mb-3 d-flex justify-content-center">
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
                                <!-- pagination -->

                            </div>
                        </div>

                        <!-- product -->
                    </div>
                </div>


            </div>
        </div>

        <?php

        require "footer.php";

        ?>

        <script src="sellerproductview.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>

<?php
} else {

?>
    <script>
        alert("You have to Signin or Signup First!");
        window.location = "index.php";
    </script>
<?php

}
?>