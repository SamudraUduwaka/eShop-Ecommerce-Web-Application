function changeStatus(id) {
    var productid = id;
    var statuscheck = document.getElementById("check");
    var statuslabel = document.getElementById("checklabel" + id);

    // var status;

    // if (statuscheck.checked) {
    //     status = 1;
    // } else {
    //     status = 0;
    // }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactive") {
                statuslabel.innerHTML = "Make Your Product Active";
            } else if (t == "active") {
                statuslabel.innerHTML = "Make Your Product Deactive";
            }
        }
    };

    r.open("GET", "statuschangeProcess.php?id=" + productid, true);
    r.send();
}

function deletemodal(id) {

    var dm = document.getElementById("deleteModal" + id);
    k = new bootstrap.Modal(dm);
    k.show();

}

function deleteproduct(x) {
    var productid = x;
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var t = request.responseText;
            if (t == "Success") {
                k.hide();
                window.location = "sellerproductview.php";
            }
        }
    };

    request.open("GET", "deleteproductprocess.php?id=" + productid, true);
    request.send();
}

function addFilters() {

    var search = document.getElementById("s");

    var age;
    if (document.getElementById("n").checked) {

        age = 1;

    } else if (document.getElementById("o").checked) {

        age = 2;

    } else {

        age = 0;

    }

    var qty;

    if (document.getElementById("l").checked) {

        qty = 1;

    } else if (document.getElementById("h").checked) {

        qty = 2;

    } else {

        qty = 0;

    }

    var condition;

    if (document.getElementById("b").checked) {

        condition = 1;

    } else if (document.getElementById("u").checked) {

        condition = 2;

    } else {

        condition = 0;

    }

    var f = new FormData();

    f.append("s", search.value);
    f.append("a", age);
    f.append("q", qty);
    f.append("c", condition);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            // var arr = JSON.parse(t);

            // for (var i = 0; i < arr.length; i++) {
            //     var row = arr[i];
            //     alert(row["title"]);
            //     alert(array["img"]);


            // }
            var mainbox = document.getElementById("mainbox");
            mainbox.innerHTML = t;
        }

    };

    r.open("POST", "filterProcess.php", true);
    r.send(f);


}

//send id to update//

function sendid(id) {
    var id = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "updateProduct.php";
            }
        }
    };

    r.open("GET", "sendproductprocess.php?id=" + id, true);
    r.send();


}