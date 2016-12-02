<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 25/10/16
 * Time: 13:32
 */

session_start();

session_destroy();
//unset($_SESSION['user']);

header('Location: index.php');