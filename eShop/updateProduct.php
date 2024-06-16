<?php

session_start();

require "connection.php";

$product = $_SESSION["p"];

if(isset($product)){
    ?>


<!DOCTYPE html>

<html>

<head>
    <title>eShop | Update a product</title>

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

            <!-- header -->
            <div class="col-12 mb-2">
                <h2 class="h1 text-center text-primary">Update Product</h2>
            </div>
            <!-- header -->

            <!-- search field -->

            <!-- <div class="col-12 mb-2 mt-4">
                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-6">
                        <input type="text" class="form-control text-center" placeholder="Search Product You Want to Update" id="searchtoupdate"/>
                    </div>
                    <div class="col-12 col-lg-4 d-grid">
                        <button class="btn btn-primary searchbtn mt-sm-2 mt-lg-0" style="height: 40px;" onclick="searchtoupdate();">Search Product</button>
                    </div>
                </div>
            </div> --> 

            <hr class="hrbreak1" />

            <!-- search field -->

            <!-- category,brand,model -->

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Select Product Category</label>
                            </div>
                            <div class="col-12">
                                <select class="form-select" disabled>
                                    <!-- <option id="uca">Select Category</option> -->

                                    <?php

                                    $cat = Database::search("SELECT * FROM `category` WHERE `id`='".$product["category_id"]."'");
                                    $n = $cat->num_rows;

                                    for ($i = 0; $i < $n; $i++) {
                                        $d = $cat->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
                                    <?php
                                    }

                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                    $mhasb = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='".$product["model_has_brand_id"]."'");
                    $nmhb = $mhasb->num_rows;
                    $pppp = $mhasb->fetch_assoc();

                    ?>

                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Select Product Brand</label>
                            </div>
                            <div class="col-12">
                                <select class="form-select" disabled>
                                    <!-- <option id="ubr">Select Brand</option> -->

                                    <?php

                                    $brand = Database::search("SELECT * FROM `brand` WHERE `id`='".$pppp["brand_id"]."'");
                                    $nbrand = $brand->num_rows;

                                    for ($i = 0; $i < $nbrand; $i++) {
                                        $dbrand = $brand->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $dbrand['id']; ?>"><?php echo $dbrand['name']; ?></option>
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
                                <select class="form-select" disabled>
                                    <!-- <option id="umo">Select Model</option> -->

                                    <?php

                                    $model = Database::search("SELECT * FROM `model` WHERE `id`='".$pppp["model_id"]."'");
                                    $nmodel = $model->num_rows;

                                    for ($i = 0; $i < $nmodel; $i++) {
                                        $dmodel = $model->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $dmodel['id']; ?>"><?php echo $dmodel['name']; ?></option>
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
                        <input type="text" class="form-control" id="uti" value="<?php echo $product["title"];?>" />
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

                            <?php
                            
                            $conditions = Database::search("SELECT * FROM `condition` WHERE `id`='".$product["condition_id"]."'");
                            $condition = $conditions->fetch_assoc();
                            $cond = $condition["name"];

                            ?>

                            <div class="offset-lg-1 col-6 col-lg-3 ms-5 form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="ubn" disabled <?php
                                                                                                                if($cond=="Brandnew"){
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                                ?>>
                                <label class="form-check-label" for="ubn">
                                    Brandnew
                                </label>
                            </div>
                            <div class="offset-lg-1 col-6 col-lg-3 ms-5 form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="uus" disabled <?php
                                                                                                                if($cond=="Used"){
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                                ?>>
                                <label class="form-check-label" for="uus">
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
                                <?php
                            
                                $colours = Database::search("SELECT * FROM `color` WHERE `id`='".$product["color_id"]."'");
                                $colour = $colours->fetch_assoc();
                                $color = $colour["name"];

                                ?>
                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                        <input class="form-check-input" type="radio" value="" id="uclr1" name="colorRadio" disabled <?php
                                                                                                                if($color=="Gold"){
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                                ?>>
                                        <label class="form-check-label" for="uclr1">
                                            Gold
                                        </label>
                                    </div>
                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                        <input class="form-check-input" type="radio" value="" name="colorRadio" id="uclr2" disabled <?php
                                                                                                                if($color=="Silver"){
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                                ?>>
                                        <label class="form-check-label" for="uclr2">
                                            Silver
                                        </label>
                                    </div>
                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                        <input class="form-check-input" type="radio" value="" name="colorRadio" id="uclr3" disabled <?php
                                                                                                                if($color=="Graphite"){
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                                ?>>
                                        <label class="form-check-label" for="uclr3">
                                            Graphite
                                        </label>
                                    </div>
                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                        <input class="form-check-input" type="radio" value="" name="colorRadio" id="uclr4" disabled <?php
                                                                                                                if($color=="Pacific Blue"){
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                                ?>>
                                        <label class="form-check-label" for="uclr4">
                                            Pacific Blue
                                        </label>
                                    </div>
                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                        <input class="form-check-input" type="radio" value="" name="colorRadio" id="uclr5" disabled <?php
                                                                                                                if($color=="Jet Black"){
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                                ?>>
                                        <label class="form-check-label" for="uclr5">
                                            Jet Black
                                        </label>
                                    </div>
                                    <div class="offset-1 offset-lg-0 col-5+ col-lg-4 form-check">
                                        <input class="form-check-input" type="radio" value="" name="colorRadio" id="uclr6" disabled <?php
                                                                                                                if($color=="Rose Gold"){
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                                ?>>
                                        <label class="form-check-label" for="uclr6">
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
                                <input class="form-control" type="number" value="<?php echo $product["qty"];?>" min="0" id="uqty" />
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
                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="ucost" value="<?php echo $product["price"];?>" disabled>
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
                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_colombo"];?>" id="udwc">
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
                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_other"];?>" id="udoc">
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
                        <textarea class="form-control" cols="100" rows="30" style="background-color: ghostwhite;"  id="udesc">
                            <?php echo $product["description"]; ?>
                        </textarea>
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
                    <?php
                    $imageee = Database::search("SELECT * FROM `images` WHERE `product_id`='".$_SESSION["p"]["id"]."'");
                    $num = $imageee->num_rows;
                    for($i=0; $i<$num; $i++){
                        $image= $imageee->fetch_assoc();
                        if($i==0){
                            $img = $image["code"];
                        }
                    }
                    
                    ?>
                    <img src="<?php echo $img;?>" class="col-5 col-lg-2 ms-2 img-thumbnail" id="uprev" />
                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col-12 col-lg-6 mt-2">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <input class="d-none" type="file" accept="img/*" id="uimguploader" />
                                        <label class="btn btn-primary col-5 col-lg-8" for="uimguploader" onclick="changeImg();">Upload</label>
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
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="col-12 offset-0 col-lg-4 offset-lg-2 d-grid">
                        <button class="btn btn-success searchbtn" onclick="updateProduct(<?php echo $product['id'];?>);">Update Product</button>
                    </div>
                    <div class="col-12 col-lg-4 d-grid mt-2 mt-lg-0">
                        <button class="btn btn-dark searchbtn" onclick="goToAddProduct();">Add Product</button>
                    </div>
                </div>
            </div>
            <!-- save btn -->

        </div>
        
    </div>
    <?php
            
            require "footer.php";

        ?>
    
    <script src="updateproduct.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>

<?php
}else{

}
?>