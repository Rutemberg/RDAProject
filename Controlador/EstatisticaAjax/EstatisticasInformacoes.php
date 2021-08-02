<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDA - Faculdade Processus</title>


    <link rel="stylesheet" href="../../Css/Estatisticas_estilo.css">
    <link rel="stylesheet" href="../../Css/ElementStatic_estilo.css">


    <script src="../../Js/jquery-3.2.1.min.js"></script>
    <script src="../../Js/Estatisticas.js"></script>
    <script src="../../Js/velocity.min.js"></script>
    <script src="../../Js/velocity.ui.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<?php
if (empty($_SESSION)) {
    session_start();
}
date_default_timezone_set('America/Sao_Paulo');
$idfuncionariologado = $_SESSION['IdUsuarioLogado'];

function calcularporcentagem($qntd, $TOTAL) {
    $calcular = ($qntd / $TOTAL) * 100;
    $altura = round($calcular, 0);
    return $altura;
}

include '../../Modelo/DAO/classeRelatoriosDAO.php';
$listar = new classeRelatoriosDAO();

$listarUltimoano = $listar->listarDistinct('ano', 'relatorios', 'data', 'DESC LIMIT 1');
foreach ($listarUltimoano as $Ultimoano) {
    $ano = $Ultimoano['ano'];
}
$listarUltimomes = $listar->listarDistinct('mes', 'relatorios', 'data', 'DESC LIMIT 1');
foreach ($listarUltimomes as $Ultimomes) {
    $mes = $Ultimomes['mes'];
}

if (!empty($_GET["ano"])) {
    $ano = $_GET["ano"];
}

$listarUltimomesdoanoselecionado = $listar->listarDistinct('mes', 'relatorios', 'data', 'DESC LIMIT 1', 'WHERE ano = ', $ano);
foreach ($listarUltimomesdoanoselecionado as $Ultimomesdoanoselect) {
    $ultimomesdoanoselecionado = $Ultimomesdoanoselect['mes'];
    $mesinfo = $Ultimomesdoanoselect['mes'];
}


if (!empty($_GET["mes"])) {
    $mes = $_GET["mes"];
    $mesinfo = $mes;
}

if (!empty($_GET["ano"]) && empty($_GET["mes"])) {
    $listarNumeroderelarotios = $listar->COUNT2('relatorios', 'ano', $ano, 'AND mes = ', "'$ultimomesdoanoselecionado'");
    $listarProblemas = $listar->listarRegistrosRepetidos('problema', 'problemas', "DESC", "WHERE anop = ", $ano, 'AND mesp =', "'$ultimomesdoanoselecionado'");
    $listarProblemasmais = $listar->listarRegistrosRepetidos('problema', 'problemas', "DESC", "WHERE anop = ", $ano, 'AND mesp =', "'$ultimomesdoanoselecionado'", "LIMIT 1");
    $listarProblemasmenos = $listar->listarRegistrosRepetidos('problema', 'problemas', "ASC", "WHERE anop = ", $ano, 'AND mesp =', "'$ultimomesdoanoselecionado'", "LIMIT 1");
}
if (!empty($_GET["ano"]) && !empty($_GET["mes"])) {
    if (!empty($_GET["mes"]) && $_GET["mes"] == 'ano inteiro') {
        $listarNumeroderelarotios = $listar->COUNT2('relatorios', 'ano', $ano);
        $listarProblemas = $listar->listarRegistrosRepetidos('problema', 'problemas', "DESC", "WHERE anop = ", $ano);
        $listarProblemasmais = $listar->listarRegistrosRepetidos('problema', 'problemas', "DESC", "WHERE anop = ", $ano, null, null, 'LIMIT 1');
        $listarProblemasmenos = $listar->listarRegistrosRepetidos('problema', 'problemas', "ASC", "WHERE anop = ", $ano, null, null, 'LIMIT 1');
    } else {
        $listarNumeroderelarotios = $listar->COUNT2('relatorios', 'ano', $ano, 'AND mes = ', "'$mes'");
        $listarProblemas = $listar->listarRegistrosRepetidos('problema', 'problemas', "DESC", "WHERE anop = ", $ano, 'AND mesp =', "'$mes'");
        $listarProblemasmais = $listar->listarRegistrosRepetidos('problema', 'problemas', "DESC", "WHERE anop = ", $ano, 'AND mesp =', "'$mes'", 'LIMIT 1');
        $listarProblemasmenos = $listar->listarRegistrosRepetidos('problema', 'problemas', "ASC", "WHERE anop = ", $ano, 'AND mesp =', "'$mes'", 'LIMIT 1');
    }
}


