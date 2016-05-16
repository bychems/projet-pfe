<!DOCTYPE html>
<html lang="en" manifest=<?php base_path("offline.manifest")?>>

@include ('inc.head')

<body class="front_body">


    <div class="row " style="margin-right: 0px">

        <div class="col-md-1 test" style="padding-left: 0%; padding-right: 0px;margin-right: 0px">
            <a href="#"> <img src="{{url('project/resources/assets/img/menu.png')}}" class="menu_icone"></a><br>
            @foreach($modele as $m)
                <a href="#">
                    <div class="modele_voiture" data-finition="{{json_encode($m->cars()->get())}}">
                    {{$m->name}}
                    </div>
                </a>
            @endforeach
        </div>


        <div class="col-md-2" style="padding-left: 0%; padding-right: 0%">
            <div class="model_finitions scrollbar" id="style-3" >

            </div>

            <a href="#"> <i class="fa fa-facebook tt" aria-hidden="true" style="margin-left: 30%"></i> </a>
            <a href="#"> <i class="fa fa-twitter tt" aria-hidden="true"></i> </a>
            <a href="#"> <i class="fa fa-youtube-play tt" aria-hidden="true"></i> </a>
        </div>

        <div class="col-md-9" style="padding-right: 0%">

            <div class="row">
                <a href="#" style="padding-left: 20px"><img src="{{url('project/resources/assets/img/perso_icone.png')}}" class="perso_icone"></a>

                <img src="{{url('project/resources/assets/img/logo_audi.png')}}" class="droite logo_audi">
            </div>


            <div class="cont">
                <div class="row" style="height: 347px;">
                    <img src="{{url('project/resources/assets/img/background.jpg')}}" class="background_front">
                    <img src="{{url('project/resources/assets/img/logo_a3.png')}}" class="logo_modele">

                </div>

                <div class="row rouge_back">
                    <img src="{{url('project/resources/assets/img/audi_a3.png')}}" class="audi_img">
                </div>
            </div>


            <div class="row">
                <a href="#">
                    <div class="col-md-3 icone caract">
                        <img src="{{url('project/resources/assets/img/caracteristique_icone.png')}}" ><br>
                        <label class="txt_noir">Caract&eacute;ristiques</label>
                    </div>
                </a>

                <a href="#">
                    <div class="col-md-3 icone">
                        <img src="{{url('project/resources/assets/img/demande_devis_icone.png')}}"><br>
                        <label class="txt_noir">Demande de devis</label>
                    </div>
                </a>

                <a href="#">
                    <div class="col-md-3 icone">
                        <img src="{{url('project/resources/assets/img/demande_catalogue_icone.png')}}"><br>
                        <label class="txt_noir">Demande de catalogue</label>
                    </div>
                </a>

                <a href="#">
                    <div class="col-md-3 icone">
                        <img src="{{url('project/resources/assets/img/ajout_client_icone.png')}}"><br>
                        <label class="txt_noir">Ajouter client</label>
                     </div>
                </a>
            </div>
         </div>
    </div>





    @include('inc.js')
    <script>
        var image="{{url('project/uploads')}}";
        var back_image="{{url('project/resources/assets/img/background.jpg')}}";
        var routeCategories="{{route('getcategories',0)}}";
        routeCategories = routeCategories.slice(0, - 1);
        var logo="{{url('project/resources/assets/img/logo_a3.png')}}";
        var icon="{{url('project/resources/assets/img/icon.png')}}";
    </script>

</body>
</html>


