<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDA - Faculdade Processus</title>


    <link rel="stylesheet" href="../../Css/Estatisticas_estilo.css">
    <link rel="stylesheet" href="../../Css/ElementStatic_estilo.css">
    <link rel="stylesheet" href="../../Js/OwlCarousel2-2.3.3/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../../Js/OwlCarousel2-2.3.3/dist/assets/owl.theme.default.min.css">


    <script src="../../Js/jquery-3.2.1.min.js"></script>
    <script src="../../Js/Estatisticas.js"></script>
    <script src="../../Js/velocity.min.js"></script>
    <script src="../../Js/velocity.ui.js"></script>
    <script src="../../Js/OwlCarousel2-2.3.3/dist/owl.carousel.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
    <?php
    if (empty($_SESSION)) {
        session_start();
    }
    date_default_timezone_set('America/Sao_Paulo');
    $idfuncionariologado = $_SESSION['IdUsuarioLogado'];

    include '../../Modelo/DAO/classeRelatoriosDAO.php';
    include '../../Modelo/funcoesAuxiliares/funcoesAux.php';
    $listar = new classeRelatoriosDAO();

    $listarUsuario = $listar->listarESPECIFIC("*", "usuarios", 'idusuario');


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

    <div class="owl-carousel statisticasusuarios">
        <?php
        $count = 0;
        foreach ($listarUsuario as $Usuario) {
            $count++;

            if (!empty($_GET["ano"]) && empty($_GET["mes"])) {
                $listarNumeronotes = $listar->COUNT2('salasmontadas', 'anosm', $ano, 'AND messm = ', "'$mes' AND idfuncionario = {$Usuario['idusuario']}");
                $listarNumerorelatorios = $listar->COUNT2('relatorios', 'ano', $ano, 'AND mes = ', "'$mes' AND idfuncionario = {$Usuario['idusuario']}");
            }
            if (!empty($_GET["ano"]) && !empty($_GET["mes"])) {
                if (!empty($_GET["mes"]) && $_GET["mes"] == 'ano inteiro') {
                    $listarNumeronotes = $listar->COUNT2('salasmontadas', 'anosm', $ano, 'AND idfuncionario = ', $Usuario['idusuario']);
                    $listarNumerorelatorios = $listar->COUNT2('relatorios', 'ano', $ano, 'AND idfuncionario = ', $Usuario['idusuario']);
                } else {
                    $listarNumeronotes = $listar->COUNT2('salasmontadas', 'anosm', $ano, 'AND messm = ', "'$mes' AND idfuncionario = {$Usuario['idusuario']}");
                    $listarNumerorelatorios = $listar->COUNT2('relatorios', 'ano', $ano, 'AND mes = ', "'$mes' AND idfuncionario = {$Usuario['idusuario']}");
                }
            }
            $COUNTnote = $listarNumeronotes;
            $COUNTrelatorio = $listarNumerorelatorios;
            ?>
            <div class="cardusuarios">

                <header>
                    <div class="pictureusuario"  style="width: 100%;height: 100%;background: url('../..//Img/Userimg/<?php echo $Usuario['picture']; ?>') center no-repeat;background-size: contain">
                    </div>
                </header>
                <p class="cardusuariosname"><?php echo $Usuario['tag']; ?></p>
                <div class="cardusuarioestatisticas">
                    <script>
                        $(document).ready(function () {
                            Contador(<?php echo $COUNTnote[0]; ?>, 'usuarioestatisticascount<?php echo $count; ?>', 1);
                        });
                    </script>
                    <p class="usuarioestatisticascount numerofont" id="usuarioestatisticascount<?php echo $count; ?>"><?php
                        if ($COUNTnote[0] == 0) {
                            echo $COUNTnote[0];
                        }
                        ?></p>
                    <p class="usuarioestatisticasname">Notebooks montados</p>
                </div>
                <div class="cardusuarioestatisticas">
                    <script>
                        $(document).ready(function () {
                            Contador(<?php echo $COUNTrelatorio[0]; ?>, 'usuarioestatisticascountrelatorio<?php echo $count; ?>', 1);
                        });
                    </script>
                    <p class="usuarioestatisticascount usuarioestatisticascountrelatorio numerofont" id="usuarioestatisticascountrelatorio<?php echo $count; ?>"><?php
                        if ($COUNTrelatorio[0] == 0) {
                            echo $COUNTrelatorio[0];
                        }
                        ?></p>
                    <p class="usuarioestatisticasname">Relatorios feitos</p>
                </div>
            </div>
<?php } ?>
    </div>

    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    600: {
                        items: 1,
                        nav: false
                    },
                    1000: {
                        items: 3,
                        nav: false,
                        loop: false
                    }
                }
            })
        });
    </script>
</body>