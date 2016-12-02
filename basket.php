<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 21/10/16
 * Time: 16:33
 */

    include 'header.php';

    //var_dump(json_encode($_SESSION));
    //unset($_SESSION);
    //session_destroy();

    //create basket object
    $basket = new basket();
    $bdd = bdd::getBdd();
    $PriceTotal = $basket->getPriceBasket();
    $QteBasket = $basket->getNbElementBasket();

    echo $twig->render('basket.html', array(
        'basket' => $basket->getBasket(),
        'basketQte' => $QteBasket,
        'basketPrice' => $PriceTotal
    ));

    // fonction de suppression d'un produit
    if(isset($_POST['function'])){
        if(isset($_SESSION['user'])){
            $bdd->deleteProductFromBasket($_SESSION['user']->idUser, $_POST['param']);
        }
        $basket->deleteArticle($_POST['param']);
        $return = new stdClass();
        $return->success = true;
        $return->data["result"] = $basket->getBasket();
        $return = json_encode($return);
        echo $return;
    }

    if(isset($_POST['orderBasket'])){

        // redirect vers la page de commande
        $_SESSION['orderOne'] = "Basket";
        echo("<script>location.href = 'order.php';</script>");
    }

    include 'footer.php';

?>