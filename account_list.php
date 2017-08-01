<?php
    require("includes/db.php");
    // require("getAccounts.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <?php
            require ("header.php");
        ?>
        <script src="refreshAccountList.js" charset="utf-8"></script>
    </head>
    <body>
        <?php require("includes/navbar.php"); ?>

        <div class="container-fluid" id="account_list_data">
            <!-- <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    <?php //getAccounts(); ?>


                </table>
            </div> -->
            <script type="text/javascript">
                refreshAccountList();
            </script>
        </div>

        <?php include("account_form_modal.php"); ?>

        <script type="text/javascript">
            function openAccountInsert(){
                action = "insert";
                $('#account_form').modal('show');
                document.getElementById("first_name").removeAttribute("disabled");
                document.getElementById("last_name").removeAttribute("disabled");
                document.getElementById("email").removeAttribute("disabled");

                document.getElementById("first_name").value="";
                document.getElementById("last_name").value="";
                document.getElementById("email").value="";
                document.getElementById("action").value="insert";


            }

            function processSubmitClick() {
                console.log("PROCESS CLICK");
                console.log(action);
                // var actionField = document.getElementById("action").value;
                // if (actionField) {
                //     var action = actionField;
                // }

                if (action == "insert") {
                    insertAccount();
                }

                if (action == "update") {
                    console.log("ACTION UPDATE");
                    updateAccount();
                }

                if (action == "delete") {
                    console.log("DELETING");
                    deleteAccount();
                }

                if (action == "view") {
                    viewAccount();
                }
            }

            function insertAccount(){

                var request = new XMLHttpRequest();
                var url = "account_process.php";
                var first_name = document.getElementById("first_name").value;
                var last_name = document.getElementById("last_name").value;
                var email = document.getElementById("email").value;

                var vars = "first_name=" + first_name + "&last_name=" + last_name + "&email=" + email + "&action=insert";

                request.open("POST", url, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        var return_data = request.responseText;
                        refreshAccountList();
                    }
                }
                request.send(vars);
                $('#account_form').modal('hide');

            }

            function getAccount(accountId) {

                var request = new XMLHttpRequest();
                var url = "account_process.php";
                var vars = "account_id=" + accountId + "&action=update";

                request.open("POST", url, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        var returnData = JSON.parse(request.responseText);
                        var first_name = returnData.first_name;
                        var last_name = returnData.last_name;
                        var email = returnData.email;

                        $('#account_form').modal('show');
                        document.getElementById("first_name").value = first_name;
                        document.getElementById("last_name").value = last_name;
                        document.getElementById("email").value = email;
                        document.getElementById("account_id").value = accountId;
                        document.getElementById("action").value = "update";

                        document.getElementById("first_name").removeAttribute("disabled");
                        document.getElementById("last_name").removeAttribute("disabled");
                        document.getElementById("email").removeAttribute("disabled");
                        // refreshAccountList();
                    }
                }
                request.send(vars);
            }

            function updateAccount(accountId){
                console.log("UPDATING ACCOUNT INFO ", accountId);

            }

            function viewAccount(){
                console.log("CODE THAT RETRIEVES THE SELECTED RECORD");

                                // JUST IN CASE I DON"T REMEMBER THE CODE FOR VIEW
                                // var request = new XMLHttpRequest();
                                // var url = "account_process.php";
                                // var vars = "account_id=" + accountId + "&action=update";
                                //
                                // request.open("POST", url, true);
                                // request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                // request.onreadystatechange = function() {
                                //     if (request.readyState == 4 && request.status == 200) {
                                //         var returnData = JSON.parse(request.responseText);
                                //         console.log(returnData);
                                //         var first_name = returnData.first_name;
                                //         var last_name = returnData.last_name;
                                //         var email = returnData.email;
                                //         console.log(first_name, last_name, email);
                                //
                                //         $('#account_form').modal('show');
                                //         document.getElementById("first_name").value = first_name;
                                //         document.getElementById("last_name").value = last_name;
                                //         document.getElementById("email").value = email;
            }

            function deleteAccount(accountId) {
                var request = new XMLHttpRequest();
                var url = "account_process.php";
                var vars = "account_id=" + accountId + "&action=delete";

                request.open("POST", url, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        var returnData = request.responseText;
                        refreshAccountList();
                        document.getElementById("action").value = "";
                    }
                }
                request.send(vars);
            }

            document.getElementById("submit").addEventListener("click", processSubmitClick);

        </script>

    </body>
</html>
