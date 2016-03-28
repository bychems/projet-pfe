@extends("default-full-width")
@section('title',$title)
@section('content')
    <h1 align="center">Calendrier</h1>

    @if(isset($dateDispo))
        <div class="row">
            <div id="datetimepicker12" class="cal  col-md-6"></div>


            <div class="hours col-md-6" id="listhours">
                <h2>Les Heures de : <span class="showDate"></span></h2><hr>
                {!! Form::open(['method'=>'post', 'url'=>route('add-hour',$carid)])!!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="radio h-9">
                            <label class="state"><input type="radio" name="heure" value="9" required>9</label>
                            <span></span>
                        </div>
                        <div class="radio h-10">
                            <label class="state"><input type="radio" name="heure" value="10">10</label>
                            <span></span>
                        </div>
                        <div class="radio h-11">
                            <label class="state"><input type="radio" name="heure" value="11" >11</label>
                            <span></span>
                        </div>
                        <div class="radio h-12">
                            <label class="state"><input type="radio" name="heure" value="12" >12</label>
                            <span></span>
                        </div>


                        <div class="radio h-13">
                            <label class="state"><input type="radio" name="heure" value="13" >13</label>
                            <span></span>
                        </div>
                        <div class="radio h-14">
                            <label class="state"><input type="radio" name="heure" value="14">14</label>
                            <span></span>
                        </div>
                        <div class="radio h-15">
                            <label class="state"><input type="radio" name="heure" value="15" >15</label>
                            <span></span>
                        </div>
                        <div class="radio h-16">
                            <label class="state"><input type="radio" name="heure" value="16">16</label>
                            <span></span>
                        </div>
                    </div>
                </div>
                <hr>
                {!! Form::label('',' Client:') !!}
                {!! Form::select('customer', $customers,null,['class'=>'form-control ']) !!}<hr>
                {!! Form::hidden('id_day', "",['class'=>'day_id']) !!}
                <button class="btn btn-success" type="submit">R&eacute;server</button>
                {!!Form::close()!!}

                {!! Form::open(['method'=>'post', 'url'=>route('supp-day',$carid)])!!}

                {!! Form::hidden('id_day', "",['class'=>'day_id']) !!}
                <button class="btn btn-success" type="submit">Supprimer</button>

                {!!Form::close()!!}
            </div>
        </div>
    @endif
    <button class="btn btn-info btn-xs hidden" id="btn-anuuler"  data-id="">Annuler</button>
@stop
{{ Auth::user()->name}}
@section('js')
    <script type="text/javascript" src="{{ url('project/resources/assets/plugins/calendar/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('project/resources/assets/plugins/calendar/bootstrap-datetimepicker.min.js')}}"></script>

    <script>

        //hoursRoute= "";
        idDayRoute= "{{route('hours', array(0,0) )}}";
        idDayRoute = idDayRoute.slice(0, -3);
        carid={{$carid}};
        // hoursRoute = hoursRoute.slice(0, -1);
        suppdayRoute= "{{route('supp-day',0)}}";
        suppdayRoute = suppdayRoute.slice(0, -1);


        detailUserRoute= "{{route('detailUser',0)}}";
        detailUserRoute= detailUserRoute.slice(0, -1);

        detailCustomerRoute= "{{route('afficheCustomer',0)}}";
        detailCustomerRoute= detailCustomerRoute.slice(0, -1);

        (function (global, factory) {
            typeof exports === 'object' && typeof module !== 'undefined'
            && typeof require === 'function' ? factory(require('../moment')) :
                    typeof define === 'function' && define.amd ? define(['moment'], factory) :
                            factory(global.moment)
        }(this, function (moment) { 'use strict';
            var fr = moment.defineLocale('fr', {
                months : 'janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre'.split('_'),
                monthsShort : 'janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.'.split('_'),
                weekdays : 'dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi'.split('_'),
                weekdaysShort : 'dim._lun._mar._mer._jeu._ven._sam.'.split('_'),
                weekdaysMin : 'Di_Lu_Ma_Me_Je_Ve_Sa'.split('_'),
                longDateFormat : {
                    LT : 'HH:mm',
                    LTS : 'HH:mm:ss',
                    L : 'YYYY/MM/DD',
                    LL : 'YYYY MMMM D',
                    LLL : 'YYYY MMMM D HH:mm',
                    LLLL : 'dddd YYYY MMMM D HH:mm'
                },
                calendar : {
                    sameDay: '[Aujourd\'hui à] LT',
                    nextDay: '[Demain à] LT',
                    nextWeek: 'dddd [à] LT',
                    lastDay: '[Hier à] LT',
                    lastWeek: 'dddd [dernier à] LT',
                    sameElse: 'L'
                },
                relativeTime : {
                    future : 'dans %s',
                    past : 'il y a %s',
                    s : 'quelques secondes',
                    m : 'une minute',
                    mm : '%d minutes',
                    h : 'une heure',
                    hh : '%d heures',
                    d : 'un jour',
                    dd : '%d jours',
                    M : 'un mois',
                    MM : '%d mois',
                    y : 'un an',
                    yy : '%d ans'
                },
                ordinalParse: /\d{1,2}(er|)/,
                ordinal : function (number) {
                    return number + (number === 1 ? 'er' : '');
                },
                week : {
                    dow : 1, // Monday is the first day of the week.
                    doy : 4  // The week that contains Jan 4th is the first week of the year.
                }
            });
            return fr;
        }));
        $('#datetimepicker12').datetimepicker({
            inline: true,
            sideBySide: false,
            minDate : "{{$dateBegin}}",
            maxDate : "{{$dateEnd}}",
            locale : 'fr' ,
            disabledDates:  {!! $nondispo !!}
 });

    </script>

@stop
{{$nondispo}}