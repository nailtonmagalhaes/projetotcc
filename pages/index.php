<?php 

include_once 'menu.php';



?>

<link href='../Arquivos/fullcalendar-3.4.0/fullcalendar.min.css' rel='stylesheet' />
<link href='../Arquivos/fullcalendar-3.4.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />


<script src='../Arquivos/fullcalendar-3.4.0/lib/moment.min.js'></script>
<!--<script src='../lib/jquery.min.js'></script>-->
<script src='../Arquivos/fullcalendar-3.4.0/fullcalendar.min.js'></script>
<script src='../Arquivos/fullcalendar-3.4.0/locale-all.js'></script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 align="center">Aulas</h1>
                </div>
                <div class="panel-body">
                    <!--
                    <div class="row">
                        <div class="col-md-offset col-md-2">
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" name="dataconsulta" id="dataconsulta" value="<?php echo date('d/m/Y')?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    -->
                    <div class="row">
                        <style>
                            #chartdiv {
                                width: 100%;
                                height: 500px;
                            }

                            #calendar {
                                max-width: 900px;
                                margin: 0 auto;
                            }
                        </style>

                        <script>

                            $(document).ready(function () {

                                $('#calendar').fullCalendar({
                                    header: {
                                        //left: 'prev,next today',
                                        //center: 'title',
                                        //right: 'agendaDay',//'month,agendaWeek,agendaDay'
                                    },
                                    locale: 'pt-br',
                                    defaultView: 'agendaDay',
                                    minTime: '08:00:00',
                                    maxTime: '22:00:00',
                                    defaultDate: new Date(),
                                    navLinks: false, // can click day/week names to navigate views
                                    editable: false,
                                    eventLimit: false, // allow "more" link when too many events
                                    /*
                                    viewRender: function(view, element){
                                        var dataInicio = view.intervalStart.format('DD/MM/YYYY');
                                        var dataFim = view.intervalEnd.format('DD/MM/YYYY');
                                        switch (view.name) {
                                            case 'agendaWeek':
                                                
                                                break;
                                            case 'agendaDay':
                                                
                                                break;
                                            case 'month':
                                                
                                                break;
                                            default:						
                                                break;
                                        }
                                    },
                                    */



                                    events: function (start, end, timezone, callback) {
                                        var today = new Date();
                                        var dd = today.getDate();
                                        var mm = today.getMonth() + 1; //January is 0!

                                        var yyyy = today.getFullYear();
                                        if (dd < 10) {
                                            dd = '0' + dd;
                                        }
                                        if (mm < 10) {
                                            mm = '0' + mm;
                                        }
                                        var today = dd + '/' + mm + '/' + yyyy;
                                        $.getJSON('aula-dia-consulta.php?dataInicio=', { dataInicio: start.format('DD/MM/YYYY') }, function (aulas) {
                                            var events = [];
                                            $.each(aulas, function (i, obj) {

                                                events.push({
                                                    id: obj.idTurma,
                                                    title: 'Curso: '+obj.curso +' - Aluno: '+ obj.aluno,
                                                    start: obj.horaInicio,
                                                    end: obj.horaTermino,
                                                });
                                            });
                                            callback(events);
                                        });
                                    },

                                    eventClick: function (calEvent, jsEvent, view) {
                                        //alert(calEvent.title + "n" + calEvent.start.format('DD/MM/YYYY') + " to " + calEvent.end.format('DD/MM/YYYY'));
                                    },
                                });

                            });


                            /*
                            $('.input-group.date').datepicker({
                                format: "dd/mm/yyyy",
                                language: "pt-BR",
                                autoclose: true,
                                clearBtn: true,
                                todayHighlight: true,
                                calendarWeeks: true,
                            });                            

                            $('#dataconsulta').change(function () {
                                var dados = []
                                $.ajax({
                                    url: 'aula-dia-consulta.php', 
                                    type: 'POST', 
                                    data: 'data=' + $(this).val(),
                                    dataType: 'json',
                                    success: function (aulas) {
                                        $.each(aulas, function (i, obj) {
                                            dado = {
                                                "name": obj.aluno + " | " + obj.curso +" | " +obj.horaInicio + " as " + obj.horaTermino,
                                                "points": obj.idTurma,
                                                "color": "#7F8DA9",
                                                "bullet": ""
                                            }
                                            dados.push(dado);
                                        })

                                        var chart = AmCharts.makeChart("chartdiv",
                                        {
                                            "type": "serial",
                                            "theme": "dark",
                                            "dataProvider": dados,
                                            "valueAxes": [{
                                                "maximum": 0,
                                                "minimum": 0,
                                                "axisAlpha": 0,
                                                "dashLength": 4,
                                                "position": "left"
                                            }],
                                            "startDuration": 1,
                                            "graphs": [{
                                                "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
                                                "bulletOffset": 10,
                                                "bulletSize": 52,
                                                "colorField": "color",
                                                "cornerRadiusTop": 8,
                                                "customBulletField": "bullet",
                                                "fillAlphas": 0.8,
                                                "lineAlpha": 0,
                                                "type": "column",
                                                "valueField": "points"
                                            }],
                                            "marginTop": 0,
                                            "marginRight": 0,
                                            "marginLeft": 0,
                                            "marginBottom": 0,
                                            "autoMargins": false,
                                            "categoryField": "name",
                                            "categoryAxis": {
                                                "axisAlpha": 0,
                                                "gridAlpha": 0,
                                                "inside": true,
                                                "tickLength": 0
                                            },
                                            "export": {
                                                "enabled": true,
                                                "menu": ["PDF", "JPG"]
                                            }
                                        });
                                    }
                                });
                            });
                            */
                        </script>

                        <div id='calendar'></div>
                        <!--<div ichartdiv"></div>-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

