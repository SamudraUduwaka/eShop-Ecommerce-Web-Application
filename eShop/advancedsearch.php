<?php

session_start();

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>

    <title>eShop | Advanced Search</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="advancedsearch.css" />
    <link rel="stylesheet" href="sellerproductview.css" />

    <link rel="stylesheet" href="font&hr.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body class="bg-info">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row bg-white border border-primary border-start-0 border-end-0 border-top-0">
                    <?php

                    require "header.php";

                    ?>
                </div>
            </div>
            <div class="col-12 bg-white">
                <div class="row">
                    <div class="offset-0 offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2 mt-2 ">
                                <div class="mb-3 searchlogo"></div>
                            </div>
                            <div class="col-10">
                                <label class="text-black-50 fw-bolder fs-3 mt-3">Advanced Search</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-3 mb-2">
                                <input type="text" class="form-control fw-bold" placeholder="Type keyword to search..." id="k" />
                            </div>
                            <div class="col-12 col-lg-2 mt-3 mb-2 d-grid">
                                <button class="btn btn-primary" onclick="advancedSearch(1);">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-primary border-2" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <select class="form-select" id="c">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $category = Database::search("SELECT * FROM `category`");
                                            $ncat = $category->num_rows;

                                            for ($x = 0; $x < $ncat; $x++) {
                                                $cat = $category->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <select class="form-select" id="b">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $brand = Database::search("SELECT * FROM `brand`");
                                            $nbr = $brand->num_rows;

                                            for ($x = 0; $x < $nbr; $x++) {
                                                $br = $brand->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $br["id"]; ?>"><?php echo $br["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $model = Database::search("SELECT * FROM `model`");
                                            $nmo = $model->num_rows;

                                            for ($x = 0; $x < $nmo; $x++) {
                                                $mo = $model->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $mo["id"]; ?>"><?php echo $mo["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-3">
                                <select class="form-select" id="con">
                                    <option value="0">Select Condition</option>
                                    <?php
                                    $condition = Database::search("SELECT * FROM `condition`");
                                    $ncon = $condition->num_rows;

                                    for ($x = 0; $x < $ncon; $x++) {
                                        $con = $condition->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $con["id"]; ?>"><?php echo $con["name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <select class="form-select" id="clr">
                                    <option value="0">Select Colour</option>
                                    <?php
                                    $color = Database::search("SELECT * FROM `color`");
                                    $ncolor = $color->num_rows;

                                    for ($x = 0; $x < $ncolor; $x++) {
                                        $colour = $color->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $colour["id"]; ?>"><?php echo $colour["name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-3">
                                <input type="text" class="form-control" placeholder="Price from" id="pf" />
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <input type="text" class="form-control" placeholder="Price to" id="pt" />
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
            <div class="offset-o offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">
                    <div class="col-9 col-lg-10"><hr></div>
                    <div class="col-3 col-lg-2 mb-2 mt-2">
                        <select id="sort" class=" form-select border border-2 border-dark border-start-0 border-end-0 border-top-0">
                            <option value="1">Price Low To High</option>
                            <option value="2">Price High To Low</option>
                            <option value="3">Quantity Low To High</option>
                            <option value="4">Quantity High To Low</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="viewResults">

                        </div>
                    </div>
                </div>
            </div>


            <?php

            require "footer.php";

            ?>

        </div>
    </div>


    <script src="advancedsearch.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="buynow.js"></script>
    <script src="singleproductview.js"></script>
</body>

</html>