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

$('body').on('click','.add-input', function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    var nbr =  $('#'+id + ' .line-input').length;
    var idCategory =  $('#'+id).attr('data-id');
    var row = $('#'+id + ' .to-copy').clone().removeClass('to-copy');
    nbr++;

    row.find('input.option').attr('name', 'option-'+idCategory+'-'+nbr).val('');
    row.find('input.price').attr('name', 'price-'+idCategory+'-'+nbr).val('');
    row.find('input.desc').attr('name', 'desc-'+idCategory+'-'+nbr).val('');

    $('#'+id + ' .appendTo').append(row);

});

//Affiche option in add car blade
$('.add-option').on('click', function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    var el=$('#to-clone').clone().removeClass('hidden').attr('id','');
    var option=$('#option-select-'+id+' option:selected');
    var option_name = option.text();
    var option_id=option.attr('value');
    console.log(option_id);
    if(option_name != ""){

        el.find('p').text(option_name);
        el.find('input').attr('name', 'price-'+option_id).val('');
        $('#new_option_'+id).append(el);
        option.remove();
        var x =$('input[name=tab_option]:hidden').val();
        $('input[name=tab_option]:hidden').val(x+option_id+'-');
    }
});


// Affiche option in add option category blade
$('.nouvelle_option').on('click',function(e){
    e.preventDefault();
    var id=$(this).attr('data-id');
    var option=$('input[name=tab_option]:hidden').val();
    var el=$('#to-clone').clone().removeClass('hidden').attr('id','').addClass('row');
    var nb=$('.new-option .row').length;
    //console.log(option_id);

    el.find('input').attr('name','name-option-'+nb).val('');
    el.find('textarea').attr('name','description-option-'+nb ).val('');
    $(this).parent().parent().find('.new-option').append(el);

    $('input[name=tab_option]:hidden').val($('.new-option .row').length);

});

// AJAX




