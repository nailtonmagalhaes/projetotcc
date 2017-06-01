<?php 

include_once 'menu.php';



?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 align="center">Aulas</h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-offset col-md-2">
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" name="dataconsulta" id="dataconsulta" value="<?php echo date('d/m/Y')?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <style>
                            #chartdiv {
                                width: 100%;
                                height: 500px;
                            }
                        </style>

                        <script>

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
                        </script>
                        <div id="chartdiv"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

