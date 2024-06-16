function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("city");
    var img = document.getElementById("profileimg");

    var f = new FormData();

    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("m", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("c", city.value);
    f.append("i", img.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
            window.location = "userprofile.php";
        }
    };
    r.open("POST", "updateprofileprocess.php", true);
    r.send(f);

    // alert(fname.value);
    // alert(lname.value);
    // alert(mobile.value);
    // alert(line1.value);
    // alert(line2.value);
    // alert(city.value);
    // alert(img.value);
}