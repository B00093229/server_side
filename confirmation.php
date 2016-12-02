<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 01/11/16
 * Time: 12:15
 */

include 'header.php';

if(!isset($_SESSION['user'])){
    header('Location: index.php');
}

$bdd = bdd::getBdd();

echo $twig->render('confirmation.html', array(

));

include 'footer.php';

?>