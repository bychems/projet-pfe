
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Mail Devis</title>
    <style type="text/css">
        .ReadMsgBody { width: 100%; background-color: #ffffff; }
        .ExternalClass { width: 100%; background-color: #ffffff; }
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
        html { width: 100%; }
        body { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }
        table { border-spacing: 0; border-collapse: collapse; table-layout: fixed; margin: 0 auto; }
        table table table { table-layout: auto; }
        img { display: block !important; }
        table td { border-collapse: collapse; }
        .yshortcuts a { border-bottom: none !important; }
        a { color: #21b6ae; text-decoration: none; }
        .textbutton a { font-family: 'open sans', arial, sans-serif !important; color: #ffffff !important; }
        .text-link a { color: #95a5a6 !important; }
    th {
        text-align: left;
    }
        @media only screen and (max-width: 640px) {
            body { width: auto !important; }
            table[class="table600"] { width: 450px !important; }
            table[class="table-inner"] { width: 90% !important; }
            table[class="table3-3"] { width: 100% !important; text-align: center !important; }
        }

        @media only screen and (max-width: 479px) {
            body { width: auto !important; }
            table[class="table600"] { width: 290px !important; }
            table[class="table-inner"] { width: 82% !important; }
            table[class="table3-3"] { width: 100% !important; text-align: center !important; }
        }
        * {
            font-family: 'Lato', sans-serif;
        }
    </style>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ccc">
    <tbody><tr>
        <td align="center" background="#ddd" style="">
            <table class="" width="900" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>

                <!-- logo -->





                <tr>
                    <td height="40"></td>
                </tr>
                <tr>
                    <td >
                        <table  bgcolor="#FFFFFF" style="border-radius:4px; box-shadow: 0px -3px 0px #d4d2d2;" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                                <td height="40"></td>
                            </tr>
                            <tr>
                                <td >
                                    <table align="" class="table-inner" width="860" >

                                        <!--img-->
                                        <tbody><tr>
                                            <td align="center" style="line-height: 0px;">
                                                <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="http://www.zeroto60times.com/blog/wp-content/uploads/2013/02/audi-cars-logo-emblem.jpg" width="150" height="150" alt="logo">
                                            </td>
                                        </tr>
                                        <!--end img-->
                                        <tr>
                                            <td>
                                        <div id="devis" class="milieu" style="margin-top: 20px; font-weight: bold; text-align: center; font-size: 30px">DEVIS</div><br><br><hr>
                                        <div class="row">
                                            <div>
                                                <strong>Client : {{$name}} {{$last_name}}</strong><span style="float: right"><strong>Date : {{$datetime}}</strong></span>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div>
                                                <strong>Voiture choisi : {{$finition}}</strong><span style="float: right"><strong>Affaire suivi par :  {{ Auth::user()->name }}</strong></span>
                                            </div>
                                        </div>

                                        <hr>
                                                <table><tr><td height="20"></td></tr></table>

                                        <div class="panel panel-default">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">OPTIONS CHOISIES</div>
                                            <table><tr><td height="20"></td></tr></table>
                                            <!-- Table -->
                                            <table style="width: 100%; border:1px solid #ddd" border="1"  cellpadding="10">
                                                <thead>
                                                <tr style="background: #f5f5f5">
                                                    <th style="width:30% ">Nom Option</th>
                                                    <th style="width:40% ">Description Option</th>
                                                    <th style="width:20% ">Prix Option</th>
                                                </tr>
                                                </thead>
                                                <tbody class="table_option">

                                                    @foreach($options as $option)
                                                     <tr>
                                                         <td>
                                                            {{ $option->name }}
                                                         </td>
                                                         <td>
                                                             {{ $option->desc }}
                                                         </td>
                                                         <td>
                                                             {{ $option->price }}
                                                         </td>
                                                     </tr>
                                                     @endforeach


                                                <tr>


                                                    <td colspan="2" align="right" ><strong>Prix de la voiture : </strong></td>
                                                    <td  style="width: 20%"> {{$basic_price}} DT</td>
                                                </tr>
                                                <tr>

                                                    <td colspan="2" align="right"><strong>TVA(18%) : </strong></td>
                                                    <td> {{$tva}} DT</td>
                                                </tr>
                                                <tr>

                                                    <td colspan="2" align="right"><strong>Frais d'immatriculation : </strong></td>
                                                    <td>  {{$frais_imm}} DT</td>
                                                </tr>
                                                <tr>

                                                    <td colspan="2" align="right"> <strong>T.M.E : </strong></td>
                                                    <td> {{$tme}} DT</td>
                                                </tr>
                                                <tr>

                                                    <td colspan="2" align="right">  <strong>Frais de timbre : </strong></td>
                                                    <td>  {{$frais_timbre}} DT</td>
                                                </tr>
                                                <tr>

                                                    <td colspan="2" align="right"> <strong>Prix totale des options :  </strong></td>
                                                    <td >  {{$prix_options}} DT</td>
                                                </tr>
                                                <tr>

                                                    <td colspan="2"  align="right"> <strong>Prix de vente T.T.C :  </strong></td>
                                                    <td class="prix_tot_car">{{$prix_tot}} DT</td>
                                                </tr>
                                                </tbody>

                                            </table>
                                        </div>



                                            </td>
                                        </tr>








                                        <!-- end content -->
                                        </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td height="40"></td>
                            </tr>

                            <!-- button -->

                            <!-- end button -->

                            <tr>
                                <td height="35"></td>
                            </tr>

                            <!-- option -->

                            <!-- end option -->

                            </tbody></table>
                    </td>
                </tr>

                <!-- end profile-img -->

                <tr>
                    <td height="30"></td>
                </tr>

                <!-- social -->

                <!-- end social -->



                <!-- copyright -->
                <tr>
                    <td align="center" style="font-family: 'Open Sans', Arial, sans-serif; font-size:13px; background-color: #ccc; color:#ffffff; line-height:30px;">

                        <a href="access.tn" style="font-weight: bold;">Audi.tn</a>
                        . All Rights Reserved.
                    </td>
                </tr>
                <!-- end copyright -->

                <tr>
                    <td height="40"></td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    </tbody></table>

</body></html>