$qntdTOTAL = 0;
foreach ($listarProblemas as $Problemas) {
    $qntdTOTAL += $Problemas['qntd'];
}

$COUNT = $listarNumeroderelarotios;
$problema = array('software' => 0, 'hardware' => 0, 'sinal' => 0, 'sei' => 0, 'ap' => 0);
?>
<div class="nrelatorios">
    <script>
        $(document).ready(function () {
            Contador(<?php echo $COUNT[0]; ?>, 'numerorelatorios', 1);
        });
    </script>
    <p class="numerorelatorios numerofont" id="numerorelatorios"><?php // echo $COUNT[0];        ?></p>
    <p class="nomerelatorios">Relatório(s)</p>
</div>

<div style="width: 100%;float: left;margin-top: 120px"></div>

<div class="estatisticasbarras">
    <?php
    foreach ($listarProblemas as $Problemas) {
//    echo "{$Problemas['problema']} = {$Problemas['qntd']} ";

        switch ($Problemas['problema']) {
            case 'software':$problema['software'] = $Problemas['qntd'];
                $altura = calcularporcentagem($Problemas['qntd'], $COUNT[0]);
                ?>
                <div class="Barra">
                    <div class="Barra_progress" title="Numero de ocorrências: <?php echo $Problemas['qntd']; ?>">
                        <script>
                            $(document).ready(function () {
                                progress(<?php echo $altura; ?>, 'progress');
                            });
                        </script>
                        <div class="progress" id="progress" style="height: <?php // echo $altura;         ?>%"></div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            Contador(<?php echo $altura; ?>, 'porcentagemT');
                        });
                    </script>
                    <p class="porcentagemT numerofont" id="porcentagemT"><b><?php // echo $altura;         ?>%</b></p>
                    <img src="../../Img/Icones/software.png">
                </div>
                <?php
                break;
            case 'hardware':$problema['hardware'] = $Problemas['qntd'];
                $altura = calcularporcentagem($Problemas['qntd'], $COUNT[0]);
                ?>
                <div class="Barra">
                    <div class="Barra_progress" title="Numero de ocorrências: <?php echo $Problemas['qntd']; ?>">
                        <script>
                            $(document).ready(function () {
                                progress(<?php echo $altura; ?>, 'progress1');
                            });
                        </script>
                        <div class="progress" id="progress1" style="height: <?php // echo $altura;         ?>%"></div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            Contador(<?php echo $altura; ?>, 'porcentagemT1');
                        });
                    </script>
                    <p class="porcentagemT numerofont" id="porcentagemT1"><b><?php // echo $altura;         ?>%</b></p>
                    <img src="../../Img/Icones/hardware.png">
                </div>
                <?php
                break;
            case 'sinal':$problema['sinal'] = $Problemas['qntd'];
                $altura = calcularporcentagem($Problemas['qntd'], $COUNT[0]);
                ?>
                <div class="Barra">
                    <div class="Barra_progress" title="Numero de ocorrências: <?php echo $Problemas['qntd']; ?>">
                        <script>
                            $(document).ready(function () {
                                progress(<?php echo $altura; ?>, 'progress2');
                            });
                        </script>
                        <div class="progress" id="progress2" style="height: <?php // echo $altura;         ?>%"></div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            Contador(<?php echo $altura; ?>, 'porcentagemT2');
                        });
                    </script>
                    <p class="porcentagemT numerofont" id="porcentagemT2"><b><?php // echo $altura;         ?>%</b></p>
                    <img src="../../Img/Icones/Sinalwifi3.png">
                </div>
                <?php
                break;
            case 'sei':$problema['sei'] = $Problemas['qntd'];
                $altura = calcularporcentagem($Problemas['qntd'], $COUNT[0]);
                ?>
                <div class="Barra">
                    <div class="Barra_progress" title="Numero de ocorrências: <?php echo $Problemas['qntd']; ?>">
                        <script>
                            $(document).ready(function () {
                                progress(<?php echo $altura; ?>, 'progress3');
                            });
                        </script>
                        <div class="progress" id="progress3" style="height: <?php // echo $altura;         ?>%"></div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            Contador(<?php echo $altura; ?>, 'porcentagemT3');
                        });
                    </script>
                    <p class="porcentagemT numerofont" id="porcentagemT3"><b><?php // echo $altura;         ?>%</b></p>
                    <img src="../../Img/Icones/SEI.png">
                </div>
                <?php
                break;
            case 'ap':$problema['ap'] = $Problemas['qntd'];
                $altura = calcularporcentagem($Problemas['qntd'], $COUNT[0]);
                ?>
                <div class="Barra">
                    <div class="Barra_progress" title="Numero de ocorrências: <?php echo $Problemas['qntd']; ?>">
                        <script>
                            $(document).ready(function () {
                                progress(<?php echo $altura; ?>, 'progress4');
                            });
                        </script>
                        <div class="progress" id="progress4" style="height: <?php // echo $altura;         ?>%"></div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            Contador(<?php echo $altura; ?>, 'porcentagemT4');
                        });
                    </script>
                    <p class="porcentagemT numerofont" id="porcentagemT4"><b><?php // echo $altura;         ?>%</b></p>
                    <img src="../../Img/Icones/APIcon.png">
                </div>
                <?php
                break;
        }
    }

    if ($problema['software'] == 0) {
        $altura = calcularporcentagem($problema['software'], $COUNT[0]);
        ?>
        <div class="Barra">
            <div class="Barra_progress">
                <div class="progress"></div>
            </div>
            <p class="porcentagemT numerofont"><b><?php echo $altura; ?>%</b></p>
            <img src="../../Img/Icones/software.png">
        </div>

        <?php
    }
    if ($problema['hardware'] == 0) {
        $altura = calcularporcentagem($problema['hardware'], $COUNT[0]);
        ?>
        <div class="Barra">
            <div class="Barra_progress">
                <div class="progress"></div>
            </div>
            <p class="porcentagemT numerofont"><b><?php echo $altura; ?>%</b></p>
            <img src="../../Img/Icones/hardware.png">
        </div>

        <?php
    }
    if ($problema['sinal'] == 0) {
        $altura = calcularporcentagem($problema['sinal'], $COUNT[0]);
        ?>
        <div class="Barra">
            <div class="Barra_progress">
                <div class="progress"></div>
            </div>
            <p class="porcentagemT numerofont"><b><?php echo $altura; ?>%</b></p>
            <img src="../../Img/Icones/Sinalwifi3.png">
        </div>

        <?php
    }
    if ($problema['sei'] == 0) {
        $altura = calcularporcentagem($problema['sei'], $COUNT[0]);
        ?>
        <div class="Barra">
            <div class="Barra_progress">
                <div class="progress"></div>
            </div>
            <p class="porcentagemT numerofont"><b><?php echo $altura; ?>%</b></p>
            <img src="../../Img/Icones/SEI.png">
        </div>

        <?php
    }
    if ($problema['ap'] == 0) {
        $altura = calcularporcentagem($problema['ap'], $COUNT[0]);
        ?>
        <div class="Barra">
            <div class="Barra_progress">
                <div class="progress"></div>
            </div>
            <p class="porcentagemT numerofont"><b><?php echo $altura; ?>%</b></p>
            <img src="../../Img/Icones/APIcon.png">
        </div>

    <?php }
    ?>


    <div class="relacaoproblemasinformation">
        <p class="anoemes"><?php echo $mesinfo . ' , ' . $ano; ?></p>
        <p class="information">Os gráficos apresentados acima correspondem a porcentagem dos problemas
            que foram encontrados referentes ao número de relatórios encontrados</p>
    </div>



