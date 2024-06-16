<?php

session_start();
require "connection.php";

$SellerSearchInput = $_POST["SellerSearchInput"];
$page = $_POST["pg"];
$offset = 2*($page-1);

$Active  = $_POST["Active"];
$Quantity = $_POST["Quantity"];
$Condition = $_POST["Condition"];

if(($Active == 0) && ($Quantity == 0) && ($Condition == 0) && ($SellerSearchInput != "")){
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."';");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' LIMIT 2 OFFSET ".$offset.";");

}elseif(($Active != 0) && ($Quantity == 0) && ($Condition == 0) && ($SellerSearchInput == "")){
    if($Active == 1){
        $SetBy = "DESC";
    }else{
        $SetBy = "ASC";
    }
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' ORDER BY `datetime_added` ".$SetBy.";");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' ORDER BY `datetime_added` ".$SetBy." LIMIT 2 OFFSET ".$offset.";");

}elseif(($Active == 0) && ($Quantity != 0) && ($Condition == 0) && ($SellerSearchInput == "")){
    if($Quantity == 1){
        $SetBy = "ASC";
    }else{
        $SetBy = "DESC";
    }
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' ORDER BY `qty` ".$SetBy.";");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' ORDER BY `qty` ".$SetBy." LIMIT 2 OFFSET ".$offset.";");

}elseif(($Active == 0) && ($Quantity == 0) && ($Condition != 0) && ($SellerSearchInput == "")){
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `condition_id` = '".$Condition."'; ");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `condition_id` = '".$Condition."' LIMIT 2 OFFSET ".$offset.";");
    
}elseif(($Active != 0) && ($Quantity == 0) && ($Condition == 0) && ($SellerSearchInput != "")){
    if($Active == 1){
        $SetBy = "DESC";
    }else{
        $SetBy = "ASC";
    }
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' ORDER BY `datetime_added` ".$SetBy.";");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' ORDER BY `datetime_added` ".$SetBy." LIMIT 2 OFFSET ".$offset.";");
  
}elseif(($Active == 0) && ($Quantity != 0) && ($Condition == 0) && ($SellerSearchInput != "")){
    if($Quantity == 1){
        $SetBy = "ASC";
    }else{
        $SetBy = "DESC";
    }
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' ORDER BY `qty` ".$SetBy.";");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' ORDER BY `qty` ".$SetBy." LIMIT 2 OFFSET ".$offset.";");

}elseif(($Active == 0) && ($Quantity == 0) && ($Condition != 0) && ($SellerSearchInput != "")){
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' AND `condition_id` = '".$Condition."';");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' AND `condition_id` = '".$Condition."' LIMIT 2 OFFSET ".$offset.";");

}elseif(($Active != 0) && ($Quantity != 0) && ($Condition == 0) && ($SellerSearchInput == "")){

}elseif(($Active != 0) && ($Quantity == 0) && ($Condition != 0) && ($SellerSearchInput == "")){
    if($Active == 1){
        $SetBy = "DESC";
    }else{
        $SetBy = "ASC";
    }
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `condition_id` = '".$Condition."' ORDER BY `datetime_added` ".$SetBy.";");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `condition_id` = '".$Condition."' ORDER BY `datetime_added` ".$SetBy." LIMIT 2 OFFSET ".$offset.";");

}elseif(($Active == 0) && ($Quantity != 0) && ($Condition != 0) && ($SellerSearchInput == "")){
    if($Quantity == 1){
        $SetBy = "ASC";
    }else{
        $SetBy = "DESC";
    }
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `condition_id` = '".$Condition."' ORDER BY `qty` ".$SetBy.";");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `condition_id` = '".$Condition."' ORDER BY `qty` ".$SetBy." LIMIT 2 OFFSET ".$offset.";");

}elseif(($Active != 0) && ($Quantity != 0) && ($Condition == 0) && ($SellerSearchInput != "")){

}elseif(($Active != 0) && ($Quantity == 0) && ($Condition != 0) && ($SellerSearchInput != "")){
    if($Active == 1){
        $SetBy = "DESC";
    }else{
        $SetBy = "ASC";
    }
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' AND `condition_id` = '".$Condition."' ORDER BY `datetime_added` ".$SetBy.";");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' AND `condition_id` = '".$Condition."' ORDER BY `datetime_added` ".$SetBy." LIMIT 2 OFFSET ".$offset.";");

}elseif(($Active == 0) && ($Quantity != 0) && ($Condition != 0) && ($SellerSearchInput != "")){
    if($Quantity == 1){
        $SetBy = "ASC";
    }else{
        $SetBy = "DESC";
    }
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' AND `condition_id` = '".$Condition."' ORDER BY `qty` ".$SetBy.";");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."' AND `title` LIKE '"."%".$SellerSearchInput."%"."' AND `condition_id` = '".$Condition."' ORDER BY `qty` ".$SetBy." LIMIT 2 OFFSET ".$offset.";");

}elseif(($Active != 0) && ($Quantity != 0) && ($Condition != 0) && ($SellerSearchInput == "")){


}elseif(($Active != 0) && ($Quantity != 0) && ($Condition != 0) && ($SellerSearchInput != "")){

    
}else{
    $AllResultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."';");
    $Resultset = Database::search("SELECT * FROM `product` WHERE `user_email` = '".$_SESSION["user"]['email']."';");
}

