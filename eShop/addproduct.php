<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>

    <title>Add a Product</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="addproduct.css" />
    <link rel="stylesheet" href="font&hr.css" />
    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">

            <div id="addProductBox">

                <!-- header -->
                <div class="col-12 mb-2">
                    <h2 class="h1 text-center text-primary">Product Listing</h2>
                </div>
                <!-- header -->

                <!-- category,brand,model -->

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Category</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="ca">
                                        <option value="Select Category">Select Category</option>

                                        <?php

                                        $cat = Database::search("SELECT * FROM `category`");
                                        $n = $cat->num_rows;

                                        for ($i = 0; $i < $n; $i++) {
                                            $d = $cat->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $d['id'];?>"><?php echo $d['name'];?></option>
                                            <?php
                                        }

                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Brand</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="br">
                                        <option value="Select Brand">Select Brand</option>

                                        <?php

                                        $brand = Database::search("SELECT * FROM `brand`");
                                        $nbrand = $brand->num_rows;

                                        for ($i = 0; $i < $nbrand; $i++) {
                                            $dbrand = $brand->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $dbrand['id'];?>"><?php echo $dbrand['name'];?></option>
                                            <?php
                                        }

                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Model</label>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="mo">
                                        <option value="Select Model">Select Model</option>

                                        <?php

                                        $model = Database::search("SELECT * FROM `model`");
                                        $nmodel = $model->num_rows;

                                        for ($i = 0; $i < $nmodel; $i++) {
                                            $dmodel = $model->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $dmodel['id'];?>"><?php echo $dmodel['name'];?></option>
                                            <?php
                                        }

                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- category,brand,model -->

                <!-- title -->

                <hr class="hrbreak1" />

                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add a Title to your Product</label>
                        </div>
                        <div class="offset-lg-2 col-12 col-lg-8">
                            <input type="text" class="form-control" id="ti" />
                        </div>
                    </div>
                </div>

                <!-- title -->

                <hr class="hrbreak1" />

                <!-- condition,color,qty -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Condition</label>
                                </div>
                                <div class="offset-lg-1 col-6 col-lg-3 ms-5 form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1" id="bn" checked/>
                                    <label class="form-check-label" for="bn">
                                        Brandnew
                                    </label>
                                </div>
                                <div class="offset-lg-1 col-6 col-lg-3 ms-5 form-check">
                                    <input class="form-check-input" type="radio" id="us" name="flexRadioDefault1">
                                    <label class="form-check-label" for="us">
                                        Used
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Colour</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio1" id="clr1" checked/>
                                            <label class="form-check-label" for="clr1">
                                                Gold
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio1" id="clr2" >
                                            <label class="form-check-label" for="clr2">
                                                Silver
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio1" id="clr3" >
                                            <label class="form-check-label" for="clr3">
                                                Graphite
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio1" id="clr4" >
                                            <label class="form-check-label" for="clr4">
                                                Pacific Blue
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio1" id="clr5" >
                                            <label class="form-check-label" for="clr5">
                                                Jet Black
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5+ col-lg-4 form-check">
                                            <input class="form-check-input" type="radio" value="" name="colorRadio1" id="clr6">
                                            <label class="form-check-label" for="clr6">
                                                Rose Gold
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Add Product Quantity</label>
                                    <input class="form-control" type="number" value="0" min="0" id="qty" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- condition,color,qty -->

                <hr class="hrbreak1" />

                <!-- cost,payment method -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Cost Per Item</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Approved Payment Methods</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-2 col-2 pm pm1"></div>
                                        <div class="col-2 pm pm2"></div>
                                        <div class="col-2 pm pm3"></div>
                                        <div class="col-2 pm pm4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cost,payment method -->

                <hr class="hrbreak1" />

                <!-- delivery cost -->

                <div class="col-12 col-lg-5">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Delivery Costs</label>
                        </div>
                        <div class="offset-lg-1 col-12 col-lg-3">
                            <label class="form-label">Delivery cost within Colombo</label>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rs</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1"></label>
                        </div>
                        <div class="offset-lg-1 col-12 col-lg-3 mt-3">
                            <label class="form-label">Delivery cost out of Colombo</label>
                        </div>
                        <div class="col-12 col-lg-7 mt-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rs</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- delivery cost -->

                <hr class="hrbreak1" />

                <!-- product description -->

                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Product Description</label>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" cols="100" rows="30" style="background-color: ghostwhite;" id="desc"></textarea>
                        </div>
                    </div>
                </div>

                <!-- product description -->

                <hr class="hrbreak1" />

                <!-- product img -->

                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add Product Image</label>
                        </div>
                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thumbnail" id="prev" />
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <input class="d-none" type="file" accept="img/*" id="imguploader" />
                                            <label class="btn btn-primary col-5 col-lg-8" for="imguploader" onclick="changeImg();">Upload</label>
                                        </div>
                                        <!-- <div class="col-6 col-lg-4 d-grid mt-2 mt-lg-0">
                                        <button class="btn btn-success">Upload</button>
                                    </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- product img -->

                <hr class="hrbreak1" />

                <!-- notice -->

                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label>
                    <br />
                    <label class="form-label">We are taking 5% of the product price from every product as a service charge.</label>
                </div>

                <!-- notice -->

                <!-- save btn -->
                <!-- save btn -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 offset-0 col-lg-4 offset-lg-2 d-grid">
                            <button class="btn btn-success searchbtn" onclick="addProduct();">Add Product</button>
                        </div>
                        <div class="col-12 col-lg-4 d-grid mt-2 mt-lg-0">
                            <button class="btn btn-dark searchbtn" onclick="goToUpdate();">Update Product</button>
                        </div>
                    </div>
                </div>
                <!-- save btn -->
            </div>

            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->

            

            <!-- footer -->

            <?php
            require "footer.php";
            ?>

            <!-- footer -->
        </div>
    </div>

    <script src="addproduct.js"></script>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>