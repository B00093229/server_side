<!DOCTYPE html>
<html>
<head>
    <title>Hulk store</title>
    <!--Import Google Icon Font-->
    <!--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <link href="fonts/google.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Architects+Daughter|Indie+Flower|Josefin+Sans|Pacifico|Wendy+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Bangers|Bungee+Shade|Cabin+Sketch:400,700|Chelsea+Market|Chewy|Comfortaa:300,400,700|Creepster|Fontdiner+Swanky|Freckle+Face|Fredericka+the+Great|Fruktur|Luckiest+Guy|Orbitron:400,500,700,900|Permanent+Marker|Righteous" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!-- font awesome -->
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/css.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>

</head>

<body class="green green lighten-5">

<div class="navbar-fixed">
    <nav class="black darken-4 my-nav">
        <div class="nav-wrapper">
            <div class="container">
                <a href="index.php" class="brand-logo green-text"><img class="logo-nav" src="img/logo.png"/></a>

                <a href="#" data-activates="mobile-demo" class="button-collapse green-text"><i class="material-icons">menu</i></a>

                <ul class="side-nav" id="mobile-demo">
                    <li><img src="//lh3.googleusercontent.com/-wxiikuPhR2g/AAAAAAAAAAI/AAAAAAAAAAA/AKTaeK_nEEv6DkJZ6ZyB6fptYgBAEcR5Sg/s64-c-mo/photo.jpg" alt="" class="circle responsive-img img-avatar-nav"></li>
                    <li><a class="green-text nav-item" href="allProduct.php">All product</a></li>
                    <li><a class="green-text" href="category.php">Category</a></li>
                    <li><a class="green-text" href="basket.php"><i class="green-text material-icons">shopping_cart</i></a></li>
                </ul>

                <ul class="right hide-on-med-and-down">
                    <li>
                        <?php
                        session_start();
                        if(isset($_SESSION['user'])){
                            if ($_SESSION['user']->RankUser == 1) {
                                echo '<a class="green-text nav-item dropdown-button" href="adminPanel.php">' ."Admin Gestion". '</a>';
                            }
                        }
                        ?>
                    </li>
                    <li><a class="green-text nav-item" href="category.php">Category</a></li>
                    <li><a class="green-text nav-item" href="allProduct.php">All product</a></li>
                    <li><a class="green-text nav-item" href="basket.php"><i class="material-icons">shopping_cart</i></a></li>
                    <li>
                        <?php
                            if(isset($_SESSION['user'])) {
                                echo '<a class="green-text nav-item dropdown-button" href="#!" data-activates="dropdown1">'.$_SESSION['user']->NameUser.'<i class="material-icons right">arrow_drop_down</i></a>';
                            }
                            else{
                                echo'<a class="green-text nav-item modal-trigger waves-effect waves-light" href="#modal1"><i class="material-icons">perm_identity</i></a>';
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<ul id="dropdown1" class="dropdown-content">

            <li><a class="black-text" href="profile.php">Profile</a></li>
            <li><a class="black-text" href="orderListe.php">My orders</a></li>
            <li class="divider"></li>
            <li><a class="black-text" href="logout.php">Logout</a></li>
</ul>


<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">

        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#login">Login</a></li>
                    <li class="tab col s3"><a href="#signUp">Sign Up</a></li>
                </ul>
            </div>
            <hr>
            <br>
            <div id="login" class="col s12">
                <h4 class="center">Login</h4>
                <hr>
                <div class="row">
                    <form method="post">
                        <div class="container">
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="icon_prefix" type="email" class="validate" name = "username">
                                <label for="icon_prefix">Email</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">lock</i>
                                <input id="icon_telephone" type="password" class="validate" name="password">
                                <label for="icon_telephone">Password</label>
                            </div>
                            <button class="btn green btn-max-width" type = "submit" name = "login">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="signUp" class="col s12">
                <h4 class="center">Sign Up</h4>
                <hr>
                <div class="row">
                    <form method="post">
                        <div class="container">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="icon_prefix" type="text" class="validate" name = "name">
                                <label for="icon_prefix">Name</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">perm_identity</i>
                                <input id="icon_telephone" type="text" class="validate" name="lastName">
                                <label for="icon_telephone">Last Name</label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">mail</i>
                                <input id="icon_telephone" type="email" class="validate" name="emailS">
                                <label for="icon_telephone">Email</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">lock</i>
                                <input id="icon_telephone" type="password" class="validate" name="passwordS">
                                <label for="icon_telephone">Password</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">lock</i>
                                <input id="icon_telephone" type="password" class="validate" name="passwordCheckS">
                                <label for="icon_telephone">Repeat</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">my_location</i>
                                <input id="icon_telephone" type="text" class="validate" name="addressS">
                                <label for="icon_telephone">Address</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">assignment_ind</i>
                                <input id="icon_telephone" type="text" class="validate" name="imgUserS">
                                <label for="icon_telephone">Picture profile</label>
                            </div>
                            <button class="btn green btn-max-width" type = "submit" name = "signUp">
                                Sign Up
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
    </div>
</div>

<?php

    include_once('vendor/twig/twig/lib/Twig/Autoloader.php');
    require './class/bdd.php';
    require './class/basket.php';

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
    $bdd = bdd::getBdd();

    // login function
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

        $result = $bdd->loginUser($_POST['username'], $_POST['password']);
        if(sizeof($result) > 0) {
            $user = new stdClass();
            $user->idUser = $result[0]['Id'];
            $user->NameUser = $result[0]['Name'];
            $user->AddressUser = $result[0]['Address'];
            $user->ImgUser = $result[0]['Img'];
            $user->LastNameUser = $result[0]['LastName'];
            $user->EmailUser = $result[0]['Email'];
            $user->RankUser = $result[0]['RankId'];
            $_SESSION['user']= $user;
            if(!empty($_SESSION['basket']['product'])){
                //reset basket bdd user
                $bdd->resetBasketUser($user->idUser);
                // inserte local basket in bdd
                foreach($_SESSION['basket']['product'] as $product){
                    $bdd->addProductToBasket($product->idProduct, $user->idUser);
                }
            }
            //header("Refresh:0");
            echo "<script>window.location.href = './'</script>";
        }
        else {
            echo('Wrong username or password');
        }
    }

    // signup function
    if (isset($_POST['signUp']) && !empty($_POST['name']) && !empty($_POST['lastName'])
        && !empty($_POST['emailS']) && !empty($_POST['passwordS']) && !empty($_POST['passwordCheckS'])
        && !empty($_POST['addressS']) && !empty($_POST['imgUserS'])) {

        $name = $_POST['name'];
        $lastname = $_POST['lastName'];
        $mail = $_POST['emailS'];
        $pw = $_POST['passwordS'];
        $pwc = $_POST['passwordCheckS'];
        $add = $_POST['addressS'];
        $img = $_POST['imgUserS'];

        if($pw == $pwc){
            // add user in bdd with rank id = 2 = user
            $bdd->addUserToSite($name, $lastname, $mail, $pw, $img, $add, 2);
        }

    }
?>