<?php 

    include_once 'menu.php';
?>
<!-- Resources -->
        <div id="page-wrapper">
            <div class="row">
            <!-- /.row -->
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h1 align="center">Relatorio Inicial</h1> 
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <!-- Styles -->
                                    <style>
                                    body { color: #fff; }
                                    #chartdiv {
                                        width   : 100%;
                                        height  : 500px;
                                    }                               
                                    </style>                                    

                                   <!-- Chart code -->
                                    <script>
                                    var dados = [];

 $.getJSON('diasemana-consulta.php', function(dias){

       $.each(dias, function(i, obj){
            console.log(obj)
            dados = {
                "name":obj.disDia,
                "points":obj.disId,
                "color":"#7F8DA9",
                "bullet":""
            }
        })
       
    });






console.log(dados)
                                    var chart = AmCharts.makeChart("chartdiv",
                                    {
                                        "type": "serial",
                                        "theme": "dark",
                                        "dataProvider": 
                                        [
                                    {
                                        "name": "Damon",
                                        "points": 65456,
                                        "color": "#FEC514",
                                        "bullet": "https://www.amcharts.com/lib/images/faces/C02.png"
                                    },                                        



                                        ],
                                        "valueAxes": [{
                                            "maximum": 80000,
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
                                            "enabled": true
                                         }
                                    });
                                    </script>

                                    <!-- HTML -->
                                    <div id="chartdiv"></div>

                                    <!-- HTML -->
                            
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
         
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
 

</body>
    <script type="text/javascript" src="../js/relatorio/Relatorio.js"></script>
</html>
