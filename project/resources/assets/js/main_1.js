/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/*
var person = {
    firstName: "Christophe",
    lastName: "Coenraets",
    blogURL: "http://coenraets.org"
};
var templateRow = "<h1>{{firstName}} {{lastName}}</h1>Blog: {{blogURL}}";

var html = Mustache.to_html(templateRow, person);
$('#sampleArea').append(html);
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

$('.suppOp').on('click',function(e){
    e.preventDefault();

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


/*
$('.form_cat').on('submit', function(e){
    console.log('eeeee');
    var parent = $(this).parent();
    var id= parent.find(input).attr('name','id_cat').val();
    e.preventDefault();

    var x  = $( this ).serialize();

    $.ajax({
        url: deleteCat+'/'+id,
        type: 'delete',
        data: x,
        dataType: 'text',
        success: function(response) {

            parent.remove();

        },
        fail: function(response) {
        }
    });
});

*/




$('.form-options').on('submit', function(e){
    var amo = $(this).find('.new_option');
    var parent = $(this).find('.ajax');
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

/*$('.suppCat').on('click', function(e){

    e.preventDefault();

    var id=$(this).attr('data-id');
    var Route=DeleteRoute+id;
    console.log(Route);
    $.ajax({
        url: Route,
        type: 'DELETE',
        data: '',
        dataType: 'text',
        success: function(response) {
console.log(response);
        },
        fail: function(response) {
        }
    });
});

$('.suppOpt').on('click', function(e){

    e.preventDefault();

    var id=$(this).attr('data-id');
    var Route=DeleteRoute+id;
    console.log(Route);
    $.ajax({
        url: Route,
        type: 'DELETE',
        data: '',
        dataType: 'text',
        success: function(response) {

        },
        fail: function(response) {
        }
    });
});*/


if($('.datepicker').length>0){
    $('.datepicker').datepicker()
}
