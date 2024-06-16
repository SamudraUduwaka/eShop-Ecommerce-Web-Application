<?php

session_start();

require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $products = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $pn = $products->num_rows;

    if ($pn == 1) {
        $pd = $products->fetch_assoc();


?>

        <!DOCTYPE html>
        <html>

        <head>
            <title>eShop | Single Product View</title>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="icon" href="resources/logo.svg" />

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="singleproductview.css" />
            <link rel="stylesheet" href="font&hr.css" />

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">
                    <?php

                    require "header.php";

                    ?>
                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">
                            <div class="bg-white" style="padding: 11px;">
                                <div class="row">
                                    <div class="col-lg-2 order-2 order-lg-1">
                                        <ul>

                                            <?php

                                            $imagesrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                            $in = $imagesrs->num_rows;

                                            $img1;

                                            if (!empty($in)) {

                                                for ($x = 0; $x < $in; $x++) {

                                                    $d = $imagesrs->fetch_assoc();
                                                    if ($x == 0) {
                                                        $img1 = $d["code"];
                                                    }

                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                        <img src="<?php echo $d["code"]; ?>" height="150px" class="mt-1 mb-1" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);" />
                                                    </li>
                                                <?php


                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }

                                            ?>

                                            <!-- <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="resources/singleview/sp1.jpg" height="150px" class="mt-1 mb-1" />
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="resources/singleview/sp2.jpg" height="150px" class="mt-1 mb-1" />
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="resources/singleview/sp3.jpg" height="150px" class="mt-1 mb-1" />
                                            </li> -->
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <!-- <div class="d-flex flex-column align-items-center border border-1 border-secondary p-3"> -->
                                        <div class=" align-items-center border border-1 border-secondary p-3">
                                            <div style="background-image: url('<?php echo $img1; ?>'); background-repeat: no-repeat; background-size: contain; height:450px ;" id="mainimg"></div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <nav>
                                                            <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                                <!-- <li class="breadcrumb-item"><a href="#">Products</a></li> -->
                                                                <li class="breadcrumb-item active">
                                                                    <a href="#" class="text-black-50 text-decoration-none">Single View</a>
                                                                </li>
                                                            </ol>
                                                        </nav>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                                    </div>

                                                    <div class="col-12 mt-1">
                                                        <span class="badge badge-success">
                                                            <li class="fa fa-star mt-1 text-warning fs-6"></li>
                                                            <label class="text-dark fs-6">4.5 Star </label>
                                                            <label class="text-dark fs-6">| 35 Ratings & 45 Reviews</label>
                                                        </span>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="d-inline-block fw-bold mt-1 fs-4">Rs. <?php echo $pd["price"]; ?> .00</label>
                                                        <label class="d-inline-block fw-bold mt-1 fs-6 text-danger"><del>Rs. <?php $a = $pd["price"];
                                                                                                                                $newval = ($a / 100) * 5;
                                                                                                                                $val = $a + $newval;
                                                                                                                                echo $val;

                                                                                                                                ?> .00</del></label>
                                                    </div>

                                                    <hr class="hrbreak1" />

                                                    <div class="col-12">
                                                        <label class="text-primary fs-6"><b>Warranty : </b>06 months warranty</label><br />
                                                        <label class="text-primary fs-6"><b>Return Policy : </b>01 months return policy</label><br />
                                                        <label class="text-primary fs-6"><b>In Stock : </b><?php echo $pd["qty"]; ?> items left</label>
                                                    </div>

                                                    <hr class="hrbreak1" />

                                                    <div class="col-12">
                                                        <label class="text-dark fs-5 fw-bold">Seller Details</label><br />

                                                        <?php

                                                        $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $pd["user_email"] . "'");
                                                        $userd = $userrs->fetch_assoc();

                                                        ?>

                                                        <label class="text-success fs-6">Seller's name : <?php echo $userd["fname"] . " " . $userd["lname"]; ?></label><br />
                                                        <label class="text-success fs-6">Seller's email : <?php echo $userd["email"]; ?></label><br />
                                                        <label class="text-success fs-6">Seller's mobile : <?php echo $userd["mobile"]; ?></label>

                                                        <br/>
                                                        <a href="messages.php?email=<?php echo $userd["email"];?>" class="btn btn-outline-secondary">Chat with Seller</a>
                                                    </div>

                                                    <hr class="hrbreak1" />

                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-10 rounded border border-1 border-success mt-1">
                                                                <div class="row">
                                                                    <div class="col-1 col-md-3 col-sm-2 col-lg-1 ">
                                                                        <img src="resources/singleview/pricetag.png" />
                                                                    </div>
                                                                    <div class="col-11 col-md-9 col-sm-10 mt-1 pe-4 col-lg-11">
                                                                        <label class="text-black-50">Stand a chance to get instant 5% discount by using VISA.</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <div class="row" style="margin-top: 10px;">
                                                            <div class="col-md-6" style="margin-top: 10px;">
                                                                <label class="fs-6 mt-1 fw-bold">Colour Options :</label><br />

                                                                <?php

                                                                $colors = Database::search("SELECT * FROM `color` WHERE `id`='" . $pd["color_id"] . "'");
                                                                $color = $colors->fetch_assoc();

                                                                ?>

                                                                <button class="btn btn-primary"><?php echo $color["name"]; ?></button>
                                                                <button class="btn btn-primary disabled">Gold</button>
                                                                <button class="btn btn-primary disabled">Blue</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="hrbreak1" />

                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-5" style="margin-top: 5px;">
                                                                <div class="row">
                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start product_qty d-inline-block position-relative">
                                                                        <span class="mt-1">Qty :</span>
                                                                        <input id="qtyinput" class="border-0 fs-6 fw-bold text-start mt-1" type="text" pattern="[0-9]*" value="1" />
                                                                        <div class="qty_buttons position-absolute">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                                                <i class="fas fa-chevron-up" onclick="qty_inc(<?php echo $pd['qty']; ?>);"></i>
                                                                            </div>
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                                                <i class="fas fa-chevron-down" onclick="qty_dec();"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-4 col-lg-3 d-grid">
                                                                        <buuton class="btn btn-primary" onclick="addToCart(<?php echo $pid;?>);">Add to cart</buuton>
                                                                    </div>
                                                                    <div class="col-4 col-lg-3 d-grid">
                                                                        <buuton class="btn btn-success" type="submit" id="payhere-payment" onclick="paynow(<?php echo $pid; ?>);">Buy Now</buuton>
                                                                    </div>
                                                                    <div class="col-4 col-lg-2 d-grid">
                                                                        <i class="fas fa-heart mt-2 fs-5 text-black-50"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-primary border-start-0 border-end-0 border-top-0">
                                    <div class="col-md-6">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">
                                    <div class="offset-1 col-10">
                                        <div class="row p-2">

                                            <?php

                                            $brandrs = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='" . $pd["model_has_brand_id"] . "'");
                                            $bd = $brandrs->fetch_assoc();
                                            // $brand = Database::search("SELECT * FROM `brand` WHERE `id`='".$bd["brand_id"]."'");
                                            $productrows = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` 
                                            ON `product`.`model_has_brand_id` = `model_has_brand`.`id` WHERE `model_has_brand`.`brand_id` = '" . $bd["brand_id"] . "' LIMIT 4");
                                            $pnumrow = $productrows->num_rows;

                                            if ($pnumrow > 0) {
                                                for ($y1 = 0; $y1 < $pnumrow; $y1++) {
                                                    $pdata = $productrows->fetch_assoc();
                                                    $img2 = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pdata["id"] . "'");
                                                    $nimg2 = $img2->num_rows;
                                                    $image2;
                                                    for ($y2 = 0; $y2 < $nimg2; $y2++) {
                                                        $dimg2 = $img2->fetch_assoc();
                                                        if ($y2 == 0) {
                                                            $image2 = $dimg2["code"];
                                                        }
                                            ?>

                                                        <div class="card me-1" style="width: 18rem;">
                                                            <img src="<?php echo $image2; ?>" class="card-img-top" alt="...">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $pdata["title"]; ?></h5>
                                                                <p class="card-text">Rs. <?php echo $pdata["price"]; ?> .00</p>
                                                                <a href="#" class="btn btn-primary">Add to cart</a>
                                                                <a href="#" class="btn btn-primary">Buy Now</a>
                                                                <a href="#" class=" mt-1 fs-6"><i class="fas fa-heart mt-1 fs-6 text-black-50"></i></a>
                                                            </div>
                                                        </div>

                                                <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <h3>No any related items to show</h3>
                                            <?php
                                            }

                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border-start-0 border-end-0 border-top-0 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label fs-5 fw-bold">Brand</label>
                                            </div>
                                            <div class="col-10">
                                                <?php
                                                $brand = Database::search("SELECT * FROM `brand` WHERE `id`='" . $bd["brand_id"] . "'");
                                                $brandname = $brand->fetch_assoc();
                                                ?>
                                                <label class="form-label"><?php echo $brandname["name"]; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label fs-5 fw-bold">Model</label>
                                            </div>
                                            <div class="col-10">
                                                <?php
                                                $model = Database::search("SELECT * FROM `model` WHERE `id`='" . $bd["model_id"] . "'");
                                                $modelname = $model->fetch_assoc();
                                                ?>
                                                <label class="form-label"><?php echo $modelname["name"]; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="form-label fs-5 fw-bold">Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" cols="60" rows="10">
                                                    <?php echo $pd["description"]; ?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                            <div class="col-md-6">
                                <span class="fs-3 fw-bold">Feedbacks...</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row g-1">
                            <?php

                            $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                            $feed = $feedbackrs->num_rows;

                            if ($feed == 0) {
                            ?>
                                <div class="col-12">
                                    <label class="form-label text-center text-black-50">There are no any feedbacks to show.</label>
                                </div>
                                <?php
                            } else {

                                for ($a = 0; $a < $feed; $a++) {
                                    $feedrow = $feedbackrs->fetch_assoc();
                                ?>


                                    <div class="col-12 col-lg-4 border border-2 border-danger rounded">
                                        <div class="row m-1">
                                            <div class="col-12 ">
                                                <span class="fs-6 fw-bold text-primary"><?php echo $feedrow["user_email"];?></span>
                                            </div>
                                            <div class="col-12 ">
                                                <span class="fs-6 fw-bold text-dark"><?php echo $feedrow["feed"];?></span>
                                            </div>
                                            <div class="col-12 text-end">
                                                <span class="fs-6 fw-bold text-black-50"><?php echo $feedrow["date"];?></span>
                                            </div>
                                        </div>
                                    </div>
                            <?php

                                }
                            }

                            ?>

                        </div>
                    </div>

                    <?php

                    require "footer.php";

                    ?>
                </div>
            </div>


            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="singleproductview.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="buynow.js"></script>
            
        </body>

        </html>

<?php
    }
}
?>