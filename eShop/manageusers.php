<?php

session_start();

require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>
    <title>eShop | Admin | Manage Users</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="font&hr.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 text-primary fw-bold">Manage All Users</label>
            </div>

            <div class="col-12 bg-light rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-10 col-lg-6">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" id="searchtxt" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-primary" onclick="searchUser();">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="offset-0 offset-lg-2 col-2 col-lg-1">
                        <div class="row d-grid">
                            <button onclick="searchAllusers();" class="btn btn-warning">All Users</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>
                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Email</span>
                    </div>
                    <div class="col-5 col-lg-2 bg-light pt-2 pb-2">
                        <span class="fs-4 fw-bold">User Name</span>
                    </div>

                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 bg-white pt-2 pb-2">

                    </div>
                </div>
            </div>

            <?php
            if (isset($_SESSION["k"])) {
                $u = $_SESSION["k"];
            ?>
                <div class="col-12 mt-3 mb-2">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                            <span class="fw-bold text-white fs-5">1</span>
                        </div>
                        <div class="col-2 bg-light d-none d-lg-block">
                            <?php

                            $imgrs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $u["email"] . "'");
                            $nimg = $imgrs->num_rows;

                            if ($nimg == 1) {
                                $img = $imgrs->fetch_assoc();

                            ?>
                                <img src="<?php echo $img["code"]; ?>" style="height: 70px; margin-left: 70px;" />
                            <?php
                            } else {
                            ?>
                                <img src="resources/demoProfileImg.jpg" style="height: 70px; margin-left: 70px;" />
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                            <span class="fw-bold text-white fs-5"><?php echo $u["email"]; ?></span>
                        </div>
                        <div class="col-5 col-lg-2 bg-light pt-2 pb-2">
                            <span class="fw-bold fs-5"><?php echo $u["fname"] . " " . $u["lname"]; ?></span>
                        </div>

                        <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                            <span class="fw-bold text-white fs-5"><?php echo $u["mobile"]; ?></span>
                        </div>
                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                            <span class="fw-bold fs-5"><?php $rd = $u["register_date"];
                                                        $splitrd = explode(" ", $rd);
                                                        echo $splitrd[0];
                                                        ?></span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white pt-2 pb-2 d-grid">
                            <?php

                            $s = $u["status_id"];

                            if ($s == "1") {
                            ?>
                                <button class="btn btn-danger" id="blockbtn<?php echo $u["email"]; ?>" onclick="blockuser('<?php echo $u['email']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-success" id="blockbtn<?php echo $u["email"]; ?>" onclick="blockuser('<?php echo $u['email']; ?>');">Unblock</button>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <?php
            } else {


                $userrs = Database::search("SELECT * FROM `user` ");
                $d = $userrs->num_rows;

                $row = $userrs->fetch_assoc();
                $results_per_page = 20;

                $number_of_pages = ceil($d / $results_per_page);

                // echo $nproducts;
                // echo $number_of_pages;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                // $offset = 6 * ($pageno-1);

                $page_first_result = ((int)$pageno - 1) * $results_per_page;

                $selectedrs = Database::search("SELECT * FROM `user` 
                LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");

                $srn = $selectedrs->num_rows;

                $c = "0";

                while ($srow = $selectedrs->fetch_assoc()) {

                    $c = $c + 1;

                ?>
                    <div class="col-12 mt-3 mb-2">
                        <div class="row">
                            <div class="col-10 col-lg-11" onclick="viewmsgmodal('<?php echo $srow['email']; ?>');">
                                <div class="row">
                                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                                        <span class="fw-bold text-white fs-5"><?php echo $c; ?></span>
                                    </div>
                                    <div class="col-2 bg-light d-none d-lg-block">
                                        <?php

                                        $imgrs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $srow["email"] . "'");
                                        $nimg = $imgrs->num_rows;

                                        if ($nimg == 1) {
                                            $img = $imgrs->fetch_assoc();

                                        ?>
                                            <img src="<?php echo $img["code"]; ?>" style="height: 70px; margin-left: 70px;" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="resources/demoProfileImg.jpg" style="height: 70px; margin-left: 70px;" />
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                                        <span class="fw-bold text-white fs-5"><?php echo $srow["email"]; ?></span>
                                    </div>
                                    <div class="col-5 col-lg-2 bg-light pt-2 pb-2">
                                        <span class="fw-bold fs-5"><?php echo $srow["fname"] . " " . $srow["lname"]; ?></span>
                                    </div>

                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2">
                                        <span class="fw-bold text-white fs-5"><?php echo $srow["mobile"]; ?></span>
                                    </div>
                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fw-bold fs-5"><?php $rd = $srow["register_date"];
                                                                    $splitrd = explode(" ", $rd);
                                                                    echo $splitrd[0];
                                                                    ?></span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-2 col-lg-1 bg-white pt-2 pb-2 d-grid">
                                <?php

                                $s = $srow["status_id"];

                                if ($s == "1") {
                                ?>
                                    <button class="btn btn-danger" id="blockbtn<?php echo $srow["email"]; ?>" onclick="blockuser('<?php echo $srow['email']; ?>');">Block</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-success" id="blockbtn<?php echo $srow["email"]; ?>" onclick="blockuser('<?php echo $srow['email']; ?>');">Unblock</button>
                                <?php
                                }

                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="msgmodal<?php echo $srow['email']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" onload="refresher('<?php echo $srow['email']; ?>');">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">My Messages</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- ////////////// -->

                                    <div class="col-12 py-5 px-4">
                                        <div class="row rounded overflow-hidden shadow">
                                            <div class="col-12 px-0">
                                                <div class="bg-white">

                                                    <div class="bg-gray px-4 py-2 bg-light">
                                                        <p class="h5 mb-0 py-1">Recent</p>
                                                    </div>

                                                    <div class="messages-box">
                                                        <div class="list-group rounded-0" id="rcv">



                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <!-- massage box -->
                                            <div class="col-12 px-0">
                                                <div class="row px-4 py-5 chat-box bg-white" id="chatrow">
                                                    <!-- massage load venne methana -->


                                                </div>
                                            </div>

                                            <div class="col-12 offset-lg-5 col-lg-7">
                                                <div class="row bg-white">

                                                    <!-- text -->
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="input-group">
                                                                <input type="text" id="msgtxt<?php echo $srow["email"];?>" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                                                <div class="input-group-append">
                                                                    <button id="button-addon2" class="btn btn-link fs-1" onclick="sendmessagema('<?php echo $srow['email']; ?>');"> <i class="bi bi-cursor-fill"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- text -->

                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <!-- ///////////// -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php

                }
                ?>


                <div class="col-12 d-flex justify-content-center fs-5 fw-bold mt-3 mb-3">
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

                    <?php
                }
                    ?>

                    </div>
                </div>

                <?php require "footer.php"; ?>
        </div>
    </div>
    <script src="manage.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>