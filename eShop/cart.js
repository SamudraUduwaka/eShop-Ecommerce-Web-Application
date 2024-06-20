function deletefromcart(id) {

    var cid = id;
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

    r.open("GET", "deleteFromCartProcess.php?id=" + cid, true);
    r.send();
}

function detailsmodel(id) {
    alert(id);
}