<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $uemail = $_SESSION["u"]["email"];

?>

    <!DOCTYPE html>
    <html>

    <head>

        <title>eShop | Watchlist</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="watchlist.css" />
        
        <link rel="stylesheet" href="font&hr.css" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row gx-2 gy-2">
                <?php

                require "header.php";

                ?>

                <div class="col-12 border border-1 border-secondary rounded">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder">Watchlist &hearts;</label>
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
                        <div class="col-12 col-lg-2 border border-top-0 border-start-0 border-bottom-0 border-end border-2 border-primary">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                <a class="nav-link" href="cart.php">My Cart</a>
                                <a class="nav-link" href="#">Recently viewed</a>
                            </nav>
                        </div>

                        <?php

                        $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $uemail . "'");
                        $wn = $watchlistrs->num_rows;

                        if ($wn <= 0) {

                        ?>
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-12 emptyview"></div>
                                        <div class="col-12 text-center ">
                                            <label class="form-label fs-1 mb-3 fw-bolder">You have no any items in watchlist</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php

                        } else {
                        ?>
                            <div class="col-12 col-lg-9">
                                <div class="row g-2">
                                    <?php
                                    for ($i = 0; $i < $wn; $i++) {
                                        $wr = $watchlistrs->fetch_assoc();
                                        $wid = $wr["product_id"];

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $wid . "'");
                                        $pn = $productrs->num_rows;

                                        if ($pn == 1) {
                                            $pr = $productrs->fetch_assoc();
                                            $proid = $pr["id"];


                                            ?>

                                            <div class="card mb-3 col-12">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <?php

                                                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $proid . "'");
                                                        $in = $imagers->num_rows;

                                                        $arr;

                                                        for ($x = 0; $x < $in; $x++) {
                                                            $ir = $imagers->fetch_assoc();
                                                            $arr[$x] = $ir["code"];
                                                        }

                                                        ?>
                                                        <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $pr["title"];  ?></h5>
                                                            <?php
                                                            $colorrs = Database::search("SELECT * FROM `color` WHERE `id`='".$pr["color_id"]."'");
                                                            $color = $colorrs->fetch_assoc();
                                                            ?>
                                                            <span class="fw-bold text-black-50">Colour: <?php echo $color["name"];?></span>&nbsp; |
                                                            <?php
                                                            $conditionrs = Database::search("SELECT * FROM `condition` WHERE `id`='".$pr["condition_id"]."'");
                                                            $condition = $conditionrs->fetch_assoc();
                                                            ?>
                                                            &nbsp;<span class="fw-bold text-black-50">Condition: <?php echo $condition["name"];?></span>
                                                            <br />
                                                            <span class="fw-bold text-black-50 fs-5">Price: </span>&nbsp;
                                                            <span class="fw-bold text-black fs-5">Rs. <?php echo $pr["price"];?> .00 </span>
                                                            <br />
                                                            <span class="fw-bold text-black-50 fs-5">Seller: </span>&nbsp;
                                                            <br />
                                                            <span class="fw-bold text-black fs-5"><?php echo $_SESSION["u"]["fname"]." ".$_SESSION["u"]["lname"];?> </span>
                                                            <br />
                                                            <span class="fw-bold text-black fs-5"><?php echo $_SESSION["u"]["email"];?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mt-4">
                                                        <div class="card-body d-grid">
                                                            <a class="btn btn-outline-success mb-2">Buy Now</a>
                                                            <a class="btn btn-outline-warning mb-2">Add to cart</a>
                                                            <a class="btn btn-outline-danger mb-2" onclick="deletefromwatchlist(<?php echo $wr['id']?>);">Remove</a>
                                                        </div>
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
                        }

                        ?>



                    </div>
                </div>

                <?php

                require "footer.php";

                ?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="watchlist.js"></script>
        <script src="bootstrap.bundle.js"></script>

    </body>

    </html>

<?php
}

?>