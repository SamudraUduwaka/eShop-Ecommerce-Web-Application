function deletefromwatchlist(id) {

    var wid = id;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var t = request.responseText;
            if (t == "success") {
                window.location = "watchlist.php";
            }
        }
    };

    request.open("GET", "removewatchlistitmprocess.php?id=" + wid, true);
    request.send();

}