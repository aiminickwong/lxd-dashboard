<!--
LXDWARE LXD Dashboard - A web-based interface for managing LXD servers
Copyright (C) 2020-2021  LXDWARE.COM

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Cache-control" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" type="image/png" href="assets/images/logo-light.svg">

  <title>LXD Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/fonts/nunito.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="vendor/sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
  <link href="assets/css/style.css?version=3.0" rel="stylesheet">

  <style>
    body {
      background-image: url('assets/images/logo-bg.svg') !important;
      background-position: center center !important;
      background-size: 100% auto !important;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  </style> 

</head>

<body class="bg-dark">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-5 d-none d-lg-block border-right">

                <div class="pt-5">
                  <div class="text-center">
                    <img src="assets/images/logo-light.svg" width="50px" style="vertical-align: bottom !important;">
                    <span class="h1 text-gray-900"><strong>LXDWARE</strong></span>
                  </div>
                </div>

                <div class="pt-5">
                  <div class="pl-4">
                    <p class="h5 text-gray-900">Manage remote LXD servers with this open source LXD dashboard.</p>
                    <p class="h5 text-gray-900 pt-3">For instructions on using the dashboard, visit <a href="https://lxdware.com" target="_blank">https://lxdware.com</a>.</p>
                  </div>
                </div>
                  
              </div>
              <div class="col-lg-7 align-self-center">
                <div class="p-5">
                  <form class="user" id="loginForm" onsubmit="return false">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>


  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="vendor/sb-admin-2/js/sb-admin-2.min.js"></script>

</body>

<script>
  function changeDatabaseInput(){
    if ($("#registerDatabaseTypeInput").val() == 'sqlite'){
      $("#registerDatabaseHostDiv").hide();
      $("#registerDatabaseNameDiv").hide();
      $("#registerDatabaseUserDiv").hide();
      $("#registerDatabasePasswordDiv").hide();
    }
    else {
      $("#registerDatabaseHostDiv").show();
      $("#registerDatabaseNameDiv").show();
      $("#registerDatabaseUserDiv").show();
      $("#registerDatabasePasswordDiv").show();
    }
  }

  function registerUser(){
    var registerUsernameInput = $("#registerUsernameInput").val();
    var registerEmailInput = $("#registerEmailInput").val();
    var registerPasswordInput = $("#registerPasswordInput").val();
    var registerRepeatPasswordInput = $("#registerRepeatPasswordInput").val();
    var registerDatabaseTypeInput = $("#registerDatabaseTypeInput").val();
    var registerDatabaseHostInput = $("#registerDatabaseHostInput").val();
    var registerDatabaseNameInput = $("#registerDatabaseNameInput").val();
    var registerDatabaseUserInput = $("#registerDatabaseUserInput").val();
    var registerDatabasePasswordInput = $("#registerDatabasePasswordInput").val();

    if (registerPasswordInput == registerRepeatPasswordInput){
      console.log("Info: setting up database");
      $.post('./backend/config/login.php?database_type=' + registerDatabaseTypeInput + '&database_host=' + registerDatabaseHostInput + '&database_name=' + registerDatabaseNameInput + '&database_user=' + registerDatabaseUserInput + '&action=writeDatabaseConfig', {database_password: registerDatabasePasswordInput},  function (data) {
        console.log(data);
        var operationData = JSON.parse(data);
        console.log(operationData);
        if (operationData.status_code == 200) {
          console.log("Info: registering user " + registerUsernameInput);
          $.post('./backend/admin/settings.php?action=createUser', {username: registerUsernameInput, password: registerPasswordInput, email: registerEmailInput},  function (data) {
            var operationData = JSON.parse(data);
            console.log(operationData);
            if (operationData.status_code == 200) {
              location.reload(); 
            }
            if (operationData.status_code >= 400) {
              console.log(operationData);
              alert(operationData.metadata.error);
              location.reload(); 
            }
          });
        }
        if (operationData.status_code >= 400) {
          console.log(operationData);
          alert(operationData.metadata.error);
        }
      });
    }
    else {
      alert("Your passwords did not match, try again");
    }
    return false;
  }


  function loginUser(){
    var loginUsernameInput = $("#loginUsernameInput").val();
    var loginPasswordInput = $("#loginPasswordInput").val();
    console.log("Info: logging in user " + loginUsernameInput);
    $.post('./backend/aaa/authentication.php?action=authenticateUser', {username: loginUsernameInput, password: loginPasswordInput},  function (data) {
      var operationData = JSON.parse(data);
      console.log(operationData);
      if (operationData.status_code == 200) {
        window.location.href = './remotes.php';
      }
      if (operationData.status_code == 401) {
        console.log(operationData);
        alert(operationData.metadata.error);
      }
      return false;
    });
  }

  
  $(document).ready(function(){

    //Check if already authorized
    $.get("./backend/aaa/authentication.php?action=validateAuthentication", function (data) {
      operationData = JSON.parse(data);
      if (operationData.status_code == 200) {
        console.log(operationData);
        window.location.href = './remotes.php'
      }
    });
      
    $("#loginForm").load( "./backend/config/login.php?action=loadLoginForm", function() {
      $("#loginUsernameInput").focus();
    });

  });

</script>

</html>