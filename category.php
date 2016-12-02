<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 02/11/16
 * Time: 12:39
 */

    include 'header.php';

    $bdd = bdd::getBdd();

    $category = $bdd->getCategory();
    $currentCategory = $bdd->getCategoryById($category[0]['Id']);
    $products = $bdd->getProductByCategory($currentCategory[0]['Id']);

    if(isset($_POST['filterCategory'])){
        if(isset($_POST['selectCategory'])){
            $products = $bdd->getProductByCategory($_POST['selectCategory']);
            $currentCategory = $bdd->getCategoryById($_POST['selectCategory']);
        }
    }

    echo $twig->render('category.html', array(
        'categorys' => $category,
        'products' => $products,
        'currentCategory' => $currentCategory[0]
    ));

    include 'footer.php';
