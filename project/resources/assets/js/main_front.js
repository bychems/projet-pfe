
/****************************/
//INIT 
/****************************/
function Price(){
    $('.money').each(function () {
        var item = $.trim($(this).text()).replace(",", "").replace(",", "");
        var num = Number(item).toLocaleString('en');

        if (Number(item) < 0) {
            num = num.replace('-','');
            $(this).addClass('negMoney');
        }else{
            $(this).addClass('enMoney');
        }

        $(this).text(num);
    });
}

function toInt(price){
    return  parseInt($.trim(price).replace(",", "").replace(",", ""));
}
function addPrice(price){
    return '<span class="price">Prix : <span class="money">'+price+'</span><sup>DT</sup></span>';
}

function initCss(){
    var w = $(window).width();
    var h = $(window).height();

    var col_1 = $('.col-au-1').width();
    var col_2 = $('.col-au-2').width();
    var col_9 = w-col_1-col_2 ;

    $('.col-au-2, div.cars-list, .cars-details, .caracteristiques').css('height', h+ 'px' );
    $('ul.cars-list ').css('min-height', h  - 2+'px');
    $('.banner').css('height', h - 201+ 'px');
}
function owlInit(){
    var owl = $('.cars-details .car-item');
    owl.owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        pagination : true,


        navigationText : ['<i class="fa fa-chevron-left" style="margin-top: 5px">left</i>', '<i class="fa fa-chevron-right" style="margin-top: 5px >right</i>'],
        rewindNav : true,
        scrollPerPage : false
    });
}

function radioBox(){
    $("input[type='radio'], input[type='checkbox']").ionCheckRadio();
}

function openCategoryChoice() {
    $('.list-options-choice a').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('.options-details, .list-options-choice').hide();
        $('.options-details#options-'+id).fadeIn();
    });
}

/////////////////////////
$('body').on('click','.list-options-choice a', function(e){
    e.preventDefault();
    var id= $(this).data('id');
    var tab=list_cat[id].options;

    $('.validate').attr('data-id',id);
    $('.options-details , .list-options-choice').hide();
    $('.options-details').attr('id','options-'+id).fadeIn();

    $('.category').html(' <h4><img src="'+icone+'/'+list_cat[id].icone+'" alt=""> '+list_cat[id].name+'</h4>')

    console.log(list_cat[id].name);
    console.log(tab);
    $('.radio_div').html('');
    for (var i in tab)
    {   var radio=$('.radio_div').html();
        $('.radio_div').html(radio+'<p><label  class="icr-label"><input id="options-'+id+'" type="radio" name="'+list_cat[id].name+'" value="'+tab[i].name+' // '+tab[i].price+'">'+tab[i].name+'<span>'+tab[i].price+'</span></label></p>');
        console.log(i);

    }

});
/////////////////////////////

function returnToCategory() {
    $('.return').on('click', function(e){
        e.preventDefault();
        $('.options-details').hide();
        $('.list-options-choice').fadeIn();
    });
}

function validateOption() {
    $('.validate').on('click', function(e){
        e.preventDefault();

        var id = $(this).attr('data-id');
        var el = $('#options-'+id + ' input:checked');
        var x = el.length;


        var price = el.val().split("//");
        var a = $('.list-options-choice a[data-id="'+id+'"]');
        var car_price = toInt($('.car-price span').text());
        var oldSelected = 0 ;
        //FIND if there is a check or not before validate
        if (x==1){
            //check if there is an old option selected -- in order to remove the old price from the total
            if(a.find('.price span').length>0){
                oldSelected = toInt(a.find('.price span').text());
            }

            $('.options-details').hide();
            $('.list-options-choice').fadeIn();
            a.addClass('ok').find('.price').remove();
            a.append(addPrice(price[1]));
            $('.car-price span').text(car_price + toInt(price[1]) - oldSelected);
            Price();

        }else {
            alert('Vous devez sélectionner une option');
        }



        //ICI tu dois ajouter le prix de l'option dans ton calcule de devis
    });
}



function toggleMenu(){
    $('.toggle-menu').on('click', function(e){
        e.preventDefault();
        $('.menu-drop-left').toggleClass('on');
    });

    $('.close-menu').on('click', function(e){
        e.preventDefault();
        $('.menu-drop-left').removeClass('on');
    });

    $('.cars-model a').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');

        $('.cars-model a').removeClass('on');
        $(this).addClass('on');
        $('.col-au-2').hide();
        $('#cars-'+id).fadeIn();
    });



$('body').on('click','.finition a', function(e){
    e.preventDefault();
    console.log( $(this).data('id'));
    var id = $(this).data('id');
    var price = $(this).data('price');
    $('.car-price span').text( price );
    $('.cars-details').hide();
    $('.cars-details').attr('id','cars-details-'+id).fadeIn();
    Price();

    var getCategoriesRoute=routeCategories+id;
    $.ajax({
        url: getCategoriesRoute,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function (response) {
            console.log(response);
             list_cat=JSON.parse(response);
            console.log(list_cat);


            $('.list-options-choice').html('');
            for (var i in list_cat)
            {

                var img='';
                if(list_cat[i].icone!=''){
                    img='<img src="'+ icone + '/' +list_cat[i].icone +'" alt="">';
                }
                var text = $('.list-options-choice').html();
                $('.list-options-choice').html(text+'<li><a href="" data-id="'+i+'">'+img+'<p>'+list_cat[i].name+'</p></a></li>');

            }



        }
    });
});
}







$(document).ready(function(){
    //PLUGINS
    initCss();
    owlInit();
    radioBox();
    $('div.cars-list, .caracteristiques').mCustomScrollbar();


    //Perso
    openCategoryChoice();
    returnToCategory();
    validateOption();
    Price();
    toggleMenu();


})

/****************************/
//RESIZE
/****************************/
$(window).resize(function(){
    initCss();
})

//-------------- Append finition model -------------------- //
$('.modele_voiture').on('click',function(e) {
    e.preventDefault();

    var finition = $(this).attr('data-finition');
    var tab = JSON.parse(finition);
var id_model=$(this).attr('data-id');
    $('.cars-list ul').html('');
    $('.cars-list ul').parent().parent().parent().parent().attr('id','cars-'+id_model);
    for (var i in tab) {

        var text = $('.cars-list ul').html();
        $('.cars-list ul').html(text+'<li class="finition"><a href="" data-id="'+tab[i].id+'" data-price="'+tab[i].basic_price+'"><img src="' + icone + '/' +tab[i].icon_finition+'" alt=""><p>'+tab[i].finition+'</p></a></li>');

    }
});
