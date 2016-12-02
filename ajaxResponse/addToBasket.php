<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 02/11/16
 * Time: 11:46
 */

session_start();

require '../class/bdd.php';
require '../class/basket.php';

$basket = new basket();
$bdd = bdd::getBdd();

// function call by ajax request
if(isset($_POST['function'])) {
    if (isset($_POST['functionName']) && $_POST['functionName'] == 'addBasket') {
        // if user connected
        if (isset($_SESSION['user'])) {
            $bdd->addProductToBasket($_POST['param'], $_SESSION['user']->idUser);
            $result = $bdd->getProductById($_POST['param']);
            $basket->ajouterArticle($result[0]['ProductName'], 1, $result[0]['Price'], $result[0]['ProductId']);
            $return = new stdClass();
            $return->success = true;
            $return->data["result"] = array("basket" => $basket->getBasket(), "function" => $_POST['functionName'], "param" => $_POST['param']);
            $return = json_encode($return);
            echo $return;
        }
        // basket local
        else {
            $result = $bdd->getProductById($_POST['param']);
            $basket->ajouterArticle($result[0]['ProductName'], 1, $result[0]['Price'], $result[0]['ProductId']);
            $return = new stdClass();
            $return->success = true;
            $return->data["result"] = array("basket" => $basket->getBasket(), "function" => $_POST['functionName'], "param" => $_POST['param']);
            $return = json_encode($return);
            echo $return;
        }
    }
}