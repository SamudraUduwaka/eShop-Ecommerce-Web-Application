function loadmainimg(id) {

    var id = id;
    var img = document.getElementById("pimg" + id).src;
    var mainimg = document.getElementById("mainimg");

    mainimg.style.backgroundImage = "url(" + img + ")";

}

function qty_inc(qty) {

    var pqty = qty;

    var input = document.getElementById("qtyinput");

    if (input.value < pqty) {

        var newvalue = parseInt(input.value) + 1;

        input.value = newvalue.toString();


    } else {

        alert("Maximum product quantity has been acheived");

    }

}

function qty_dec() {
    var input = document.getElementById("qtyinput");

    if (input.value >= 2) {

        var newvalue = parseInt(input.value) - 1;

        input.value = newvalue.toString();

    } else {
        alert("Minimum quantity count has been achieved");
    }



}

function addToCart(id) {
    var qtytxt = document.getElementById("qtyinput").value;
    var pid = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "cart.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "addToCartProcess.php?id=" + pid + "&qty=" + qtytxt, true);
    r.send();
}