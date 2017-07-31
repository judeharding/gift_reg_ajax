<?php
    require("includes/db.php");
    require("getAccounts.php");
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
                $('#account_form').on('shown.bs.modal', function (e) {
                    document.getElementById("first_name").value="";
                    document.getElementById("last_name").value="";
                    document.getElementById("email").value="";
                })
            }

            function processSubmitClick() {

                if (action == "insert") {
                    insertAccount();
                }

                if (action == "update") {
                    updateAccount();
                }

                if (action == "delete") {
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

            function updateAccount() {
                console.log("CODE THAT UPDATES THE SELECTED RECORD");
            }

            function viewAccount(){
                console.log("CODE THAT RETRIEVES THE SELECTED RECORD");
            }

            function deleteAccount(accountId) {
                var request = new XMLHttpRequest();
                var url = "account_process.php";
                var vars = "account_id=" + accountId + "&action=delete";
                console.log(vars);

                request.open("POST", url, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        var returnData = request.responseText;
                        console.log(returnData);
                        refreshAccountList();
                    }
                }
                request.send(vars);
            }



            document.getElementById("submit").addEventListener("click", processSubmitClick);

        </script>

    </body>
</html>
