<?php
include_once "functions.php";

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) logout();