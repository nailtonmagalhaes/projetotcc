<?php 

    include_once 'menu.php';
?>

<!-- Styles -->
<style>
#chartdiv {
  width: 96%;
  height: 475px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 15px;
}

.amcharts-graph-g1 .amcharts-graph-fill {
  filter: url(#blur);
}

.amcharts-graph-g2 .amcharts-graph-fill {
  filter: url(#blur);
}

.amcharts-cursor-fill {
  filter: url(#shadow);
}
</style>

<!-- Resources -->

<!-- Chart code -->
<script>
var chartData = [{
   "year": "2000",
       "cars": 16,
       "motorcycles": 37

}, {
   "year": "2001",
       "cars": 10,
       "motorcycles": 11,
       "bicycles": 11
}, {
   "year": "2002",
       "cars": 9,
       "motorcycles": 10,
       "bicycles": 10
}, {
   "year": "2003",
       "cars": 12,
       "motorcycles": 13,
       "bicycles": 12
}, {
   "year": "2004",
       "cars": 12,
       "motorcycles": 13,
       "bicycles": 13
}, {
   "year": "2005",
       "cars": 19,
       "motorcycles": 21,
       "bicycles": 20
}, {
   "year": "2006",
       "cars": 12,
       "motorcycles": 15,
       "bicycles": 13
}, {
   "year": "2007",
       "cars": 11,
       "motorcycles": 11,
       "bicycles": 12
}, {
   "year": "2008",
       "cars": 7,
       "motorcycles": 10,
       "bicycles": 8
}, {
   "year": "2009",
       "cars": 11,
       "motorcycles": 12,
       "bicycles": 12
}, {
   "year": "2010",
       "cars": 11,
       "motorcycles": 12,
       "bicycles": 12
}, {
   "year": "2011",
       "cars": 17,
       "motorcycles": 20,
       "bicycles": 18
}, {
   "year": "2012",
       "cars": 10,
       "motorcycles": 15
}];

var chart =  AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "fontFamily": "Lato",
    "autoMargins": true,
    "addClassNames": true,
    "zoomOutText": "",
    "defs": {
        "filter": [
            {
                "x": "-50%",
                "y": "-50%",
                "width": "200%",
                "height": "200%",
                "id": "blur",
                "feGaussianBlur": {
                    "in": "SourceGraphic",
                    "stdDeviation": "50"
                }
            },
            {
                "id": "shadow",
                "width": "150%",
                "height": "150%",
                "feOffset": {
                    "result": "offOut",
                    "in": "SourceAlpha",
                    "dx": "2",
                    "dy": "2"
                },
                "feGaussianBlur": {
                    "result": "blurOut",
                    "in": "offOut",
                    "stdDeviation": "10"
                },
                "feColorMatrix": {
                    "result": "blurOut",
                    "type": "matrix",
                    "values": "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"
                },
                "feBlend": {
                    "in": "SourceGraphic",
                    "in2": "blurOut",
                    "mode": "normal"
                }
            }
        ]
    },
    "fontSize": 15,
    "pathToImages": "../amcharts/images/",
    "dataProvider": chartData,
    "dataDateFormat": "YYYY",
    "marginTop": 0,
    "marginRight": 1,
    "marginLeft": 0,
    "autoMarginOffset": 5,
    "categoryField": "year",
    "categoryAxis": {
        "gridAlpha": 0.07,
        "axisColor": "#DADADA",
        "startOnAxis": true,
        "tickLength": 0,
        "parseDates": true,
        "minPeriod": "YYYY"
    },
    "valueAxes": [
        {
            "ignoreAxisWidth":true,
            "stackType": "regular",
            "gridAlpha": 0.07,
            "axisAlpha": 0,
            "inside": true
        }
    ],
    "graphs": [
        {
            "id": "g1",
            "type": "line",
            "title": "Cars",
            "valueField": "cars",
            "fillColors": [
                "#0066e3",
                "#802ea9"
            ],
            "lineAlpha": 0,
            "fillAlphas": 0.8,
            "showBalloon": false
        },
        {
            "id": "g2",
            "type": "line",
            "title": "Motorcycles",
            "valueField": "motorcycles",
            "lineAlpha": 0,
            "fillAlphas": 0.8,
            "lineColor": "#5bb5ea",
            "showBalloon": false
        },
        {
            "id": "g3",
            "title": "Bicycles",
            "valueField": "bicycles",
            "lineAlpha": 0.5,
            "lineColor": "#FFFFFF",
            "bullet": "round",
            "dashLength": 2,
            "bulletBorderAlpha": 1,
            "bulletAlpha": 1,
            "bulletSize": 15,
            "stackable": false,
            "bulletColor": "#5d7ad9",
            "bulletBorderColor": "#FFFFFF",
            "bulletBorderThickness": 3,
            "balloonText": "<div style='margin-bottom:30px;text-shadow: 2px 2px rgba(0, 0, 0, 0.1); font-weight:200;font-size:30px; color:#ffffff'>[[value]]</div>"
        }
    ],
    "chartCursor": {
        "cursorAlpha": 1,
        "zoomable": false,
        "cursorColor": "#FFFFFF",
        "categoryBalloonColor": "#8d83c8",
        "fullWidth": true,
        "categoryBalloonDateFormat": "YYYY",
        "balloonPointerOrientation": "vertical"
    },
    "balloon": {
        "borderAlpha": 0,
        "fillAlpha": 0,
        "shadowAlpha": 0,
        "offsetX": 40,
        "offsetY": -50
    }
});

// we zoom chart in order to have better blur (form side to side)
chart.addListener("dataUpdated", zoomChart);

function zoomChart(){
    chart.zoomToIndexes(1, chartData.length - 2);
}
</script>

<!-- HTML -->
 <div id="page-wrapper">
   <div class="row"
     <div class="col-lg-12">
         <div class="panel panel-default">
            <div id="chartdiv"></div>
        </div>
    </div>
   </div>
</div>