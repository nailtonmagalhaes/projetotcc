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
                <div class="panel-body">
                    <head>
                        <meta charset="utf-8">
                        <meta lang="pt-BR">

                        <link rel='stylesheet' href='../Arquivos/fullcalendar-3.4.0/fullcalendar.css' />
                        <script src='../Arquivos/fullcalendar-3.4.0/lib/jquery.min.js'></script>
                        <script src='../Arquivos/fullcalendar-3.4.0/lib/moment.min.js'></script>
                        <script src='../Arquivos/fullcalendar-3.4.0/fullcalendar.js'></script>

                        <!-- script de tradução -->
                        <script src='../Arquivos/fullcalendar-3.4.0/locale/pt-br.js'></script>

                        <script>
                           $(document).ready(function() {	

                                //CARREGA CALENDÁRIO E EVENTOS DO BANCO
                                $('#calendario').fullCalendar({
                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'month,agendaWeek,agendaDay'
                                    },
                                    defaultDate: '2017-04-01',
                                    editable: true,
                                    eventLimit: true, 
                                    events: 'calendario_evento.php',           
                                    eventColor: '#dd6777'
                                });	

                                //CADASTRA NOVO EVENTO
                                $('#novo_evento').submit(function(){
                                    //serialize() junta todos os dados do form e deixa pronto pra ser enviado pelo ajax
                                    var dados = jQuery(this).serialize();
                                    $.ajax({
                                        type: "POST",
                                        url: "calendario_cadastro_evento.php",
                                        data: dados,
                                        success: function(data)
                                        {   
                                            if(data == "1"){
                                                alert("Cadastrado com sucesso! ");
                                                //atualiza a página!
                                                location.reload();
                                            }else{
                                                alert("Houve algum problema.. ");
                                            }
                                        }
                                    });                
                                    return false;
                                });	
                               }); 

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
                            <br/>
                            <form id="novo_evento" action="" method="post">
                                Nome do Evento: <input type="text" name="nome" required/><br/><br/>            
                                Data do Evento: <input type="date" name="data" required/><br/><br/>            
                                <button type="submit"> Cadastrar novo evento </button>
                            </form>
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


    $('button[name="btn-excluir-curso"]').on('click', function (e) {
        
        e.preventDefault();

        //var $form = $(this).closest('form');
        var id =  $(this).parent().siblings('.idcurso').text();
        var nomecurso =  $(this).parent().siblings('.nomecurso').text();
        swal({
              title: "Deseja excluir o curso '"+ nomecurso +"'?",
              text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Excluir",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false
            },
            function(){
                $.post("curso-excluir.php", {id:id}, function(data){
                    if(data){
                        swal("Curso excluído com sucesso!","","success");
                        window.setTimeout("location.href='../pages/curso-listar.php'",2000);
                    }else{
                        swal("Error","","warning");
                    }
                    // if(data.error)
                    // {
                    //     swal(data, "", "warning");
                    // }else{
                    //     swal(data, "", "success");
                    //     window.setTimeout("location.href='../pages/curso-listar.php'",2000);
                    // }
                });
            });
    });

</script>
