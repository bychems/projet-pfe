$('.add-option').on('click',function(e){
    e.preventDefault();
    var id_cat=$(this).attr('data-id');
    var option=$('select[name=option-'+id_cat+'] option:selected');
    var option_name = option.text();
    var option_id = option.attr('value');
    var el=$('#to-clone').clone().removeClass('hidden').attr('id','').addClass('row');
    var nb=$('#new_option_'+id_cat +' .row').length;
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
    console.log($('form').attr('action'));
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
// prepare the form when the DOM is ready
$('.form-options').on('submit', function(e){
    var amo = $(this).find('.new_option');
    var parent = $(this).find('.ajax');
    e.preventDefault();
    var i=0;
    var x  = $( this ).serialize();
    $.ajax({
        url: route,
        type: 'POST',
        data: x,
        dataType: 'text',
        success: function(response) {
            var tab = $.parseJSON(response);
            amo.children('.row').each(function(){
                var x = $(this).find('input').val();
                var y = $(this).find('textarea').val();
                //console.log(tab[i]);
                cloneAjax(x,y,parent,tab[i]);
                i++;
            });
            amo.html('');
        },
        fail: function(response) {
        }
    });
});
function cloneAjax(x,y,parent,tab){
    var el = $('#ajax-clone').clone().removeClass('hidden').attr('id','');
    el.find('p.name').append(x);
    el.find('p.desc').append(y);
    //var url=el.find('form.form-delete-option').attr('action');
    //el.find('form.form-delete-option').attr('action',url.slice(0,-1)+tab);
    el.find('button.suppOp').attr('data-id',tab);
    $(parent).append(el);
}

/*
$('body').on('click','.suppOp',function (e){
    e.preventDefault();

    var id=$(this).attr('data-id');
    var Route=suppOpRoute+id;
    var res= $(this).parent();

    $.ajax({
        url: Route,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function(response) {
            res.parent().remove();

        },
        fail: function(response) {
        }
    });
});
*/
/*
$('.suppCat').on('click',function (e){
    e.preventDefault();

    var id=$(this).attr('data-id');
    var Route=suppCatRoute+id;
    var res= $(this).parent();

    $.ajax({
        url: Route,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function(response) {
            res.parent().parent().parent().remove();

        },
        fail: function(response) {
        }
    });
});

*/

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
       if($(this).find('.active').length!=0) {
           console.log('trueeeee');
           i++;
           data[i] = {};
           $(this).addClass('test' + i);

           var el = $(this).find('.active').find('input');
           data[i]['name'] = el.data('name');
           data[i]['desc'] = el.data('description');
           data[i]['price'] = el.data('price');
           data[i]['id'] = el.data('id');
       }
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


    $('.prix_tot_opt').text(prix_tot+'DT');
    $('#prix_options').val(prix_tot);

    var prix_basique=$(this).attr('data-price-car');
    console.log(prix_basique);
    var prix_tot_car=parseInt(prix_tot)+(parseInt(prix_basique)*1.18+236.500+500+0.500);

    var prix_totale_voiture = $(this).parent().parent().find('.prix_tot_car');
    prix_totale_voiture.text(prix_tot_car+'DT');
    $('#total_price_car').val(prix_tot_car);

    $(this).addClass('hidden');


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

//-------------- BOUTON ANNULER SEANCE TEST DRIVE ----------------------- //
$('body').on('click','.btn-cancel', function(e){

    e.preventDefault();

    var id=$(this).attr('data-id');
    var Route=cancelHourRoute+carid+'/'+id;
    var res= $(this).parent();
    //console.log(route)
    $.ajax({
        url: Route,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function(response) {
            res.parent().removeClass('disabled')
                .find('input').attr('disabled', false);
            res.html('');

        },
        fail: function(response) {
        }
    });
});


//----------------------------------------------


var datepicker  = $('#datetimepicker12');
var datepickerTD  = $('#datetimepicker12 td');


$('body').on('click', '#datetimepicker12 .day:not(.disabled)', function(e){
    e.preventDefault();
    $('.bloc').fadeOut();
    $('.chooseDate').remove();
    $('#datetimepicker12 td').removeClass('clicked')
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
                state='(r&eacuteserv&eacute;e)';
            }
                $('.h-'+json_obj[i].h).addClass('disabled').find('input').attr('disabled', true) ;

                id=json_obj[i].id;
                var  phrase  = "";
                var btn;
                if(json_obj[i].state == "true"){
                    phrase =  json_obj[i].line + ' ' + json_obj[i].attach_name;
                }
                $('.h-'+json_obj[i].h).find('span').html(state + ' '+ phrase);
                if(json_obj[i].annuler == "true")
                {  btn=$('.btn-cancel.hidden').clone().removeClass('hidden').attr('data-id',''+json_obj[i].id_hour+'');////.attr('data-id',''+json_obj[i].id+'');
                    $('.h-'+json_obj[i].h).find('span').append(btn);
                }

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


if($('.datepicker-drive').length>0){
    $('.datepicker-drive').datepicker();
}


/*if($('.owl-carousel').length>0){
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
}*/
if($('.owl-carousel').length>0) {
    $('.owl-carousel').owlCarousel({
        autoPlay: 3000,
        navigation: true, // Show next and prev buttons
        slideSpeed: 900,
        paginationSpeed: 900,
        singleItem: true,
        pagination: false,
        navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        transitionStyle: 'backSlide',
        stopOnHover: true
    });
}


////------------------ OFFLINE METHODS --------------///

function getForm(id){
    var obj = {};
    console.log(id);
    $(id+" input[type='text']").each(function(){
        var key = $(this).attr('name');
        var val = $(this).val();
        obj[key]=val;
    });
    return obj;
    console.log(obj);
}



// ----------------- BOUTON AJOUT CLIENT ---------------- //

$('#form_customer .save').on('click', function(e){
    e.preventDefault();

    var id_form='#form_customer';

    if(navigator.onLine){
        console.log("connected");
        storeCustomerOnline(id_form);
    }
    else{
        console.log("not connected");
        storeCustomerOffline(id_form);
    }
});


// --------- FONCTION AJOUT CLIENT ONLINE ----------- //

function storeCustomerOnline(id){

    var x  = $(id).serialize();

    $.ajax({
        url: storeCustomerRoute,
        type: 'POST',
        data: x,
        dataType: 'text',
        success: function(response) {
            $.ambiance({message: "Client Ajout&eacute;",
                title: "Success!",
                type: "success"});

        },
        error: function(response) {

        }
    });
}

// --------- FONCTION AJOUT CLIENT LOCALSTORAGE OFFLINE ----------- //

var c=1;
function storeCustomerOffline(id){

    var x=JSON.stringify(getForm(id));
    var test=localStorage.getItem("nb_c");
    if(test==null){
        localStorage.setItem("nb_c", c);
        var cust=localStorage.getItem("nb_c");

        localStorage.setItem("customer-"+cust, x);
        cust++;
        c++;

    }else
    {
        test++;
        localStorage.setItem("customer-"+test, x);
        localStorage.setItem("nb_c", test);
    }
    $.ambiance({message: "Ajout Client Effectu&eacute; (Local Storage)",
        title: "Success!",
        type: "success"});


}

/////////////// CHECKBOX NEW CUSTOMER ////////////////////
$('.chk_new_customer').on('change', function(e) {
    e.preventDefault();
    if($(this).prop('checked')){
        $('#new_customer_div').removeClass('hidden');
        $('.select_customer').addClass('hidden');
        $('.chk_new_customer').val(1);
    }
    else{
        $('#new_customer_div').addClass('hidden');
        $('.select_customer').removeClass('hidden');
        $('.chk_new_customer').val(0);
    }
});


///////////////-------------------- DEVIS OFFLINE---------------------///////////////////////



function getDevis(classFormCustomer) {
    var obj_devis = {};
    var obj_customer = {};
    var obj_devis_client = {};
    obj_devis_client.clients = {};
    obj_devis_client.devis = {};


    if ($('.chk_new_customer').prop('checked')) {
        var key = $('#id_car').attr('name');
        var val = $('#id_car').val();
        obj_devis[key] = val;

        var key = $('#car_finition').attr('name');
        var val = $('#car_finition').val();
        obj_devis[key] = val;

        var key = $('#basic_price').attr('name');
        var val = $('#basic_price').val();
        obj_devis[key] = val;

        var key = $('#tva').attr('name');
        var val = $('#tva').val();
        obj_devis[key] = val;

        var key = $('#frais_imm').attr('name');
        var val = $('#frais_imm').val();
        obj_devis[key] = val;

        var key = $('#tme').attr('name');
        var val = $('#tme').val();
        obj_devis[key] = val;

        var key = $('#frais_timbre').attr('name');
        var val = $('#frais_timbre').val();
        obj_devis[key] = val;

        var key = $('#prix_options').attr('name');
        var val = $('#prix_options').val();
        obj_devis[key] = val;

        var key = $('#total_price_car').attr('name');
        var val = $('#total_price_car').val();
        obj_devis[key] = val;

    //Objet liste option
        var i = 0;
        $('.btn-group').each(function(){
            if($(this).find('.active').length!=0) {
                i++;
                data[i] = {};
                $(this).addClass('test' + i);

                var el = $(this).find('.active').find('input');
                data[i]['name'] = el.data('name');
                data[i]['desc'] = el.data('description');
                data[i]['price'] = el.data('price');
                data[i]['id'] = el.data('id');
            }
        });
        var key = $('#list_options').attr('name');
        var val = data;
        obj_devis[key] = val;

    //Get new customer form
       $(classFormCustomer + " input[type='text']").each(function () {
            var key = $(this).attr('name');
            var val = $(this).val();
            obj_customer[key] = val;
        });


        obj_devis_client.clients =obj_customer;
        obj_devis_client.devis = obj_devis;
        return obj_devis_client;

    }else{
        //ID CAR
        var key = $('#id_car').attr('name');
        var val = $('#id_car').val();
        obj_devis[key] = val;

        var key = $('#car_finition').attr('name');
        var val = $('#car_finition').val();
        obj_devis[key] = val;

        var key = $('#basic_price').attr('name');
        var val = $('#basic_price').val();
        obj_devis[key] = val;

        var key = $('#tva').attr('name');
        var val = $('#tva').val();
        obj_devis[key] = val;

        var key = $('#frais_imm').attr('name');
        var val = $('#frais_imm').val();
        obj_devis[key] = val;

        var key = $('#tme').attr('name');
        var val = $('#tme').val();
        obj_devis[key] = val;

        var key = $('#frais_timbre').attr('name');
        var val = $('#frais_timbre').val();
        obj_devis[key] = val;

        var key = $('#prix_options').attr('name');
        var val = $('#prix_options').val();
        obj_devis[key] = val;

        var key = 'name_customer';
        var val = $('#id_customer option:checked').text();;
        obj_devis[key] = val;


        //ID CUSTOMER
        var key = $('#id_customer').attr('name');
        var val = $('#id_customer').val();
        obj_devis[key] = val;

        //LIST OPTION
        var i = 0;
        $('.btn-group').each(function(){
            if($(this).find('.active').length!=0)
            {
            i++;
            data[i] =  {};
            $(this).addClass('test'+i);

            var el    = $(this).find('.active').find('input');
            data[i]['name'] = el.data('name');
            data[i]['desc'] = el.data('description');
            data[i]['price']  = el.data('price');
            }
            });
        var key = $('#list_options').attr('name');
        var val = data;
        obj_devis[key] = val;

        //PRIX TOTAL VOITURE
        var key = $('#total_price_car').attr('name');
        var val = $('#total_price_car').val();
        obj_devis[key] = val;

        return obj_devis;
    }
}




//------------------------ BOUTON CREER DEVIS ------------------ //
$('.send_quotation').on('click', function(e){


    var contenu_new_customer='.contenu';

    if(navigator.onLine){
        console.log("connected");

        storeDevisOnline();
    }
    else{
        e.preventDefault();
        console.log("not connected");
        storeDevisOffline(contenu_new_customer);
    }
});




//------------------------ STORE DEVIS ONLINE ------------------ //
function storeDevisOnline(){

    var x  = $('.form-devis').serialize();
    console.log(x);

    $.ajax({
        url: storeDevisRoute,
        type: 'POST',
        data: x,
        dataType: 'text',
        success: function(response) {
           console.log(response);

        },
        error: function(response) {
            console.log("false");
        }
    });
}




var dc=1;
var d=1;

//------------------------ STORE DEVIS OFFLINE ------------------ //
function storeDevisOffline(classFormCustomer){


    var dev=JSON.stringify(getDevis(classFormCustomer));

    if ($('.chk_new_customer').prop('checked')) {
        var test=localStorage.getItem("nb_dc");
        if(test==null){
            localStorage.setItem("nb_dc", dc);
            var nb_dev_cust=localStorage.getItem("nb_dc");

            localStorage.setItem("dc-"+nb_dev_cust, dev);
            nb_dev_cust++;
            dc++;
            $.ambiance({message: "Ajout Devis Client Effectu&eacute; (Local Storage)",
                title: "Success!",
                type: "success"});
        }else
        {
            test++;
            localStorage.setItem("dc-"+test, dev);
            localStorage.setItem("nb_dc", test);
            $.ambiance({message: "Ajout Devis Client Effectu&eacute; (Local Storage)",
                title: "Success!",
                type: "success"});
        }


    }else{

        var test=localStorage.getItem("nb_d");
        if(test==null){
            localStorage.setItem("nb_d", d);
            var nb_dev=localStorage.getItem("nb_d");

            localStorage.setItem("devis-"+nb_dev, dev);
            nb_dev++;
            d++;
            $.ambiance({message: "Ajout Devis Effectu&eacute; (Local Storage)",
                title: "Success!",
                type: "success"});
        }else
        {
            test++;
            localStorage.setItem("devis-"+test, dev);
            localStorage.setItem("nb_d", test);
            $.ambiance({message: "Ajout Devis Effectu&eacute; (Local Storage)",
                title: "Success!",
                type: "success"});
        }
    }
}



// ------------------------------------- NEW CUSTOMERS OFFLINE --------------------------------------------------- //

function getNewCustomers(){
    var i;
    var nb_c=localStorage.getItem('nb_c');

    for(i=1;i<=nb_c;i++){
        var client=localStorage.getItem('customer-'+i);
        if(client==null){
            var j=i+1;
            client=localStorage.getItem('customer-'+j);
        }

        var json_obj = $.parseJSON(client);

        $('.table_new_customer').append('<tr><td class="milieu">'+json_obj.name+'</td>' +
            '                                <td class="milieu">'+json_obj.last_name+'</td>' +
            '                                <td class="milieu"><form class="form_save_customer_offline" action="'+addCustomerRoute+'" method="post"><input type="hidden" name="hidden_customer" value='+client+'><input type="hidden" name="_token" value="'+token+'"><button type="submit" class="btn btn-success btn-sm">Sauvegarder</button><button class="btn btn-danger btn-sm supp_nouv_client" data-key="customer-'+i+'">Supprimer</button></form></td></tr>');
    }
    $('.save_all_customers').removeClass('hidden');

}



// ------------------- BOUTON SUPPRIMER NOUVEAU CLIENT -------------------- //


$('body').on('click','.supp_nouv_client', function(e){
    e.preventDefault();
    client=$(this).attr('data-key');
    var nb_c=localStorage.getItem('nb_c');
    nbr_client=client.substr(9,1);
    console.log(nbr_client);

    for(var i=nbr_client;i<nb_c;i++){
        var j=i; j++;
        oldC=localStorage.getItem('customer-'+j);

        newC=localStorage.setItem('customer-'+i,oldC);
        console.log(oldC);
    }
    console.log(i);
    localStorage.removeItem('customer-'+i);


    test=nb_c--;
    localStorage.setItem("nb_c", nb_c--);

    $(this).parent().parent().parent().remove();
    $.ambiance({message: "Client Supprim&eacute;",
        type: "error",
        fade: false});
});

// ------------------- BOUTON ENREGISTRER NOUVEAU CLIENT -------------------- //

$('body').on('submit','.form_save_customer_offline', function(e){
    e.preventDefault();
    var x  = $(this).serialize();
    console.log(x);
    var y=$(this);
    $.ajax({
        url: addCustomerRoute,
        type: 'POST',
        data: x,
        dataType: 'text',
        success: function(response) {
            console.log(response);

            if(response=='true') {

                client = $('.supp_nouv_client').attr('data-key');
                var nb_c = localStorage.getItem('nb_c');
                nbr_client = client.substr(9, 1);
                console.log(nbr_client);
                for (var i = nbr_client; i < nb_c; i++) {
                    var j = i;
                    j++;
                    oldC = localStorage.getItem('customer-' + j);
                    newC = localStorage.setItem('customer-' + i, oldC);
                    console.log(oldC);
                }
                console.log(i);
                localStorage.removeItem('customer-' + i);
                test = nb_c--;
                localStorage.setItem("nb_c", nb_c--);
                y.parent().parent().remove();
                $.ambiance({
                    message: "Client Ajout&eacute;",
                    title: "Success!",
                    type: "success"
                });
            }else{
                $.ambiance({message: "Cin du nouveau client existe d&eacute;ja!",
                    type: "error",
                    fade: false});
            }


        },
        error: function(response) {
            console.log(response);
        }
    });
});



// ----------- BOUTON ENREGISTRER "TOUT" NOUVEAU CLIENT OFFLINE ------------ //

$('.save_all_customers').on('click',function(e){
    console.log('rre');
    e.preventDefault();
    $('.table tbody').each(function(){
        $('.form_save_customer_offline').trigger("submit");

    });

});


// ------------------------------------ NEW QUOTATIONS OFFLINE ----------------------------------------------------- //

function getNewQuotations(){
    var i;
    var nb_d=localStorage.getItem('nb_d');

    for(i=1;i<=nb_d;i++){
        var devis=localStorage.getItem('devis-'+i);
        var json_obj = $.parseJSON(devis);

        $('.table_new_quotation').append('<tr><td class="milieu">'+json_obj.name_customer+'</td>' +
            '                                <td class="milieu">'+json_obj.car_finition+'</td>' +
            '                                <td class="milieu">'+json_obj.prix_total_voiture+'</td>'+
            '                                <td class="milieu"><form class="form_save_devis_offline" action="'+addQuotationRoute+'" method="post"><input type="hidden" name="hidden_quotation" class="json_dev"><input type="hidden" name="_token" value="'+token+'"><button type="submit" class="btn btn-success btn-sm">Sauvegarder & Envoyer</button><button class="btn btn-danger btn-sm supp_nouv_devis" data-key="devis-'+i+'">Supprimer</button></form></td></tr>');
        $('.table_new_quotation tr').last().find('.json_dev').val(devis);

    }


    var j;
    var nb_dc = localStorage.getItem('nb_dc');

    for (j = 1; j <= nb_dc; j++) {
        var customer_devis = localStorage.getItem('dc-' + j);
        var devis_cust = $.parseJSON(customer_devis);

        $('.table_new_quotation').append('<tr><td class="milieu"> ' + devis_cust.clients.name + ' ' + devis_cust.clients.last_name + '</td>' +
            '                                <td class="milieu">' + devis_cust.devis.car_finition + '</td>' +
            '                                <td class="milieu">' + devis_cust.devis.prix_total_voiture + '</td>' +
            '                                <td class="milieu"><form class="form_save_devis_offline" action="' + addQuotationRoute + '" method="post"><input type="hidden" name="hidden_quotation_customer" class="json_dev_cust"><input type="hidden" name="_token" value="' + token + '"><button type="submit" class="btn btn-success btn-sm">Sauvegarder & Envoyer</button><button class="btn btn-danger btn-sm supp_nouv_devis_client" data-key="dc-'+j+'">Supprimer</button></form></td></tr>');
        $('.table_new_quotation tr').last().find('.json_dev_cust').val(customer_devis);
    }
    $('.save_all_quotations').removeClass('hidden');

}


// ----------- BOUTON ENREGISTRER NOUVEAU DEVIS OFFLINE ------------ //

$('body').on('submit','.form_save_devis_offline', function(e){
    e.preventDefault();
    var x  = $(this).serialize();
    var y =$(this);
    console.log('ttttttttttttttttttttt');
    $.ajax({
        url: addQuotationRoute,
        type: 'POST',
        data: x,
        dataType: 'text',
        success: function(response) {
           if(response=='d'){
               devis=$('.supp_nouv_devis').attr('data-key');
               console.log(devis);
               var nb_d=localStorage.getItem('nb_d');
               nbr_devis=devis.substr(6,1);
               for(var i=nbr_devis;i<nb_d;i++){
                   var j=i; j++;
                   oldD=localStorage.getItem('devis-'+j);

                   newD=localStorage.setItem('devis-'+i,oldD);
                   console.log(oldD);
               }
               console.log(i);
               localStorage.removeItem('devis-'+i);


               test=nb_d--
               localStorage.setItem("nb_d", nb_d--);

               y.parent().parent().remove();
               $.ambiance({message: "Devis Ajout&eacute;",
                   title: "Success!",
                   type: "success"});
           }
            else if(response=='dc'){
               devis_customer=$('.supp_nouv_devis_client').attr('data-key');
               console.log(devis_customer);
               var nb_dc=localStorage.getItem('nb_dc');
               nbr_devis_customer=devis_customer.substr(3,1);
               for(var i=nbr_devis_customer;i<nb_dc;i++){
                   var j=i; j++;
                   oldDC=localStorage.getItem('dc-'+j);

                   newDC=localStorage.setItem('dc-'+i,oldDC);
                   console.log(oldDC);
               }
               console.log(i);
               localStorage.removeItem('dc-'+i);


               test=nb_dc--
               localStorage.setItem("nb_dc", nb_dc--);

               y.parent().parent().remove();
               $.ambiance({message: "Devis et client Ajout&eacute;",
                   title: "Success!",
                   type: "success"});
           }else{
               $.ambiance({message: "Cin du nouveau client existe d&eacute;ja!",
                   type: "error",
                   fade: false});
           }

     console.log("khalil");



        },
        error: function(response) {
            console.log(response);
        }
    });
});


// ------------------- BOUTON SUPPRIMER NOUVEAU DEVIS -------------------- //


$('body').on('click','.supp_nouv_devis', function(e){
    e.preventDefault();
    devis=$(this).attr('data-key');
    var nb_d=localStorage.getItem('nb_d');
    nbr_devis=devis.substr(6,1);



    for(var i=nbr_devis;i<nb_d;i++){
        var j=i; j++;
        oldD=localStorage.getItem('devis-'+j);

        newD=localStorage.setItem('devis-'+i,oldD);

    }

    localStorage.removeItem('devis-'+i);


    var test=localStorage.getItem('nb_d');
    test=test-1;
    localStorage.setItem("nb_d", test);
    $(this).parent().parent().parent().remove();
    $.ambiance({message: "Devis Supprim&eacute;",
        type: "error",
        fade: false});

});

$('body').on('click','.supp_nouv_devis_client', function(e){
    e.preventDefault();
    devis_client=$(this).attr('data-key');
    var nb_dc=localStorage.getItem('nb_dc');
    localStorage.removeItem(devis_client);
    var test=localStorage.getItem("nb_dc");
    test=test-1;
    localStorage.setItem("nb_dc", test);
    $(this).parent().parent().parent().remove();
    $.ambiance({message: "Devis Supprim&eacute;",
        type: "error",
        fade: false});

});


// ----------- BOUTON ENREGISTRER "TOUT" NOUVEAU DEVIS OFFLINE ------------ //

$('.save_all_quotations').on('click',function(e){
    e.preventDefault();
    $('.table tbody').each(function(){
             $('.form_save_devis_offline').trigger("submit");
    });

});

// ----------- AFFICHE CONNEXION ------------ //

function testConnection(){
    if(navigator.onLine){
        $.ambiance({message: "connect&eacute;",
            permanent: true,
            fade: true,
            timeout: 1,
            type:'success'
        });
    }
    else{
        $.ambiance({message: "non connect&eacute;",
            permanent: true,
            fade: true,
            timeout: 1,
            type:'danger'
        });
    }

}








// *********<!-- NOTIF -->**************/
var nb_customer=localStorage.getItem('nb_c');
var nb_devis=localStorage.getItem('nb_d');
var nb_dev_cust=localStorage.getItem('nb_dc');
var nb=0;
if(nb_dev_cust==null){
    nb_dev_cust=0;
}else{
    nb_dev_cust=parseInt(nb_dev_cust);
    nb=nb+nb_dev_cust;
}
if(nb_devis==null){
    nb_devis=0;
}else{
    nb_devis=parseInt(nb_devis);
    nb=nb+nb_devis;
}

if(nb_customer!=null){
    nb_customer=parseInt(nb_customer);
    nb=nb+nb_customer;
}

if(nb!=0){
    $('.notif_all').removeClass('hidden').html(''+nb+'');
}
if(nb_customer!=0){
    $('.notif_c').removeClass('hidden').html(''+nb_customer+'');
}

var nb_devis_all= nb_devis+nb_dev_cust;
if(nb_devis_all!=0){
    $('.notif_d').removeClass('hidden').html(''+nb_devis_all+'');
}



// ------------------ SELECT ROLE ---------------------- //
$('.select_role').on('click  change',function(e){
    e.preventDefault();
    var id_role=$('#id_role').val();
        nbr_chk=$('.chk_new_permission').length;

   /* for(var j=1;j<=nbr_chk;j++){
        $('#'+j).attr('checked',false);
    }*/



    var Route=getRolePermission+id_role;
        $.ajax({
            url: Route,
            type: 'GET',
            data: '',
            dataType: 'text',
            success: function (response) {
                $('.chk_new_permission').prop('checked',false);
                console.log('true');
                res=JSON.parse(response);
                for (var i in res){

                    $('#'+res[i]).prop('checked',true);
                    }
                //console.log(res);
            },
            error: function (response) {

            }

   });

});

//-------------- CHECKBOX NEX MODEL ---------------------//
$('.chk_new_model').on('change', function(e) {
    e.preventDefault();
    if($(this).prop('checked')){
        $('#new_model_div').removeClass('hidden');
        $('.select_model').remove();
        $('.chk_new_model').val(1);
    }
    else{
        $('#new_model_div').addClass('hidden');
        $('.select_model').removeClass('hidden');
        $('.chk_new_model').val(0);
    }
});

// ------------------ SELECT Model For TestDrive ---------------------- //
$('.select_model').on('click change',function(e){
    e.preventDefault();
    console.log('changed');
    var id=$(this).val();
    var Route=routeFinition+id;
    $.ajax({
        url: Route,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function (response) {
            if(response!="[]")
            {
                var res=JSON.parse(response);
                var select=$('.finition_div').removeClass('hidden').find('select');
                var option ="";
                for (var i in res)
                {
                    option += "<option value='"+i+"'>"+res[i]+"</option>";
                }
                select.html(option);
                $(".inp_debut").attr('disabled',false);
                $(".inp_fin").attr('disabled',false);
            }
            else
            {
                $('.finition_div').addClass('hidden');
                $(".inp_debut").attr('disabled',true);
                $(".inp_fin").attr('disabled',true);
            }
        },
        error: function (response) {

        }

    });

});






//-------------------- FRONT JAVASCRIPT ----------------------//

$('.modele_voiture').on('click',function(e){
    e.preventDefault();
    $('.modele_voiture').removeClass('rouge_back');
    $(this).addClass('rouge_back');
    var finition=$(this).attr('data-finition');
    var tab =JSON.parse(finition);
    $('.model_finitions').html('')
    for (var i in tab)
    {

        var text=$('.model_finitions').html();
            $('.model_finitions').html(text+'<a href="#"><div class="finition" data-id="'+tab[i].id+'"><img src="'+image+'/'+tab[i].icon_finition +'"><br><label class="txt_noir">'+tab[i].finition+'</label></div></a>');
    }



});

$('.model_finitions').on('click','.finition',function(e){
    e.preventDefault();
    $('.finition').removeClass('gris_back');
    $(this).addClass('gris_back');

});

$('.icone').on('click',function(e) {
    e.preventDefault();
    $('.icone').removeClass('gris_back');
    $(this).addClass('gris_back');
});

$('.caract').on('click',function(e) {
    $('.icone').removeClass('gris_back');
    $(this).addClass('gris_back');
    var id_car = $('.gris_back').attr('data-id');
    console.log(id_car);
    var getCategoriesRoute=routeCategories+id_car;
    $.ajax({
        url: getCategoriesRoute,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function (response) {
            console.log(response);
            var list_cat=JSON.parse(response);
            console.log(list_cat);

            var cat_car_div='';
            for (var i in list_cat)
            {


                cat_car_div=cat_car_div+'<div class="col-md-3 categorie_front">' +
                    '<img src="' + icon +'" class="icon_front" style="float:right; margin-top: 2%; border-radius: 10px;"><div style="margin-top:8%">'+list_cat[i].name+'</div></div>';
            }
            $('.cont').html('<div class="row " style="height: 464px;">' +
                '<img src="' + back_image + '" class="back_front">'+
                '<div style="    text-align: center; color: #DF1637;  font-size: 24px; margin-top: 3%; font-weight: bold"> Cat&eacute;gories d\'option <br>'+
                '<img src="' + logo +'" style="height: 50px;  width: 15%;"></div>' +
                '<div class="row" style="text-align: center; margin-top: 3%; margin-left: 7%;  font-weight: bold;">'
                + cat_car_div  +
                '</div></div>');

        }
    });
});


$('.cont').on('click','.categorie_front',function(e){
    e.preventDefault();


});




