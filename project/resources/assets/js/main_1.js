/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* last add-cars
$('body').on('click','.add-input', function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    var nbr =  $('#'+id + ' .line-input').length;
    var idCategory =  $('#'+id).attr('data-id');
    var row = $('#'+id + ' .to-copy').clone().removeClass('to-copy');
    nbr++;
    //console.log(nbr);
    row.find('select.option').attr('name', 'option-'+idCategory+'-'+nbr).val('');
    row.find('input.price').attr('name', 'price-'+idCategory+'-'+nbr).val('');
    row.find('input.desc').attr('name', 'desc-'+idCategory+'-'+nbr).val('');

    $('#'+id + ' .appendTo').append(row);

});
*/

////AJOUT DES CHAMPS POUR AJOUTER LE PRIX D'UNE OPTION
$('.add-option').on('click',function(e){
  e.preventDefault();
  var id_cat=$(this).attr('data-id');
  var option=$('select[name=option-'+id_cat+'] option:selected');
  var option_name = option.text();
  var option_id = option.attr('value');
  var el=$('#to-clone').clone().removeClass('hidden').attr('id','').addClass('row');
  var nb=$('#new_option_'+id_cat +' .row').length;
  console.log(option_id);
 if($('select[name=option-'+id_cat+'] option').length != 0){
    nb++;
   // console.log(nb, '#new_option_'+id_cat +' .row');
    el.find('p').text(option_name);
    //el.find('input').attr('name','price-'+id_cat+'-'+option_id).val('');
    el.find('input').attr('name','price-'+option_id).val('');
    $('#new_option_'+id_cat).append(el);
    var x =$('input[name=tab_option]:hidden').val(); 
      $('input[name=tab_option]:hidden').val(x+option_id+'-');
        //var tab =
       //var id=tab.val();
       //tab.value = id+option_id;
       option.remove();
 }
});

//--------AJOUT DES CHAMPS POUR AJOUTER UNE NOUVELLE OPTION SOUS UNE NOUVELLE CATEGORIE
$('.nouvelle_option').on('click',function(e){
  e.preventDefault();
  var amo = $(this).parent().parent().find('.new_option');
  var el=$('#to-clone').clone().removeClass('hidden').attr('id','').addClass('row');
  var nb=amo.find('.row').length;
  
    el.find('input.name').attr('name','name_option_'+nb).val('');
    el.find('textarea.description').attr('name','description_option_'+nb).val('');
    amo.append(el);
    $('input[name=tab_option]:hidden').val(amo.find('.row').length);
});


//--------AJOUT DES CHAMPS POUR AJOUTER UNE NOUVELLE OPTION SOUS UNE CATEGORIE EXISTANTE
$('.option_nouvelle').on('click',function(e){
    e.preventDefault();
    var amo = $(this).parent().parent().find('.new_option');
    var el=$('#to-clone').clone().removeClass('hidden').attr('id','').addClass('row');
    var nb=amo.find('.row').length;

    el.find('input.name').attr('name','name_option_'+nb).val('');
    el.find('textarea.description').attr('name','description_option_'+nb).val('');
    amo.append(el);
    $('input[name=nb_option]:hidden').val(amo.find('.row').length);
    var enregistrer=$(this).parent().find('.btn.btn-success.pull-right');
    enregistrer.css('visibility','visible');
});


//$(el).css('visibility', 'hidden');
//$(el).css('visibility', 'visible');
//$(el).css('background', 'red');
//$(el).css({'background': 'red', 'border':'1px solid #000'});


/*SELECTION element avec class .
avec id #
balise div
$('.add-input').on('click', function(){});
$(this) refer to element clicked
 e.preventDefault(); do my work not yours
console.log debugueur js
clone() function copy html
PARENT.append('fils'); -> <parent> fils </parent>
*/

// prepare the form when the DOM is ready


