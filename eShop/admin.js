function dailysellings() {
    var from = document.getElementById("fromdate").value;
    var to = document.getElementById("todate").value;
    var link = document.getElementById("historylink");

    link.href = "ProductSellingHistory.php?f=" + from + "&t=" + to;


}






































// var r = new XMLHttpRequest();

// r.onreadystatechange = function() {
//     if (r.readyState == 4) {
//         var t = r.responseText;

//         if (t == "success") {
//             window.location = "ProductSellingHistory.php";
//         }
//     }
// };
// r.open("GET", "dailySellingsProcess.php?f=" + from + "&t=" + to, true);
// r.send();