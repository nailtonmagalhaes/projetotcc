<?php
    include_once 'valida-sessao.php';
    include_once 'perfil.php';
?>


<!--MENU ALUNO-->
<li>
    <a href="#"><i class="fa fa-user fa-fw"></i> Aluno <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
                <li>
                    <a href="../pages/aluno-listar-ativos.php?tipo=<?php echo SHA1(EPerfil::Aluno); ?>"><i class="fa fa-search fa-fw"></i>Listar</a>
                </li>
                <li>
                    <a href="../pages/aluno-cadastro.php?tipo=<?php echo SHA1(EPerfil::Aluno); ?>"><i class="fa fa-plus fa-fw"></i>Cadastrar</a>
                </li>
                <li>
                    <a href="../pages/aluno-listar-inativos.php?tipo=<?php echo SHA1(EPerfil::Aluno); ?>"><i class="fa fa-ban fa-fw"></i>Inativos</a>
                </li>                      
            <li>
            <a href="#"><i class="fa fa-print fa-fw"></i>Emitir Boletim</a>
        </li>
    </ul>
</li>
<!--MENU MATERIAL-->                       
<li >
    <a href="#"><i class="fa fa-book fa-fw"></i> Material <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/material-listar.php"><i class="fa fa-search fa-fw"></i>Listar</a>
        </li>
        <li>
            <a href="../pages/material-cadastro.php"><i class="fa fa-plus fa-fw"></i>Cadastrar</a>
        </li>
    </ul>
</li>
<!--MENU MATRICULA-->
<li>
    <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Matrícula <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/matricula-listar.php?tipo=<?php echo SHA1(EPerfil::Aluno); ?>"><i class="fa fa-search fa-fw"></i>Listar</a>
        </li>
        <li>
            <a href="../pages/matricula-cadastro.php?tipo=<?php echo SHA1(EPerfil::Aluno); ?>"><i class="fa fa-plus fa-fw"></i>Cadastrar</a>
        </li>
    </ul>
</li>
<!--MENU CURSO-->
<li>
    <a href="#"><i class="fa fa-book fa-fw"></i> Curso <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/curso-listar-ativos.php"><i class="fa fa-search fa-fw"></i>Listar</a>
        </li>
        <li>
            <a href="../pages/curso-cadastro.php"><i class="fa fa-plus fa-fw"></i>Cadastrar</a>
        </li>
        <li>
            <a href="../pages/curso-listar-inativos.php"><i class="fa fa-ban fa-fw"></i>Inativos</a>
        </li>
    </ul>
</li>
<!--MENU AVALIAÇÃO-->
<li>
    <a href="#"><i class="fa fa-book fa-fw"></i> Avaliação <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/avaliacao-listar.php"><i class="fa fa-search fa-fw"></i>Listar</a>
        </li>
        <li>
            <a href="../pages/avaliacao-cadastro.php"><i class="fa fa-plus fa-fw"></i>Cadastrar</a>
        </li>
    </ul>
</li>
                        
<!--<li >
    <a href="#"><i class="fa fa-male fa-fw"></i> Autor <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/autor-listar.php"><i class="fa fa-search fa-fw"></i>Listar</a>
        </li>
        <li>
            <a href="../pages/autor-cadastro.php"><i class="fa fa-plus fa-fw"></i>Cadastrar</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
<!-- / </li> -->
<!--MENU TURMA-->
<li>
    <a href="#"><i class="fa fa-book fa-fw"></i> Turma <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/turma-listar.php"><i class="fa fa-search fa-fw"></i>Listar</a>
        </li>
        <li>
            <a href="../pages/turma-cadastro.php"><i class="fa fa-plus fa-fw"></i>Cadastrar</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-ban fa-fw"></i>Inativos</a>
        </li>
    </ul>
</li>
<!--MENU PROFESSOR-->
<li>
    <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Professor <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
                <li>
                <a href="../pages/aluno-listar-ativos.php?tipo=<?php echo SHA1(EPerfil::Professor); ?>"><i class="fa fa-search fa-fw"></i>Listar</a>
                </li>                                
                <li>
                    <a href="../pages/aluno-cadastro.php?tipo=<?php echo SHA1(EPerfil::Professor); ?>"><i class="fa fa-plus fa-fw"></i>Cadastrar</a>
                </li>
                <li>
                    <a href="../pages/aluno-listar-inativos.php?tipo=<?php echo SHA1(EPerfil::Professor); ?>"><i class="fa fa-ban fa-fw"></i>Inativos</a>
                </li>                              
        <li>
            <a href="../pages/calendario_index.php?tipo=<?php echo SHA1(EPerfil::Professor); ?>"><i class="fa fa-calendar fa-fw"></i>Frequência de Alunos</a>
        </li>
    </ul>
</li>
<!--MENU RELATÓRIOS-->
<li>
    <a href="#"><i class="fa fa-print fa-fw"></i> Relatórios <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/relatorio-teste.php"><i class="fa fa-print fa-fw"></i>1</a>
        </li>                                
        <li>
            <a href="#"><i class="fa fa-print fa-fw"></i>2</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-print fa-fw"></i>3</a>
        </li>
    </ul>
</li> 