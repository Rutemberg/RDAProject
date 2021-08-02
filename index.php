<?php
session_start();
if (!empty($_SESSION['UsuarioLogado']) && $_SESSION['UsuarioLogado'] == TRUE) {
    header('Location: Home.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RDA - Faculdade Processus</title>

        <link rel="shortcut icon" href="Img/Icones/RDA.ico" type="image/x-icon">
        <link rel="icon" href="Img/Icones/RDA.ico" type="image/x-icon">

        <link rel="stylesheet" href="Css/TelaLogin_Estilo.css">

        <script src="Js/jquery-3.2.1.min.js"></script>
        <script src="Js/Login.js"></script>


    </head>
    <body class="corpo">
        <div style="display: table;width: 100%;height: 100%">
        <div class="centralizar">
            <header class="topo">
                <div class="centralizar">
                    <h1 class="logo" style="font-size: 70px;color: #fa6f08">RDA</h1>
                    <h1 class="logo" style="font-size: 30px;color: black;">Project</h1>
<!--                    <h1 style="font-size: 13px;color: #18121E;font-family: Roboto-Black;text-transform: uppercase;">Sistema para gerenciamento de relatórios</h1>-->
                </div>
            </header>

            <article class="login">
                <div class="centralizar">

                    <div  class="img_login"></div>


                    <form class="formulario_login" id="formulario_login" method="POST" action="Controlador/controladorLogin.php" onsubmit="return ValidaFormulario();">

                        <label class="icone"><img src="Img/Icones/tag.png"></label>
                        <input type="text" name="tag" class="nome" id="nome">

                        <label class="icone"><img src="Img/Icones/password.png"></label>
                        <input type="password" name="pin" class="pin" id="pin" pattern="[0-9]{4}" maxlength="4" style="letter-spacing:15px;">

                        <input type="submit" class="submit" value="Entrar">
                    </form>


                </div>
            </article>

            <footer class="rodape">
                <div class="centralizar">
                </div>
            </footer>
        </div>
        </div>
    </body>
</html>
