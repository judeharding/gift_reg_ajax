function refreshAccountList() {
    var request = new XMLHttpRequest();
    var url = "account_list_data.php";
    // var first_name = document.getElementById("first_name").value;
    // var last_name = document.getElementById("last_name").value;
    // var email = document.getElementById("email").value;

    var vars = "";

    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var returnData = request.responseText;
            document.getElementById("account_list_data").innerHTML = returnData;
            document.getElementById("action").value = "xxx";
        }
    }
    request.send(vars);
}
