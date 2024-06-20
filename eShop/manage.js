function blockuser(email) {
    var mail = email;

    var blockbtn = document.getElementById("blockbtn" + mail);

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";
            } else if (t == "2") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";
            }
        }
    };

    r.open("POST", "manageuserblockprocess.php", true);
    r.send(f);
}

function searchUser() {
    var text = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "manageusers.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "managesearchuserprocess.php?s=" + text, true);
    r.send();
}

function blockproduct(id) {
    var id = id;

    var blockbtn = document.getElementById("blockbtn" + id);

    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";
            } else if (t == "2") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";
            }
        }
    };

    r.open("POST", "manageproductblockprocess.php", true);
    r.send(f);
}

function searchproduct() {
    var text = document.getElementById("searchptxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "manageproducts.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "managesearchproductprocess.php?s=" + text, true);
    r.send();
}

function searchAllusers() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "manageusers.php";
            }
        }
    };

    r.open("GET", "manageAlluprocess.php", true);
    r.send();
}

function searchAllproducts() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "manageproducts.php";
            }
        }
    };

    r.open("GET", "manageAllpprocess.php", true);
    r.send();
}

function viewmsgmodal(email) {
    var pop = document.getElementById("msgmodal" + email);

    k = new bootstrap.Modal(pop);
    k.show();

    refresher(email);

}

function addnewmodal() {
    var popa = document.getElementById("addnewmodal");

    a = new bootstrap.Modal(popa);
    a.show();
}

function savecategory() {
    var txt = document.getElementById("categorytxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Successfully added") {
                a.hide();
                alert(t);
                window.location = "manageproducts.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "addnewCategoryProcess.php?t=" + txt, true);
    r.send();
}

function singleviewmodal(id) {
    var popa1 = document.getElementById("singleproductview" + id);

    b = new bootstrap.Modal(popa1);
    b.show();
}



////////////////////////////////////////


// sendmessage

function sendmessage(mail) {

    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                msgtxt = "Type a message...";
                refresher(email);

            } else {
                alert("t");
            }
        }
    }

    r.open("POST", "sendmessageprocess.php", true);
    r.send(f);

}

// refresher

function refresher(email) {

    setInterval(refreshmsgare(email), 200);
    setInterval(refreshrecentarea(), 200);
}

// refres msg view area

function refreshmsgare(mail) {

    var chatrow = document.getElementById("chatrow");

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            chatrow.innerHTML = t;

        }
    }

    r.open("POST", "refreshmsgareaprocess.php", true);
    r.send(f);

}

// refreshrecentarea

function refreshrecentarea() {

    var rcv = document.getElementById("rcv");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;
        }
    }

    r.open("POST", "refreshrecentareaprocess.php", true);
    r.send();

}



// manageusers

function sendmessagema(mail) {

    var email = mail;
    var msgtxt = document.getElementById("msgtxt" + email).value;

    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                msgtxt = "Type a message...";
                refresher(email);

            } else {
                alert("t");
            }
        }
    }

    r.open("POST", "sendmessageprocess.php", true);
    r.send(f);

}