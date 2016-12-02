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
        echo "<script>window.location.href = './'</script>";
    }

    if($_SESSION['user']->RankUser != 1){
        echo "<script>window.location.href = './'</script>";
    }

    if(!isset($_GET["type"]) || !isset($_GET["id"])){
        echo "<script>window.location.href = './'</script>";
    }

    $type = $_GET["type"];
    $id = $_GET["id"];
    $item;
    $rank = $bdd->getRank();

    if($type == "product"){
        $product = $bdd->getProductById($id);
        $item = $product;
    }
    elseif($type == "user"){
        $usr = $bdd->getUserById($id);
        $item = $usr;
    }
    else{
        echo "<script>window.location.href = './'</script>";
    }

    echo $twig->render('update.html', array(
        'type' => $type,
        'id' => $id,
        'item' => $item[0],
        'ranks' => $rank
    ));

    // update product
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

    //update usr
    if(isset($_POST["updateUser"])){
        $name = $_POST["usrName"];
        $lastName = $_POST["usrLastName"];
        $rank = $_POST["selectRank"];
        $img = $_POST["userImg"];
        $address = $_POST["userAddress"];
        $mail = $_POST["userEmail"];

        if($bdd->updateUserProfileAdm($name, $lastName, $address, $img, $rank, $mail, $id)){
            echo "<div class='panel panel-success'> Update success ! <a href='./adminPanel.php'>Go admin panel</a></div>";
        }
    }


    include 'footer.php';

