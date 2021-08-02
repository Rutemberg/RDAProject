<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$idfuncionariologado = $_SESSION['IdUsuarioLogado'];
?>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../Css/ElementStatic_estilo.css">
        <link rel="stylesheet" href="../../Css/Form_estilo.css">
        <link rel="stylesheet" href="../../Css/CheckBox.css">
        <link rel="stylesheet" href="../../Css/Animation.css">

        <script src="../../Js/jquery-3.2.1.min.js"></script>
        <script src="../../Js/Forms.js"></script>
        <script src="../../Js/PopUps.js"></script>
        <script src="../../Js/Animacoes.js"></script>
        <script src="../../Js/velocity.min.js"></script>
        <script src="../../Js/velocity.ui.js"></script>
        <script src="../../Js/jquery.foggy.min.js"></script>
        <title></title>
    </head>
    <body class="corpo">




        <div class="backgroundtopo">

            <ul class="navegacao">
                <li class="mark">Novo relatório</li>
            </ul>
            <ul class="navegacao navegacaosub">
                <li>
                    <?php
                    include_once '../../Modelo/DAO/classeRelatoriosDAO.php';
                    $ListRelatoriosDAO = new classeRelatoriosDAO();
                    $ListRelatorios = $ListRelatoriosDAO->listarRelatoriosFULL($idfuncionariologado, 'idrelatorios');
                    $countRelatorios = count($ListRelatorios);
                    $countRelatorios = $countRelatorios + 1;
                    ?>
                    <?php echo "Relatório de número " . "<b style='color:#12bbe6' class='numerofont'>$countRelatorios</b>"; ?>

                </li>
            </ul>


            <div class="user">
                <div class="centralizar">
                    <div class="userbackpic">
                        <div class="picuser" style="        
                             background: url('<?php echo "../../Img/Userimg/{$_SESSION['PictureUsuarLologado']}"; ?>') no-repeat center;
                             -webkit-background-size: contain;
                             -moz-background-size: contain;
                             -o-background-size: contain;
                             background-size: contain;"></div>
                    </div>
                    <div class="user_texts">
                        <h1 class="texttag"><?php echo $_SESSION['TagUsuarioLogado']; ?></h1><br>
                        <h1 class="textperfil"><?php echo $_SESSION['CampusUsuarioLogado']; ?></h1>
                        <h3 class="textsair"><a href="../../Controlador/controladorLogin.php?logout=1">Sair</a></h3>
                    </div>
                </div>
            </div>
        </div>

        <header class="topo">
            <?php if (!empty($_SESSION["ultimocadastronaorealizado"]) && $_SESSION["ultimocadastronaorealizado"] == 2) { ?>
                <div id="popup" class="closepopup">
                    <div class="popup">
                        <div class="centralizar">
                            <p class="popuptitle">Relatorio</p>
                            <img src="../../Img/Icones/fail.png">
                            <p class="fail">ultimo relatorio não cadastrado</p>
                            <p class="view">Faça o relatorio corretamente</p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </header>


        <?php if (!empty($_SESSION["cadastronaorealizado"])) { ?>
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
                                                    <img src="../../Img/Icones/fail.png">
                                                    <p class="mensagem_Fail">nao cadastrado</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mensagem_corpo_inlineblock mensagem_corpo_corpo">
                                            <div id="mensagem_corpo_corpo">
                                                <div class="centralizar">
                                                    <p class="mensagem_corpo_corpo_top">houve falha nos seguintes campos:</p>
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
            unset($_SESSION["cadastronaorealizado"]);
            $_SESSION["ultimocadastronaorealizado"] = 2;
        }
        ?>


        <section class="localization">
            <div class="centralizar">
                <a href="../../Home.php?Pagina=RDA"><img class="icon_back animacao" src="../../Img/Icones/iconBack.png"></a>
                <p class="name_localization">RDA</p>
<!--                <p class="atualname_localization">Novo relatorio</p>-->
            </div>
        </section>


        <div class="backrelatorio">
            <article class="Corpo_caroussel">
                <div class="caroussel">


                    <form name="formrelatorio" id="formrelatorio" class="formrelatorio" action="../../Controlador/controladorCadastrarRelatorio.php" method="POST">

                        <div class="Form_container form_datahora" id="form_datahora">
                            <div class="centralizar">
                                <header class="Form_Cabecalho_container">
                                    <p class="Form_Titulo_container">Data e horário</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar">
                                        <div class="Linha"> 
                                            <img src="../../Img/Icones/calendario.png"><input type="date" name="data" class="data" id="data" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="Linha"> 
                                            <img src="../../Img/Icones/clock.png"><input type="time" name="hora" class="hora" id="hora" value="<?php echo date('H:i'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoform('form_datahora')">
                            </div>
                        </div>


                        <div class="Form_container form_salasmontadas" id="form_salasmontadas">
                            <div class="centralizar">
                                <header class="Form_Cabecalho_container">
                                    <p class="Form_Titulo_container">Salas montadas</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar" style="text-align: center">

                                        <img class="img_floatForm" src="../../Img/Icones/ClassRoom.png">

                                        <div class="inputsCheckbox">

                                            <p class="checkboxandarname">Subsolo</p>
                                            <div class="checkboxandar">
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="001"><span><p>001</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="002"><span><p>002</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="003"><span><p>003</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="004"><span><p>004</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="005"><span><p>005</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="007"><span><p>007</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="010"><span><p>010</p></span></label>
                                            </div>

                                            <p class="checkboxandarname">1° andar</p>
                                            <div class="checkboxandar">
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="101"><span><p>101</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="102"><span><p>102</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="103"><span><p>103</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="104"><span><p>104</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="105"><span><p>105</p></span></label>
                                            </div>

                                            <p class="checkboxandarname">2° andar</p>
                                            <div class="checkboxandar">
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="201"><span><p>201</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="202"><span><p>202</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="203"><span><p>203</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="204"><span><p>204</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="205"><span><p>205</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="206"><span><p>206</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="207"><span><p>207</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="208"><span><p>208</p></span></label>
                                            </div>

                                            <p class="checkboxandarname">3° andar</p>
                                            <div class="checkboxandar">
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="301"><span><p>301</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="302"><span><p>302</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="303"><span><p>303</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="304"><span><p>304</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="305"><span><p>305</p></span></label>
                                            </div>
                                            <div class="checkboxandar" style="text-align: right">
                                                <label class="csscheckbox csscheckbox-primary"><input onclick="javascript:checkAll(this,'salasmontadas')" type="checkbox"><span><p style="font-size: 11px">todas</p></span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" class="botaoprosseguir" id="botaoprosseguirsalas" value="comfirmar" onclick="return animaçaoform('form_salasmontadas')">
                            </div>
                        </div>


                        <div class="Form_container form_SinalWifi" id="form_SinalWifi">
                            <div class="centralizar">
                                <header class="Form_Cabecalho_container">
                                    <p class="Form_Titulo_container">Sinal WIFI</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar" style="text-align: center">
                                        <div class="inputsCheckboxnoleft">
                                            <label class="csscheckbox wifi csscheckbox-default" onclick="return animaçaoform('form_SinalWifi')"><input type="checkbox" name="sinalwifi" value="ruim" class="radio"><span><img src="../../Img/Icones/Sinalwifiruim.png"><p>Ruim</p></span></label>
                                            <label class="csscheckbox wifi csscheckbox-default" onclick="return animaçaoform('form_SinalWifi')"><input type="checkbox" name="sinalwifi" value="regular" class="radio"><span><img src="../../Img/Icones/SInalwifiregular.png"><p>Regular</p></span></label>
                                            <label class="csscheckbox wifi csscheckbox-default" onclick="return animaçaoform('form_SinalWifi')"><input type="checkbox" name="sinalwifi" value="bom" class="radio"><span><img src="../../Img/Icones/Sinalwifi.png"><p>Bom</p></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="Form_container form_Notebookfuncionando" id="form_Notebookfuncionando">
                            <div class="centralizar">
                                <header class="Form_Cabecalho_container">
                                    <p class="Form_Titulo_container">Notebooks funcionando?</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar" style="text-align: center">
                                        <img class="imgfloatnone" src="../../Img/Icones/laptop.png">
                                        <div class="inputsCheckboxnoleft">
                                            <label class="csscheckbox csscheckbox-default simN" onclick="return animaçaoform('form_Notebookfuncionando')"><input type="checkbox" name="notebookfuncionando" id="notebookfuncionando" value="sim" class="radio"><span><p>Sim</p></span></label>
                                            <label class="csscheckbox csscheckbox-danger naoN" onclick="return animaçaoform('form_Notebookfuncionando')"><input type="checkbox" name="notebookfuncionando" id="notebookfuncionando" value="nao" class="radio"><span><p>Nao</p></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="Form_container form_notebookproblema" id="form_notebookproblema">
                            <div class="centralizar">
                                <header class="Form_Cabecalho_container">
                                    <p class="Form_Titulo_container">notebook(s) com problema</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar" style="text-align: center">
                                        <img class="img_floatForm" src="../../Img/Icones/laptop.png">
                                        <div class="inputsCheckbox">
                                            <p class="checkboxandarname">Subsolo</p>
                                            <div class="checkboxandar">
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="001"><span><p>001</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="002"><span><p>002</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="003"><span><p>003</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="004"><span><p>004</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="005"><span><p>005</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="007"><span><p>007</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="010"><span><p>010</p></span></label>
                                            </div>

                                            <p class="checkboxandarname">1° andar</p>
                                            <div class="checkboxandar">
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="101"><span><p>101</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="102"><span><p>102</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="103"><span><p>103</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="104"><span><p>104</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="105"><span><p>105</p></span></label>
                                            </div>

                                            <p class="checkboxandarname">2° andar</p>
                                            <div class="checkboxandar">
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="201"><span><p>201</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="202"><span><p>202</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="203"><span><p>203</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="204"><span><p>204</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="205"><span><p>205</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="206"><span><p>206</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="207"><span><p>207</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="208"><span><p>208</p></span></label>
                                            </div>

                                            <p class="checkboxandarname">3° andar</p>
                                            <div class="checkboxandar">
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="301"><span><p>301</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="302"><span><p>302</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="303"><span><p>303</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="304"><span><p>304</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" class="notebooks" value="305"><span><p>305</p></span></label>
                                            </div>
                                            <div class="checkboxandar" style="text-align: right">
                                                <label class="csscheckbox csscheckbox-primary csscheckboxnote"><input onclick="javascript:checkAll(this,'notebooks')" type="checkbox"><span><p style="font-size: 11px">todas</p></span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" class="botaoprosseguir" id="botaoprosseguirnotebookproblema" value="comfirmar" onclick="return animaçaoform('form_notebookproblema')">
                            </div>
                        </div>

                        <div class="Form_container form_Especificarproblema" id="form_Especificarproblema">
                            <div class="centralizar">
                                <header class="Form_Cabecalho_container">
                                    <p class="Form_Titulo_container">Especificar problema(s)</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar" style="text-align: center">
                                        <div class="inputsCheckboxnoleft">
                                            <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="software"><span><img src="../../Img/Icones/software.png" class="especificar"><p class="especificar">software</p></span></label>
                                            <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="hardware"><span><img src="../../Img/Icones/hardware.png" class="especificar"><p class="especificar">hardware</p></span></label>
                                            <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="sinal"><span><img src="../../Img/Icones/Sinalwifi3.png" class="especificar"><p class="especificar">sinal</p></span></label>
                                            <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="sei"><span><img src="../../Img/Icones/SEI.png" class="especificar"><p class="especificar">SEI</p></span></label>
                                            <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="ap"><span><img src="../../Img/Icones/APIcon.png" class="especificar"><p class="especificar">AP</p></span></label>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" class="botaoprosseguir" id="botaoprosseguirespecificarproblema" value="comfirmar" onclick="return animaçaoform('form_Especificarproblema')">

                            </div>
                        </div>


                        <div class="Form_container form_relateproblema" id="form_relateproblema">
                            <div class="centralizar">
                                <header class="Form_Cabecalho_container">
                                    <p class="Form_Titulo_container">Informe o problema</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar" style="text-align: center">
                                        <img class="imgfloatnone" src="../../Img/Icones/laptop.png"><br>
                                        <textarea name="relatorio_notebook" id="textareanote" class="textarea" spellcheck="true" autocorrect="on"></textarea>
                                    </div>
                                </div>
                                <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoform('form_relateproblema')">
                            </div>
                        </div>


                        <div class="Form_container form_algumoutroproblema" id="form_algumoutroproblema">
                            <div class="centralizar">
                                <header class="Form_Cabecalho_container">
                                    <p class="Form_Titulo_container">mais algum problema?</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar" style="text-align: center">
                                        <img class="imgfloatnone" src="../../Img/Icones/problem.png">
                                        <div class="inputsCheckboxnoleft">
                                            <label class="csscheckbox csscheckbox-danger naoP" onclick="return animaçaoform('form_algumoutroproblema')"><input type="checkbox" name="problema" value="nao" class="radio"><span><p>Nao</p></span></label>
                                            <label class="csscheckbox csscheckbox-default simP" onclick="return animaçaoform('form_algumoutroproblema')"><input type="checkbox" name="problema" value="sim" class="radio"><span><p>Sim</p></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="Form_container form_relatealgumoutroproblema" id="form_relatealgumoutroproblema">
                            <div class="centralizar">
                                <header class="Form_Cabecalho_container">
                                    <p class="Form_Titulo_container">Informe o problema</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar" style="text-align: center">
                                        <img src="../../Img/Icones/problem.png"><br>
                                        <textarea name="relatorio_problema" class="textarea" spellcheck="true" autocorrect="on"></textarea>
                                    </div>
                                </div>
                                <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoform('form_relatealgumoutroproblema')">
                            </div>
                        </div>


                        <div class="Form_container form_finalizar" id="form_relatealgumoutroproblema">
                            <div class="centralizar" style="text-align: center">
                                <header class="Form_Cabecalho_container" style="width: 100%">
                                    <p class="Form_Titulo_container">Finalizar Relatorio</p>
                                </header>
                                <div class="Form_corpo_container">
                                    <div class="centralizar" style="text-align: center">
                                        <img class="imgfloatnone" style="float: none;width: auto;height: 150px" src="../../Img/Icones/ok.png">
                                    </div>
                                </div>
                                <input type="submit" class="botaoprosseguir" style="float: none;margin-right: 0;background: #3eba00 no-repeat;
                                       " value="Finalizar">
                            </div>
                        </div>



                    </form>
                </div>


            </article>
        </div>
        <?php
//        $letras = array("a", "b", "c");
//        $stringArrayF = implode(",", $letras);
//        echo $stringArrayF; //retorna abc
        ?>









        <div class="background">
            <div class="background_relatorio" style="background: url('../..//Img/Backgrounds/report new.jpg') no-repeat center;
                 -webkit-background-size: contain;
                 -moz-background-size: contain;
                 -o-background-size: contain;
                 background-size: contain;">
            </div>
        </div>



    </body>
</html>
