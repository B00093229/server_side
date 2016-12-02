<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 22/11/16
 * Time: 14:14
 */

require '../class/bdd.php';

$bdd = bdd::getBdd();

// function call by ajax request
if(isset($_POST['function'])) {
    if(isset($_POST['param'])) {

        $bdd->delUser($_POST['param']);

        $return = new stdClass();
        $return->success = true;
        $return = json_encode($return);
        echo $return;
    }
}