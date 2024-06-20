function signOut() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location = "home.php";
            }

        }

    };

    r.open("GET", "signoutprocess.php", true);
    r.send();
}

// function basicsearch() {

//     var txt = document.getElementById("basicsearchtxt").value;
//     var select = document.getElementById("basicsearchselect").value;
//     document.getElementById("pdiv").className = "d-none";
//     // document.getElementById("pcat").className="d-none";

//     var r = new XMLHttpRequest();

//     r.onreadystatechange = function() {

//         if (r.readyState == 4) {
//             var t = r.responseText;
//             var ar = JSON.parse(t);



//             // var pdetails = document.getElementById("pdetails");

//             var divrow = document.createElement("div");
//             divrow.className = "row";

//             for (var i = 0; i < ar.length; i++) {
//                 // var divrowcol = document.createElement("div");
//                 // divrowcol.className = "col-12";
//                 // var divrow = document.createElement("div");
//                 // divrow.className = "row";
//                 var div = document.createElement("div");
//                 div.className = "card col-6 col-lg-2  mt-1 mb-1";
//                 div.style.width = "14rem";
//                 var img = document.createElement("img");
//                 img.className = "card-img-top cardTopImg";
//                 img.src = "resources/products/" + ar[i]["img"];
//                 var div1 = document.createElement("div");
//                 div1.className = "card-body";
//                 var h5 = document.createElement("h5");
//                 h5.className = "card-title";
//                 h5.innerHTML = ar[i]["title"];
//                 var span1 = document.createElement("span");
//                 span1.innerHTML = "New";
//                 var span2 = document.createElement("span");
//                 span2.className = "card-text text-primary";
//                 span2.innerHTML = ar[i]["price"];
//                 var br = document.createElement("br");
//                 var span3 = document.createElement("span");
//                 span3.className = "card-text text-warning";
//                 span3.innerHTML = "In Stock";
//                 var input = document.createElement("input");
//                 input.type = "number";
//                 input.value = ar[i]["qty"];
//                 input.className = "form-control mb-1";
//                 var a1 = document.createElement("a");
//                 a1.className = "btn btn-success d-grid";
//                 a1.innerHTML = "Buy Now"
//                 var a2 = document.createElement("a");
//                 a2.className = "btn btn-danger d-grid";
//                 a2.innerHTML = "Add To Cart";

//                 // divrowcol.appendChild(divrow);
//                 // divrow.appendChild(div);
//                 div.appendChild(div1);
//                 div1.appendChild(img);
//                 div1.appendChild(h5);
//                 h5.appendChild(span1);
//                 div1.appendChild(span2);
//                 div1.appendChild(br);
//                 div1.appendChild(span3);
//                 div1.appendChild(input);
//                 div1.appendChild(a1);
//                 div1.appendChild(a2);



//                 // document.getElementById("pdetails").appendChild(div);
//                 divrow.appendChild(div);

//             }

//             document.getElementById("pdetails").appendChild(divrow);

//         }

//     };

//     r.open("GET", "basicsearchprocess.php?txt=" + txt + "&select=" + select, true);
//     r.send();
// }

function basicsearch(pg) {

    var txt = document.getElementById("basicsearchtxt").value;
    var select = document.getElementById("basicsearchselect").value;
    var div = document.getElementById("pdiv");
    var divnone = document.getElementById("pdetails");

    if (pg == null) {
        pg = 1;
    }


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;

            div.innerHTML = t;
            div.className = "border border-primary rounded mt-3 mb-3";
            divnone.className = "d-none";
        }

    };

    r.open("POST", "basicsearchprocess.php", true);
    r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    r.send("txt=" + txt + "&select=" + select + "&pg=" + pg);
}

function addToWatchlist(id) {
    var pid = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "successfully added") {
                window.location = "watchlist.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "addtowatchlistprocess.php?id=" + pid, true);
    r.send();
}

function addToCart(id) {
    var qtytxt = document.getElementById("qtytxt" + id).value;
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