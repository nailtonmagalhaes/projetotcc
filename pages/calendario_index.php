<?php 
	include_once "menu.php";
    include_once 'includes.php';
 ?>
  
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Frequência</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Frequência do Aluno
                </div>
                <div id="mensagem" title="Título da mensagem" style="display:none">
                    <p>Aqui fica o conteúdo da mensagem.</p>
                </div>
                <div class="panel-body">
                    <head>
                        <meta charset="utf-8">
                        <meta lang="pt-BR">

                        <link rel='stylesheet' href='../Arquivos/fullcalendar-3.4.0/fullcalendar.css' />
                        <!--<script src='../Arquivos/fullcalendar-3.4.0/lib/jquery.min.js'></script>-->
                        <script src='../Arquivos/fullcalendar-3.4.0/lib/moment.min.js'></script>
                        <script src='../Arquivos/fullcalendar-3.4.0/fullcalendar.js'></script>

                        <!-- script de tradução -->
                        <script src='../Arquivos/fullcalendar-3.4.0/locale/pt-br.js'></script>

                        <script>
                            
                            var date = new Date();
                            
                            $.ajax({
                                url: "calendario_evento.php"
                                ,type: "POST"
                                ,dataType: 'json'
                                ,success: function(data){
                                    if(data!=null){
                                       
                                       var contador = 0;
                                       
                                       $(document).ready(function() {	
                                            //CARREGA CALENDÁRIO E EVENTOS DO BANCO
                                            $('#calendario').fullCalendar({
                                                header: {
                                                    left: 'prev,next today',
                                                    center: 'title',
                                                    right: 'month,agendaWeek,agendaDay'
                                                },
                                                defaultDate: date,
                                                editable: true,
                                                eventLimit: true, 
                                                events: data,           
                                                eventColor: '#dd6777',
                                                eventRender: function (event,element,view){
            //                                        console.log(event);
            //                                        console.log(element);
            //                                        console.log(view);
//                                                      console.log(data[contador]);
//                                                      console.log('OIoi')
//                                                      console.log(data[contador].id)
                                                    element.attr("idTurma",data[contador].id);
                                                    element.click(function(){ turmaDialog($(this).attr('idturma')) })
                                                    contador++;
                                                }
                                            });	
                                        });
                                       
                                    } else {
                                        alert('Problema de conexao')
                                    }
                                }
                            })
                            
                            function turmaDialog(id){
                                
//                                console.log('TESTE')
//                                console.log(id)
                                
                                var div = "";
                                var inputs = "";
                                
                                $.ajax({
                                        url: "calendario_turma.php"
                                        ,type: "POST"
                                        ,data: 'IdTurma='+id
                                        ,dataType: 'json'
                                        ,success: function(data){
                                            $.each(data,function(idx,elem){
                                                
//                                                  console.log(idx,elem)
                                                  
                                                  var checkbox = '<label><div class="checkbox"><input name="box" type="checkbox" IdAluno="'+elem.IdAluno+'" IdTurma="'+elem.IdTurma+'" NumeroMatricula="'+elem.NumeroMatricula+'"/>'+elem.Nome+'</div></label></br>';
                                                
//                                                console.log(checkbox)
                                                inputs +=checkbox;
                                            })
                                            div = '<div name="divTurma">'+inputs+'</div>';
//                                            console.log(div);

                                            swal({
                                                title: "Presenca de alunos",
                                                html:div,
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Inserir',
                                                cancelButtonText: 'Cancelar',
                                                preConfirm: function () {
                                                    
                                                    var campo = '';

                                                    $('input[name="box"]:checked').each(function(idx,elm){
                                                        campo += '&idaluno'+idx+'='+$(elm).attr('idaluno')+'&idturma'+idx+'='+$(elm).attr('idturma')+'&numeromatricula'+idx+'='+$(elm).attr('numeromatricula')+'&total='+idx
                                                    })
                                                    
//                                                    console.log(campo)
                                                    return new Promise(function (resolve) {
//                                                      resolve([
                                                          $.ajax({
                                                                url: "frequencia-salvar.php"
                                                                ,type: "POST"
                                                                ,data: campo
                                                                ,dataType: 'json'
                                                                ,success: function(data){
//                                                                    alert('asdasd')
//                                                                    console.log(data)
                                                                    if(!data){
                                                                        swal("Sucesso!","Frequencias foram salvas!",'success')
                                                                    } else {
                                                                        swal("Houve algum erro!","E possivel que algo tenha dado errado!",'error')
                                                                    }
                                                                }
                                                            })
                                                        
//                                                      ])
                                                    })
                                                  },
                                                  onOpen: function () {
//                                                    $('#swal-input1').focus()
                                                  }
                                                }).then(function (result) {
                                                  swal(JSON.stringify(result))
                                                }).catch(swal.noop)
                                        }
                                })
                                
//                                console.log('123123',div)
//                                console.log('TEST 2')
//                                console.log($(inputs))
                                
                                
                                
                            }
                            
                            
                            

                        </script>

                        <style>
                            #calendario{
                                position: relative;
                                width: 70%;
                                margin: 0px auto;
                            }        
                        </style>

                    </head>
                    <body>    
                        <div id='calendario'>
                            
                        </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables JavaScript -->
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
	$(document).ready(function() {
	    $('#dataTables-example').DataTable({
	        responsive: true,
            "language":{
               "url":"../js/Portuguese-Brasil.json"
            }
	    });
	});


    

</script>
