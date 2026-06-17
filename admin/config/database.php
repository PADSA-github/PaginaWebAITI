<?php
require 'constants.php';


//Conectar a la base de datos
$conecction = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_errno($conecction)){
    die(mysqli_error($conecction));
}