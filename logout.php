<?php

session_start();
session_destroy();

header("Location: ./");

setcookie("token", $token, time() - 31536000, NULL, NULL, NULL, TRUE);
setcookie("betaToken", $betaToken, time() - 31536000, NULL, NULL, NULL, TRUE);

?>