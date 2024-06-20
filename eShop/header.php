<!-- <?php

// session_start();

?> -->

<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="header.css"/>

</head>

<body>
    <div class="col-12">
        <div class="row mt-1 mb-1">
            <div class="offset-lg-1 col-12 col-lg-4 align-self-start">
                <span class="text-start label1"><b>Welcome</b>

                    <?php

                    if (isset($_SESSION["u"])) {
                        $user = $_SESSION["u"]["fname"];
                        echo $user;
                    } else {
                    ?>
                        <a href="index.php">Hi! Sign in or register</a>
                    <?php
                    }

                    ?>

                </span>|

                <?php

                if (isset($_SESSION["u"])) {
                ?>
                    <span class="text-start label2" onclick="signOut();">Sign Out</span>|
                <?php
                }

                ?>

                <span class="text-start label2">Help and Contact</span>

            </div>
            <div class="offset-lg-5 col-12 col-lg-2 align-self-end" style="text-align: center;">
                <div class="row mt-1 mb-1">
                    <div class="col-1 col-md-3 col-lg-2 mt-1">
                        <span class="text-start label2" onclick="goToAddProduct();">Sell</span>
                    </div>
                    <div class="col-2 col-md-5 col-lg-5 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            My eShop
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                            <li><a class="dropdown-item" href="purchasehistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item" href="messages.php">Message</a></li>
                            <li><a class="dropdown-item" href="sellerproductview.php">My Products</a></li>
                            <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="ProductSellingHistory.php">My Sellings</a></li>
                        </ul>
                    </div>
                    <div class="col-1 col-lg-4 col-md-1 mt-1 ms-5 ms-lg-3 carticon">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goToAddProduct() {
            window.location = "addproduct.php"
        }
    </script>
    <script src="home.js"></script>
</body>

</html>