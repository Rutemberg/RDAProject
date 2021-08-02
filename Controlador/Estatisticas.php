<html>
    <?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    ?>
    <html>
        <head>
            <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RDA - Faculdade Processus</title>

            <link rel="stylesheet" href="../Css/ElementStatic_estilo.css">
            <link rel="stylesheet" href="../Css/Animation.css">
            <link rel="stylesheet" href="../Css/CheckBox.css">
            <link rel="stylesheet" href="../Css/Print.css">
            <link rel="stylesheet" href="../Css/Estatisticas_estilo.css">
            <link rel="stylesheet" href="../Css/Graficoempizza.css">


            <script src="../Js/jquery-3.2.1.min.js"></script>
            <script src="../Js/PopUps.js"></script>
            <script src="../Js/Ajax.js"></script>
            <script src="../Js/Estatisticas.js"></script>
            <script src="../Js/velocity.min.js"></script>
            <script src="../Js/velocity.ui.js"></script>
            <script src="../Js/Animacoes.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        </head>

        <body class="corpo">
            <div id="corpo">

                <div class="backgroundtopo">
                    <!--                    <div class="logo">
                                            <div class="centralizar">
                                                <h1 class="RDAlogo">RDA</h1>
                                                <h1 class="PROJECTlogo">Project</h1>
                                            </div>
                                        </div>-->
                    <ul class="navegacao">
                        <a href="Estatisticas.php"><li <?php if (empty($_GET['View'])) { ?>class="mark"<?php } ?>>Problemas</li></a>
                        <a href="Estatisticas.php?View=Notebooks"><li <?php if (!empty($_GET['View']) && $_GET['View'] == 'Notebooks') { ?>class="mark"<?php } ?>>Notebooks</li></a>
                        <a href="Estatisticas.php?View=Usuarios"><li <?php if (!empty($_GET['View']) && $_GET['View'] == 'Usuarios') { ?>class="mark"<?php } ?>>Usuários</li></a>
                    </ul>
                    <ul class="navegacao navegacaosub">
                        <li>Estatísticas</li>
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
                        <div class="localizationback">
                            <a href="../Home.php?Pagina=RDA"><img class="icon_back animacao" src="../Img/Icones/iconBack.png"></a>
                            <p class="name_localization">RDA</p>
                        </div>
<!--                        <p class="atualname_localization">Estatíticas</p>-->
                    </div>
                </section>

                <div class="corpo_estatisticas">


                    <div class="corpo_estatisticas_cards">
                        <?php
                        include '../Modelo/DAO/classeRelatoriosDAO.php';
                        $listarDAO = new classeRelatoriosDAO();
                        $listarAnos = $listarDAO->listarDistinct('ano', 'relatorios', 'ano', 'DESC');
                        ?>



                        <?php if (empty($_GET['View'])) { ?>
                            <div class="card_statisticas card_statisticas_view">
                                <div class="problemas_ano">
                                    <select class="select_ano" onchange="abrir('problemas_mes', 'EstatisticaAjax/EstatisticasMes.php?ano=' + this.value)">
                                        <?php foreach ($listarAnos as $ano) { ?>
                                            <option value="<?php echo $ano['ano']; ?>"><?php echo $ano['ano']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <iframe class="problemas_mes" marginwidth="0" scrolling='no' marginheight='0' id="problemas_mes" src="EstatisticaAjax/EstatisticasMes.php"></iframe>

                            </div>
                        <?php } ?>

                        <?php if (!empty($_GET['View']) && $_GET['View'] == 'Notebooks') { ?>
                            <div class="card_statisticas card_statisticas_view">
                                <div class="problemas_ano">
                                    <select class="select_ano" onchange="abrir('problemas_mes', 'EstatisticaAjax/EstatisticasMes.php?view=notebooks&ano=' + this.value)">
                                        <?php foreach ($listarAnos as $ano) { ?>
                                            <option value="<?php echo $ano['ano']; ?>"><?php echo $ano['ano']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <iframe class="problemas_mes" marginwidth="0" scrolling='no' marginheight='0' id="problemas_mes" src="EstatisticaAjax/EstatisticasMes.php?view=notebooks"></iframe>

                            </div>
                        <?php } ?>

                        <?php if (!empty($_GET['View']) && $_GET['View'] == 'Usuarios') { ?>
                            <div class="card_statisticas card_statisticas_view">
                                <div class="problemas_ano">
                                    <select class="select_ano" onchange="abrir('problemas_mes', 'EstatisticaAjax/EstatisticasMes.php?view=usuarios&ano=' + this.value)">
                                        <?php foreach ($listarAnos as $ano) { ?>
                                            <option value="<?php echo $ano['ano']; ?>"><?php echo $ano['ano']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <iframe class="problemas_mes" marginwidth="0" scrolling='no' marginheight='0' id="problemas_mes" src="EstatisticaAjax/EstatisticasMes.php?view=usuarios"></iframe>

                            </div>
                        <?php } ?>
                    </div>

                </div>


                <!--                <div class="progressbar">
                                    <div id="myBar" class="barra" style="width:0%;text-align: center">0%</div>
                                </div>
                                
                                <br>
                                <button class="w3-button w3-green" onclick="move()">Click Me</button> -->

            </div>





            <div class="background">
                <div class="background_relatorio" style="background: url('../Img/Backgrounds/backestatisticas.jpg') no-repeat center;
                     -webkit-background-size: contain;
                     -moz-background-size: contain;
                     -o-background-size: contain;
                     background-size: contain;"></div>
            </div>
        </body>

    </html>
