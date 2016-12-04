<?php

class bdd
{
    private $bdd = 'mysql:host=localhost;dbname=server_side';
    private $user = 'server_side';
    private $pass = 'server_side123';
    private $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
    private $PDOInstance = null;
    private static $_instance;

    /**
     * bdd constructor.
     */
    private function __construct() {
        try{
            $this->PDOInstance = new PDO($this->bdd, $this->user, $this->pass, $this->options);
        }catch (Exception $ex) {
            return "error -> $ex";
        }
    }

    /**
     * This function return the bdd object
     * @return bdd
     */
    public static function getBdd(){
        if(is_null(self::$_instance)) {
            self::$_instance = new bdd();
        }

        return self::$_instance;
    }

    /**
     * This function return all users
     * @return array of user
     */
    public function getUser(){
        $query = 'SELECT * FROM User';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute();
        $users = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    /**
     * This function return all products
     * @return array of product
     */
    public function getProducts(){
        $query = 'SELECT prod.Id AS "ProductId", prod.Name AS "ProductName", prod.Price, prod.Description, prod.Picture, prod.IsStar, cat.Name AS "CateName"
                  FROM Products prod INNER JOIN Category cat 
                  ON prod.IdCategory = cat.Id';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute();
        $products = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    /**
     * This function return all stars products
     * @return array of stars products
     */
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

    /**
     * This function return a product with an id
     * @param $id: id of product
     * @return array with all info of this product
     */
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

    /**
     * This function search the user name and the password of user with bdd content
     * @param $user user name
     * @param $pwd user password
     * @return array with the user info
     */
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

    /**
     * This function update user infos
     * @param $userInfos object with the new infos user
     * @return bool state true if ok false if error
     */
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

    /**
     * This function return the save basket of the user with $id
     * @param $userId id of user
     * @return array the content of user basket
     */
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

    /**
     * This function delete the item $id of user basket
     * @param $idUser id of user
     * @param $idProduct id of product we want deleted
     * @return bool state true if ok false if error
     */
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

    /**
     * This function add $id product in the basket of user $id
     * @param $idProduct id of product
     * @param $idUser id of user
     */
    public function addProductToBasket($idProduct, $idUser){
        $query = 'INSERT INTO Basket(IdProduct, QteProduct, IdUser)
                  VALUES(:idProduct, 1, :idUser)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':idProduct'=>$idProduct, ':idUser'=>$idUser));
    }