</div>
<div class="relacaoproblemas">
    <div id="relacaoproblemas">
        <div class="centralizar">

            <div class="problemasecontrados">
                <script>
                    $(document).ready(function () {
                        Contador(<?php echo $qntdTOTAL; ?>, 'problemasecontradosnumero', 1);
                    });
                </script>
                <p class="problemasecontradosnumero numerofont textooverflow" id="problemasecontradosnumero"><?php
                    if ($qntdTOTAL == 0) {
                        echo $qntdTOTAL;
                    }
                    ?></p>
                <p class="problemasecontradoslabel">problema(s) encontrado(s)</p>
            </div>

            <div class="problemasecontrados_maisemenos" style="border: none">

                <?php
                foreach ($listarProblemasmais as $Problemasmais) {
                    $Problemasmais = $Problemasmais['problema'];
                }
                foreach ($listarProblemasmenos as $Problemasmenos) {
                    $Problemasmenos = $Problemasmenos['problema'];
                }
                ?>
                        <?php if ($listarProblemasmais && $listarProblemasmenos) { ?>
                    <div class="problemasecontrados_maisemenos_bloco">
                        <p class="result textooverflow"><?php
                            if (!empty($Problemasmais)) {
                                echo $Problemasmais;
                            }
                            ?>
                        </p>
                        <p class="problemasecontrados_mais textooverflow">mais ocorrido</p>
                    </div>
                    <div class="problemasecontrados_maisemenos_bloco">
                        <p class="result textooverflow"><?php
                            if (!empty($Problemasmenos)) {
                                echo $Problemasmenos;
                            }
                            ?>
                        </p>
                        <p class="problemasecontrados_mais textooverflow">menos ocorrido</p>
                    </div>
<?php } ?>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Software', <?php echo $problema['software']; ?>],
            ['Hardware', <?php echo $problema['hardware']; ?>],
            ['Sinal', <?php echo $problema['sinal']; ?>],
            ['SEI', <?php echo $problema['sei']; ?>],
            ['AP', <?php echo $problema['ap']; ?>]
        ]);

        var options = {
            chartArea: {top: 50, width: '90%', height: '75%'},
            backgroundColor: 'transparent',
            colors: ['#3eba00', '#504184', '#12bbe6', '#a20027', '#5d7077'],
            fontSize: 15,
            fontName: 'Roboto-Regular',
            legend: {alignment: 'center', position: 'top', textStyle: {color: '#5d7077', fontSize: 14, fontName: 'Roboto-Regular', }},
            pieSliceBorderColor: '#ededeb',
            pieSliceTextStyle: {color: 'White', fontName: 'Roboto-Light', fontSize: 13, bold: true},
            tooltip: {textStyle: {color: '#5d7077', fontName: 'Roboto-Regular'}, showColorCode: true, trigger: 'selection'}

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
<div class="piechart">
    <div class="centralizar">
        <?php if ($qntdTOTAL > 0) { ?>
            <div id="piechart">
            </div>
        <?php } else { ?>
            <img src="../../Img/Icones/Piechart.png">  
<?php } ?>
        <div class="relacaoproblemasinformation">
            <p class="information">O gráfico em formato de pizza acima mostra a porcentagem dos problemas com base no total de problemas encontrados</p>
        </div>
    </div>
</div>