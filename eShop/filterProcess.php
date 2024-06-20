<?php

session_start();

$user = $_SESSION["u"];

require "connection.php";

$array;

$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];

if (!empty($search)) {

    $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%'");
    $pn = $products->num_rows;

    for ($x = 0; $x < $pn; $x++) {
        $pd = $products->fetch_assoc();

        // $array[$x] = $products->fetch_assoc();

        $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pd["id"] . "'");

        if ($productimg->num_rows == 1) {
            $img = $productimg->fetch_assoc();
?>
            <div class="col-md-4 mt-4">
                <img src="<?php echo  $img["code"]; ?>" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $pd["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs. <?php echo $pd["price"]; ?>.00</span>
                    <br />
                    <span class="card-text text-success fw-bold"><?php echo $pd["qty"]; ?> items left</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="check" onchange="changeStatus(<?php echo $pd['id']; ?>);" <?php

                                                                                                                                        if ($pd["status_id"] == 2) {
                                                                                                                                            echo "checked";
                                                                                                                                        }

                                                                                                                                        ?>>

                        <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $pd['id']; ?>">
                            <?php
                            if ($pd["status_id"] == 2) {
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
                                <a href="#" class="btn btn-success d-grid">Update</a>
                            </div>
                            <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                <a href="#" class="btn btn-danger d-grid" onclick="deletemodal(<?php echo $pd['id']; ?>);">Delete</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
        }
    }

    // echo json_encode($array);
} else if (!empty($age)) {
    if ($age == 1) {
        

//////////////////////////////////////////////////////////////////////////////////////////////////////////


$page = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` DESC");

        $pnage = $page->num_rows;

        for ($y = 0; $y < $pnage; $y++) {
            $pdage = $page->fetch_assoc();

            $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pdage["id"] . "'");

            if ($productimg->num_rows == 1) {
                $aimg = $productimg->fetch_assoc();
            }
            ?>
             <div class="card mb-3 col-12 col-lg-6 mt-3">
                <div class="row g-0">
                    <div class="col-md-4 mt-4">
                        <img src="<?php echo  $aimg["code"]; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $pdage["title"]; ?></h5>
                            <span class="card-text text-primary fw-bold">Rs. <?php echo $pdage["price"]; ?>.00</span>
                            <br />
                            <span class="card-text text-success fw-bold"><?php echo $pdage["qty"]; ?> items left</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check" onchange="changeStatus(<?php echo $pdage['id']; ?>);" <?php 

                                                                                                                                                    if ($pdage["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }

                                                                                                                                                    ?>>

                                <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $pdage['id']; ?>">
                                    <?php
                                    if ($pdage["status_id"] == 2) {
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
                                        <a href="#" class="btn btn-success d-grid">Update</a>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                        <a href="#" class="btn btn-danger d-grid" onclick="deletemodal(<?php echo $pdage['id']; ?>);">Delete</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

    } else if ($age != 0) {
        $page = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` ASC");

        $pnage = $page->num_rows;

        for ($y = 0; $y < $pnage; $y++) {
            $pdage = $page->fetch_assoc();

            $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pdage["id"] . "'");

            if ($productimg->num_rows == 1) {
                $aimg = $productimg->fetch_assoc();
            }
            ?>
            <div class="card mb-3 col-12 col-lg-6 mt-3">
                <div class="row g-0">
                    <div class="col-md-4 mt-4">
                        <img src="<?php echo  $aimg["code"]; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $pdage["title"]; ?></h5>
                            <span class="card-text text-primary fw-bold">Rs. <?php echo $pdage["price"]; ?>.00</span>
                            <br />
                            <span class="card-text text-success fw-bold"><?php echo $pdage["qty"]; ?> items left</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check" onchange="changeStatus(<?php echo $pdage['id']; ?>);" <?php

                                                                                                                                                    if ($pdage["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }

                                                                                                                                                    ?>>

                                <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $pdage['id']; ?>">
                                    <?php
                                    if ($pdage["status_id"] == 2) {
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
                                        <a href="#" class="btn btn-success d-grid">Update</a>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                        <a href="#" class="btn btn-danger d-grid" onclick="deletemodal(<?php echo $pdage['id']; ?>);">Delete</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
} else if (!empty($qty)) {

    if ($qty == 1) {

        $pqty = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` ASC");

        $pnqty = $pqty->num_rows;

        for ($y = 0; $y < $pnqty; $y++) {
            $pdqty = $pqty->fetch_assoc();

            $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pdqty["id"] . "'");

            if ($productimg->num_rows == 1) {
                $qimg = $productimg->fetch_assoc();
            }
        ?>
            <div class="card mb-3 col-12 col-lg-6 mt-3">
                <div class="row g-0">
                    <div class="col-md-4 mt-4">
                        <img src="<?php echo  $qimg["code"]; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $pdqty["title"]; ?></h5>
                            <span class="card-text text-primary fw-bold">Rs. <?php echo $pdqty["price"]; ?>.00</span>
                            <br />
                            <span class="card-text text-success fw-bold"><?php echo $pdqty["qty"]; ?> items left</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check" onchange="changeStatus(<?php echo $pdqty['id']; ?>);" <?php

                                                                                                                                                    if ($pdqty["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }

                                                                                                                                                    ?>>

                                <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $pdqty['id']; ?>">
                                    <?php
                                    if ($pdqty["status_id"] == 2) {
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
                                        <a href="#" class="btn btn-success d-grid">Update</a>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                        <a href="#" class="btn btn-danger d-grid" onclick="deletemodal(<?php echo $pdqty['id']; ?>);">Delete</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }else if($qty!=0){
        $pqty = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` DESC");

        $pnqty = $pqty->num_rows;

        for ($y = 0; $y < $pnqty; $y++) {
            $pdqty = $pqty->fetch_assoc();

            $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pdqty["id"] . "'");

            if ($productimg->num_rows == 1) {
                $qimg = $productimg->fetch_assoc();
            }
        ?>
            <div class="card mb-3 col-12 col-lg-6 mt-3">
                <div class="row g-0">
                    <div class="col-md-4 mt-4">
                        <img src="<?php echo  $qimg["code"]; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $pdqty["title"]; ?></h5>
                            <span class="card-text text-primary fw-bold">Rs. <?php echo $pdqty["price"]; ?>.00</span>
                            <br />
                            <span class="card-text text-success fw-bold"><?php echo $pdqty["qty"]; ?> items left</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check" onchange="changeStatus(<?php echo $pdqty['id']; ?>);" <?php

                                                                                                                                                    if ($pdqty["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }

                                                                                                                                                    ?>>

                                <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $pdqty['id']; ?>">
                                    <?php
                                    if ($pdqty["status_id"] == 2) {
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
                                        <a href="#" class="btn btn-success d-grid">Update</a>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                        <a href="#" class="btn btn-danger d-grid" onclick="deletemodal(<?php echo $pdqty['id']; ?>);">Delete</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }
}else if(!empty($condition)){

    if ($condition == 1) {

        $pqty = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='".$condition."'");

        $pnqty = $pqty->num_rows;

        for ($y = 0; $y < $pnqty; $y++) {
            $pdqty = $pqty->fetch_assoc();

            $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pdqty["id"] . "'");

            if ($productimg->num_rows == 1) {
                $qimg = $productimg->fetch_assoc();
            }
        ?>
            <div class="card mb-3 col-12 col-lg-6 mt-3">
                <div class="row g-0">
                    <div class="col-md-4 mt-4">
                        <img src="<?php echo  $qimg["code"]; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $pdqty["title"]; ?></h5>
                            <span class="card-text text-primary fw-bold">Rs. <?php echo $pdqty["price"]; ?>.00</span>
                            <br />
                            <span class="card-text text-success fw-bold"><?php echo $pdqty["qty"]; ?> items left</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check" onchange="changeStatus(<?php echo $pdqty['id']; ?>);" <?php

                                                                                                                                                    if ($pdqty["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }

                                                                                                                                                    ?>>

                                <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $pdqty['id']; ?>">
                                    <?php
                                    if ($pdqty["status_id"] == 2) {
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
                                        <a href="#" class="btn btn-success d-grid">Update</a>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                        <a href="#" class="btn btn-danger d-grid" onclick="deletemodal(<?php echo $pdqty['id']; ?>);">Delete</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }else if($condition==2){
        $pqty = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='".$condition."'");

        $pnqty = $pqty->num_rows;

        for ($y = 0; $y < $pnqty; $y++) {
            $pdqty = $pqty->fetch_assoc();

            $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pdqty["id"] . "'");

            if ($productimg->num_rows == 1) {
                $qimg = $productimg->fetch_assoc();
            }
        ?>
            <div class="card mb-3 col-12 col-lg-6 mt-3">
                <div class="row g-0">
                    <div class="col-md-4 mt-4">
                        <img src="<?php echo  $qimg["code"]; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $pdqty["title"]; ?></h5>
                            <span class="card-text text-primary fw-bold">Rs. <?php echo $pdqty["price"]; ?>.00</span>
                            <br />
                            <span class="card-text text-success fw-bold"><?php echo $pdqty["qty"]; ?> items left</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check" onchange="changeStatus(<?php echo $pdqty['id']; ?>);" <?php

                                                                                                                                                    if ($pdqty["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }

                                                                                                                                                    ?>>

                                <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $pdqty['id']; ?>">
                                    <?php
                                    if ($pdqty["status_id"] == 2) {
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
                                        <a href="#" class="btn btn-success d-grid">Update</a>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                        <a href="#" class="btn btn-danger d-grid" onclick="deletemodal(<?php echo $pdqty['id']; ?>);">Delete</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }

}

?>