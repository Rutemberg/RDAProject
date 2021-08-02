
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDA - Faculdade Processus</title>

    <link rel="stylesheet" href="../../Css/ElementStatic_estilo.css">
    <link rel="stylesheet" href="../../Css/Estatisticas_estilo.css">


    <script src="../../Js/jquery-3.2.1.min.js"></script>
    <script src="../../Js/Estatisticas.js"></script>
    <script src="../../Js/velocity.min.js"></script>
    <script src="../../Js/velocity.ui.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body>

    <?php
    if (empty($_SESSION)) {
        session_start();
    }
    date_default_timezone_set('America/Sao_Paulo');
    $idfuncionariologado = $_SESSION['IdUsuarioLogado'];


    include_once '../../Modelo/DAO/classeRelatoriosDAO.php';


    $listar = new classeRelatoriosDAO();

    $listarUltimoano = $listar->listarDistinct('ano', 'relatorios', 'data', 'DESC LIMIT 1');
    foreach ($listarUltimoano as $Ultimoano) {
        $ano = $Ultimoano['ano'];
    }
    if (!empty($_GET["ano"])) {
        $ano = $_GET["ano"];
    }

    $listarMes = $listar->listarDistinct('mes', 'relatorios', 'data', "DESC", "WHERE ano = ", $ano);
    ?>

    <?php if (empty($_GET['view'])) { ?>
        <select class="select_mes" onchange="abrir('Estatisticas', 'EstatisticasInformacoes.php?ano=<?php echo $ano; ?>&mes=' + this.value)">
            <?php foreach ($listarMes as $mes) { ?>
                <option value="<?php echo $mes['mes']; ?>"><?php echo $mes['mes']; ?></option>
            <?php } ?>
            <option value="ano inteiro">Ano inteiro</option>
        </select>


        <iframe class="Estatisticas" id="Estatisticas" scrolling='no' marginwidth="0" marginheight='0' src="EstatisticasInformacoes.php?ano=<?php echo $ano; ?>"></iframe>
    <?php } ?>
    <?php if (!empty($_GET['view']) && $_GET['view'] == 'notebooks') { ?>
        <select class="select_mes" onchange="abrir('Estatisticas', 'EstatisticasNotebooks.php?ano=<?php echo $ano; ?>&mes=' + this.value)">
            <?php foreach ($listarMes as $mes) { ?>
                <option value="<?php echo $mes['mes']; ?>"><?php echo $mes['mes']; ?></option>
            <?php } ?>
            <option value="ano inteiro">Ano inteiro</option>
        </select>


        <iframe class="Estatisticas" id="Estatisticas" scrolling='no' marginwidth="0" marginheight='0' src="EstatisticasNotebooks.php?ano=<?php echo $ano; ?>"></iframe>
        <?php } ?>
    <?php if (!empty($_GET['view']) && $_GET['view'] == 'usuarios') { ?>
        <select class="select_mes" onchange="abrir('Estatisticas', 'EstatisticasUsuarios.php?ano=<?php echo $ano; ?>&mes=' + this.value)">
            <?php foreach ($listarMes as $mes) { ?>
                <option value="<?php echo $mes['mes']; ?>"><?php echo $mes['mes']; ?></option>
            <?php } ?>
            <option value="ano inteiro">Ano inteiro</option>
        </select>


        <iframe class="Estatisticas" id="Estatisticas" scrolling='no' marginwidth="0" marginheight='0' src="EstatisticasUsuarios.php?ano=<?php echo $ano; ?>"></iframe>
        <?php } ?>

</body>