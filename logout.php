<?php
require 'config/constants.php';
//cerrar sesión y redirigir a login
session_destroy();
header('location: ' . ROOT_URL . 'home.php');
die();