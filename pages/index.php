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
            <div class="panel panel-default outracor">
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
                                max-width: 950px;
                                margin: 0 auto;
                            }

                            .outracor {
                                background-color: aliceblue;
                            }
                        </style>

                        <script>

                            $(document).ready(function () {
                                $('#calendar').fullCalendar({
                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'month,agendaWeek,agendaDay'
                                    },
                                    locale: 'pt-br',
                                    defaultView: 'agendaDay',
                                    minTime: '08:00:00',
                                    maxTime: '22:00:00',
                                    defaultDate: new Date(),
                                    navLinks: false,
                                    editable: false,
                                    eventLimit: false,
                                    viewRender: function (view, element) {
                                        var dataInicio = view.intervalStart.format('DD/MM/YYYY');
                                        var dataTermino = view.name == 'agendaDay' ? view.intervalStart.format('DD/MM/YYYY') : view.intervalEnd.format('DD/MM/YYYY');
                                        $('#calendar').fullCalendar('removeEvents');
                                        $.ajax({
                                            type: "POST",
                                            url: "aula-dia-consulta.php",
                                            data: { 'dataInicio': dataInicio, 'dataTermino': dataTermino },
                                            dataType: "json",
                                            success: function (data) {
                                                var events = [];
                                                $.each(data, function (i, obj) {

                                                    events.push({
                                                        id: obj.idTurma,
                                                        title: 'Curso: ' + obj.curso + ' - Aluno: ' + obj.aluno,
                                                        description: 'l�kdsjglkdfg g fgkl jdkgjdkgj�d jg�dj g�kljdf�g',
                                                        start: view.name == 'agendaDay' ? retornaHora(obj.horaInicio) : obj.horaInicio,
                                                        end: view.name == 'agendaDay' ? retornaHora(obj.horaTermino) : obj.horaTermino,
                                                    });
                                                });


                                                $('#calendar').fullCalendar('addEventSource', events)
                                                $('#calendar').fullCalendar('rerenderEvents');
                                            }
                                        });
                                        //$.getJSON('aula-dia-consulta.php?dataInicio=', { dataInicio: dataInicio }, function (aulas) {
                                        //    var events = [];
                                        //    $.each(aulas, function (i, obj) {

                                        //        events.push({
                                        //            id: obj.idTurma,
                                        //            title: 'Curso: ' + obj.curso + ' - Aluno: ' + obj.aluno,
                                        //            start: view.name == 'agendaDay' ? retornaHora(obj.horaInicio) : obj.horaInicio,
                                        //            end: view.name == 'agendaDay' ? retornaHora(obj.horaTermino) : obj.horaTermino,
                                        //        });
                                        //    });


                                        //    $('#calendar').fullCalendar('addEventSource', events)
                                        //    $('#calendar').fullCalendar('rerenderEvents');

                                        //});
                                    },
                                    dayClick: function (date, allDay, view) {
                                        console.log(view.name);
                                        if (view.name === "month" || view.name === "agendaWeek") {
                                            $('#calendar').fullCalendar('gotoDate', date);
                                            $('#calendar').fullCalendar('changeView', 'agendaDay');
                                        }
                                    },
                                    eventClick: function (calEvent, jsEvent, view) {
                                        //alert(calEvent.title + "n" + calEvent.start.format('DD/MM/YYYY') + " to " + calEvent.end.format('DD/MM/YYYY'));
                                    },
                                    eventRender: function (event, element) {
                                        var tooltip = event.Description;
                                        $(element).attr("data-original-title", tooltip)
                                        $(element).tooltip({ container: "body" })
                                    }
                                    /*
                                    eventRender: function (event, element) {
                                        element.qtip({
                                            content: event.description + '<br />' + event.start,
                                            style: {
                                                background: 'black',
                                                color: '#FFFFFF'
                                            },
                                            position: {
                                                corner: {
                                                    target: 'center',
                                                    tooltip: 'bottomMiddle'
                                                }
                                            }
                                        });
                                    },
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

                                    /*

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
                                                    title: 'Curso: ' + obj.curso + ' - Aluno: ' + obj.aluno,
                                                    start: obj.horaInicio,
                                                    end: obj.horaTermino,
                                                });
                                            });
                                            callback(events);
                                        });
                                    },
                                    */
                                });

                            });

                            function retornaHora(date1) {
                                var hours = new Date(date1).getHours();
                                var minutes = new Date(date1).getMinutes();

                                if (hours < 10) hours = "0" + hours;
                                if (minutes < 10) minutes = "0" + minutes;

                                var time = "" + hours + ":" + minutes;
                                return time;
                            }


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

