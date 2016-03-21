@extends("default")
@section('title',$title)

@section('content')

    <h1 align="center">Calendrier</h1>

    <ul>

        @foreach($dateDispo as $date)
            @if(!empty($date->date))
                <li class="haut">
                    {{$date->date}}
                    <button class="btn btn-info modifier" name={{$date->id}}>Modifier</button>
                    <a href="calendar-Test-Drive.blade.php"></a>

                    <button class="btn btn-info supp"  data-toggle="modal" data-target="#confirmProductDeletion">Supprimer</button>

                </li>
            @endif
        @endforeach
            <div id="datetimepicker12"></div>
            <div class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <p>One fine body&hellip;</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    </ul>

@stop

@section('js')
    <script type="text/javascript" src="{{ url('project/resources/assets/plugins/calendar/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('project/resources/assets/plugins/calendar/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        hoursRoute= "{{route('Hours',0)}}";
        hoursRoute = hoursRoute.slice(0, -1);
        console.log(hoursRoute);




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
                    L : 'DD/MM/YYYY',
                    LL : 'D MMMM YYYY',
                    LLL : 'D MMMM YYYY HH:mm',
                    LLLL : 'dddd D MMMM YYYY HH:mm'
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
            minDate : "{{$begin}}",
            maxDate : "{{$end}}",
            locale : 'fr'
        });

    </script>


@stop