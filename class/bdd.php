<?php

/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 17/10/16
 * Time: 21:53
 */
class bdd
{
    private $bdd = 'mysql:host=localhost;dbname=server_side';
    private $user = 'server_side';
    private $pass = 'server_side123';
    private $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
    private $PDOInstance = null;
    private static $_instance;

    private function __construct() {
        try{
            $this->PDOInstance = new PDO($this->bdd, $this->user, $this->pass, $this->options);
        }catch (Exception $ex) {
            return "error -> $ex";
        }
    }

    public static function getBdd(){
        if(is_null(self::$_instance)) {
            self::$_instance = new bdd();
        }

        return self::$_instance;
    }

    public function getUser(){
        $query = 'SELECT * FROM User';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute();
        $users = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getProducts(){
        $query = 'SELECT prod.Id AS "ProductId", prod.Name AS "ProductName", prod.Price, prod.Description, prod.Picture, prod.IsStar, cat.Name AS "CateName"
                  FROM Products prod INNER JOIN Category cat 
                  ON prod.IdCategory = cat.Id';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute();
        $products = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getStarProducts(){
        $query = 'SELECT prod.Id AS "ProductId", prod.Name AS "ProductName", prod.Price, prod.Description, prod.Picture, prod.IsStar, cat.Name AS "CateName"
                  FROM Products prod INNER JOIN Category cat 
                  ON prod.IdCategory = cat.Id
                  WHERE prod.IsStar';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute();
        $products = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getProductById($id){
        $query = 'SELECT prod.Id AS "ProductId", prod.Name AS "ProductName", prod.Price, /*prod.Description,*/ prod.Picture, prod.IsStar, cat.Name AS "CateName"
                  FROM Products prod INNER JOIN Category cat 
                  ON prod.IdCategory = cat.Id
                  WHERE prod.Id = :id';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':id'=>$id));
        $product = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $product;
    }

    public function loginUser($user, $pwd){
        $query = 'SELECT *
                  FROM User
                  WHERE Email = :name
                  AND Password = PASSWORD(:pwd)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':name'=>$user, ':pwd'=>$pwd));
        $user = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    public function updateUserProfile($userInfos){
        $query = 'UPDATE User
                  SET Name=:name, LastName=:lastname, Email=:email, Address=:address
                  WHERE Id = :id;';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':id'=>$userInfos->idUser, ':name'=>$userInfos->NameUser, ':lastname'=>$userInfos->LastNameUser, ':email'=>$userInfos->EmailUser, ':address'=>$userInfos->AddressUser));
        if($sql->rowCount() >= 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function getBasket($userId){
        $query = 'SELECT prod.Id, bask.IdProduct, SUM(bask.QteProduct) as QteProduct, bask.IdUser, prod.Name, prod.Price
                  FROM Basket bask INNER JOIN Products prod
                  ON bask.IdProduct = prod.Id
                  WHERE bask.IdUser = :userId
                  GROUP BY prod.Id';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':userId'=>$userId));
        $basket = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $basket;
    }

    public function deleteProductFromBasket($idUser, $idProduct){
        $query = 'DELETE
                  FROM Basket
                  WHERE IdUser = :userId
                  AND IdProduct = :idProduct';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':userId'=>$idUser, ':idProduct'=>$idProduct));
        $count = $sql->rowCount();
        if($count > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function addProductToBasket($idProduct, $idUser){
        $query = 'INSERT INTO Basket(IdProduct, QteProduct, IdUser)
                  VALUES(:idProduct, 1, :idUser)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':idProduct'=>$idProduct, ':idUser'=>$idUser));
    }

    public function addProductToSite($name, $cate, $price, $star, $img, $description){
        $query = 'INSERT INTO Products(Name, Price, Picture, IsStar, IdCategory, Description)
                  VALUES(:NameProduct, :Price, :Img, :Star, :Cate, :Description)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':NameProduct'=>$name, ':Price'=>$price, ':Img'=>$img, ':Star'=>$star, ':Cate'=>$cate, ':Description'=>$description));
    }

    public function resetBasketUser($idUser){
        $query = 'DELETE
                  FROM Basket
                  WHERE IdUser = :userId';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':userId'=>$idUser));
    }

    public function getOrdersToUser($idUser){
        $query = 'SELECT ord.Id as idOrd, ord.OrderDate as dateOrd, prod.Id as idProd, prod.Price as priceProd, prod.Name as nameProd
                  FROM Orders ord INNER JOIN Products prod
                  ON ord.IdProduct = prod.Id
                  WHERE ord.IdUser = :idUser';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':idUser'=>$idUser));
        $orders = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }

    public function addOrderToUser($idUser, $idProduct){
        $query = 'INSERT INTO Orders(IdUser, IdProduct)
                  VALUES(:idUser, :idProduct)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':idUser'=>$idUser, ':idProduct'=>$idProduct));
    }

