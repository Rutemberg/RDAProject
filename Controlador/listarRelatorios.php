<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
?>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RDA - Faculdade Processus</title>


        <link rel="stylesheet" href="../Css/Animation.css">
        <link rel="stylesheet" href="../Css/ListarFull_estilo.css">
        <link rel="stylesheet" href="../Css/CheckBoxFiltros.css">
        <link rel="stylesheet" href="../Css/Print.css" media="print">
        <link rel="stylesheet" href="../Css/ElementStatic_estilo.css">


        <script src="../Js/jquery-3.2.1.min.js"></script>
        <script src="../Js/PopUps.js"></script>
        <script src="../Js/Home.js"></script>
        <script src="../Js/Ajax.js"></script>
        <script src="../Js/velocity.min.js"></script>
        <script src="../Js/velocity.ui.js"></script>
        <script src="../Js/jquery.foggy.min.js"></script>
        <script src="../Js/Listar.js"></script>
        <script src="../Js/Animacoes.js"></script>

    </head>
    <body class="corpo">
        <div id="corpo">

            <div class="Fulltop">
                <div class="backgroundtopo">
                    <!--                    <div class="logo">
                                            <div class="centralizar">
                                                <h1 class="RDAlogo">RDA</h1>
                                                <h1 class="PROJECTlogo">Project</h1>
                                            </div>
                                        </div>-->
                    <ul class="navegacao">
                        <li class="mark">Relatórios</li>
                    </ul>
                    <ul class="navegacao navegacaosub">
                        <li>
                            <label>Filtrar por</label>
                            <input style="width: 70px;" placeholder="ano" type="number" pattern="[0-9]{4}" maxlength="4" class="inputfiltros" onkeyup="Data(this.value)">
                            <input style="width: 110px;" placeholder="mes" type="text" class="inputfiltros" onkeyup="Mes(this.value)">
                            <input style="width: 50px;" placeholder="dia" type="number" pattern="[0-9]{4}" maxlength="2" type="text" class="inputfiltros" onkeyup="dia(this.value)">
                        </li>
                    </ul>

                    <div class="user">
                        <div class="centralizar">
                            <div class="userbackpic">
                                <div class="picuser" style="        
                                     background: url('<?php echo "../Img/Userimg/{$_SESSION['PictureUsuarLologado']}"; ?>') no-repeat center;
                                     -webkit-background-size: contain;
                                     -moz-background-size: contain;
                                     -o-background-size: contain;
                                     background-size: contain;"></div>
                            </div>
                            <div class="user_texts">
                                <h1 class="texttag"><?php echo $_SESSION['TagUsuarioLogado']; ?></h1><br>
                                <h1 class="textperfil"><?php echo $_SESSION['CampusUsuarioLogado']; ?></h1>
                                <h3 class="textsair"><a href="controladorLogin.php?logout=1">Sair</a></h3>
                            </div>
                        </div>
                    </div>
                </div>


                <section class="localization">
                    <div class="centralizar">
                        <a href="../Home.php?Pagina=RDA"><img class="icon_back animacao" src="../Img/Icones/iconBack.png"></a>
                        <p class="name_localization">RDA</p>
<!--                        <p class="atualname_localization">Relatórios</p>-->
                    </div>
                </section>

            </div>




            <div id="ajaxfiltros">
                <?php
                if (empty($_REQUEST["ano"])) {
                    include_once './FiltroRelatorios.php';
                }
                ?>
            </div>




            <!--            <div class="iconeimprimir animacaocomsombra" onclick="window.print()">
                            <img src="../Img/Icones/imprimir.png">
                        </div>-->

        </div>








    </body>
</html>