$('.form-options').on('submit', function(e){
    var amo = $(this).find('.new_option');
    var parent = $(this).find('.ajax');
    var enregistrer=$(this).find('.pull-right');
    enregistrer.css('visibility','hidden');
    e.preventDefault();

    var x  = $( this ).serialize();

    $.ajax({
        url: route,
        type: 'POST',
        data: x,
        dataType: 'text',
        success: function(response) {
            amo.children('.row').each(function(){
                var x = $(this).find('input').val();
                var y = $(this).find('textarea').val();
                cloneAjax(x,y,parent);
            });
            amo.html('');
        },
        fail: function(response) {
        }
    });
});
function cloneAjax(x,y,parent){
    var el = $('#ajax-clone').clone().removeClass('hidden').attr('id','');
    el.find('p.name').append(x);
    el.find('p.desc').append(y);

    $(parent).append(el);
}


//-----MODIFIER DISPONIBILTE JOUR TEST DRIVE
$('.modifier').on('click', function(e){

    e.preventDefault();
    var id=$(this).attr('data-id');
    var Route=hoursRoute+id;
    $.ajax({
        url: Route,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function(response) {
            console.log(response);
        },
        fail: function(response) {

        }
    });
});


//--------SUPPRIMER CATEGORIE
$('.suppCat').on('click', function(e){

    e.preventDefault();
    var token = $(this).data('token');
    var id=$(this).attr('data-id');

    var Route=DeleteCatRoute+id;
    console.log(Route);
    $.ajax({
        url: Route,
        type: 'post',
        data: {_method: 'delete', _token :token},
        success: function(response) {
            $("."+id).remove();
        },
        fail: function(response) {

        }
    });
});


//--------SUPPRIMER OPTION
$('.suppOpt').on('click', function(e){

    e.preventDefault();
    var token = $(this).data('token');
    var id=$(this).attr('data-id');
    var Route=DeleteOptRoute+id;
    console.log(Route);
    $.ajax({
        url: Route,
        type: 'post',
        data: {_method: 'delete', _token :token},
        success: function(response) {
           $(".op"+id).remove();
        },
        fail: function(response) {

        }
    });
});


//AFFICHAGE DATEPICKER
if($('.datepicker-drive').length>0){
    $('.datepicker-drive').datepicker()
}

$('.list-group-item').on('click', function(e){
    var current;
    var activate = function(el) {
        if (current) {
            current.classList.remove('active');
        }
        current = el;
        el.classList.add('active');
    }
});

//////////////////////////////////////
/*var tabchecked = new Array();
$('.opt-checked').on('change',function(e) {
    e.preventDefault();
    tabchecked[tabchecked.length] = 'Categorie: '+$(this).attr('data-category')+', Option: '+$(this).attr('data-name')+', Description: '+$(this).attr('data-description')+', Prix: '+$(this).attr('data-price');
    console.log(tabchecked);
});*/




//---------------DEVIS---------------------//
$('.create-devis').on('click',function(e) {
    e.preventDefault();
    data =  {};
    obj =  {};
    var i = 0;

   $('.btn-group').each(function(){

       i++;
       data[i] =  {};
       $(this).addClass('test'+i);

       var el    = $(this).find('.active').find('input');
       data[i]['name'] = el.data('name');
       data[i]['desc'] = el.data('description');
       data[i]['price']  = el.data('price');
   });

    //console.log(data);
    var prix_tot=0;
    var json_obj = $.parseJSON(JSON.stringify(data));
    console.log(data);
    $('#list_options').val(JSON.stringify(data));
    for(var i in json_obj)
    {
       var name =  json_obj[i].name;
       var desc =  json_obj[i].desc;
       var price = json_obj[i].price;
        prix_tot=prix_tot+price;
       $('.table .table_option').append('<tr><td>'+name+'</td><td>'+desc+'</td><td>'+price+' DT</td></tr>');
    }

    var prix_totale_option = $(this).parent().parent().find('.prix_tot_opt');
    prix_totale_option.text(prix_tot+'DT');
    $('#prix_options').val(prix_tot);

    var prix_basique=$(this).attr('data-price-car');
    console.log(prix_basique);
    var prix_tot_car=parseInt(prix_tot)+(parseInt(prix_basique)*1.18+236.500+500+0.500);

    var prix_totale_voiture = $(this).parent().parent().find('.prix_tot_car');
    prix_totale_voiture.text(prix_tot_car+'DT');
    //var el=$('#to-clone').clone().removeClass('hidden').attr('id','').addClass('row');
    //var nb=amo.find('.row').length;

    //el.find('input.name').attr('name','name_option_'+nb).val('');
    //el.find('textarea.description').attr('name','description_option_'+nb).val('');


});


