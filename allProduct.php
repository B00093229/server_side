<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 22/10/16
 * Time: 11:43
 */
    include 'header.php';

    $bdd = bdd::getBdd();
    $products = $bdd->getProducts();

    echo $twig->render('allProduct.html', array(
        'products' => $products
    ));

    include 'footer.php';

?>