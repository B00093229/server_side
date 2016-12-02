<?php
    include 'header.php';

    $basket = new basket();

    $bdd = bdd::getBdd();
    $products = $bdd->getStarProducts();

    if(isset($_GET["pass"])){
        $message = "You need to log in !";
    }
    else{
        $message = null;
    }

    echo $twig->render('index.html', array(
        'products' => $products,
        'message' => $message
    ));

    include 'footer.php';

?>