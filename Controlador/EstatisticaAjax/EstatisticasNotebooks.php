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

include '../../Modelo/DAO/classeRelatoriosDAO.php';
include '../../Modelo/funcoesAuxiliares/funcoesAux.php';
$listar = new classeRelatoriosDAO();

if (!empty($_GET['ano'])) {
    $ano = $_GET['ano'];
}

$listarUltimomesdoanoselecionado = $listar->listarDistinct('mes', 'relatorios', 'data', 'DESC LIMIT 1', 'WHERE ano = ', $ano);
foreach ($listarUltimomesdoanoselecionado as $Ultimomesdoanoselect) {
    $ultimomesdoanoselecionado = $Ultimomesdoanoselect['mes'];
}
if (!empty($_GET['mes'])) {
    $mes = $_GET['mes'];
    $mesinfo = $_GET['mes'];
} else {
    $mes = $ultimomesdoanoselecionado;
    $mesinfo = $ultimomesdoanoselecionado;
}

if (!empty($_GET["ano"]) && empty($_GET["mes"])) {
    $listarNumeronotes = $listar->COUNT2('salasmontadas', 'anosm', $ano, 'AND messm = ', "'$mes'");
    $listarnotes = $listar->listarRegistrosRepetidos('numeronotebook', 'notebooks', "DESC", "WHERE anon = ", $ano, 'AND mesn =', "'$mes'");
    $listarnotemais = $listar->listarRegistrosRepetidos('numeronotebook', 'notebooks', "DESC", "WHERE anon = ", $ano, 'AND mesn =', "'$mes'", "LIMIT 1");
    $listarnotemenos = $listar->listarRegistrosRepetidos('numeronotebook', 'notebooks', "ASC", "WHERE anon = ", $ano, 'AND mesn =', "'$mes'", "LIMIT 1");
}
if (!empty($_GET["ano"]) && !empty($_GET["mes"])) {
    if (!empty($_GET["mes"]) && $_GET["mes"] == 'ano inteiro') {
        $listarNumeronotes = $listar->COUNT2('salasmontadas', 'anosm', $ano);
        $listarnotes = $listar->listarRegistrosRepetidos('numeronotebook', 'notebooks', "DESC", "WHERE anon = ", $ano);
        $listarnotemais = $listar->listarRegistrosRepetidos('numeronotebook', 'notebooks', "DESC", "WHERE anon = ", $ano, null, null, 'LIMIT 1');
        $listarnotemenos = $listar->listarRegistrosRepetidos('numeronotebook', 'notebooks', "ASC", "WHERE anon = ", $ano, null, null, 'LIMIT 1');
    } else {
        $listarNumeronotes = $listar->COUNT2('salasmontadas', 'anosm', $ano, 'AND messm = ', "'$mes'");
        $listarnotes = $listar->listarRegistrosRepetidos('numeronotebook', 'notebooks', "DESC", "WHERE anon = ", $ano, 'AND mesn =', "'$mes'");
        $listarnotemais = $listar->listarRegistrosRepetidos('numeronotebook', 'notebooks', "DESC", "WHERE anon = ", $ano, 'AND mesn =', "'$mes'", 'LIMIT 1');
        $listarnotemenos = $listar->listarRegistrosRepetidos('numeronotebook', 'notebooks', "ASC", "WHERE anon = ", $ano, 'AND mesn =', "'$mes'", 'LIMIT 1');
    }
}

$qntdTOTAL = 0;
foreach ($listarnotes as $notes) {
    $qntdTOTAL += $notes['qntd'];
}
$COUNT = $listarNumeronotes;
?>

<div style="width: 100%;float: left;margin-top: 120px"></div>
<div class="nrelatorios">
    <script>
        $(document).ready(function () {
            Contador(<?php echo $COUNT[0]; ?>, 'numerorelatorios', 1);
        });
    </script>
    <p class="numerorelatorios numerofont" id="numerorelatorios"><?php // echo $COUNT[0];         ?></p>
    <p class="nomerelatorios">TOTAL DE NOTEBOOKS MONTADOS</p>
