<?php

require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>
    <title>eShop | User Profile</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="userprofile.css" />
    <link rel="stylesheet" href="font&hr.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="bg-primary">

    <?php

    session_start();

    if (isset($_SESSION["u"])) {
        $name = $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"];
    ?>

        <div class="container-fluid bg-white rounded mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-end">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <?php

                        $profileimg = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                        $pn = $profileimg->num_rows;

                        if ($pn == 1) {
                            $p = $profileimg->fetch_assoc();
                        ?>
                            <img class="rounded mt-5" width="150px" src="<?php echo $p["code"]; ?>" />
                        <?php
                        } else {
                        ?>
                            <img class="rounded mt-5" width="150px" src="resources/demoProfileImg.jpg" />
                        <?php
                        }

                        ?>
                        <span class="font-weight-bold"><?php echo $name; ?></span>
                        <span class="text-black-50"><?php echo $_SESSION["u"]["email"]; ?></span>
                        <input class="d-none" type="file" id="profileimg" accept="image/" />
                        <label for="profileimg" class="btn btn-primary">Update Profile Image</label>
                    </div>
                </div>
                <div class="col-md-5 border-end">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="first name" id="fname" value="<?php echo $_SESSION["u"]["fname"]; ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Surname</label>
                                <input type="text" class="form-control" placeholder="last name" id="lname" value="<?php echo $_SESSION["u"]["lname"]; ?>" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mobile number</label>
                                <input type="text" class="form-control" placeholder="Enter phone number" id="mobile" value="<?php echo $_SESSION["u"]["mobile"]; ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Enter Password" readonly value="<?php echo $_SESSION["u"]["password"]; ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" placeholder="Enter email id" id="email" readonly value="<?php echo $_SESSION["u"]["email"]; ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Registered Date</label>
                                <input type="text" class="form-control" placeholder="Enter Registered date" readonly value="<?php echo $_SESSION["u"]["register_date"]; ?>" />
                            </div>

                            <?php

                            $useremail = $_SESSION["u"]["email"];

                            $resultset = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $useremail . "'");
                            $naddress = $resultset->num_rows;

                            if ($naddress == 1) {
                                $address = $resultset->fetch_assoc();

                            ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input type="text" class="form-control" placeholder="Enter address line 01" id="line1" value="<?php echo $address["line1"]; ?>" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input type="text" class="form-control" placeholder="Enter address line 02" id="line2" value="<?php echo $address["line2"]; ?>" />
                                </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label">Province</label>
                                <?php

                                $location = $address["location_id"];
                                $locations = Database::search("SELECT * FROM `location` WHERE `id`= '" . $location . "'");
                                $locate = $locations->fetch_assoc();
                                $provincess = $locate["province_id"];
                                $provinceof = Database::search("SELECT * FROM `province` WHERE `id`='" . $provincess . "'");
                                $pprovinceof = $provinceof->fetch_assoc();

                                ?>
                                <!-- <Select class="form-select disabled">
                                    <option value="<?php echo $pprovinceof["id"]; ?>"><?php echo $pprovinceof["name"]; ?></option> -->
                                    <?php
                                    $provinces = Database::search("SELECT * FROM `province` WHERE `id`='" . $pprovinceof["id"] . "'");
                                    $nprovince = $provinces->num_rows;

                                    // for ($y = 0; $y < $nprovince; $y++) {
                                        $province = $provinces->fetch_assoc();
                                    ?>
                                        <input type="text" class="form-control" value="<?php echo $province["name"]; ?>" readonly />
                                        <!-- <option value="<?php echo $province["id"] ?>"><?php echo $province["name"]; ?></option> -->
                                    <?php
                                    // }

                                    ?>

                                <!-- </Select> -->
                            </div>


                            <div class="col-md-6">
                                <label class="form-label">District</label>

                                <?php

                                $districtss = $locate["district_id"];
                                $districtof = Database::search("SELECT * FROM `district` WHERE `id`='" . $districtss . "'");
                                $ddistrictof = $districtof->fetch_assoc();

                                ?>

                                <!-- <Select class="form-select disabled"> -->
                                    <!-- <option value="<?php echo $ddistrictof["id"]; ?>"><?php echo $ddistrictof["name"]; ?></option> -->
                                    <?php

                                    $districts = Database::search("SELECT * FROM `district` WHERE `id`='" . $ddistrictof['id'] . "'");
                                    $ndistrict = $provinces->num_rows;
                                    // for ($z = 0; $z < $ndistrict; $z++) {
                                        $district = $districts->fetch_assoc();
                                    ?>
                                        <!-- <option value="<?php echo $district["id"] ?>"><?php echo $district["name"]; ?></option> -->
                                        <input type="text" class="form-control" value="<?php echo $district["name"]; ?>" readonly />
                                    <?php
                                    // }

                                    ?>
                                <!-- </Select> -->
                            </div>
                        </div>
                        <span class="text-black-50 fs-6">Please note that by updating city, the province and district may update automatically</span>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label">City</label>

                                <?php

                                $location = $address["location_id"];
                                $locations = Database::search("SELECT * FROM `location` WHERE `id`= '" . $location . "'");

                                $nlocation = $locations->num_rows;
                                if ($nlocation == 1) {
                                    $locate = $locations->fetch_assoc();
                                    $cities = $locate["city_id"];
                                    $citygot = Database::search("SELECT * FROM `city` WHERE `id`='" . $cities . "'");
                                    $ncity = $citygot->num_rows;
                                    if ($ncity == 1) {
                                        $city = $citygot->fetch_assoc();
                                        $cityof = $city["name"];
                                ?>
                                        <select class="form-select" id="city">
                                            <option selected value="<?php echo $city["id"];?>"><?php echo $cityof; ?></option>
                                            <?php

                                            $cityr = Database::search("SELECT * FROM `city` WHERE `name`!='" . $cityof . "'");
                                            $cityn = $cityr->num_rows;

                                            for ($i = 0; $i < $cityn; $i++) {
                                                $ccbb = $cityr->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $ccbb['id']; ?>"><?php echo $ccbb["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>

                                        <!-- <input type="text" class="form-control" placeholder="Enter your city" id="city" value="<?php echo $city["name"]; ?>" /> -->
                                <?php
                                    }
                                }

                                ?>
                            </div>

                        <?php
                            } else {
                        ?>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address Line 01</label>
                                <input type="text" class="form-control" placeholder="Enter address line 01" id="line1" value="" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address Line 02</label>
                                <input type="text" class="form-control" placeholder="Enter address line 02" id="line2" value="" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label">Province</label>
                                <!-- <Select class="form-select disabled">
                                    <?php

                                    // $provinces = Database::search("SELECT * FROM `province`");
                                    // $nprovince = $provinces->num_rows;
                                    // for ($y = 0; $y < $nprovince; $y++) {
                                    //     $province = $provinces->fetch_assoc();
                                    // ?>
                                    //     <option><?php echo $province["name"]; ?></option>
                                    // <?php
                                    // }

                                    ?>

                                </Select> -->
                                <input type="text" placeholder="Province" class="form-control" readonly/>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label">District</label>
                                <!-- <Select class="form-select disabled"> --> 
                                    <!-- <?php

                                    // $districts = Database::search("SELECT * FROM `district`");
                                    // $ndistrict = $provinces->num_rows;
                                    // for ($z = 0; $z < $ndistrict; $z++) {
                                        // $district = $districts->fetch_assoc(); -->
                                    ?>
                                         <option><?php echo $district["name"]; ?></option> -->
                                        
                                    <!-- <?php
                                    // } -->

                                    ?>
                                 </Select> -->
                                <input type="text" value="District" class="form-control" readonly />
                            </div>
                        </div>
                        <span class="text-black-50 fs-6">Please note that by updating city, the province and district may update automatically</span>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <select class="form-select" id="city">
                                    <option value="0">Select Your City</option>
                                    <?php

                                    $cityr = Database::search("SELECT * FROM `city`");
                                    $citynr = $cityr->num_rows;

                                    for ($i = 0; $i < $citynr; $i++) {
                                        $ccbbr = $cityr->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $ccbbr["id"]; ?>"><?php echo $ccbbr["name"]; ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        

                        <?php
                            }
                        ?>

                        <div class="col-md-6">
                            <label class="form-label">Gender</label>

                            <?php

                            $genderid = $_SESSION["u"]["gender_id"];
                            $ugender = Database::search("SELECT * FROM `gender` WHERE `id`='" . $genderid . "'");
                            $g = $ugender->fetch_assoc();

                            ?>
                            <input type="text" class="form-control" placeholder="Gender" value="<?php echo $g['name']; ?>" readonly />
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                        </div>
                        </div>
                    </div>
                </div>


            <?php
        } else {
            ?>
                <script>
                    window.location = "index.php";
                </script>
            <?php
        }

            ?>

            <div class="col-md-4">
                <div class="row p-3 py-5">
                    <div class="col-md-12">
                        <span class="fw-bold">User Rating</span>
                        <span class="fa fa-star fs-5 text-warning"></span>
                        <span class="fa fa-star fs-5 text-warning"></span>
                        <span class="fa fa-star fs-5 text-warning"></span>
                        <span class="fa fa-star fs-5 text-warning"></span>
                        <span class="fa fa-star fs-5 text-black-50"></span>
                        <p>4.1 average based on 254 reviews</p>
                    </div>
                    <div class="col-md-12">
                        <hr class="hrbreak1" />
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="mt-5">
                                <div>5 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="text-end">150</div>
                            </div>

                            <div class="mt-1 side">
                                <div>4 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="text-end">63</div>
                            </div>

                            <div class="mt-1 side">
                                <div>3 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="text-end">15</div>
                            </div>

                            <div class="mt-1 side">
                                <div>2 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="text-end">6</div>
                            </div>

                            <div class="mt-1 side">
                                <div>1 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="text-end">20</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <?php

        require "footer.php";

        ?>



        <script src="userprofile.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>

</html>