<?php

session_start();

	if( isset($_SESSION['token']) ) {
		header("Location: home/index.php");
	} else {
		if( isset( $_COOKIE['token']) ) {
			header("Location: ./redirect.php");
		} else {
			?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="./assets/favicon.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="manifest" href="./manifest.json">
    <script src="./sw.js"></script>
    <title>Welcome To Triventure Sales! </title>
</head>

<body>
    <div class="container-fluid loginContainer">
        <div class="row">
            <div class="col-md"></div>
            <div class="col-md">
                <div class="container containerBox" style="margin-top:10%;">
                    <br><br>
                    <div class="centerClass">
                        <img src="./assets/logo.png" style="height:100px">
                    </div>
                    <h3 class="center"> Welcome to Triventure Sales!</h3>
                    <br>
                    <form id="loginForm" class="p-3">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <a id="submit" class="btn btn-triventure">Login</a>
                    </form>
                    <br>
                </div>
                <br>
                <div class="fixed--bottom center">
                    <p> All Rights Reserved | Triventure Advisory Pvt Ltd</p>
                </div>
            </div>
            <div class="col-md"></div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script>
    var base_url = "https://api.triventure.co.in/api";
    // var base_url = "http://sales-backend.test/api";
    $(document).on('click', '#submit', function() {

        var email = $('#email').val();
        var password = $('#password').val();

        if (email == '' || password == '') {
            alert('All fields are mandatory');
        } else {
            $.ajax({
                url: base_url + '/adminLogin',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                }
            }).done(function(result) {
                $('#token').val(result.token);
                $('#admin_name').val(result.user.first_name + ' ' + result.user.last_name);
                $('#sesstionCreate').submit();
            });
        }
    });
    </script>
    <div style="display:none">
        <form id="sesstionCreate" action="redirect.php" method="POST">
            <input type="hidden" name="token" id="token">
            <input type="hidden" name="admin_name" id="admin_name">
        </form>
    </div>
</body>

</html>

<?php
		}
	}

?>