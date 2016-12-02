<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 27/10/16
 * Time: 11:35
 */

    include 'header.php';

    if(!isset($_SESSION['user'])){
        header('Location: index.php');
    }

    $basket = new basket();

    $bdd = bdd::getBdd();

    $profile = $_SESSION['user'];

    echo $twig->render('profile.html', array(
        'profile' => $profile
    ));

    // update profile function
    if(isset($_POST['submit'])){
        $_SESSION['user']->NameUser = $_POST['firstName'];
        $_SESSION['user']->AddressUser = $_POST['address'];
        $_SESSION['user']->LastNameUser = $_POST['lastName'];
        $_SESSION['user']->EmailUser = $_POST['email'];
        if($bdd->updateUserProfile($_SESSION['user'])){
            header("Refresh:0");
        }
    }

    include 'footer.php';

?>