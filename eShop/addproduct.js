function changeImg() {
    var image = document.getElementById("imguploader");
    var view = document.getElementById("prev");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}

function changeProductView() {
    var update = document.getElementById("updateProductBox");
    var add = document.getElementById("addProductBox");

    add.classList.toggle("d-none");
    update.classList.toggle("d-none");
}

function addProduct() {
    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");
    var condition;

    if (document.getElementById("bn").checked) {
        condition = "1";
    } else if (document.getElementById("us").checked) {
        condition = "2";
    }

    var colour;

    if (document.getElementById("clr1").checked) {
        colour = "1";
    } else if (document.getElementById("clr2").checked) {
        colour = "2";
    } else if (document.getElementById("clr3").checked) {
        colour = "3";
    } else if (document.getElementById("clr4").checked) {
        colour = "4";
    } else if (document.getElementById("clr5").checked) {
        colour = "5";
    } else if (document.getElementById("clr6").checked) {
        colour = "6";
    }

    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imguploader");

    // alert(category.value);
    // alert(brand.value);
    // alert(model.value);
    // alert(title.value);
    // alert(condition);
    // alert(colour);
    // alert(qty.value);
    // alert(price.value);
    // alert(delivery_within_colombo.value);
    // alert(delivery_outof_colombo.value);
    // alert(description.value);
    // alert(image.value);

    var form = new FormData();

    form.append("c", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("co", condition);
    form.append("col", colour);
    form.append("qty", qty.value);
    form.append("p", price.value);
    form.append("dwc", delivery_within_colombo.value);
    form.append("doc", delivery_outof_colombo.value);
    form.append("desc", description.value);
    form.append("img", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var text = r.responseText;
            if (text == "1") {
                window.location = "addproduct.php";
            } else {
                alert(text);
            }

        }
    };

    r.open("POST", "addProductProcess.php", true);
    r.send(form);

}

function goToUpdate() {
    alert("To Update a product Please access 'My Products' section from home page");
    window.location = "home.php";
}