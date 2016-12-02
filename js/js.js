/**
 * Created by cyril on 16/10/16.
 */

$(document).ready(function(){
    console.log("document is ready");

    $(".button-collapse").sideNav();

    $('.modal-trigger').leanModal();

    $('select').material_select();

    $('.parallax').parallax();
});

var addBasket = function($product) {
    console.log($product);

    $.ajax({
        url: 'ajaxResponse/addToBasket.php',
        type: "POST",
        data: {function: 'addBasket', functionName: 'addBasket', param: $product},
        success: function (obj, textstatus) {
            console.log(obj);
            console.log(textstatus);
            if(textstatus == 'success'){
                console.log(textstatus);
                Materialize.toast('Product add at your basket', 4000)
            }
        }
    });
};

var orderProduct = function($product) {
    console.log($product);

    $.ajax({
        url: 'ajaxResponse/orderProduct.php',
        type: "POST",
        data: {function: 'addBasket', functionName: 'orderProduct', param: $product},
        success: function (obj, textstatus) {
            //console.log(obj);
            console.log(textstatus);
            if(textstatus == 'success'){
                console.log(textstatus);
                console.log("redirect");
                window.location.replace("order.php");
            }
        }
    });
};

var delItemBasket = function($productId) {
    console.log($productId);

    $.ajax({
        url: 'basket.php',
        type: "POST",
        data: {function: 'test', param: $productId},
        success: function (obj, textstatus) {
            //console.log(obj);
            console.log(textstatus);
            if(textstatus == "success"){
                location.reload();
            }
        }
    });
};

var delItemSite = function(idProduct){
    console.log(idProduct);

    $.ajax({
        url: 'ajaxResponse/delProductSite.php',
        type: "POST",
        data: {function: 'delProduct', param: idProduct},
        success: function (obj, textstatus) {
            console.log(obj);
            console.log(textstatus);
            if(textstatus == "success"){
                Materialize.toast('Product '+ idProduct +' removed', 4000)
                location.reload();
            }
        }
    });
};

var delUserSite = function($idUser){
    console.log($idUser);

    $.ajax({
        url: 'ajaxResponse/delUserSite.php',
        type: "POST",
        data: {function: 'delUser', param: $idUser},
        success: function (obj, textstatus) {
            console.log(obj);
            console.log(textstatus);
            if(textstatus == "success"){
                Materialize.toast('User '+ $idUser +' removed', 4000);
                location.reload();
            }
        }
    });
};

var delCateSite = function($idCate){
    console.log($idCate);

    $.ajax({
        url: 'ajaxResponse/delCateSite.php',
        type: "POST",
        data: {function: 'delCate', param: $idCate},
        success: function (obj, textstatus) {
            console.log(obj);
            console.log(textstatus);
            if(textstatus == "success"){
                Materialize.toast('User '+ $idCate +' removed', 4000);
                location.reload();
            }
        }
    });
};

var delRankSite = function($idRank){
    console.log($idRank);

    $.ajax({
        url: 'ajaxResponse/delRankSite.php',
        type: "POST",
        data: {function: 'delCate', param: $idRank},
        success: function (obj, textstatus) {
            console.log(obj);
            console.log(textstatus);
            if(textstatus == "success"){
                Materialize.toast('User '+ $idRank +' removed', 4000);
                location.reload();
            }
        }
    });
};