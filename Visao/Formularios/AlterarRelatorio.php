<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

$idfuncionariologado = $_SESSION['IdUsuarioLogado'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../Css/ElementStatic_estilo.css">
        <link rel="stylesheet" href="../../Css/Form_estilo.css">
        <link rel="stylesheet" href="../../Css/CheckBox.css">

        <script src="../../Js/jquery-3.2.1.min.js"></script>
        <script src="../../Js/Forms.js"></script>
        <script src="../../Js/PopUps.js"></script>
        <script src="../../Js/velocity.min.js"></script>
        <script src="../../Js/velocity.ui.js"></script>
        <title></title>
    </head>
    <body class="corpo">


        <div class="logo">
            <div class="centralizar">
                <h1 style="font-size: 50px;float: left;margin: 0;color: #984B43">RDA</h1>
                <h1 style="font-size: 25px;float: left;color: white;text-shadow: 1px 1px 5px rgba(0,0,0, 1);">Project</h1>
            </div>
        </div>

        <header class="topo">
            <div class="user">
                <div class="centralizar">
                    <div class="picuser" style="        
                         background: url('<?php echo "../../Img/Userimg/{$_SESSION['PictureUsuarLologado']}"; ?>') no-repeat center;
                         -webkit-background-size: cover;
                         -moz-background-size: cover;
                         -o-background-size: cover;
                         background-size: cover;"></div>
                    <h1 class="texttag"><?php echo $_SESSION['TagUsuarioLogado']; ?></h1>
                    <h1 class="textperfil"><?php echo "#" . $_SESSION['PerfilUsuarLologado']; ?></h1>
                    <h3 class="textsair"><a href="../../Controlador/controladorLogin.php?logout=1">Sair</a></h3>
                </div>
            </div>
            <?php if (!empty($_SESSION["ultimocadastronaorealizado"]) && $_SESSION["ultimocadastronaorealizado"] == 2) { ?>
                <div id="popup">
                    <div class="popup">
                        <div class="centralizar">
                            <p>Relatorio</p>
                            <img src="../../Img/Icones/fail.png">
                            <p class="fail">Seu ultimo relatorio nao foi cadastrado</p>
                            <p class="view">Faça o relatorio corretamente</p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php if (!empty($_SESSION["cadastronaorealizado"]) && $_SESSION["cadastronaorealizado"] == 1) { ?>
                <div id="popup">
                    <div class="popup">
                        <div class="centralizar">
                            <p>Novo Relatorio</p>
                            <img src="../../Img/Icones/fail.png">
                            <p class="fail">nao cadastrado</p>
                            <p class="view" style="margin-bottom: 20px;font-size: 15px">houve falha nos seguintes campos:</p>
                            <?php
                            if (!empty($_SESSION["popup"])) {
                                foreach ($_SESSION["popup"] as $value) {
                                    ?>
                                    <p class="mensagensfailcadastro"><?php echo $value . "<hr class='hrmensagens'>"; ?></p>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                unset($_SESSION["cadastronaorealizado"]);
                $_SESSION["ultimocadastronaorealizado"] = 2;
            }
            ?>

        </header>




        <section class="localization">
            <div class="centralizar">
                <a href="../../Controlador/listarRelatorio.php"><img class="icon_back" src="../../Img/Icones/iconBack.png"></a>
                <img class="icon_relatorio" src="../../Img/Icones/Relatorios.png">
                <p class="name_localization">Alterar Relatório</p>
            </div>
        </section>


        <?php
        include '../../Modelo/DAO/classeRelatoriosDAO.php';

        if (!empty($_GET['idRelatorio'])) {
            $idRelatorio = $_GET['idRelatorio'];


            $relatorioDAO = new classeRelatoriosDAO();
            $resultadoRelatorio = $relatorioDAO->listarRelatoriosPorID($idRelatorio, "idrelatorios");

            foreach ($resultadoRelatorio as $Relatorio) {
                ?>


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
                                                <img src="../../Img/Icones/calendario.png"><input type="date" name="data" class="data" id="data" value="<?php echo $Relatorio['data']; ?>">
                                            </div>
                                            <div class="Linha"> 
                                                <img src="../../Img/Icones/clock.png"><input type="time" name="hora" class="hora" id="hora" value="<?php echo $Relatorio['hora']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoform('form_datahora')">
                                </div>
                            </div>


                            <?php
                            $idrelatorio = $Relatorio["idrelatorios"];
                            $listarSalasDAO = new classeRelatoriosDAO();
                            $listarSalas = $listarSalasDAO->listarsalasFULL($idrelatorio);

                            foreach ($listarSalas as $salas) {
                                switch ($salas['numerosala']) {
                                    case 1:$sala[1] = $salas['numerosala'];
                                        break;
                                    case 2:$sala[2] = $salas['numerosala'];
                                        break;
                                    case 3:$sala[3] = $salas['numerosala'];
                                        break;
                                    case 4:$sala[4] = $salas['numerosala'];
                                        break;
                                    case 5:$sala[5] = $salas['numerosala'];
                                        break;
                                    case 101:$sala[101] = $salas['numerosala'];
                                        break;
                                    case 102:$sala[102] = $salas['numerosala'];
                                        break;
                                    case 103:$sala[103] = $salas['numerosala'];
                                        break;
                                    case 104:$sala[104] = $salas['numerosala'];
                                        break;
                                    case 105:$sala[105] = $salas['numerosala'];
                                        break;
                                    case 201:$sala[201] = $salas['numerosala'];
                                        break;
                                    case 202:$sala[202] = $salas['numerosala'];
                                        break;
                                    case 203:$sala[203] = $salas['numerosala'];
                                        break;
                                    case 204:$sala[204] = $salas['numerosala'];
                                        break;
                                    case 205:$sala[205] = $salas['numerosala'];
                                        break;
                                    case 206:$sala[206] = $salas['numerosala'];
                                        break;
                                    case 207:$sala[207] = $salas['numerosala'];
                                        break;
                                    case 208:$sala[208] = $salas['numerosala'];
                                        break;
                                    case 301:$sala[301] = $salas['numerosala'];
                                        break;
                                    case 302:$sala[302] = $salas['numerosala'];
                                        break;
                                    case 303:$sala[303] = $salas['numerosala'];
                                        break;
                                    case 304:$sala[304] = $salas['numerosala'];
                                        break;
                                    case 305:$sala[305] = $salas['numerosala'];
                                        break;
                                }
                            }
                            ?>
                            <div class="Form_container form_salasmontadas" id="form_salasmontadas">
                                <div class="centralizar">
                                    <header class="Form_Cabecalho_container">
                                        <p class="Form_Titulo_container">Salas montadas</p>
                                    </header>
                                    <div class="Form_corpo_container">
                                        <div class="centralizar" style="text-align: center">
                                            <img class="img_floatForm" src="../../Img/Icones/ClassRoom.png">
                                            <div class="inputsCheckbox">
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[1])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="001"><span><p>001</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[2])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="002"><span><p>002</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[3])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="003"><span><p>003</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[4])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="004"><span><p>004</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[5])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="005"><span><p>005</p></span></label><br>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[101])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="101"><span><p>101</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[102])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="102"><span><p>102</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[103])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="103"><span><p>103</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[104])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="104"><span><p>104</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[105])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="105"><span><p>105</p></span></label><br>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[201])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="201"><span><p>201</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[202])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="202"><span><p>202</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[203])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="203"><span><p>203</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[204])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="204"><span><p>204</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[205])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="205"><span><p>205</p></span></label><br>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[206])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="206"><span><p>206</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[207])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="207"><span><p>207</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[208])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="208"><span><p>208</p></span></label><br>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[301])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="301"><span><p>301</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[302])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="302"><span><p>302</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[303])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="303"><span><p>303</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[304])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="304"><span><p>304</p></span></label>
                                                <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[305])) { ?> checked <?php } ?> name="salasmontadas[]" id="salasmontadas" value="305"><span><p>305</p></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoform('form_salasmontadas')">
                                </div>
                            </div>

                            <div class="Form_container form_SinalWifi" id="form_SinalWifi">
                                <div class="centralizar">
                                    <header class="Form_Cabecalho_container">
                                        <p class="Form_Titulo_container">Sinal WIFI</p>
                                    </header>
                                    <div class="Form_corpo_container">
                                        <div class="centralizar" style="text-align: center">
                                            <div class="inputsCheckbox">
                                                <label class="csscheckbox wifi csscheckbox-danger" onclick="return animaçaoform('form_SinalWifi')"><input type="checkbox" <?php if ($Relatorio['wifi'] == 'ruim') { ?> checked <?php } ?> name="sinalwifi" value="ruim" class="radio"><span><img src="../../Img/Icones/Sinalwifiruim.png"><p>Ruim</p></span></label>
                                                <label class="csscheckbox wifi csscheckbox-warning" onclick="return animaçaoform('form_SinalWifi')"><input type="checkbox" <?php if ($Relatorio['wifi'] == 'regular') { ?> checked <?php } ?> name="sinalwifi" value="regular" class="radio"><span><img src="../../Img/Icones/SInalwifiregular.png"><p>Regular</p></span></label>
                                                <label class="csscheckbox wifi csscheckbox-default" onclick="return animaçaoform('form_SinalWifi')"><input type="checkbox" <?php if ($Relatorio['wifi'] == 'bom') { ?> checked <?php } ?> name="sinalwifi" value="bom" class="radio"><span><img src="../../Img/Icones/Sinalwifi.png"><p>Bom</p></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoform('form_SinalWifi')">

                                </div>
                            </div>


                            <div class="Form_container form_Notebookfuncionando" id="form_Notebookfuncionando">
                                <div class="centralizar">
                                    <header class="Form_Cabecalho_container">
                                        <p class="Form_Titulo_container">Notebooks funcionando corretamente?</p>
                                    </header>
                                    <div class="Form_corpo_container">
                                        <div class="centralizar" style="text-align: center">
                                            <img class="imgfloatnone" src="../../Img/Icones/laptop.png">
                                            <div class="inputsCheckbox">
                                                <label class="csscheckbox csscheckbox-default simN" onclick="return animaçaoform('form_Notebookfuncionando')"><input type="checkbox" <?php if ($Relatorio['notebooksfuncionando'] == 'sim') { ?> checked <?php } ?> name="notebookfuncionando" id="notebookfuncionando" value="sim" class="radio"><span><p>Sim</p></span></label>
                                                <label class="csscheckbox csscheckbox-danger naoN" onclick="return animaçaoform('form_Notebookfuncionando')"><input type="checkbox" <?php if ($Relatorio['notebooksfuncionando'] == 'nao') { ?> checked <?php } ?> name="notebookfuncionando" id="notebookfuncionando" value="nao" class="radio"><span><p>Nao</p></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoform('form_Notebookfuncionando')">

                                </div>
                            </div>


                            <div class="Form_container form_notebookproblema" id="form_notebookproblema">
                                <div class="centralizar">
                                    <header class="Form_Cabecalho_container">
                                        <p class="Form_Titulo_container">Selecione o(s) notebook(s) com problema</p>
                                    </header>
                                    <div class="Form_corpo_container">
                                        <div class="centralizar" style="text-align: center">
                                            <img class="img_floatForm" src="../../Img/Icones/laptop.png">
                                            <div class="inputsCheckbox">
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="001"><span><p>001</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="002"><span><p>002</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="003"><span><p>003</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="004"><span><p>004</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="005"><span><p>005</p></span></label><br>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="101"><span><p>101</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="102"><span><p>102</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="103"><span><p>103</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="104"><span><p>104</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="105"><span><p>105</p></span></label><br>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="201"><span><p>201</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="202"><span><p>202</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="203"><span><p>203</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="204"><span><p>204</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="205"><span><p>205</p></span></label><br>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="206"><span><p>206</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="207"><span><p>207</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="208"><span><p>208</p></span></label><br>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="301"><span><p>301</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="302"><span><p>302</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="303"><span><p>303</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="304"><span><p>304</p></span></label>
                                                <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" name="notebooks[]" value="305"><span><p>305</p></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" class="botaoprosseguir" id="botaoprosseguirnotebookproblema" value="comfirmar" onclick="return animaçaoform('form_notebookproblema')">
                                </div>
                            </div>


                            <div class="Form_container form_relateproblema" id="form_relateproblema">
                                <div class="centralizar">
                                    <header class="Form_Cabecalho_container">
                                        <p class="Form_Titulo_container">Relate o problema com o(s) notebook(s)</p>
                                    </header>
                                    <div class="Form_corpo_container">
                                        <div class="centralizar" style="text-align: center">
                                            <img src="../../Img/Icones/laptop.png"><br>
                                            <textarea name="relatorio_notebook" id="textareanote" class="textarea" spellcheck="true" autocorrect="on"></textarea>
                                        </div>
                                    </div>
                                    <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoform('form_relateproblema')">
                                </div>
                            </div>


                            <div class="Form_container form_algumoutroproblema" id="form_algumoutroproblema">
                                <div class="centralizar">
                                    <header class="Form_Cabecalho_container">
                                        <p class="Form_Titulo_container">Relatar algum problema a mais?</p>
                                    </header>
                                    <div class="Form_corpo_container">
                                        <div class="centralizar" style="text-align: center">
                                            <img src="../../Img/Icones/problem.png">
                                            <div class="inputsCheckbox">
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
                                        <p class="Form_Titulo_container">Relate o problema abaixo</p>
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
                                    <header class="Form_Cabecalho_container">
                                        <p class="Form_Titulo_container">Finalizar Relatorio</p>
                                    </header>
                                    <div class="Form_corpo_container">
                                        <div class="centralizar" style="text-align: center">
                                            <img style="float: none" src="../../Img/Icones/ok.png">
                                        </div>
                                    </div>
                                    <input type="submit" class="botaoprosseguir" style="float: none;margin-right: 0;background: url('../..//Img/Icones/Submit.png') no-repeat;
                                           " value="Finalizar">
                                </div>
                            </div>





                        </form>
                    </div>

                </div>
            </article>

            <?php
        }
    }
                $valores = array($_POST['relatorio_problema'] = 'asdasdasd', $idRelatorioAlterar = 1, $idfuncionariologado = 10);
                $valoresporvirgula = implode(",", $valores);
    echo $valoresporvirgula; //retorna abc
//        $letras = array("a", "b", "c");
//        $stringArrayF = implode(",", $letras);
//        echo $stringArrayF; //retorna abc
    ?>









    <div class="background">
        <img class="background_relatorio" src="../../Img/Icones/iconrelatorio.png">
    </div>

</body>
</html>
