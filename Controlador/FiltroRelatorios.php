<?php
if (empty($_SESSION)) {
    session_start();
}
date_default_timezone_set('America/Sao_Paulo');

include_once '../Modelo/DAO/classeRelatoriosDAO.php';
include_once '../Modelo/funcoesAuxiliares/funcoesAux.php';
include '../Modelo/DAO/classeUsuarioDAO.php';

$idfuncionariologado = $_SESSION['IdUsuarioLogado'];

if (!empty($_REQUEST["ano"])) {
    $anoAjax = $_REQUEST["ano"];
}
if (!empty($_REQUEST["mes"])) {
    $mesAjax = $_REQUEST["mes"];
}
if (!empty($_REQUEST["dia"])) {
    $diaAjax = $_REQUEST["dia"];
}

$listarRelatorio = new classeRelatoriosDAO();

$listarUltimoano = $listarRelatorio->listarDistinct('ano', 'relatorios', 'data', 'DESC LIMIT 1');
foreach ($listarUltimoano as $Ultimoano) {
    $Ultimoano = $Ultimoano['ano'];
}
$listarUltimomes = $listarRelatorio->listarDistinct('mes', 'relatorios', 'data', 'DESC LIMIT 1');
foreach ($listarUltimomes as $Ultimomes) {
    $Ultimomes = $Ultimomes['mes'];
}
$listardiaespecifico = $listarRelatorio->listarESPECIFIC('data', 'relatorios', 'data', 'DESC LIMIT 1');
foreach ($listardiaespecifico as $diaespecifico) {
    $Ultimodia = $diaespecifico['data'];
}


if (!empty($anoAjax)) {
    $ano = $anoAjax;
} else {
    if (!empty($Ultimoano)) {
        $ano = $Ultimoano;
//    $ano = 0;todos os anos
    }
}

if (!empty($mesAjax)) {
    $mes = $mesAjax;
} else {
    if (!empty($Ultimomes)) {
        $mes = $Ultimomes;
    }
}

if (!empty($diaAjax)) {
    $dia = $diaAjax;
}



if (!empty($mes)) {
    $numeromes = convertMesEmNumero($mes);
}

if (!empty($dia)) {
    $datadiaespecifico = $ano . '-' . $numeromes . '-' . $dia;
}