    /**
     * This function add new product in the database
     * @param $name the name of product
     * @param $cate the cate of new product
     * @param $price the price of new product
     * @param $star if the new product is a star product
     * @param $img the image of new product
     * @param $description the description of new product
     */
    public function addProductToSite($name, $cate, $price, $star, $img, $description){
        $query = 'INSERT INTO Products(Name, Price, Picture, IsStar, IdCategory, Description)
                  VALUES(:NameProduct, :Price, :Img, :Star, :Cate, :Description)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':NameProduct'=>$name, ':Price'=>$price, ':Img'=>$img, ':Star'=>$star, ':Cate'=>$cate, ':Description'=>$description));
    }

    /**
     * This function delete the basket stored in the database
     * @param $idUser id of user
     */
    public function resetBasketUser($idUser){
        $query = 'DELETE
                  FROM Basket
                  WHERE IdUser = :userId';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':userId'=>$idUser));
    }

    /**
     * This function return the list of orders of user $id
     * @param $idUser id of user
     * @return array with all order of user
     */
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

    /**
     * This function add a new order in the database for a user $id
     * @param $idUser id of user
     * @param $idProduct $id of product
     */
    public function addOrderToUser($idUser, $idProduct){
        $query = 'INSERT INTO Orders(IdUser, IdProduct)
                  VALUES(:idUser, :idProduct)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':idUser'=>$idUser, ':idProduct'=>$idProduct));
    }

    /**
     * This function return all product of category $idCategory
     * @param $idCategory id of category
     * @return array with all product of category $idCategory
     */
    public function getProductByCategory($idCategory){
        $query = 'SELECT *
                  FROM Products
                  WHERE IdCategory = :idCategory';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':idCategory'=>$idCategory));
        $products = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    /**
     * this function return all category
     * @return array with all category
     */
    public function getCategory(){
        $query = 'SELECT *
                  FROM Category';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute();
        $category = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $category;
    }

    /**
     * This function return a category with id = $idCategory
     * @param $idCategory id of category
     * @return array with all infos of category
     */
    public function getCategoryById($idCategory){
        $query = 'SELECT *
                  FROM Category
                  WHERE Id = :idCategory';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':idCategory' => $idCategory));
        $category = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $category;
    }

    /**
     * This function return all user rank
     * @return array with all user rank
     */
    public function getRank(){
        $query = 'SELECT *
                  FROM Rank';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute();
        $rank = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rank;
    }

    /**
     * This function delete a product of site in the database
     * @param $idProduct of product
     * @return bool state true if ok false if error
     */
    public function delProduct($idProduct){
        $query = 'DELETE
                  FROM Products
                  WHERE Id = :idProduct';
        $sql = $this->PDOInstance->prepare($query);
        $result = $sql->execute(array(':idProduct' => $idProduct));
        return $result;
    }

    /**
     * This function delete a user of site in the database
     * @param $idUser id of user
     * @return bool state true if ok false if error
     */
    public function delUser($idUser){
        $query = 'DELETE
                  FROM User
                  WHERE Id = :idUser';
        $sql = $this->PDOInstance->prepare($query);
        $result = $sql->execute(array(':idUser' => $idUser));
        return $result;
    }

    /**
     * This function delete a category of site in the database
     * @param $idCate id of category
     * @return bool state true if ok false if error
     */
    public function delCate($idCate){
        $query = 'DELETE
                  FROM Category
                  WHERE Id = :idCate';
        $sql = $this->PDOInstance->prepare($query);
        $result = $sql->execute(array(':idCate' => $idCate));
        return $result;
    }

    /**
     * This function delete a rank of site in the database
     * @param $idRank id of rank
     * @return bool state true if ok false if error
     */
    public function delRank($idRank){
        $query = 'DELETE
                  FROM Rank
                  WHERE Id = :idRank';
        $sql = $this->PDOInstance->prepare($query);
        $result = $sql->execute(array(':idRank' => $idRank));
        return $result;
    }

    /**
     * This function add a new category of the site
     * @param $name of new cate
     */
    public function addCateToSite($name){
        $query = 'INSERT INTO Category(Name)
                  VALUES(:NameCate)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':NameCate'=>$name));
    }

    /**
     * This function add new rank in the site
     * @param $name name of new rank
     */
    public function addRankToSite($name){
        $query = 'INSERT INTO Rank(Name)
                  VALUES(:NameRank)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':NameRank'=>$name));
    }

    /**
     * This function add a new user in the site
     * @param $name name of new user
     * @param $lastName laste name of new user
     * @param $email email of new user
     * @param $password password of new user
     * @param $img img of new user
     * @param $address address of new user
     * @param $rank rank of new user
     */
    public function addUserToSite($name, $lastName, $email, $password, $img, $address, $rank){
        $query = 'INSERT INTO User(Name, Password, Img, Address, LastName, Email, RankId)
                  VALUES(:Name, PASSWORD(:Password), :Img, :Address, :LastName, :Email, :RankId)';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':Name'=>$name, ':Password'=>$password, ':Img'=>$img, ':Address'=>$address, ':LastName'=>$lastName, ':Email'=>$email, ':RankId' =>$rank));
    }

    /**
     * This function update an existing product with id = $id
     * @param $name the new name of user
     * @param $price the new price of product
     * @param $img the new img of product
     * @param $star if the product is star
     * @param $id the id of product we want to update
     * @return bool state return true ou false
     */
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

    /**
     * This function get user with an id
     * @param $id id of user
     * @return array with infos of user
     */
    public function getUserById($id){
        $query = 'SELECT usr.Id, usr.Name, usr.Img, usr.Address, usr.LastName AS "usrLastName", usr.Email, usr.RankId, rk.Name AS "RankName" 
                  FROM User usr INNER JOIN Rank rk 
                  ON usr.RankId = rk.Id
                  WHERE usr.Id = :id';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':id'=>$id));
        $usr = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $usr;
    }

    /**
     * This function permit admin to update an user profile for change user rank for example.
     * The rank can't is updated by user just by admin user.
     * @param $name the new name of user
     * @param $lastName the new lastname of user
     * @param $address the new address of user
     * @param $img the new img of user
     * @param $rank the new rank of user
     * @param $mail the new email of user
     * @param $id id of user updated
     * @return bool state return true if it's ok or false
     */
    public function updateUserProfileAdm($name, $lastName, $address, $img, $rank, $mail, $id){
        $query = 'UPDATE User
                  SET Name=:name, LastName=:lastname, Email=:email, Address=:address, Img=:img, RankId=:rankId
                  WHERE Id = :id;';
        $sql = $this->PDOInstance->prepare($query);
        $sql->execute(array(':id'=>$id, ':name'=>$name, ':lastname'=>$lastName, ':email'=>$mail, ':address'=>$address, ':img'=>$img, ':rankId'=>$rank));
        if($sql->rowCount() >= 1){
            return true;
        }
        else{
            return false;
        }
    }
}