<?php

session_start();
session_destroy();

setcookie('token', null, -1, '/'); 
setcookie('betaToken', null, -1, '/'); 

header("Location: ./");



?>