if (!empty($ano)) {
    $resultadoultimoano = $listarRelatorio->listarDistinct("ano", 'relatorios', 'data', 'DESC LIMIT 1', 'WHERE ano = ', $ano);
} else {
    $resultadoultimoano = $listarRelatorio->listarDistinct("ano", 'relatorios', 'data', 'DESC');
}
?>
<div class="backrelatorios">
    <div class="listarelatorios">
        <?php
        $countresultadoultimoano = count($resultadoultimoano);
        if ($countresultadoultimoano == 0) {
            ?>

            <div class="Titulorelatorios">
                <p style="font-size: 19px;">Ano não encontrado</p>
            </div>

            <?php
        }

        foreach ($resultadoultimoano as $Ano) {
            $Ultimoano = $Ano['ano'];
            if (!empty($mesAjax)) {
                $resultadoUltimomes = $listarRelatorio->listarDistinct("mes", 'relatorios', 'data', 'DESC LIMIT 1', 'WHERE mes = ', "'$mes'", 'AND ano = ', $Ultimoano);
//                $resultadoUltimomes = $listarRelatorio->listarDistinct("mes", 'relatorios', 'data', 'DESC', 'WHERE ano = ', $Ultimoano);
            } else {
                $resultadoUltimomes = $listarRelatorio->listarDistinct("mes", 'relatorios', 'data', 'DESC', 'WHERE ano = ', $Ultimoano);
            }
            $countresultadoUltimomes = count($resultadoUltimomes);
            ?>


            <div class="Titulorelatorios">
                <p><?php echo $Ultimoano ?></p>
            </div>
            <?php if ($countresultadoUltimomes == 0) { ?>
                <div class="Titulorelatorios titulomes">
                    <p>Mes não encontrado</p>
                </div>
                <?php
            }


            foreach ($resultadoUltimomes as $Ultimomes) {
                $Ultimomes = $Ultimomes['mes'];
                ?>
                <div class="Titulorelatorios titulomes">
                    <p><?php echo $Ultimomes; ?></p>
                </div>
                <hr class="linha">
                <?php
                if (!empty($datadiaespecifico)) {
                    $resultadodiasUltimomes = $listarRelatorio->listarDistinct("data", 'relatorios', 'data', 'DESC', 'WHERE mes = ', "'$Ultimomes'", 'AND ano = ', $Ultimoano, 'and data LIKE ', "'%-$dia'");
                } else {
                    $resultadodiasUltimomes = $listarRelatorio->listarDistinct("data", 'relatorios', 'data', 'DESC', 'WHERE mes = ', "'$Ultimomes'", 'AND ano = ', $Ultimoano);
                }
                $countresultadodiasUltimomes = count($resultadodiasUltimomes);
                if ($countresultadodiasUltimomes == 0) {
                    ?>
                <div class="Titulorelatorios titulodia2">
                        <p>Dia nao encontrado</p>
                    </div>
                    <?php
                }

                foreach ($resultadodiasUltimomes as $relatorio) {
                    $data = explode("-", $relatorio['data']);
                    $ano = $data[0];
                    $mes = mesData($relatorio['data']);
                    $dia = $data[2];
                    ?>


                    <ul class="backrelatoriodia">
                        <div class="Titulorelatorios titulodia">
                            <p><?php echo 'dia <b style="font-size: 15">' . $dia . '</b>' ?></p>  
                        </div>
                        <?php
                        $resultadoRelatorio2 = $listarRelatorio->listarTodososRelatoriosData($relatorio['data'], 'hora', 'ASC');
                        foreach ($resultadoRelatorio2 as $relatoriodata) {
                            $idrelatorio = $relatoriodata['idrelatorios'];
                            ?>

                        <li class="relatoriomin animacaopadrao" onmouseenter="return viewreport(<?php echo $idrelatorio; ?>)" ondblclick="return redirection('listarRelatorio.php?idRelatorio=<?php echo $idrelatorio; ?>')">
                            <div class="relatorio" style="pointer-events: none">

                                    <div id="dataehorarelatorio">
                                        <div style="width: 100%;height: 100%;position: absolute;top: 0;left: 0;"></div>
                                        <div class="dataehorarelatorio">
                                            <div class="centralizar">    
                                                <p class="hora">
                                                    <?php
                                                    $relatoriodata['hora'] = substr($relatoriodata['hora'], 0, -3);
                                                    echo $relatoriodata['hora'];
                                                    ?>
                                                </p>
                                                <p class="turno">
                                                    <?php
                                                    echo $relatoriodata['turno'];
                                                    ?>
                                                </p>

                                            </div>
                                        </div>
                                    </div>

                                    <div id="corporelatorio">

                                        <div class="corporelatorio">
                                            <div class="centralizar">

                                                <div class="relatoriolinha salasmontadas">
                                                    <div class="centralizar">
                        <!--                                            <img class="iconlabelrelatorio" src="../Img/Icones/ClassRoom.png"><p class="labelrelatorio">salas montadas</p>-->
                                                        <div class="textrelatorio salasrelatorio">
                                                            <img class="iconlabelrelatorio" src="../Img/Icones/ClassRoom.png">
                                                            <?php
                                                            $listarSalas = new classeRelatoriosDAO();
                                                            $resultadoSalas = $listarSalas->listarsalasFULL($idrelatorio);
                                                            foreach ($resultadoSalas as $salas) {
                                                                $salas['numerosala'] = sprintf("%03d", $salas['numerosala']);
                                                                ?>
                                                                <div class="blocosEmlinha salas">
                                                                    <?php echo $salas['numerosala'] . " "; ?>
                                                                </div>
                                                            <?php }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
//                                                if ($relatoriodata['notebooksfuncionando'] == 'nao') {
//                                                    $colorborder = '#a20027';
//                                                } else {
//                                                    $colorborder = '#d0d4d3';
//                                                }
                                                ?>

                                                <div class="relatoriolinha Notebooks" style="border-bottom: 1px solid <?PHP echo $colorborder; ?>" onclick="return animaçaoformalterar('formalterarnotebooks')">
                                                    <div class="centralizar">
                                                        <img class="iconlabelrelatorio" src="../Img/Icones/laptop.png">
                                                        <div class="textrelatorio">
                                                            <?php
                                                            if ($relatoriodata['notebooksfuncionando'] == 'nao') {
                                                                ?>
                                                                <div class="blocosEmlinha relatorionotebookN">
                                                                    <?php echo 'Existem notebooks com problemas'; ?>
                                                                </div>

                                                            <?php } else {
                                                                ?>
                                                                <?php
                                                                $listarrelatorionotebook = new classeRelatoriosDAO();
                                                                $resultadoRelatorionotebook = $listarrelatorionotebook->listarrelatorionotebookFULL($idrelatorio);
                                                                foreach ($resultadoRelatorionotebook as $Relatorionotebook) {
                                                                    ?>

                                                                    <div class="blocosEmlinha relatorionotebookS">
                                                                        <?php echo $Relatorionotebook['relatorio'] . " "; ?>
                                                                    </div>

                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $listaproblema = new classeRelatoriosDAO();
                                                $resultadolistaproblema = $listaproblema->listarproblemaFULL($idrelatorio);
                                                $count = count($resultadolistaproblema);

//                                                if ($count > 0) {
//                                                    $colorborder2 = '#a20027';
//                                                } else {
//                                                    $colorborder2 = '#d0d4d3';
//                                                }
                                                ?>

                                                <div class="relatoriolinha relatorioProblema" style="border-bottom: 1px solid <?PHP echo $colorborder2; ?>" onclick="return animaçaoformalterar('formalterarproblema')">
                                                    <div class="centralizar">
                                                        <img class="iconlabelrelatorio" src="../Img/Icones/problem.png">
                                                        <?php
                                                        if ($count > 0) {
                                                            foreach ($resultadolistaproblema as $Relatorioproblema) {
                                                                ?>
                                                                <div class="textrelatorio">
                                                                    <div class="blocosEmlinha relatorionotebookN">
                                                                        Relatorio problema encontrado
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="textrelatorio">
                                                                <div class="blocosEmlinha relatorionotebookS">
                                                                    Nenhum relatorio encontrado
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="wifi">
                                            <div class="centralizar">
                                                <?php if ($relatoriodata['wifi'] == 'regular') { ?>
                                                    <img class="iconewifi" src="../Img/Icones/SInalwifiregular2.png">
                                                <?php } ?>
                                                <?php if ($relatoriodata['wifi'] == 'bom') { ?>
                                                    <img class="iconewifi" src="../Img/Icones/Sinalwifi2.png">
                                                <?php } ?>
                                                <?php if ($relatoriodata['wifi'] == 'ruim') { ?>
                                                    <img class="iconewifi" src="../Img/Icones/Sinalwifiruim2.png">
                                                <?php } ?>
                                                <p class="paragraphwifi"><?php echo $relatoriodata['wifi']; ?></p>
                                            </div>
                                        </div>


                                    </div>
                                    <!--                                <div id="funcionario">
                                                                        <div class="funcionario">
                                                                            <div class="centralizar">
                                    <?php
                                    $idfuncionariologado = $relatoriodata['idfuncionario'];

                                    $listarUsuario = new classeUsuarioDAO();
                                    $resultadoUsuario = $listarUsuario->listarUsuario("tag,picture,cargo,email", $idfuncionariologado, 'idusuario', 'LIMIT 1');

                                    foreach ($resultadoUsuario as $usuario) {
                                        ?>
                                                                                                                        <div class="picfuncionario" style="        
                                                                                                                             background: url('<?php echo "../Img/Userimg/{$usuario['picture']}"; ?>') no-repeat center;
                                                                                                                             -webkit-background-size: cover;
                                                                                                                             -moz-background-size: cover;
                                                                                                                             -o-background-size: cover;
                                                                                                                             background-size: cover;"></div>
                                                                                                                        <p class="labelfuncionarioNome"><?php echo $usuario['tag']; ?></p>
                                    <?php }
                                    ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                    
                                    -->                            </div>

                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            <?php } ?>


        <?php } ?>
    </div>

    <div class="visualizarrelatorio">
        <div id="visualizarrelatorio">
            <?php if (empty($_REQUEST["idrelatorio"])) { ?>
                <div style="display: table;width: 100%;height: 100%;text-align: center">
                    <div class="centralizar backgroundview">
                        <img src="../Img/Backgrounds/listreports.png">
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>

</div>