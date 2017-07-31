<?php
    require("includes/db.php");

    function getAccounts(){
        global $mysqli;
        $sql = "SELECT * FROM account";
        $result = mysqli_query($mysqli, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $account_id = $row["account_id"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $email = $row["email"];
            // echo $first_name . "<br>";
            // echo $last_name . "<br>";
            // echo $email . "<br>";
            echo "<tr>";
                echo "<td><a href='account.php?action=view&account_id=$account_id'>$first_name</a></td>";
                echo "<td><a href='account.php?action=view&account_id=$account_id'>$last_name</a></td>";
                echo "<td><a href='account.php?action=view&account_id=$account_id'>$email</a></td>";
                echo "<td>
                            <a href='account.php?action=update&account_id=$account_id' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-pencil'></span> Edit</a>
                            <a href='account.php?action=delete&account_id=$account_id' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                      </td>";
            echo "</tr>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <?php
            require ("header.php");
        ?>
    </head>
    <body>
        <?php require("includes/navbar.php"); ?>

        <div class="container-fluid" id="account_list_data">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    <?php getAccounts(); ?>
                </table>
            </div>
        </div>


        <!-- Everything below this is a modal -->

        <div id="account_form" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Account Info</h4>
                    </div>
                    <div class="modal-body">
                        <!-- my modal form -->
                            <form class="form-horizontal" action="account_process.php" method="post">
                                <div class="form-group">
                                    <label for="first_name" class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="" disabled="disabled">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="" disabled="disabled">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="" disabled="disabled">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="hidden" name="action" value="">
                                        <!-- <button type="submit" id="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                                        <button type="cancel" id="cancel" class="btn btn-default" name="cancel" value="cancel" onclick="returnAccountList()">Cancel</button> -->
                                    </div>
                                </div>
                                <!-- end of my modal form -->
                            </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

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
            }
            function insertAccount(){
                console.log("CODE THAT INSERTS ACCOUNT RECORD");

                var request = new XMLHttpRequest();
                var url = "account_process.php";
                var first_name = document.getElementById("first_name").value;
                var last_name = document.getElementById("last_name").value;
                var email = document.getElementById("email").value;

                var vars = "first_name=" + first_name + "&last_name=" + last_name + "&email=" + email + "&action=insert";
                console.log(vars);

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

            function deleteAccount() {
                console.log("CODE THAT DELETES THE SELECTED RECORD");
            }

            function refreshAccountList() {
                console.log("account list refreshing");
                var request = new XMLHttpRequest();
                var url = "account_list_data.php";
                // var first_name = document.getElementById("first_name").value;
                // var last_name = document.getElementById("last_name").value;
                // var email = document.getElementById("email").value;

                var vars = "";
                // console.log(vars);

                request.open("POST", url, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        var returnData = request.responseText;
                        console.log(returnData);
                        document.getElementById("account_list_data").innerHTML = returnData;
                    }
                }
                request.send(vars);
            }

            document.getElementById("submit").addEventListener("click", processSubmitClick);



        </script>

    </body>
</html>
