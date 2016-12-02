<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 31/10/16
 * Time: 11:15
 */

    include 'header.php';

    $bdd = bdd::getBdd();
    $orders = $bdd->getOrdersToUser($_SESSION['user']->idUser);

    echo $twig->render('orderListe.html', array(
        'orders' => $orders
    ));

    include 'footer.php';

?>