<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
if (empty($_SESSION['UsuarioLogado'])) {
    header('Location: index.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RDA - Faculdade Processus</title>


        <link rel="stylesheet" href="Css/Home_Estilo.css">
        <link rel="stylesheet" href="Css/ElementStatic_estilo.css">
        <link rel="stylesheet" href="Css/Animation.css">
        <link rel="stylesheet" href="Js/OwlCarousel2-2.3.3/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="Js/OwlCarousel2-2.3.3/dist/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="Css/Animation.css">

        <script src="Js/jquery-3.2.1.min.js"></script>
        <script src="Js/Login.js"></script>
        <script src="Js/Home.js"></script>
        <script src="Js/PopUps.js"></script>
        <script src="Js/Animacoes.js"></script>
        <script src="Js/velocity.min.js"></script>
        <script src="Js/velocity.ui.js"></script>
        <script src="Js/jquery.foggy.min.js"></script>
        <script src="Js/OwlCarousel2-2.3.3/dist/owl.carousel.min.js"></script>


        <script>
            $(document).ready(function () {
                $('.owl-carousel').owlCarousel({
                    margin: 10,
                    loop: true,
                    autoWidth: true,
                    items: 3
                })
            });
        </script>
    </head>
    <body class="corpo">


        <?php if (!empty($_SESSION["cadastrorealizado"])) { ?>
            <div class="backmensagem">
                <div id="backmensagem">
                    <div class="centralizar">

                        <div class="mensagem">
                            <div id="mensagem">
                                <div class="centralizar">

                                    <div class="mensagem_top">
                                        <p>Relatorio</p>
                                    </div>

                                    <div class="mensagem_corpo">

                                        <div class="mensagem_corpo_inlineblock mensagem_corpo_img">
                                            <div id="mensagem_corpo_img">
                                                <div class="centralizar">
                                                    <img src="Img/Icones/ok.png">
                                                    <p class="mensagem_sucess">cadastrado com sucesso</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mensagem_corpo_inlineblock mensagem_corpo_corpo">
                                            <div id="mensagem_corpo_corpo">
                                                <div class="centralizar">
                                                    <p class="mensagem_corpo_corpo_top">Itens inseridos no banco de dados</p>
                                                    <?php
                                                    if (!empty($_SESSION["popupcadastrofinalizado"])) {
                                                        foreach ($_SESSION["popupcadastrofinalizado"] as $value) {
                                                            ?>
                                                            <p class="mensagem_corpo_corpo_mensagens"><?php echo $value; ?></p>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mensagem_bottom">
                                        <hr>
                                    </div>
                                    <div class="fecharmensagem">
                                        <button class="botaofechar" onclick="return fecharmensagem()">fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <?php
            unset($_SESSION["cadastrorealizado"]);
        }
        ?>

        <?php if (!empty($_SESSION["exclusaocompleta"]) && $_SESSION["exclusaocompleta"] == 1) { ?>

            <div class="backmensagem">
                <div id="backmensagem">
                    <div class="centralizar">

                        <div class="mensagem">
                            <div id="mensagem">
                                <div class="centralizar">

                                    <div class="mensagem_top">
                                        <p>Exclusão</p>
                                    </div>

                                    <div class="mensagem_corpo">

                                        <div class="mensagem_corpo_inlineblock mensagem_corpo_img">
                                            <div id="mensagem_corpo_img">
                                                <div class="centralizar">
                                                    <img src="Img/Icones/fail.png">
                                                    <p class="mensagem_sucess">Realizada com sucesso</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mensagem_corpo_inlineblock mensagem_corpo_corpo">
                                            <div id="mensagem_corpo_corpo">
                                                <div class="centralizar">
                                                    <p class="mensagem_corpo_corpo_top">Relatorio exclusão</p>
                                                    <?php
                                                    if (!empty($_SESSION["popup"])) {
                                                        foreach ($_SESSION["popup"] as $value) {
                                                            ?>
                                                            <p class="mensagem_corpo_corpo_mensagens"><?php echo $value; ?></p>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mensagem_bottom">
                                        <hr>
                                    </div>
                                    <div class="fecharmensagem">
                                        <button class="botaofechar" onclick="return fecharmensagem()">fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php
            unset($_SESSION["exclusaocompleta"]);
            unset($_SESSION["popup"]);
        }
        ?>



        <div class="backgroundtopo">
            <?php if (empty($_GET['Pagina'])) { ?>
                <div class="logo">
                    <div class="centralizar">
                        <h1 class="RDAlogo">RDA</h1>
                        <h1 class="PROJECTlogo">Project</h1>
                    </div>
                </div>
            <?php } else { ?>

                <ul class="navegacao">
                    <li class="mark">RDA</li>
                    <li>MM</li>
                    <li>Memos</li>
                    <li>Ip</li>
                </ul>
                <ul class="navegacao navegacaosub">
                    <li>gerenciar relatórios</li>
                    <li onclick="return redirectionform('Controlador/Estatisticas.php')">Estatisticas</li>
                    <li onclick="return redirectionform('Controlador/listarRelatorios.php')">Relatórios</li>
                </ul>
            <?php } ?>

            <div class="user">
                <div class="centralizar">
                    <div class="userbackpic">
                        <div class="picuser" style="
                             background: url('<?php echo "Img/Userimg/{$_SESSION['PictureUsuarLologado']}"; ?>') no-repeat center;
                             -webkit-background-size: contain;
                             -moz-background-size: contain;
                             -o-background-size: contain;
                             background-size: contain;
                             ">
                        </div>
                    </div>
                    <div class="user_texts">
                        <h1 class="texttag"><?php echo $_SESSION['TagUsuarioLogado']; ?></h1><br>
                        <h1 class="textperfil"><?php echo $_SESSION['CampusUsuarioLogado']; ?></h1>
                        <div class="textsair"><a href="Controlador/controladorLogin.php?logout=1">Sair</a></div>
                    </div>
                </div>
            </div>
        </div>




        <?php if (empty($_GET['Pagina'])) { ?>

            <div class="Img_relatorioFundo">
                <div class="centralizar">
                    <img src="Img/Icones/iconrelatorio.png">
                </div>
            </div>
            <div class="Img_usuarioFundo">
                <div class="centralizar">
                    <img src="Img/Icones/iconuserblack.png">
                </div>
            </div>
            <section class="navigation_cards">
                <div class="centralizar">
                    <ul class="menu">
                        <div class="centralizar">
                            <a href="?Pagina=RDA">
                                <li class="menu_item">
                                    <div class="relatorio">
                                        <div class="centralizar">
                                            <p>Gerenciar Relatórios</p>
                                        </div>
                                    </div>
                                </li>
                            </a>
                            <li class="menu_item">
                                <div class="usuario">
                                    <div class="centralizar">
                                        <p>Gerenciar Usuários</p>
                                    </div>
                                </div>
                            </li>

                        </div>
                    </ul>
                </div>
            </section>


            <?php
        } else {
            ?>
            <section class="localization">
                <div class="centralizar">
                    <a href="Home.php"><img class="icon_back animacao" src="Img/Icones/iconBack.png"></a>
                    <p class="name_localization">Inicio</p>
    <!--                <p class="atualname_localization">Gerenciar relatorios</p>-->
                </div>
            </section>


            <?php
            $pagina = $_GET['Pagina'];
            if ($pagina == 'RDA') {
                include './Visao/Navigation/RDA.php';
            }
        }
        ?>

    </body>
</html>
