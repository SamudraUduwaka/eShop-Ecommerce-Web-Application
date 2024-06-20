function adminverification() {
    var e = document.getElementById("e").value;

    var r = new XMLHttpRequest();

    var f = new FormData();
    f.append("e", e);

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {

                var verificationModal = document.getElementById("verificationModal");
                k = new bootstrap.Modal(verificationModal);

                k.show();

            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "adminverificationprocess.php", true);
    r.send(f);
}

function verify() {
    var verificationcode = document.getElementById("v").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                k.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "verifyProcess.php?v=" + verificationcode, true);
    r.send();

}