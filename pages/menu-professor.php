<?php
    include_once 'valida-sessao.php';
    include_once 'perfil.php';
?>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<!--MENU ALUNO-->
<li>
    <a href="#"><i class="fa fa-user fa-fw"></i> Aluno <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/aluno-listar-ativos.php?tipo=<?php echo SHA1(EPerfil::Aluno); ?>"><i class="fa fa-search fa-fw"></i>Listar</a>
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
<li>
    <a href="#"><i class="fa fa-book fa-fw"></i> Curso <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/curso-listar.php"><i class="fa fa-search fa-fw"></i>Listar</a>
        </li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-book fa-fw"></i> Turma <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="../pages/turma-listar.php"><i class="fa fa-search fa-fw"></i>Listar</a>
        </li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Professor <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">                         
        <li>
            <a href="../pages/calendario_index.php?tipo=<?php echo SHA1(EPerfil::Professor); ?>"><i class="fa fa-calendar fa-fw"></i>Frequência de Alunos</a>
        </li>
    </ul>
</li>