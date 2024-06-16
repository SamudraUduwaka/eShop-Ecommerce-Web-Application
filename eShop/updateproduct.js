function changeProductView() {
    var update = document.getElementById("updateProductBox");
    var add = document.getElementById("addProductBox");

    add.classList.toggle("d-none");
    update.classList.toggle("d-none");
}

function changeImg() {
    var image = document.getElementById("uimguploader");
    var view = document.getElementById("uprev");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}


// function searchtoupdate() {
//     var search = document.getElementById("searchtoupdate").value;
//     var title = document.getElementById("uti");
//     var brnadnew = document.getElementById("ubn");
//     var used = document.getElementById("uus");
//     var qty = document.getElementById("uqty");
//     var cat = document.getElementById("uca");
//     var brand = document.getElementById("ubr");
//     var model = document.getElementById("umo");
//     var cost = document.getElementById("ucost");
//     var dwc = document.getElementById("udwc");
//     var doc = document.getElementById("udoc");
//     var desc = document.getElementById("udesc");


//     var request = new XMLHttpRequest();

//     request.onreadystatechange = function() {
//         if (request.readyState == 4) {
//             var text = request.responseText;
//             var object = JSON.parse(text);
//             // alert(object["title"]);

//             cat.innerHTML = object["category"];
//             brand.innerHTML = object["brand"];
//             model.innerHTML = object["model"];

//             title.value = object["title"];
//             if (object["condition"] == "Brandnew") {
//                 if (!brnadnew.checked) {
//                     if (used.checked) {
//                         used.removeAttribute("checked", "");
//                         brnadnew.setAttribute("checked", "");
//                     } else {
//                         brnadnew.setAttribute("checked", "");
//                     }

//                 }

//             } else if (object["condition"] == "Used") {
//                 if (!used.checked) {
//                     if (brnadnew.checked) {
//                         brnadnew.removeAttribute("checked", "");
//                         used.setAttribute("checked", "");
//                     } else {
//                         used.setAttribute("checked", "");
//                     }
//                 }

//             }
//             qty.value = object["qty"];
//             cost.value = object["price"];
//             dwc.value = object["dwc"];
//             doc.value = object["doc"];
//             desc.value = object["desc"];

//         }
//     };

//     request.open("GET", "searchToUpdateProcess.php?id=" + search, true);
//     request.send();
// }

function goToAddProduct() {
    window.location = "addproduct.php";
}

function updateProduct(id) {

    var id = id;

    var title = document.getElementById("uti");
    var qty = document.getElementById("uqty");
    var dwc = document.getElementById("udwc");
    var doc = document.getElementById("udoc");
    var desc = document.getElementById("udesc");
    var image = document.getElementById("uimguploader");


    var f = new FormData();

    f.append("id", id);
    f.append("t", title.value);
    f.append("qty", qty.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);
    f.append("img", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {
                window.location = "singleproductview.php?id=" + id;
            } else {
                alert(text);
            }
        }
    };

    r.open("POST", "updateproductprocess.php", true);
    r.send(f);



}