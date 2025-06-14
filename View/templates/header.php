<a class="btn btn-outline" href="/sistema-de-matricula-escolar/">Página inicial</a>
<a class="btn btn-outline" href="/sistema-de-matricula-escolar/sobre">Sobre</a>
<?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] !== "" && $_SESSION["usuario"] !== "Guest") { ?>
<a class="btn btn-outline" href="/sistema-de-matricula-escolar/meus-cursos">Meus Cursos</a>
<a class="btn btn-fill" href="/sistema-de-matricula-escolar/logout">Sair</a>
<?php } else { ?>
<a class="btn btn-outline" href="/sistema-de-matricula-escolar/login">Login</a>
<a class="btn btn-fill" href="/sistema-de-matricula-escolar/cadastrar">Criar Conta</a>
<?php } ?>