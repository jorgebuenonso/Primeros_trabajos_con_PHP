<!-- menú general -->
<?php if ($_SESSION['cargo'] == 'otros') { ?>
<nav class="nav-otros" style='text-align: center; width: 220px; padding-left:5px'>
    <a href='consulta.php'>Buscar </a>;
    <a href='index.php'>Salir</a>;
    <div class='animation start-home-'></div>
</nav>
<?php } ?>
<!-- menú presidente -->
<?php if ($_SESSION['cargo'] == 'presidente') { ?>
<nav class="nav-presidente">
    <a href='consulta.php'>Buscar </a>;
    <a href='informe.php'>Informe</a>
    <a href='fichero.php'>Fichero</a>
    <a href='index.php'>Salir</a>;
    <div class='animation start-home-'></div>
</nav>
<?php } ?>

<!-- menú manager -->
<?php if ($_SESSION['cargo'] == 'manager') { ?>
<nav class="nav-manager" style='text-align: center; width: 310px; padding-left:5px'>
    <a href='consulta.php'>Buscar </a>;
    <a href='fichero.php'>Fichero</a>
    <a href='index.php'>Salir</a>;
    <div class='animation start-home-'></div>
</nav>;
<?php } ?>