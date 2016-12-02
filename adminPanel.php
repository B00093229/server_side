<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 02/11/16
 * Time: 18:15
 */

    include 'header.php';

    $basket = new basket();
    $bdd = bdd::getBdd();
    $items = $bdd->getProducts();
    $param = array('Product', 'User', 'Category', 'Rank');
    $curentParam = $param[0];

    if(isset($_POST['changeParam'])){
        $curentParam = $_POST['changeParam'];
        switch($_POST['changeParam']){
            case 'Product':
                $items = $bdd->getProducts();
                break;
            case 'User':
                $items = $bdd->getUser();
                break;
            case 'Category':
                $items = $bdd->getCategory();
                break;
            case 'Rank':
                $items = $bdd->getRank();
                break;
        }
    }

    echo $twig->render('adminPanel.html', array(
        'params' => $param,
        'items' => $items,
        'curentParam' => $curentParam,
        'cates' => $bdd->getCategory()
    ));

    //add new product
    if(isset($_POST['btn-add-product'])){
        if(isset($_POST['productName']) &&
            isset($_POST['productCate']) &&
            isset($_POST['productPrice']) &&
            isset($_POST['productImg']) &&
            isset($_POST['productDescription'])) {

            $name = $_POST['productName'];
            $cate = $_POST['productCate'];
            $price = $_POST['productPrice'];
            $img = $_POST['productImg'];
            $description = $_POST['productDescription'];
            if(!isset($_POST['productStar'])){
                $star = 0;
            }
            else{
                $star = 1;
            }

            $bdd = bdd::getBdd();
            $bdd->addProductToSite($name, $cate, $price, $star, $img, $description);
        }
        else{
            echo "<div class='alerte-perso alerte-warning'>Error please complete all informations</div>";
        }
    }

    //add new cate
    if(isset($_POST['btn-add-cate'])){
        if(isset($_POST['cateName'])){
            $name = $_POST['cateName'];

            $bdd = bdd::getBdd();
            $bdd->addCateToSite($name);
        }
        else{
            echo "<div class='alerte-perso alerte-warning'>Error please complete all informations</div>";
        }
    }

    //add new rank
    if(isset($_POST['btn-add-rank'])){
        if(isset($_POST['rankName'])){
            $name = $_POST['rankName'];

            $bdd = bdd::getBdd();
            $bdd->addRankToSite($name);
        }
        else{
            echo "<div class='alerte-perso alerte-warning'>Error please complete all informations</div>";
        }
    }

include 'footer.php';