<?php

session_start();

require "connection.php";

// $pageno;
// if (isset($_GET["page"])) {
//     $pageno = $_GET["page"];
// } else {
//     $pageno = 1;
// }
?>

<!DOCTYPE html>
<html>

<head>
    <title>eShop Home</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="sellerproductview.css" />

    <link rel="stylesheet" href="font&hr.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- header -->
            <?php

            require "header.php";

            ?>
            <!-- header -->
            <hr class="hrbreak1" />
            <!-- searchbar -->
            <div class="col-12">
                <div class="row">
                    <div class="offset-lg-1 col-lg-1 col-12 logoimg" style="background-position: center;"></div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basicsearchtxt">
                            <!-- <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Category</button> -->
                            <select class="btn btn-outline-primary" id="basicsearchselect">
                                <option value="0">Select Category</option>

                                <?php

                                $rs = Database::search("SELECT * FROM `category`");
                                $n = $rs->num_rows;

                                for ($i = 0; $i < $n; $i++) {
                                    $cat = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 d-grid gap-2">
                        <button class="btn btn-primary mt-3 searchbtn" onclick="basicsearch(1);">Search</button>
                    </div>
                    <div class="col-6 col-md-3 col-lg-1 mt-4">
                        <a href="advancedsearch.php" class="link-secondary link1">Advanced</a>
                    </div>
                </div>
            </div>
            <!-- searchbar -->
            <hr class="hrbreak1 mt-2" />
            <!-- carausel -->
            <div class="col-8 offset-2 d-none d-lg-block">
                <div class="row">

                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/slider images/posterimg.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block postercaption">
                                    <h5 class="postertitle">Welcome to eShop</h5>
                                    <p class="postertext">The World's best online shopping store</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg2.jpg" class="d-block posterimg1" alt="...">
                                <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div> -->
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg3.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block postercaption1">
                                    <h5 class="postertitle">Be Free...</h5>
                                    <p class="postertext">Experience the lowest delivery costs with us</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>
            <!-- carausel -->

            <!-- product title view  -->
            <div class="col-12" id="pdiv">
                <div class="row" id="pdetails">
                    <?php

                    $rs = Database::search("SELECT * FROM `category`");
                    $n = $rs->num_rows;

                    for ($x = 0; $x < $n; $x++) {
                        $c = $rs->fetch_assoc();

                    ?>
                        <a class="link-dark link2" href="#"><?php echo $c["name"]; ?></a>
                        <a class="link-dark link3" href="#">&nbsp;&nbsp; See All &rightarrow;</a>
                        <br />
                        <?php

                        $resultset = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c["id"] . "' ORDER BY `datetime_added` DESC LIMIT 5");
                        ?>
                        <div class="col-12">
                            <div class="row border border-primary">
                                <div class="offset-lg-1 col-12 col-lg-10">
                                    <div class="row">
                                        <!-- <div id="pdiv"> -->

                                        <?php
                                        $nr = $resultset->num_rows;
                                        for ($y = 0; $y < $nr; $y++) {
                                            $prod = $resultset->fetch_assoc();
                                        ?>
                                            <div class="card col-6 col-lg-2 mt-1 mb-1" style="width: 14rem;">

                                                <?php

                                                $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $prod["id"] . "'");

                                                $imggg;

                                                for ($z = 0; $z < $pimage->num_rows; $z++) {
                                                    $imgrow = $pimage->fetch_assoc();
                                                    if ($z == 0) {
                                                        $imggg = $imgrow['code'];
                                                    }
                                                }

                                                // $imggg = $imgrow[0];

                                                ?>
                                                <img src="<?php echo $imggg; ?>" class="card-img-top cardTopImg" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $prod["title"]; ?><span class="badge bg-info">New</span></h5>
                                                    <span class="card-text text-primary">Rs: <?php echo $prod['price']; ?>.00</span>
                                                    <br />

                                                    <?php

                                                    if ((int)$prod["qty"] > 0) {

                                                    ?>
                                                        <span class="card-text text-warning"><b>In Stock</b></span>
                                                        <br />
                                                        <input class="form-control" type="number" value="1" id="qtytxt<?php echo $prod["id"]; ?>" />
                                                        <a href="<?php echo "singleproductview.php?id=" . ($prod["id"]); ?>" class="btn btn-success d-grid">Buy Now</a>

                                                        <a href="#" class="btn btn-danger" onclick="addToCart(<?php echo $prod['id']; ?>);">Add To Cart</a>

                                                        <a href="#" onclick="addToWatchlist(<?php echo $prod['id']; ?>);" class="btn btn-secondary"><i class="bi bi-suit-heart-fill"></i></a>



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
                                        ?>
                                    </div>



                                </div>
                            </div>
                        </div>

                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>

        <!-- product title view  -->

        <!-- product view  -->

        <!-- product view  -->

        <!-- footer -->

        <?php
        require "footer.php";
        ?>

        <!-- footer -->
    </div>
    </div>
    <script src="home.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>