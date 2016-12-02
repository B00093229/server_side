<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 31/10/16
 * Time: 12:24
 */

    include 'header.php';

    if(!isset($_SESSION['user'])){
        header('Location: index.php?pass=NotLogin');
    }

    $bdd = bdd::getBdd();

    if(isset($_SESSION['orderOne'])){

        if($_SESSION['orderOne'] == "Basket"){
            $product = $_SESSION['basket']['product'];
            $profile = $_SESSION['user'];
            echo $twig->render('order.html', array(
                'type' => 'basket',
                'products' => $product,
                'profile' => $profile
            ));
        }
        else {

            $product = $bdd->getProductById($_SESSION['orderOne']);
            $profile = $_SESSION['user'];
            echo $twig->render('order.html', array(
                'type' => 'product',
                'product' => $product[0],
                'profile' => $profile
            ));
        }
    }

    // order sigle product
    if(isset($_POST['order'])){
        $product = $_POST['order'];
        $bdd->addOrderToUser($_SESSION['user']->idUser, $product);
        echo("<script>location.href = 'confirmation.php';</script>");
    }

    //order basket
    if(isset($_POST['orderBasket'])){
        $products = $_SESSION['basket']['product'];
        foreach($products as $product){
            //var_dump($product);
            $bdd->addOrderToUser($_SESSION['user']->idUser, $product->idProduct);
        }
        echo("<script>location.href = 'confirmation.php';</script>");
    }

    include 'footer.php';

?>