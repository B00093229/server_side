<?php

class basket
{
    /**
     * basket constructor.
     */
    function __construct(){
        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = array();
            $_SESSION['basket']['product'] = array();
            $_SESSION['basket']['lock'] = false;
            $_SESSION['basket']['firstLog'] = true;
        }

        if(isset($_SESSION['user'])){
            unset($_SESSION['basket']['product']);
            $_SESSION['basket']['product'] = array();
            $bdd = bdd::getBdd();

            $basket = $bdd->getBasket($_SESSION['user']->idUser);

            foreach($basket as $product){
                $data = new stdClass();
                $data->idProduct = $product['Id'];
                $data->nameProduct = $product['Name'];
                $data->qteProduct = $product['QteProduct'];
                $data->priceProduct = $product['Price'];
                array_push($_SESSION['basket']['product'], $data);
            }
        }

        //bdd check if user login
        if(isset($_SESSION['user']) && $_SESSION['basket']['firstLog'] == true) {
            $bdd = bdd::getBdd();
            $basket = $bdd->getBasket($_SESSION['user']->idUser);

            for($i=0; $i < sizeof($basket); $i++){
                $test = false;
                for($j=0; $j < sizeof($_SESSION['basket']['product']); $j++){
                    if($_SESSION['basket']['product'][$j]->nameProduct == $basket[$i]['Name']){
                        $_SESSION['basket']['product'][$j]->qteProduct += $basket[$i]['QteProduct'];
                        $test = true;
                        break;
                    }
                };
                if($test == false) {
                    $data = new stdClass();
                    $data->idProduct = $basket[$i]['Id'];
                    $data->nameProduct = $basket[$i]['Name'];
                    $data->qteProduct = $basket[$i]['QteProduct'];
                    $data->priceProduct = $basket[$i]['Price'];
                    array_push($_SESSION['basket']['product'], $data);
                }
            }
            $_SESSION['basket']['firstLog'] = false;
        }
    }

    /**
     * This function return the basket stored in the session
     * @return mixed
     */
    public function getBasket(){
        return $_SESSION['basket'];
    }

    /**
     * This function return the total price of the basket stored in the session
     * @return int price total of the basket
     */
    public function getPriceBasket(){
        if (isset($_SESSION['basket']))
        {
            $total = 0;
            foreach($_SESSION['basket']['product'] as $product){
                $total += $product->priceProduct * $product->qteProduct;
            }
            return $total;
        }
    }

    /**
     * this function return the number of element present in the basket stored in the session
     * @return int the number of element in the basket
     */
    public function getNbElementBasket(){
        if (isset($_SESSION['basket']))
        {
            return sizeof($_SESSION['basket']['product']);
        }
    }

    /**
     * This function add new product in the basket stored in the session
     * @param $name name of product
     * @param $qte qte of this product
     * @param $price prie of product
     * @param $id id of product
     */
    public function ajouterArticle($name,$qte,$price, $id){

        //Si le panier existe
        if (isset($_SESSION['basket']) && $_SESSION['basket']['lock'] == false ){
            if(empty($_SESSION['basket']['product'])){
                $data = new stdClass();
                $data->idProduct = $id;
                $data->nameProduct = $name;
                $data->qteProduct = $qte;
                $data->priceProduct = $price;
                array_push( $_SESSION['basket']['product'],$data);
            }
            else{
                $test = false;
                foreach($_SESSION['basket']['product'] as $product){
                    if($product->idProduct == $id){
                        $product->qteProduct += $qte;
                        $test = true;
                        break;
                    }
                }
                if($test == false)
                {
                    //Sinon on ajoute le produit
                    $data = new stdClass();
                    $data->idProduct = $id;
                    $data->nameProduct = $name;
                    $data->qteProduct = $qte;
                    $data->priceProduct = $price;
                    array_push($_SESSION['basket']['product'],$data);
                }
            }
        }
    }

    /**
     * This function delete an article in the basket stored in the session
     * @param $idProduct id of user
     */
    public function deleteArticle($idProduct){
        if(isset($_SESSION['basket']) && $_SESSION['basket']['lock'] == false ){
            for($i=0; $i < sizeof($_SESSION['basket']['product']); $i++){
                if($_SESSION['basket']['product'][$i]->idProduct == $idProduct){
                    unset($_SESSION['basket']['product'][$i]);
                    break;
                }
            }
        }
    }

    /**
     * this function lock the basket stored in the session
     */
    public function lockBasket(){
        if(isset($_SESSION['basket'])){
            if($_SESSION['basket']['lock'] == false){
                $_SESSION['basket']['lock'] == true;
            }
        }
    }

    /**
     * This function unlock the basket stored in the session
     */
    public function unlockBasket(){
        if(isset($_SESSION['basket'])){
            if($_SESSION['basket']['lock'] == true){
                $_SESSION['basket']['lock'] == false;
            }
        }
    }


}