$allProductnm = $AllResultset->num_rows;
$DividedNumber = $allProductnm/2 ;
$PageNumbers = intval($DividedNumber);
if($allProductnm%2 != 0){
    $PageNumbers = $PageNumbers+1;
}
if($page > $PageNumbers){
    $page = 1;
}

?>
                <div class="row justify-content-evenly">
                    <?php 
                    for($Value = 0; $Value < 2; $Value++){
                        $dataofproduct = $Resultset->fetch_assoc(); 
                        if($dataofproduct != null){
                            $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='".$dataofproduct["id"]."';");
                            $imgrow = $pimage->fetch_assoc();
                            $Pstatus = Database::search("SELECT * FROM `status` WHERE `id`='".$dataofproduct["status_id"]."';");
                            $Prodstatus = $Pstatus->fetch_assoc();
                                                ?>
                    <div class="col-11 col-md-5-5 bg-white border border-2 mt-3">
                        <div class="card m-3">
                            <div class="row g-0 overflow-hidden">
                                <div class="col-12 col-xl-4 d-flex justify-content-center overflow-hidden">
                                    <img src="<?php echo $imgrow['code']; ?>" class="round-image2 product-img">
                                </div>
                                <div class="col-12 col-xl-8">
                                    <div class="card-body">
                                        <div class="d-flex flex-column g-1 align-items-center">
                                            <h5 class="card-title"><?php echo $dataofproduct["title"]; ?></h5>
                                            <span class="card-text text-primary">Rs: <?php echo $dataofproduct['price']; ?>.00</span>
                                            <span class="card-text text-warning"><?php echo $dataofproduct['qty']; ?> Items Left</span>
                                            <label class="form-label text-center"><b
                                                    class="text-dark">Product Status : </b><span id="StsNow<?php echo $dataofproduct["id"]; ?>" class="text-bold <?php if($Prodstatus['id'] == 1){echo "text-green";}else if($Prodstatus['id'] == 3){echo "text-warning";}else{echo "text-danger";} ?>"><?php echo $Prodstatus['name']; ?></span></label>
                                            <div class="row form-check form-switch">
                                                <input onclick="ChangeStatus('ChangPSts<?php echo $dataofproduct['id']; ?>');" id="ChangPSts<?php echo $dataofproduct["id"]; ?>" class="form-check-input" type="checkbox" role="switch" <?php if($Prodstatus['id'] != 1){echo "checked";}else{}  ?> value="<?php echo $dataofproduct["id"]; ?>">
                                                <label class="form-check-label" for="ChangPSts<?php echo $dataofproduct["id"]; ?>">Change
                                                    Product Status</label>
                                            </div>
                                        </div>
                                        <form action="addproduct.php?Update" method="POST">
                                            <div class="row justify-content-between Prodbtn mt-3 mb-3">
                                                <input type="text" value="<?php echo $dataofproduct["id"]; ?>" class="d-none" name="FromViewid"/>
                                                <div
                                                    class="col-6 col-lg-8 offset-lg-2 col-xl-6 offset-xl-0 my-lg-1 my-xl-0 p-0 d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-success w-90">Update</button>
                                                </div>
                                                <div class="col-6 col-lg-8 offset-lg-2 col-xl-6 offset-xl-0 my-lg-1 my-xl-0 p-0 d-flex justify-content-center">
                                                    <button class="btn btn-danger w-90">Delete</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    }
                    ?>
                </div>
                <?php
                $PgnStart = 1;
                if($PageNumbers > 4){
                    if($page > $PageNumbers-4){
                        $PgnStart = $PageNumbers-4;
                        $backFPage = "on" ;
                    }
                    if($page <= $PageNumbers-4){
                        $PgnStart = $page;
                    }
                    $Pgnlimit = $PgnStart+4;
                }else{
                    $PgnStart = 1;
                    $Pgnlimit = $PageNumbers;
                }
                ?>  
                <div class="row my-3 mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center col-gap">
                            <li class="page-item <?php if($page == 1){echo "disabled";}else{} ?> "><button onclick="SellerSearch('<?php echo $page-1; ?>');" class="page-link">&laquo;</button></li>
                            <?php if((isset($backFPage)) || $page > 2){?><li class="page-item page-item-xs-none"><button class="page-link" onclick="SellerSearch('1');">1</button></li>
                                <li class="page-item <?php if($page != 3){echo "disabled";}else{} ?> page-item-xs-none"><button class="page-link" <?php if($page == 3){ ?> onclick="SellerSearch('2');" <?php }else{}?> > <?php if($page == 3){echo "2";}else{echo "...";} ?></button></li><?php } ?>
                            <?php for($Pgn = $PgnStart; $Pgn <= $Pgnlimit; $Pgn++){ ?>
                            <li class="page-item <?php if($Pgn == $page){echo "active point-none";} ?>"><button onclick="SellerSearch('<?php echo $Pgn; ?>');" class="page-link"><?php echo $Pgn; ?></a></li>
                            <?php } ?>
                            <li class="page-item <?php if($page == $PageNumbers){echo "disabled";}else{} ?>"><button onclick="SellerSearch('<?php echo $page+1; ?>');" class="page-link">&raquo;</button></li>
                        </ul>
                    </nav>
                </div>
