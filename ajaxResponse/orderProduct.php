<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 02/11/16
 * Time: 12:03
 */

session_start();

require '../class/bdd.php';
require '../class/basket.php';

$basket = new basket();
$bdd = bdd::getBdd();

if(isset($_POST['function'])){
    if(isset($_POST['functionName']) && $_POST['functionName'] == 'orderProduct') {
        // redirect vers la page de commande
        $_SESSION['orderOne'] = $_POST['param'];
        $return = new stdClass();
        $return->success = true;
        $return = json_encode($return);
        echo $return;
    }
}