//------------ CHECK CONNECTION -----------------//
function checkConx(){
    var res = 'false';
    data={};
    $.ajax({
        url: 'http://audi-tunisie.tn/teasing/controllers/submit.php',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function(data, textStatus, xhr) {

            if(xhr.status==200){
                res = ' true';
            }
            console.log(res) ;

        },
        error: function(data, textStatus, xhr) {
            console.log(res) ;
        }
    });

}


//---------------- CALENDRIER ------------------//

$('.supprimer').on('click', function(e){

    e.preventDefault();

    var id=$(this).attr('data-id');
    var Route=suppdayRoute+id;
    $.ajax({
        url: Route,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function(response) {
            $( "."+id ).remove();
        },
        fail: function(response) {
        }
    });
});

var datepicker  = $('#datetimepicker12');
var datepickerTD  = $('#datetimepicker12 td');

datepicker.on('click', '.day:not(.disabled)', function(e){
    e.preventDefault();
    datepickerTD.removeClass('clicked')
    $(this).addClass('clicked');
    var dates=$(this).attr('data-day');
    $('.showDate').html(dates);
    dates=dates.replace('/','-');
    dates=dates.replace('/','-');
    var Route=idDayRoute+dates+'/'+carid;
    $.ajax({
        url: Route,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function(response) {
            var json_obj = $.parseJSON(response);
            var id;
            var state;
            // if($.inArray(i, tabheurs)==0)
            for(var j=9;j<=16;j++)
            {
                $('.h-'+j).removeClass('disabled').find('input').attr('disabled', false).attr('checked',false) ;
                $('.h-'+j).find('span').html('');
            }
            for (var i in json_obj)
            {   if(json_obj[i].state=='false')
            {
                state='(non disponible)';
            }
            else
            {
                state='(r&eacute;serv&eacute;e)';
            }
                $('.h-'+json_obj[i].h).addClass('disabled').find('input').attr('disabled', true) ;

                id=json_obj[i].id;
                var  phrase  = "";
                var btn;
                if(json_obj[i].state == "true"){
                    phrase =  json_obj[i].line + ' ' + json_obj[i].attach_name;
                }
                if(json_obj[i].line == "Par") {
                    $('.h-' + json_obj[i].h).find('span').html(state + "<a href=" + detailUserRoute + json_obj[i].attach_id + ">" + phrase + "</a>");
                }
                else if(json_obj[i].line == "Pour")
                {
                    $('.h-' + json_obj[i].h).find('span').html(state + "<a href=" + detailCustomerRoute + json_obj[i].attach_id + ">" + phrase + "</a>");
                }


                if(json_obj[i].annuler == "true")
                {  btn=$('#btn-anuuler').clone().removeClass('hidden');
                    $('.h-'+json_obj[i].h).find('span').append(btn);
                }

                console.log(json_obj[i].annuler);

            }
            $('.day_id').val(id);
            $('.supprimer').attr('data-id',id);

            //json_obj[i].state
            /* for(var i in json_obj)
             {}*/
        },
        fail: function(response) {

        }
    });
});
// console.log(dates);

datepicker.on('control space', function(e){
    $('#datetimepicker12 td').attr('data-action', '');
});
datepickerTD.attr('data-action', '');


if($('.owl-carousel').length>0){
    $('.owl-carousel').owlCarousel({
        stagePadding: 0,
        loop:false,
        margin:10,
        nav:true,
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        autoplay:true,
        autoHeight:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });
}