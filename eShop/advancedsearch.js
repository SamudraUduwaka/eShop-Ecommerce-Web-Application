function advancedSearch(pg) {

    var viewResults = document.getElementById("viewResults");

    var keyword = document.getElementById("k").value;
    var category = document.getElementById("c").value;
    var brand = document.getElementById("b").value;
    var model = document.getElementById("m").value;
    var condition = document.getElementById("con").value;
    var color = document.getElementById("clr").value;
    var pricefrom = document.getElementById("pf").value;
    var priceto = document.getElementById("pt").value;

    var psort = document.getElementById("sort").value;

    if (pg == null) {

        pg = 1;

    }

    var f = new FormData();

    f.append("k", keyword);
    f.append("c", category);
    f.append("b", brand);
    f.append("m", model);
    f.append("con", condition);
    f.append("clr", color);
    f.append("pf", pricefrom);
    f.append("pt", priceto);
    f.append("pg", pg);
    f.append("sort", psort);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            viewResults.innerHTML = t;

        }
    };

    r.open("POST", "advancedsearchprocess.php", true);
    r.send(f);

    // alert(keyword);
    // alert(category);
    // alert(brand);
    // alert(model);
    // alert(condition);
    // alert(color);
    // alert(pricefrom);
    // alert(priceto);

}

function p() {
    alert("p");
}


// function advancedSearch(x) {


// var s = document.getElementById("s1").value;
// var ca = document.getElementById("ca1").value;
// var br = document.getElementById("br1").value;
// var mo = document.getElementById("mo1").value;
// var co = document.getElementById("co1").value;
// var col = document.getElementById("col1").value;
// var prif = document.getElementById("prif1").value;
// var prit = document.getElementById("prit2").value;

// var form = new FormData();
// form.append("page", x);
// form.append("s", s);
// form.append("c", ca);
// form.append("b", br);
// form.append("m", mo);
// form.append("co", co);
// form.append("col", col);
// form.append("prif", prif);
// form.append("prit", prit);


// var r = new XMLHttpRequest();
// r.onreadystatechange = function() {
//     if (r.readyState == 4) {
//         var text = r.responseText;
// 
//             document.getElementById("filter").innerHTML = text;
//         }
//     };
//     r.open("POST", "advancedSearchpro.php", true);
//     r.send(form);

// }