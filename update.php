<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 29/11/16
 * Time: 14:12
 */

    include 'header.php';
    $bdd = bdd::getBdd();

    if(!isset($_SESSION['user'])){
        //header('Location: index.php');
        echo "<script>window.location.href = './'</script>";
    }

    if($_SESSION['user']->RankUser != 1){
        //header('Location: index.php');
        echo "<script>window.location.href = './'</script>";
    }

    if(!isset($_GET["type"]) || !isset($_GET["id"])){
        //header('Location: index.php');
        echo "<script>window.location.href = './'</script>";
    }

    $type = $_GET["type"];
    $id = $_GET["id"];
    $item;

    if($type == "product"){
        $product = $bdd->getProductById($id);
        $item = $product;
    }

    echo $twig->render('update.html', array(
        'type' => $type,
        'id' => $id,
        'item' => $item[0]
    ));

    if(isset($_POST["updateProduct"])){
        $name = $_POST["prodName"];
        $price = $_POST["prodPrice"];
        $img = $_POST["productImg"];
        if(isset($_POST["productStar"])){
            $star = 1;
        }
        else{
            $star = 0;
        }

        if($bdd->updateProduct($name, $price, $img, $star, $id)){
            echo "<div class='panel panel-success'> Update success ! <a href='./adminPanel.php'>Go admin panel</a></div>";
        }
    }

    include 'footer.php';

