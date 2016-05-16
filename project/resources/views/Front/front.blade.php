<!DOCTYPE html>
<html lang="en" manifest="{{url('project/offline.manifest')}}">


<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/jpg" href="{{ asset('project/uploads/audi.jpg')}}" />

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->

    {!! HTML::style('project/resources/assets/font-awesome/css/font-awesome.min.css') !!}
    {!! HTML::style('project/resources/assets/dist/css/bootstrap.min.css') !!}


    {!! HTML::style('project/resources/assets/plugins/scroll/jquery.mCustomScrollbar.min.css') !!}
    {!! HTML::style('project/resources/assets/plugins/radio/css/ion.checkRadio.html5.css') !!}
    {!! HTML::style('project/resources/assets/plugins/radio/css/ion.checkRadio.css') !!}



    {!! HTML::style('project/resources/assets/css/style_front.css') !!}


    {!! HTML::style('project/resources/assets/plugins/owl.carousel/owl.carousel.css') !!}




    @yield('css')
</head>

<body>
<div class="container-front">

    <div class="row-1">
        <!--menu drop left-->
        <div class="menu-drop-left">
            <a href="" class="close-menu">X</a>
            test
        </div>
        <!--/.menu drop left-->
        <!--menu model-->
        <div class="col-au-1">
            <div class="menu">
                <a href="" class="toggle-menu"><img src="{{url('project/uploads/menu.png')}}" alt=""> </a>
            </div>

            <div class="cars-model">
                <ul class="ul_cars_model">
                    @foreach($modele as $m)

                        <li><a href=""  class="modele_voiture" data-id="{{$m->id}}"  data-finition="{{json_encode($m->cars()->get())}}">{{$m->name}}</a></li>

                    @endforeach
                </ul>
            </div>
        </div>
        <!--/.menu model-->

        <!--menu finition-->

        <div class="col-au-2" id="">
            <div class="cars-list">
                <ul class="cars-list">
                    <!--boucle foreach => les petites images de chaque voiture avec leurs noms et leurs ID (data-id)  -->

                    <!--/.boucle foreach-->
                </ul>
            </div>

            <ul class="social-media">
                <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                <li><a href="#"> <i class="fa fa-twitter" ></i> </a></li>
                <li><a href="#"> <i class="fa fa-youtube-play"></i> </a></li>
            </ul>
        </div>
        <!--/.menu finition-->



        <!--affichage-->
        <div class="col-au-9">

            <div class="logo">
                <img src="{{url('project/uploads/logo_audi.png')}}" alt="">
            </div>

            <div class="car-price">
                <span class=" money">25999</span> <sup>DT</sup>
            </div>
            <!--partie dynamique-->


            <!--ITEMS-->
            <!--Dans cette partie vous allez charger les options de chaque voiture => boucle foreach-->
            <div class="cars-details" id="cars-details-1">
                <!--ITEM => CAR -->
                <div class="car-item">


                    <div class="front">

                        <!--bannière pour chaque voiture-->
                        <div class="banner">
                            <!--logo model-->
                            <div class="model">
                                <a href="#" class="get-details"><img src="{{url('project/uploads/logo_a3.png')}}" alt=""></a>
                            </div>
                            <!--/.logo model-->

                            <!--image voiture-->
                            <div class="car-front">
                                <a href="#" class="get-details"><img src="{{url('project/uploads/audi_a3.png')}}" alt=""></a>
                            </div>
                            <!--image voiture-->
                        </div>
                        <!--/.bannière pour chaque voiture-->


                        <div class="menu-options">
                            <ul>
                                <li><a href=""><img src="{{url('project/uploads/caracteristique_icone.png')}}" alt=""><p>Caract&eacute;ristiques</p></a></li>
                                <li><a href=""><img src="{{url('project/uploads/demande_devis_icone.png')}}" alt=""><p>Demande de devis</p></a></li>
                                <li><a href=""><img src="{{url('project/uploads/demande_catalogue_icone.png')}}" alt=""><p>Demande de catalogue</p></a></li>
                                <li><a href=""><img src="{{url('project/uploads/demande_devis_icone.png')}}" alt=""><p>Ajouter client</p></a></li>
                            </ul>
                        </div>


                    </div>


                    <!--liste des options pour chaque voiture-->

                    <div class="caracteristiques">
                        <div class="row">
                            <div class="text-center"><img src="{{url('project/uploads/logo_a3.png')}}" width="100" alt=""></div>
                            <div class="col-xs-10 col-xs-offset-1">
                                <p> Grumpy wizards make toxic brew for the evil Queen and Jack. Grumpy wizards make toxic brew for the evil Queen and Jack.</p>

                                <!--list options name  with IDs-->
                                <ul class="list-options-choice">

                                </ul>
                                <!--/.list options name  with IDs-->

                                <!--options details-->
                                <!--boucle foreach pour les options de chaque category-->
                                <div class="options-details" id="options-1" >
                                    <!--category image and name-->
                                    <div class="category">
                                        <h4><img src="{{url('project/uploads/clim.png')}}" alt=""> Climatiseur</h4>
                                    </div>
                                    <!--/.category image and name-->
                                    <!--list of options for this category-->
                                    <!-- Attention les noms de l'input Radio sont tous les memes pour chaque category-->
                                    <div class="radio_div">
                                        <p><label  class="icr-label"><input type="radio" name="category-1" value="Climatiseur 1// 0">Climatiseur 1
                                                <span>Basique</span>
                                            </label></p>
                                    </div>
                                    <!--category image and name-->
                                    <div class="row">
                                        <div class="col-xs-4 col-xs-offset-1"><a href="#" class="return btn-round">Retour</a></div>
                                        <div class="col-xs-4 col-xs-offset-2"><a href="#" class="validate btn-round" data-id="1">Valider</a></div>
                                    </div>
                                </div>



                            </div>

                        </div>
                        <!--<div class="buttons">
                          <div class="row">
                              <div class="col-xs-10 col-xs-offset-1">
                                <a href="" class="btn-round pull-left">Retour</a>
                                <a href="" class="btn-round pull-right">Créer le devis</a>
                              </div>
                           </div>
                        </div>-->
                    </div>
                    <div class="devis">

                    </div>

                    <!--/.liste des options pour chaque voiture-->


                </div>
                <!--/.ITEM => CAR -->

            </div>
            <!--/.ITEMS-->

            <!--/.partie dynamique-->

        </div>
        <!--/.affichage-->

    </div>
</div>
<div class="col-md-6"></div>


<!--JavaScript-->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('project/resources/assets/dist/js/jquery.min.js')}}"></script>


<script src="{{ asset('project/resources/assets/dist/js/bootstrap.min.js') }}"></script>
<!-- main -->
@yield('js')
<script src="{{ asset('project/resources/assets/plugins/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('project/resources/assets/plugins/radio/js/ion.checkRadio.min.js') }}"></script>
<script src="{{ asset('project/resources/assets/plugins/scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<script src="{{ url('project/resources/assets/js/main_front.js') }}"></script>
<script>
    var list_cat=new Array();
    var icone="{{url('project/uploads')}}";
    var routeCategories="{{route('getcategories',0)}}";
    routeCategories = routeCategories.slice(0, - 1);
    $(document).ready(function(){

        $( ".ul_cars_model li a" ).first().click();
    });
</script>
<!--fin js-->

</body>
</html>