    public function getProductByCategory($idCategory){
        $query = 'SELECT *
                  FROM Products
                  WHERE IdCategory = :idCategory';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':idCategory'=>$idCategory));
        $products = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getCategory(){
        $query = 'SELECT *
                  FROM Category';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute();
        $category = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $category;
    }

    public function getCategoryById($idCategory){
        $query = 'SELECT *
                  FROM Category
                  WHERE Id = :idCategory';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':idCategory' => $idCategory));
        $category = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $category;
    }

    public function getRank(){
        $query = 'SELECT *
                  FROM Rank';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute();
        $rank = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rank;
    }

    public function delProduct($idProduct){
        $query = 'DELETE
                  FROM Products
                  WHERE Id = :idProduct';
        $sql = $this->PDOInstance->prepare($query);
        $result = $sql->execute(array(':idProduct' => $idProduct));
        return $result;
    }

    public function delUser($idUser){
        $query = 'DELETE
                  FROM User
                  WHERE Id = :idUser';
        $sql = $this->PDOInstance->prepare($query);
        $result = $sql->execute(array(':idUser' => $idUser));
        return $result;
    }

    public function delCate($idCate){
        $query = 'DELETE
                  FROM Category
                  WHERE Id = :idCate';
        $sql = $this->PDOInstance->prepare($query);
        $result = $sql->execute(array(':idCate' => $idCate));
        return $result;
    }

    public function delRank($idRank){
        $query = 'DELETE
                  FROM Rank
                  WHERE Id = :idRank';
        $sql = $this->PDOInstance->prepare($query);
        $result = $sql->execute(array(':idRank' => $idRank));
        return $result;
    }

    public function addCateToSite($name){
        $query = 'INSERT INTO Category(Name)
                  VALUES(:NameCate)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':NameCate'=>$name));
    }

    public function addRankToSite($name){
        $query = 'INSERT INTO Rank(Name)
                  VALUES(:NameRank)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':NameRank'=>$name));
    }

    public function addUserToSite($name, $lastName, $email, $password, $img, $address, $rank){
        $query = 'INSERT INTO User(Name, Password, Img, Address, LastName, Email, RankId)
                  VALUES(:Name, PASSWORD(:Password), :Img, :Address, :LastName, :Email, :RankId)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':Name'=>$name, ':Password'=>$password, ':Img'=>$img, ':Address'=>$address, ':LastName'=>$lastName, ':Email'=>$email, ':RankId' =>$rank));
    }

    public function updateProduct($name, $price, $img, $star, $id){
        $query = 'UPDATE Products
                  SET Name=:name, Price=:price, Picture=:img, IsStar=:star
                  WHERE Id = :id;';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':id'=>$id, ':name'=>$name, ':price'=>$price, ':img'=>$img, ':star'=>$star));
        if($sql->rowCount() >= 1){
            return true;
        }
        else{
            return false;
        }
    }
}