</div>

<div class="statisticasnotes">
    <div class="centralizar">
        <div class="contnotes">
            <?php
            $count = 0;
            if ($listarnotes) {
                foreach ($listarnotes as $notes) {
                    $count++;
                    $notes['numeronotebook'] = sprintf("%03d", $notes['numeronotebook']);
                    $porcentagem = calcularporcentagem($notes['qntd'], $qntdTOTAL);
                    ?>
                    <div class="blocostatisticasnotes">
                        <div class="numeronote numerofont"><div class="centralizar"><?php echo $notes['numeronotebook']; ?></div></div>
                        <p class="notesala">Notebook da sala <?php echo $notes['numeronotebook']; ?></p>
                        <div class="barraH" title="Numero de ocorrências: <?php echo $notes['qntd']; ?>">

                            <script>
                                $(document).ready(function () {
                                    Contador(<?php echo $porcentagem; ?>, 'porcentagemTH<?php echo $count; ?>');
                                });
                            </script>

                            <p class="porcentagemTH numerofont" id="porcentagemTH<?php echo $count; ?>"></p>
                            <script>
                                $(document).ready(function () {
                                    progressH(<?php echo $porcentagem; ?>, 'progressH<?php echo $count; ?>');
                                });
                            </script>
                            <div class="Barra_progressH">
                                <div class="progressH" id="progressH<?php echo $count; ?>">
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div style="width: 100%;height: 100%;display: table">
                    <div class="centralizar">
                        <img style="width: 180px;margin-bottom: 20px;" src="../../Img/Icones/note.png">
                        <p class="noteocorrencias" style="font-size: 20px">Não houve ocorrências</p>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <div class="relacaoproblemasinformation">
            <p class="anoemes"><?php echo $mes . ' , ' . $ano; ?></p>
            <p class="information">A lista acima representa os notebooks que tiveram problemas nos horários de suporte e montagem referentes ao mês ou ano.</p>
        </div>
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
                <p class="problemasecontradoslabel">total de notebooks com problemas encontrados</p>
            </div>

            <div class="problemasecontrados_maisemenos" style="border: none">

                <?php
                foreach ($listarnotemais as $notemais) {
                    $notemais = $notemais['numeronotebook'];
                    $notemais = sprintf("%03d", $notemais);
                }
                foreach ($listarnotemenos as $notemenos) {
                    $notemenos = $notemenos['numeronotebook'];
                    $notemenos = sprintf("%03d", $notemenos);
                }
                ?>
                <?php if ($listarnotemais && $listarnotemenos) { ?>
                    <div class="problemasecontrados_maisemenos_bloco">
                        <p class="result textooverflow"><?php
                            if (!empty($notemais)) {
                                echo $notemais;
                            }
                            ?>
                        </p>
                        <p class="problemasecontrados_mais textooverflow" title="notebook com mais ocorrência">notebook com mais ocorrência</p>
                    </div>
                    <div class="problemasecontrados_maisemenos_bloco">
                        <p class="result textooverflow"><?php
                            if (!empty($notemenos)) {
                                echo $notemenos;
                            }
                            ?>
                        </p>
                        <p class="problemasecontrados_mais textooverflow" title="notebook com menos ocorrência">notebook com menos ocorrência</p>
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
            ['Notebooks que não deram problemas', <?php echo $COUNT[0] - $qntdTOTAL; ?>],
            ['Notebooks que deram problemas', <?php echo $qntdTOTAL; ?>]

        ]);

        var options = {
            chartArea: {top: 50, width: '90%', height: '75%'},
            backgroundColor: 'transparent',
            colors: ['#5d7077','#a20027'],
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
            <p class="information">O gráfico em formato de pizza acima mostra a porcentagem dos notebooks que tiveram ocorrências de problemas com base no total de notebooks montados</p>
        </div>
    </div>
</div>