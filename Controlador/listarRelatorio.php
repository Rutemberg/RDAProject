<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

include_once '../Modelo/DAO/classeRelatoriosDAO.php';
include_once '../Modelo/DAO/classeUsuarioDAO.php';

if (!empty($_GET['idRelatorio'])) {
    $idRelatorio = $_GET['idRelatorio'];
}

$idfuncionariologado = $_SESSION['IdUsuarioLogado'];

$listarRelatorio = new classeRelatoriosDAO();

if (empty($_GET['idRelatorio'])) {
    $resultadoRelatorio = $listarRelatorio->verRelatorios($idfuncionariologado, "idrelatorios", "DESC LIMIT 1");
} else {
    $resultadoRelatorio = $listarRelatorio->listarRelatoriosPorID($idRelatorio, "idrelatorios", "DESC LIMIT 1");
}
foreach ($resultadoRelatorio as $relatorio) {
    $idrelatorio = $relatorio['idrelatorios'];
    $idRelatorio = $relatorio['idrelatorios'];
    $idfuncionario = $relatorio['idfuncionario'];

    $listarFuncionario = new classeUsuarioDAO();
    $resultadoFuncionario = $listarFuncionario->listarUsuario("*", $idfuncionario, 'idusuario', 'LIMIT 1');

    foreach ($resultadoFuncionario as $Funcionario) {
        $nomeFuncionario = $Funcionario['tag'];
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RDA - Faculdade Processus</title>


        <link rel="stylesheet" href="../Css/Lists_estilos.css">
        <link rel="stylesheet" href="../Css/Form_estilo.css">
        <link rel="stylesheet" href="../Css/FormAlterar_estilo.css">
        <link rel="stylesheet" href="../Css/Animation.css">
        <link rel="stylesheet" href="../Css/CheckBox.css">
        <link rel="stylesheet" href="../Css/Print.css">
        <link rel="stylesheet" href="../Css/ElementStatic_estilo.css">



        <script src="../Js/jquery-3.2.1.min.js"></script>
        <script src="../Js/Login.js"></script>
        <script src="../Js/Home.js"></script>
        <script src="../Js/Listar.js"></script>
        <script src="../Js/PopUps.js"></script>
        <script src="../Js/velocity.min.js"></script>
        <script src="../Js/velocity.ui.js"></script>
        <script src="../Js/jquery.foggy.min.js"></script>
        <script src="../Js/Forms.js"></script>
        <script src="../Js/Animacoes.js"></script>

    </head>
    <body class="corpo">
        <div id="corpo">

            <div class="backgroundtopo">

                <ul class="navegacao">
                    <li class="mark">Visualizar Relatório</li>
                </ul>
                <ul class="navegacao navegacaosub">
                    <?php if (!empty($_GET['idRelatorio'])) { ?>
                        <li>Relatorio #<?php echo $_GET['idRelatorio']; ?></li>
                    <?php } else { ?>
                        <li>Ultimo relatorio</li>
                    <?php } ?>
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


            <?php if (!empty($_SESSION["alteracaorealizada"]) && $_SESSION["alteracaorealizada"] == 1) { ?>

                <div class="backmensagem">
                    <div id="backmensagem">
                        <div class="centralizar">

                            <div class="mensagem">
                                <div id="mensagem">
                                    <div class="centralizar">

                                        <div class="mensagem_top">
                                            <p>Alteração</p>
                                        </div>

                                        <div class="mensagem_corpo">

                                            <div class="mensagem_corpo_inlineblock mensagem_corpo_img">
                                                <div id="mensagem_corpo_img">
                                                    <div class="centralizar">
                                                        <img src="../Img/Icones/ok.png">
                                                        <p class="mensagem_sucess">Realizada com sucesso</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mensagem_corpo_inlineblock mensagem_corpo_corpo">
                                                <div id="mensagem_corpo_corpo">
                                                    <div class="centralizar">
                                                        <p class="mensagem_corpo_corpo_top">relatorio alteracao</p>
                                                        <?php
                                                        if (!empty($_SESSION["popupalteracaofinalizada"])) {
                                                            foreach ($_SESSION["popupalteracaofinalizada"] as $value) {
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
                unset($_SESSION["alteracaorealizada"]);
                unset($_SESSION["popupalteracaofinalizada"]);
            }
            ?>



            <?php if (!empty($_SESSION["alteracaonaorealizada"]) && $_SESSION["alteracaonaorealizada"] == 1) { ?>

                <div class="backmensagem">
                    <div id="backmensagem">
                        <div class="centralizar">

                            <div class="mensagem">
                                <div id="mensagem">
                                    <div class="centralizar">

                                        <div class="mensagem_top">
                                            <p>Alteração</p>
                                        </div>

                                        <div class="mensagem_corpo">

                                            <div class="mensagem_corpo_inlineblock mensagem_corpo_img">
                                                <div id="mensagem_corpo_img">
                                                    <div class="centralizar">
                                                        <img src="../Img/Icones/fail.png">
                                                        <p class="mensagem_Fail">nao realizada</p>
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
                unset($_SESSION["alteracaonaorealizada"]);
                unset($_SESSION["cadastronaorealizado"]);
                unset($_SESSION["popup"]);
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
                                                        <img src="../Img/Icones/fail.png">
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



            <section class="localization">
                <div class="centralizar">
                    <div class="localizationback">
                        <a href="../Home.php?Pagina=RDA"><img class="icon_back animacao" src="../Img/Icones/iconBack.png"></a>
                        <p class="name_localization">RDA</p>
                    </div>
                    <div class="localizationGo">
                        <p class="name_localization" style="margin-right: 10px;">Relatorios</p>
                        <a href="listarRelatorios.php"><img class="icon_back animacao" style="margin-left: 20px" src="../Img/Icones/iconGO.png"></a>
                    </div>

                </div>
            </section>


            <div class="backexlcuir">
                <div id="backmensagem">
                    <div class="centralizar">

                        <div class="mensagem">
                            <div id="mensagem">
                                <div class="centralizar">

                                    <div class="backexlcuir_top">
                                        <p>Excluir Relatorio</p>
                                    </div>

                                    <div class="mensagem_corpo">

                                        <div class="mensagem_corpo_inlineblock backexcluir_corpo_img">
                                            <div id="mensagem_corpo_img2">
                                                <div class="centralizar">
                                                    <img src="../Img/Icones/fail.png">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mensagem_corpo_inlineblock backexcluir_corpo_corpo">
                                            <div id="mensagem_corpo_corpo">
                                                <div class="centralizar">
                                                    <p class="backexcluir_corpo_corpo_top" style="font-size: 17px">Comfirmar exclusao</p>
                                                    <div class="backexcluir_corpo_corpo_mensagem">
                                                        <label class="csscheckbox" onclick="return redirection('controladorExcluir.php?idRelatorio=<?php echo $idRelatorio; ?>')"><input type="checkbox" class="radio"><span><p>Sim</p></span></label>
                                                        <label class="csscheckbox" onclick="return fecharexcluirRelatorio()"><input type="checkbox" class="radio"><span><p>Nao</p></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="backexlcuir_bottom">
                                        <hr>
                                    </div>
                                    <div class="fecharmensagem">
                                        <button class="botaofecharexcluir" onclick="return fecharexcluirRelatorio()">fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            <div class="backverrelatorio">
                <article class="verrelatorio" id="verrelatorio">



                    <?php
                    foreach ($resultadoRelatorio as $relatorio) {
                        $idrelatorio = $relatorio['idrelatorios'];
                        $idfuncionario = $relatorio['idfuncionario'];

                        $listarFuncionario = new classeUsuarioDAO();
                        $resultadoFuncionario = $listarFuncionario->listarUsuario("*", $idfuncionario, 'idusuario', 'LIMIT 1');

                        foreach ($resultadoFuncionario as $Funcionario) {
                            ?>

                            <div class="verrelatorio_nomeUser">
                                <p class="vnomeUser"><?php echo $Funcionario['tag']; ?></p>
                            </div>
                            <div class="verrelatorio_nomeUser">
                                <p class="vinformationUser">
                                    <?php
                                    $listarnderelatoriosDAO = new classeRelatoriosDAO();
                                    $listarnderelatorios = $listarnderelatoriosDAO->COUNT('relatorios', 'idfuncionario', $Funcionario['idusuario']);
                                    $COUNT = $listarnderelatorios;
//                var_dump($COUNT);
                                    echo $Funcionario['campus'] . " | " . $Funcionario['cargo'] . " | " . "relatorios feitos: " . $COUNT[0];
                                    ?>

                                </p>
                            </div>

                        <?php } ?>


                        <div class="vrelatorio" id="vrelatorio">
                            <?php if ($idfuncionario == $idfuncionariologado) { ?>
                                <div class="habilitarediçao">
                                    <button class="excluirrelatorio_button" onclick="return excluirRelatorio()">Excluir relatorio</button>
                                </div>
                            <?php } ?>
                            <div class="vrelatorio_backpicUser">
                                <div class="vrelatorio_picUser">
                                    <div style="width: 100%;height: 100%;background: url('<?php echo "../Img/Userimg/{$Funcionario['picture']}"; ?>') no-repeat top center;
                                         -webkit-background-size: contain;
                                         -moz-background-size: contain;
                                         -o-background-size: contain;
                                         background-size: contain;">
                                    </div>
                                </div>
                            </div>

                            <div class="vrelatorio_Relatorio">
                                <div class="vrelatorio_data" <?php if ($idfuncionario == $idfuncionariologado) { ?>onclick="return animaçaoformalterar('formalterardataehora')"<?php } ?>>
                                    <p class="animacaopadrao">
                                        <?php
                                        $dia = explode("-", $relatorio['data']);
                                        echo $dia[2] . " de " . $relatorio['mes'] . " | " . $relatorio['ano'];
                                        ?>
                                    </p>
                                </div>

                                <div class="vrelatorio_RelatorioLeft">
                                    <div id="vrelatorio_RelatorioLeft">
                                        <div class="centralizar">

                                            <div class="vhorawifi vhora animacaopadrao" <?php if ($idfuncionario == $idfuncionariologado) { ?>onclick="animaçaoformalterar('formalterardataehora')"<?php } ?>>
                                                <div style="display: table;width: 100%;height: 100%">
                                                    <div class="centralizar">
                                                        <p class="vhorawifi_label">Hora</p>
                                                        <p class="vhorawifi_hora">
                                                            <?php
                                                            $relatorio['hora'] = substr($relatorio['hora'], 0, -3);
                                                            echo $relatorio['hora'];
                                                            ?>
                                                        </p>
                                                        <p class="vhorawifi_label" style="font-family: pirulen;font-size: 10px"><?php echo $relatorio['turno'] ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="vhorawifi vwifi animacaopadrao" <?php if ($idfuncionario == $idfuncionariologado) { ?>onclick="animaçaoformalterar('formalterarsinalwifi')"<?php } ?>>
                                                <div style="display: table;width: 100%;height: 100%">
                                                    <div class="centralizar">
                                                        <?php if ($relatorio['wifi'] == 'regular') { ?>
                                                            <img class="viconewifi" src="../Img/Icones/SInalwifiregular2.png">
                                                        <?php } ?>
                                                        <?php if ($relatorio['wifi'] == 'bom') { ?>
                                                            <img class="viconewifi" src="../Img/Icones/Sinalwifi2.png">
                                                        <?php } ?>
                                                        <?php if ($relatorio['wifi'] == 'ruim') { ?>
                                                            <img class="viconewifi" src="../Img/Icones/Sinalwifiruim2.png">
                                                        <?php } ?>
                                                        <p class="vhorawifi_wifi"><?php echo $relatorio['wifi']; ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="vrelatorio_salas salas animacaopadrao" <?php if ($idfuncionario == $idfuncionariologado) { ?>onclick="animaçaoformalterar('formalterarsalas')"<?php } ?>>
                                                <div class="vrelatorio_titulocampos">
                                                    <img src="../Img/Icones/ClassRoom.png">
                                                    <p>SALAS MONTADAS</p>
                                                </div>
                                                <?php
                                                $listarSalas = new classeRelatoriosDAO();
                                                $resultadoSalas = $listarSalas->listarsalasFULL($idrelatorio);
                                                foreach ($resultadoSalas as $salas) {
                                                    $salas['numerosala'] = sprintf("%03d", $salas['numerosala']);
                                                    ?>
                                                    <div class="vrelatorio_salas_blocos">
                                                        <?php echo $salas['numerosala'] . " "; ?>
                                                    </div>
                                                <?php }
                                                ?>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="vrelatorio_RelatorioRight">
                                    <div id="vrelatorio_RelatorioRight">
                                        <div class="centralizar">
                                            <?php
                                            if ($relatorio['notebooksfuncionando'] == 'sim') {
                                                $color = '#3eba00';
                                            } else {
                                                $color = '#5d7077';
                                                $background = '#a20027';
                                                $textColor = 'white';
                                            }
                                            ?>
                                            <div class="vrelatorio_salas vnotes animacaopadrao" <?php if ($idfuncionario == $idfuncionariologado) { ?>onclick="return animaçaoformalterar('formalterarnotebooks')"<?php } ?>>
                                                <div class="vrelatorio_titulocampos">
                                                    <img src="../Img/Icones/laptop.png">
                                                    <p style="color: <?php echo $color; ?>">Notebooks</p>
                                                </div>
                                                <?php
                                                if ($relatorio['notebooksfuncionando'] == 'nao') {
                                                    $listar = new classeRelatoriosDAO();
                                                    $resultadoNotes = $listar->listarnotebookFULL($idrelatorio);

                                                    foreach ($resultadoNotes as $notes) {
                                                        $notes['numeronotebook'] = sprintf("%03d", $notes['numeronotebook']);
                                                        ?>
                                                        <div class="vrelatorio_salas_blocos" style="background: <?php echo $background; ?>;color: <?php echo $textColor; ?>">
                                                            <?php echo $notes['numeronotebook'] . " "; ?>
                                                        </div>
                                                        <?php
                                                    }


                                                    $resultadoProblema = $listar->listarESPECIFIC('*', 'problemas', 'idproblema', null, "WHERE idrelatorio = ", $idrelatorio);
                                                    ?>

                                                    <div style="text-align: center; margin: 10px 0;">
                                                        <?php
                                                        foreach ($resultadoProblema as $value) {
                                                            switch ($value['problema']) {
                                                                case 'software':
                                                                    ?>

                                                                    <div class="vrelatorio_salas_blocos problemas">
                                                                        <img class="vrelatorio_salas_blocos_img" src="../Img/Icones/software.png" title="software">
                                                                    </div>
                                                                    <?php
                                                                    break;
                                                                case 'hardware':
                                                                    ?>
                                                                    <div class="vrelatorio_salas_blocos problemas">
                                                                        <img class="vrelatorio_salas_blocos_img" src="../Img/Icones/hardware.png" title="hardware">
                                                                    </div>
                                                                    <?php
                                                                    break;
                                                                case 'sinal':
                                                                    ?>
                                                                    <div class="vrelatorio_salas_blocos problemas">
                                                                        <img class="vrelatorio_salas_blocos_img" src="../Img/Icones/Sinalwifi3.png" title="sinal">
                                                                    </div>
                                                                    <?php
                                                                    break;
                                                                case 'ap':
                                                                    ?>
                                                                    <div class="vrelatorio_salas_blocos problemas">
                                                                        <img class="vrelatorio_salas_blocos_img" src="../Img/Icones/APIcon.png" title="ap">
                                                                    </div>
                                                                    <?php
                                                                    break;
                                                                case 'sei':
                                                                    ?>
                                                                    <div class="vrelatorio_salas_blocos problemas">
                                                                        <img class="vrelatorio_salas_blocos_img" src="../Img/Icones/SEI.png" title="sei">
                                                                    </div>
                                                                    <?php
                                                                    break;

                                                                default:
                                                                    break;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                <?php }
                                                ?>

                                                <div class="vrelatorio_relatorionote">
                                                    <?php
                                                    $listarrelatorio = new classeRelatoriosDAO();
                                                    $resultadoRelatorionote = $listarrelatorio->listarrelatorionotebookFULL($idrelatorio);

                                                    foreach ($resultadoRelatorionote as $Relatorionote) {
                                                        echo $Relatorionote['relatorio'];
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <?php
                                            if ($relatorio['outrosproblemas'] == 'sim') {
                                                ?>
                                                <div class="vrelatorio_salas vproblema animacaopadrao" <?php if ($idfuncionario == $idfuncionariologado) { ?>onclick="return animaçaoformalterar('formalterarproblema')"<?php } ?>>
                                                    <div class="vrelatorio_titulocampos">
                                                        <img src="../Img/Icones/problem.png">
                                                        <p style="color: #5d7077">Problema</p>
                                                    </div>
                                                    <div class="vrelatorio_relatorionote">
                                                        <?php
                                                        $resultadoRelatorioproblem = $listarrelatorio->listarproblemaFULL($idrelatorio);

                                                        foreach ($resultadoRelatorioproblem as $Relatorioproblem) {
                                                            echo $Relatorioproblem['relatoriop'];
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="vrelatorio_salas vproblema adicionarproblema animacaopadrao" <?php if ($idfuncionario == $idfuncionariologado) { ?>onclick="return animaçaoformalterar('formalterarproblema')"<?php } ?>>
                                                    <div class="vrelatorio_titulocampos">
                                                        <img src="../Img/Icones/problem.png">
                                                        <p style="color: #5d7077">nenhum problema</p>
                                                    </div>
                                                    <div class="vrelatorio_relatorionote" style="text-align: center">
                                                        clique para adicionar um 
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    <?php } ?>
                </article>
            </div>


        </div>



        <div class="formalterar formalterardataehora">
            <div id="formalterar">
                <div class="centralizar">

                    <div class="corpo_formalterar">
                        <div id="corpo_formalterar">
                            <div class="centralizar">

                                <div class="corpo_formalterar_top">
                                    <p>Alterar data/hora</p>
                                </div>

                                <div class="corpo_formalterar_corpo">

                                    <div class="corpoformalterarcarousel">
                                        <div class="formalterarcarousel">

                                            <form name="formrelatorio" id="formalterarrelatorio" class="formalterarrelatorio" action="../Controlador/controladorAlterarRelatorio.php?alterar=data_hora" method="POST">
                                                <input name="idRelatorioAlterar" id="idRelatorioAlterar" class="idRelatorioAlterar" type="text" value="<?php echo $relatorio['idrelatorios']; ?>" hidden>
                                                <div class="form_alterar">
                                                    <div class="Formalterar_container formalterar_datahora">
                                                        <div class="centralizar">
                                                            <div class="Formalterar_corpo_container">
                                                                <div class="centralizar">
                                                                    <div class="Linhaalterar"> 
                                                                        <img src="../Img/Icones/calendario.png"><input type="date" name="data" class="data" id="data" value="<?php echo $relatorio['data']; ?>">
                                                                    </div>
                                                                    <div class="Linhaalterar"> 
                                                                        <img src="../Img/Icones/clock.png"><input type="time" name="hora" class="hora" id="hora" value="<?php echo $relatorio['hora']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoformsaida('form_alterar')">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="Formalterar_container formalterar_finalizar">
                                                    <div class="centralizar" > 
                                                        <img class="Formalterar_container_iconfinalizar" src="../Img/Icones/ok.png"><br>
                                                        <input type="submit" class="botaofinalizar" value="Alterar">
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>

                                </div>

                                <div class="corpo_formalterar_bottom">
                                    <hr>
                                </div>
                                <div class="corpo_formalterar_fecharmensagem">
                                    <button class="botaofecharalterar" onclick="return animaçaoformalterarfechar('formalterardataehora', 'form_alterar')">fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="formalterar formalterarsalas">
            <div id="formalterar">
                <div class="centralizar">

                    <div class="corpo_formalterar">
                        <div id="corpo_formalterar">
                            <div class="centralizar">

                                <div class="corpo_formalterar_top">
                                    <p>Alterar salas</p>
                                </div>

                                <div class="corpo_formalterar_corpo">

                                    <div class="corpoformalterarcarousel">
                                        <div class="formalterarcarousel">

                                            <form name="formrelatorio" id="formalterarrelatorio" class="formalterarrelatorio" action="../Controlador/controladorAlterarRelatorio.php?alterar=salasmontadas" method="POST">
                                                <input name="idRelatorioAlterar" id="idRelatorioAlterar" class="idRelatorioAlterar" type="text" value="<?php echo $relatorio['idrelatorios']; ?>" hidden>

                                                <?php
                                                $idrelatorio = $relatorio['idrelatorios'];
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
                                                        case 7:$sala[7] = $salas['numerosala'];
                                                            break;
                                                        case 10:$sala[10] = $salas['numerosala'];
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
                                                <div class="form_alterar">
                                                    <div class="Formalterar_container formalterar_salasmontadas" id="form_salasmontadas">
                                                        <div class="centralizar">
                                                            <div class="Formalterar_corpo_container">
                                                                <div class="centralizar">
    <!--                                                                <img class="img_floatForm" src="../Img/Icones/ClassRoom.png">-->

                                                                    <div class="inputsalterarCheckbox">
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[1])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="001"><span><p>001</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[2])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="002"><span><p>002</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[3])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="003"><span><p>003</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[4])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="004"><span><p>004</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[5])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="005"><span><p>005</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[7])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="007"><span><p>007</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[10])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="010"><span><p>010</p></span></label><br>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[101])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="101"><span><p>101</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[102])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="102"><span><p>102</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[103])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="103"><span><p>103</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[104])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="104"><span><p>104</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[105])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="105"><span><p>105</p></span></label><br>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[201])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="201"><span><p>201</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[202])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="202"><span><p>202</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[203])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="203"><span><p>203</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[204])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="204"><span><p>204</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[205])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="205"><span><p>205</p></span></label><br>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[206])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="206"><span><p>206</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[207])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="207"><span><p>207</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[208])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="208"><span><p>208</p></span></label><br>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[301])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="301"><span><p>301</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[302])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="302"><span><p>302</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[303])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="303"><span><p>303</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[304])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="304"><span><p>304</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default"><input type="checkbox" <?php if (!empty($sala[305])) { ?> checked <?php } ?> name="salasmontadas[]" class="salasmontadas" id="salasmontadas" value="305"><span><p>305</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-primary "><input onclick="javascript:checkAll(this, 'salasmontadas')" type="checkbox"><span><p style="font-size: 11px">todas</p></span></label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoformsaida('form_alterar')">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="Formalterar_container formalterar_finalizar">
                                                    <div class="centralizar" > 
                                                        <img class="Formalterar_container_iconfinalizar" src="../Img/Icones/ok.png"><br>
                                                        <input type="submit" class="botaofinalizar" value="Alterar">
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                </div>

                                <div class="corpo_formalterar_bottom">
                                    <hr>
                                </div>
                                <div class="corpo_formalterar_fecharmensagem">
                                    <button class="botaofecharalterar" onclick="return animaçaoformalterarfechar('formalterarsalas', 'form_alterar')">fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="formalterar formalterarsinalwifi">
            <div id="formalterar">
                <div class="centralizar">

                    <div class="corpo_formalterar">
                        <div id="corpo_formalterar">
                            <div class="centralizar">

                                <div class="corpo_formalterar_top">
                                    <p>Alterar WIFI</p>
                                </div>

                                <div class="corpo_formalterar_corpo">

                                    <div class="corpoformalterarcarousel">
                                        <div class="formalterarcarousel">


                                            <form name="formrelatorio" id="formalterarrelatorio" class="formalterarrelatorio" action="../Controlador/controladorAlterarRelatorio.php?alterar=sinalwifi" method="POST">
                                                <input name="idRelatorioAlterar" id="idRelatorioAlterar" class="idRelatorioAlterar" type="text" value="<?php echo $relatorio['idrelatorios']; ?>" hidden>

                                                <div class="form_alterar">
                                                    <div class="Formalterar_container form_SinalWifi" id="form_SinalWifi">
                                                        <div class="centralizar">
                                                            <div class="Formalterar_corpo_container" style="margin: 15px">
                                                                <div class="centralizar">
                                                                    <div class="inputsalterarCheckbox">
                                                                        <label class="csscheckbox wifi csscheckbox-danger" onclick="return animaçaoformsaida('form_alterar')"><input type="checkbox" <?php if ($relatorio['wifi'] == 'ruim') { ?> checked <?php } ?> name="sinalwifi" value="ruim" class="radio"><span><img src="../Img/Icones/Sinalwifiruim.png"><p>Ruim</p></span></label>
                                                                        <label class="csscheckbox wifi csscheckbox-warning" onclick="return animaçaoformsaida('form_alterar')"><input type="checkbox" <?php if ($relatorio['wifi'] == 'regular') { ?> checked <?php } ?> name="sinalwifi" value="regular" class="radio"><span><img src="../Img/Icones/SInalwifiregular.png"><p>Regular</p></span></label>
                                                                        <label class="csscheckbox wifi csscheckbox-default" onclick="return animaçaoformsaida('form_alterar')"><input type="checkbox" <?php if ($relatorio['wifi'] == 'bom') { ?> checked <?php } ?> name="sinalwifi" value="bom" class="radio"><span><img src="../Img/Icones/Sinalwifi.png"><p>Bom</p></span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoformsaida('form_alterar')">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="Formalterar_container formalterar_finalizar">
                                                    <div class="centralizar" > 
                                                        <img class="Formalterar_container_iconfinalizar" src="../Img/Icones/ok.png"><br>
                                                        <input type="submit" class="botaofinalizar" value="Alterar">
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                    </div>

                                </div>

                                <div class="corpo_formalterar_bottom">
                                    <hr>
                                </div>
                                <div class="corpo_formalterar_fecharmensagem">
                                    <button class="botaofecharalterar" onclick="return animaçaoformalterarfechar('formalterarsinalwifi', 'form_alterar')">fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="formalterar formalterarnotebooks">
            <div id="formalterar">
                <div class="centralizar">

                    <div class="corpo_formalterar">
                        <div id="corpo_formalterar">
                            <div class="centralizar">

                                <div class="corpo_formalterar_top">
                                    <p>Alterar Relatorio notebook</p>
                                </div>

                                <div class="corpo_formalterar_corpo">

                                    <div class="corpoformalterarcarousel">
                                        <div class="formalterarcarousel">


                                            <form name="formrelatorio" id="formalterarrelatorio" class="formalterarrelatorio" action="../Controlador/controladorAlterarRelatorio.php?alterar=notebooks" method="POST">
                                                <input name="idRelatorioAlterar" id="idRelatorioAlterar" class="idRelatorioAlterar" type="text" value="<?php echo $relatorio['idrelatorios']; ?>" hidden>

                                                <div class="form_alterar">
                                                    <div class="Formalterar_container form_Notebookfuncionando" id="form_Notebookfuncionando">
                                                        <div class="centralizar">
                                                            <div class="Formalterar_corpo_container">
                                                                <div class="centralizar" style="text-align: center">
                                                                    <img src="../Img/Icones/laptop.png">
                                                                    <p class="perguntaalterar">Notebooks funcionando corretamente?</p>
                                                                    <div class="inputsalterarCheckbox">
                                                                        <label class="csscheckbox csscheckbox-default simN" onclick="return animaçaoformsaida('form_alterar')"><input type="checkbox" name="notebookfuncionando" id="notebookfuncionando" value="sim" class="radio"><span><p>Sim</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-danger naoN" onclick="return animaçaoformsaida('form_alterar')"><input type="checkbox" name="notebookfuncionando" id="notebookfuncionando" value="nao" class="radio"><span><p>Nao</p></span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <?php
                                                $listarNotesDAO = new classeRelatoriosDAO();
                                                $listarNotes = $listarNotesDAO->listarFULL("notebooks", $relatorio['idrelatorios']);
                                                $countNotes = $listarNotesDAO->resultadolistarFULL();

                                                if ($countNotes > 0) {
                                                    foreach ($listarNotes as $notes) {
                                                        switch ($notes['numeronotebook']) {
                                                            case 1:$note[1] = $notes['numeronotebook'];
                                                                break;
                                                            case 2:$note[2] = $notes['numeronotebook'];
                                                                break;
                                                            case 3:$note[3] = $notes['numeronotebook'];
                                                                break;
                                                            case 4:$note[4] = $notes['numeronotebook'];
                                                                break;
                                                            case 5:$note[5] = $notes['numeronotebook'];
                                                                break;
                                                            case 7:$note[7] = $notes['numeronotebook'];
                                                                break;
                                                            case 10:$note[10] = $notes['numeronotebook'];
                                                                break;
                                                            case 101:$note[101] = $notes['numeronotebook'];
                                                                break;
                                                            case 102:$note[102] = $notes['numeronotebook'];
                                                                break;
                                                            case 103:$note[103] = $notes['numeronotebook'];
                                                                break;
                                                            case 104:$note[104] = $notes['numeronotebook'];
                                                                break;
                                                            case 105:$note[105] = $notes['numeronotebook'];
                                                                break;
                                                            case 201:$note[201] = $notes['numeronotebook'];
                                                                break;
                                                            case 202:$note[202] = $notes['numeronotebook'];
                                                                break;
                                                            case 203:$note[203] = $notes['numeronotebook'];
                                                                break;
                                                            case 204:$note[204] = $notes['numeronotebook'];
                                                                break;
                                                            case 205:$note[205] = $notes['numeronotebook'];
                                                                break;
                                                            case 206:$note[206] = $notes['numeronotebook'];
                                                                break;
                                                            case 207:$note[207] = $notes['numeronotebook'];
                                                                break;
                                                            case 208:$note[208] = $notes['numeronotebook'];
                                                                break;
                                                            case 301:$note[301] = $notes['numeronotebook'];
                                                                break;
                                                            case 302:$note[302] = $notes['numeronotebook'];
                                                                break;
                                                            case 303:$note[303] = $notes['numeronotebook'];
                                                                break;
                                                            case 304:$note[304] = $notes['numeronotebook'];
                                                                break;
                                                            case 305:$note[305] = $notes['numeronotebook'];
                                                                break;
                                                        }
                                                    }
                                                }
                                                ?>

                                                <div id="form_notebookproblema" class="form_notebookproblema">
                                                    <div class="Formalterar_container formalterar_notebookproblema">
                                                        <div class="centralizar">
                                                            <div class="Formalterar_corpo_container">
                                                                <div class="centralizar">
                                                                    <div class="inputsalterarCheckbox">
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[1])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="001"><span><p>001</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[2])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="002"><span><p>002</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[3])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="003"><span><p>003</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[4])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="004"><span><p>004</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[5])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="005"><span><p>005</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[7])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="007"><span><p>007</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[10])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="010"><span><p>010</p></span></label><br>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[101])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="101"><span><p>101</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[102])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="102"><span><p>102</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[103])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="103"><span><p>103</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[104])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="104"><span><p>104</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[105])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="105"><span><p>105</p></span></label><br>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[201])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="201"><span><p>201</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[202])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="202"><span><p>202</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[203])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="203"><span><p>203</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[204])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="204"><span><p>204</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[205])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="205"><span><p>205</p></span></label><br>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[206])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="206"><span><p>206</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[207])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="207"><span><p>207</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[208])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="208"><span><p>208</p></span></label><br>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[301])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="301"><span><p>301</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[302])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="302"><span><p>302</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[303])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="303"><span><p>303</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[304])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="304"><span><p>304</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default csscheckboxnote"><input type="checkbox" <?php if (!empty($note[305])) { ?> checked <?php } ?> name="notebooks[]" class="notebooks" value="305"><span><p>305</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-primary csscheckboxnote"><input onclick="javascript:checkAll(this, 'notebooks')" type="checkbox"><span><p style="font-size: 11px">todas</p></span></label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="informacao_alterar">
                                                                <p>*Selecione os notebooks com problema</p>
                                                            </div>
                                                            <input type="button" class="botaoprosseguir" id="botaoprosseguir" value="comfirmar" onclick="return animaçaoformsaida('form_notebookproblema')">
                                                        </div>
                                                    </div>
                                                </div>





                                                <div id="form_problema" class="form_problema form_problema">
                                                    <div class="Formalterar_container formalterar_problema">
                                                        <div class="centralizar">
                                                            <div class="Formalterar_corpo_container" style="margin-bottom: 20px;">
                                                                <div class="centralizar">

                                                                    <?php
                                                                    $listar = new classeRelatoriosDAO();
                                                                    $resultadoProblema = $listar->listarESPECIFIC('*', 'problemas', 'idproblema', null, "WHERE idrelatorio = ", $idrelatorio);
                                                                    foreach ($resultadoProblema as $value) {
                                                                        switch ($value['problema']) {
                                                                            case 'software':$problemaChecked['software'] = 1;
                                                                                break;
                                                                            case 'hardware':$problemaChecked['hardware'] = 1;
                                                                                break;
                                                                            case 'sinal':$problemaChecked['sinal'] = 1;
                                                                                break;
                                                                            case 'ap':$problemaChecked['ap'] = 1;
                                                                                break;
                                                                            case 'sei':$problemaChecked['sei'] = 1;
                                                                                break;
                                                                        }
                                                                    }
                                                                    ?>

                                                                    <div class="inputsCheckboxnoleft checkalterar">
                                                                        <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="software" <?php if (!empty($problemaChecked['software'])) { ?> checked <?php } ?> ><span><img src="../Img/Icones/software.png" class="especificar"><p class="especificar">software</p></span></label>
                                                                        <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="hardware" <?php if (!empty($problemaChecked['hardware'])) { ?> checked <?php } ?>><span><img src="../Img/Icones/hardware.png" class="especificar"><p class="especificar">hardware</p></span></label>
                                                                        <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="sinal" <?php if (!empty($problemaChecked['sinal'])) { ?> checked <?php } ?>><span><img src="../Img/Icones/Sinalwifi3.png" class="especificar"><p class="especificar">sinal</p></span></label>
                                                                        <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="sei" <?php if (!empty($problemaChecked['sei'])) { ?> checked <?php } ?>><span><img src="../Img/Icones/SEI.png" class="especificar"><p class="especificar">SEI</p></span></label>
                                                                        <label class="csscheckbox wifi csscheckbox-default"><input type="checkbox" name="especificarproblema[]" value="ap" <?php if (!empty($problemaChecked['ap'])) { ?> checked <?php } ?>><span><img src="../Img/Icones/APIcon.png" class="especificar"><p class="especificar">AP</p></span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="informacao_alterar">
                                                                <p>*Selecione acima o(s) problema(s) encontrado(s)</p>
                                                            </div>
                                                            <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoformsaida('form_problema')">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="form_relateproblema" class="form_relateproblema">
                                                    <div class="Formalterar_container formalterar_relateproblema">
                                                        <div class="centralizar">
                                                            <div class="Formalterar_corpo_container" style="margin-bottom: 20px;">
                                                                <div class="centralizar" style="text-align: center">
                                                                    <?php
                                                                    $Listarrelatorionote = $listarNotesDAO->listarrelatorionotebookFULL($idrelatorio);
                                                                    foreach ($Listarrelatorionote as $relatorionote) {
                                                                        ?>
                                                                        <textarea name="relatorio_notebook" id="textareanote" class="textarea" spellcheck="true" autocorrect="on"><?php echo $relatorionote['relatorio']; ?></textarea>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="informacao_alterar">
                                                                <p>*Relate acima o(s) problema(s) encontrado(s)</p>
                                                            </div>
                                                            <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoformsaida('form_relateproblema')">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="Formalterar_container formalterar_finalizar">
                                                    <div class="centralizar" > 
                                                        <img class="Formalterar_container_iconfinalizar" src="../Img/Icones/ok.png"><br>
                                                        <input type="submit" class="botaofinalizar" value="Alterar">
                                                    </div>
                                                </div>



                                            </form>
                                        </div>
                                    </div>

                                </div>

                                <div class="corpo_formalterar_bottom">
                                    <hr>
                                </div>
                                <div class="corpo_formalterar_fecharmensagem">
                                    <button class="botaofecharalterar" onclick="return animaçaoformalterarfechar2('formalterarnotebooks', 'form_alterar', 'form_notebookproblema', 'form_relateproblema')">fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>







        <div class="formalterar formalterarproblema">
            <div id="formalterar">
                <div class="centralizar">

                    <div class="corpo_formalterar">
                        <div id="corpo_formalterar">
                            <div class="centralizar">

                                <div class="corpo_formalterar_top">
                                    <p>Alterar relatorio problema</p>
                                </div>

                                <div class="corpo_formalterar_corpo">

                                    <div class="corpoformalterarcarousel">
                                        <div class="formalterarcarousel">

                                            <form name="formrelatorio" id="formalterarrelatorio" class="formalterarrelatorio" action="../Controlador/controladorAlterarRelatorio.php?alterar=problema" method="POST">
                                                <input name="idRelatorioAlterar" id="idRelatorioAlterar" class="idRelatorioAlterar" type="text" value="<?php echo $relatorio['idrelatorios']; ?>" hidden>

                                                <div class="form_alterar">
                                                    <div class="Formalterar_container form_algumoutroproblema" id="form_algumoutroproblema">
                                                        <div class="centralizar">
                                                            <div class="Formalterar_corpo_container">
                                                                <div class="centralizar">
                                                                    <img src="../Img/Icones/problem.png">
                                                                    <p class="perguntaalterar">Informar/alterar problema?</p>
                                                                    <div class="inputsalterarCheckbox">
                                                                        <label class="csscheckbox csscheckbox-danger naoP" onclick="return animaçaoformsaida('form_alterar')"><input type="checkbox" name="problema" value="nao" class="radio"><span><p>Nao</p></span></label>
                                                                        <label class="csscheckbox csscheckbox-default simP" onclick="return animaçaoformsaida('form_alterar')"><input type="checkbox" name="problema" value="sim" class="radio"><span><p>Sim</p></span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div id="form_informarproblema" class="form_informarproblema">
                                                    <div class="Formalterar_container formalterar_relatealgumoutroproblema">
                                                        <div class="centralizar">
                                                            <div class="Form_corpo_container">
                                                                <div class="centralizar" style="text-align: center">
                                                                    <?php
                                                                    $listaproblema = new classeRelatoriosDAO();
                                                                    $Listarrelatoriproblema = $listaproblema->listarproblemaFULL($idrelatorio);
                                                                    foreach ($Listarrelatoriproblema as $relatoriproblema) {
                                                                        ?>
                                                                    <?php } ?>
                                                                    <textarea name="relatorio_problema" class="textarea" spellcheck="true" autocorrect="on"><?php
                                                                        if (isset($relatoriproblema['relatoriop'])) {
                                                                            echo $relatoriproblema['relatoriop'];
                                                                        };
                                                                        ?></textarea>

                                                                </div>
                                                            </div>
                                                            <input type="button" class="botaoprosseguir" value="comfirmar" onclick="return animaçaoformsaida('form_informarproblema')">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="Formalterar_container formalterar_finalizar">
                                                    <div class="centralizar" > 
                                                        <img class="Formalterar_container_iconfinalizar" src="../Img/Icones/ok.png"><br>
                                                        <input type="submit" class="botaofinalizar" value="Alterar">
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                </div>

                                <div class="corpo_formalterar_bottom">
                                    <hr>
                                </div>
                                <div class="corpo_formalterar_fecharmensagem">
                                    <button class="botaofecharalterar" onclick="return animaçaoformalterarfechar2('formalterarproblema', 'form_alterar', 'form_informarproblema')">fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!--        <div class="iconeimprimir animacaocomsombra" onclick="window.print()">
                    <img src="../Img/Icones/imprimir.png">
                </div>-->
        <div class="background">
            <div class="background_relatorio" style="background: url('../Img/Backgrounds/editReport.jpg') no-repeat center;
                 -webkit-background-size: contain;
                 -moz-background-size: contain;
                 -o-background-size: contain;
                 background-size: contain;"></div>
        </div>

























    </body>
</html>