<?php

if( isset($_POST['token']) ) {
    session_start();
    ob_start();
    $token = $_POST['token'];
    $betaToken = "";
    $name = $_POST['admin_name'];
    $base_url = "https://api.triventure.co.in/api";
    // $base_url = "http://sales-backend.test/api";

    $_SESSION['token'] = $token;
    $_SESSION['name'] = $name;
    $_SESSION['base_url'] = $base_url;
    $_SESSION['dashboard_url'] = "https://dash.triventure.co.in/assets";

    setcookie("token", $token, time() + 31536000, NULL, NULL, NULL, TRUE);
    setcookie("betaToken", $betaToken, time() + 31536000, NULL, NULL, NULL, TRUE);

    header("Location: home/index.php");
} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to Zooters!">
    <meta name="keyword" content="Zooters">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Login | Triventure Sales</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"
        defer>
</head>
<style type="text/css">
.redirect-div {
    margin-top: 10%;
    margin-right: 150px;
    margin-left: 150px;
}

@media only screen and (max-width:768px) {
    .redirect-div {
        margin-top: 15%;
        margin-right: 20px;
        margin-left: 20px;
    }
}
</style>
<script>
var base_url = "https://api.triventure.co.in/api";
// var base_url = "http://sales-backend.test/api";

$(document).ready(function() {
    $.ajax({
        url: base_url + '/tokenLogin',
        type: 'GET',
        contentType: 'application/json',
        dataType: "json",
        headers: {
            "Authorization": "Bearer <?php echo $_COOKIE['token']; ?>"
        },
    }).done(function(data) {
        var obj = data;
        if (obj.id !== undefined) {
            $('#token').val('<?php echo $_COOKIE['token']; ?>');
            $('#admin_name').val(obj.first_name + ' ' + obj.last_name);
            $('#sesstionCreate').submit();
        } else {
            window.location.href = './';
        }
    });
});
</script>
<div class="row">
    <div class="col-md-2"></div>
    <div class="redirect-div col-md-8">
        <h3 style="font-family: 'Open Sans', sans-serif;"> <span style="font-size: 36px;">🚀</span> <br />
            Welcome to the world of Triventure!<br />
            <!-- <span style="font-size: 16px;color:#666;font-weight:400;">- Frank Herbert</span><br> -->
            <div class='loader'
                style='align-content: center;vertical-align: middle; margin-top: 2%; z-index: 20;display: block;'>
                <style type='text/css'>
                .fa-spin-custom,
                .glyphicon-spin {
                    -webkit-animation: spin 1000ms infinite linear;
                    animation: spin 1000ms infinite linear;
                }

                @-webkit-keyframes spin {
                    0% {
                        -webkit-transform: rotate(0deg);
                        transform: rotate(0deg);
                    }

                    100% {
                        -webkit-transform: rotate(359deg);
                        transform: rotate(359deg);
                    }
                }

                @keyframes spin {
                    0% {
                        -webkit-transform: rotate(0deg);
                        transform: rotate(0deg);
                    }

                    100% {
                        -webkit-transform: rotate(359deg);
                        transform: rotate(359deg);
                    }
                }
                </style>
                <div style='padding:4px;border-radius: 2px;'><i class='fa fa-spinner fa-spin-custom'
                        style='font-size: 16px'></i></div>
            </div>
        </h3>

    </div>
    <div class="col-md-2"></div>
</div>
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
?>