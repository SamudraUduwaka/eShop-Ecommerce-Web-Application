<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];

    $total = "0";
    $subtotal = "0";
    $shipping = "0";

?>


    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop | Cart</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="cart.css" />
        <link rel="stylesheet" href="font&hr.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <?php

                require "header.php";

                ?>
                <div class="col-12" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Basket</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 border border-1 border-secondary rounded mb-2">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder">Basket <i class="bi bi-cart4"></i></label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hrbreak1" />
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in watchlist...." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="hrbreak1" />
                        </div>

                        <?php

                        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
                        $ncart = $cartrs->num_rows;

                        if ($ncart == 0) {
                        ?>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-2 fw-bolder">You have no items in your basket</label>
                                    </div>
                                    <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                        <a href="#" class="btn btn-primary fs-3">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {

                        ?>
                            <div class="col-12 col-lg-9">
                                <div class="row">

                                    <?php

                                    for ($i = 0; $i < $ncart; $i++) {
                                        $dcart = $cartrs->fetch_assoc();

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $dcart["product_id"] . "'");
                                        $pr = $productrs->fetch_assoc();

                                        $total = $total + ($pr["price"] * $dcart["qty"]);

                                        $addressrs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `location` ON `user_has_address`.`location_id`=`location`.`id`
                                            WHERE `user_email`='" . $uemail . "'");
                                        $ar = $addressrs->fetch_assoc();
                                        $district_id = $ar["district_id"];

                                        $ship = "0";

                                        if ($district_id == "1") {
                                            $ship = $pr["delivery_fee_colombo"];

                                            $shipping = $shipping + $pr["delivery_fee_colombo"];
                                        } else {
                                            $ship = $pr["delivery_fee_other"];

                                            $shipping = $shipping + $pr["delivery_fee_other"];
                                        }

                                        // echo $total;
                                        // echo $shipping;

                                        $sellerrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $pr["user_email"] . "'");
                                        $sn = $sellerrs->fetch_assoc();

                                    ?>


                                        <div class="card mb-3 col-12">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller: </span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $sn["fname"] . " " . $sn["lname"]; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="hrbreak1" />
                                                <div class="col-md-4">
                                                    <?php

                                                    $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pr["id"] . "'");
                                                    $in = $imagers->num_rows;

                                                    $arr;

                                                    for ($x = 0; $x < $in; $x++) {
                                                        $ir = $imagers->fetch_assoc();
                                                        $arr[$x] = $ir["code"];
                                                    }

                                                    ?>
                                                    <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start d-inline-block" 
                                                    tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $pr["title"];?>" data-bs-content="<?php echo $pr["description"];?>" alt="...">
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $pr["title"]; ?></h5>
                                                        <?php
                                                        $colorrs = Database::search("SELECT * FROM `color` WHERE `id`='" . $pr["color_id"] . "'");
                                                        $color = $colorrs->fetch_assoc();
                                                        ?>
                                                        <span class="fw-bold text-black-50">Colour: <?php echo $color["name"]; ?></span>&nbsp; |
                                                        <?php
                                                        $conditionrs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $pr["condition_id"] . "'");
                                                        $condition = $conditionrs->fetch_assoc();
                                                        ?>
                                                        &nbsp;<span class="fw-bold text-black-50">Condition: <?php echo $condition["name"]; ?></span>
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-5">Price: </span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $pr["price"]; ?> .00 </span>
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-5">Quantity: </span>&nbsp;
                                                        <input type="text" value="<?php echo $dcart["qty"]; ?>" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cartqtytxt" />
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee: </span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $ship; ?> .00 </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-4">
                                                    <div class="card-body d-grid">
                                                        <a class="btn btn-outline-success mb-2">Pay for this</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick="deletefromcart(<?php echo $dcart['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs. <?php echo ($pr["price"] * $dcart["qty"]) + $ship; ?> .00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summery</label>
                                    </div>
                                    <div class="col-12">
                                        <hr />
                                    </div>
                                    <div class="col-6">
                                        <span class="fs-6 fw-bold ">Items (<?php echo $ncart; ?>)</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold ">Rs. <?php echo $total; ?> .00</span>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="fs-6 fw-bold ">Shipping </span>
                                    </div>
                                    <div class="col-6 text-end mt-2">
                                        <span class="fs-6 fw-bold ">Rs. <?php echo $shipping; ?> .00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>
                                    <div class="col-6 mt-2">
                                        <span class="fs-5 fw-bold ">Total</span>
                                    </div>
                                    <div class="col-6 text-end mt-2">
                                        <span class="fs-5 fw-bold ">Rs. <?php echo $total + $shipping; ?> .00</span>
                                    </div>
                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            <?php
                        }

            ?>




            <?php

            require "footer.php";

            ?>
            </div>
        </div>

        <script src="cart.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

    </html>

<?php

}

?>