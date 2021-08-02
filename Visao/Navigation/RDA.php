<?php
include './Modelo/DAO/classeRelatoriosDAO.php';
include './Modelo/funcoesAuxiliares/funcoesAux.php';

$idfuncionariologado = $_SESSION['IdUsuarioLogado'];
$listar = new classeRelatoriosDAO();

$listarRelatorio = $listar->listarTodososRelatorios('data');
$countRelatorios = $listar->resultadolistarRelatoriosFULL();
?>
<div class="backrelatorio">

    <div class="owl-carousel">

        <div style="width: 500px">
            <div class="menu_relatorio_item" ondblclick="return redirectionform('Visao/Formularios/NovoRelatorio.php')" >
                <p class="name_menu">Novo</p>
                <article class="information_menu">clique no icone abaixo para preencher e cadastrar um novo relatorio</article>
                <img class="icon_menu animacao" src="Img/Icones/RelatoriosAdd.png">
                <p class="label_menu">Criar novo relatorio</p>
            </div>
        </div>

        <div style="width: 500px">
            <div class="menu_relatorio_item">
                <p class="name_menu">Ultimo relatório</p>

                <?php
                $tempoDAO = new classeRelatoriosDAO();
                $Resultadotempo = $tempoDAO->listarRelatoriosFULL($idfuncionariologado, "data", "DESC LIMIT 1");
                $count = $tempoDAO->resultadolistarRelatoriosFULL();

                if ($count > 0) {
                    foreach ($Resultadotempo as $tempo) {
                        $dataatual = date('Y-m-d');
                        $data = $tempo['data'];

                        $datacalculada = calculardata($data, $dataatual);
                        ?>
                        <div class="lembrete">
                            <div ondblclick="return redirectionform('Controlador/listarRelatorio.php')">
                                <div class="textlembrete">
                                    <div class="centralizar">

                                        <p class="lembretetitulo">Seu ultimo relatorio foi feito<p>
                                        <p class="tempolembrete"><?php echo $datacalculada; ?></p>

                                        <?php if ($datacalculada > 1) { ?>
                                            <p class="tempolembrete_dias" style="font-family: Roboto-Regular;color: #5d7077">dias atras</p>
                                        <?php } ?>
                                        <?php if ($datacalculada <= 1) { ?>
                                            <p class="tempolembrete_dias">
                                                <?php
                                                $H = explode(":", $tempo['hora']);
                                                echo "às {$H[0]} hora(s)";
                                                ?>
                                            </p>
                                        <?php } ?>


                                    <?php } ?>

                                </div>
                            </div>
                            <div class="icon_lembrete">
                                <div class="imgrelatorioslembrete">
                                    <div class="centralizar">
                                        <div class="userbackpicrelatorio" id="userbackpicrelatoriolembrete">
                                            <div class="picuserrelatorio" style="
                                                 background: url('Img/Userimg/<?php echo $_SESSION['PictureUsuarLologado']; ?>') no-repeat center;
                                                 -webkit-background-size: contain;
                                                 -moz-background-size: contain;
                                                 -o-background-size: contain;
                                                 background-size: contain;
                                                 ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="imgrelatorioslembrete relatorioimg">
                                    <div class="centralizar">
                                        <div class="relatoriobackpicrelatorio" id="relatoriobackpicrelatorio<?php echo $count; ?>">
                                            <div class="picrelatorio" style="
                                                 background: url('Img/Icones/iconrelatorio.png') no-repeat center;
                                                 -webkit-background-size: contain;
                                                 -moz-background-size: contain;
                                                 -o-background-size: contain;
                                                 background-size: contain;
                                                 ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--                                    <div class="imgrelatorios" style="height: 100%">
                                                                        <div class="centralizar">
                                                                            <img class="icon_lembrete_img" src="Img/Icones/iconrelatorio.png">
                                                                        </div>
                                                                    </div>
                                                                    <div class="imgrelatorios" style="height: 100%">
                                                                        <div class="centralizar">
                                                                            <div class="picuser picuserlembrete" style="        
                                                                                 background: url('<?php echo "Img/Userimg/{$_SESSION['PictureUsuarLologado']}"; ?>') no-repeat center;
                                                                                 -webkit-background-size: contain;
                                                                                 -moz-background-size: contain;
                                                                                 -o-background-size: contain;
                                                                                 background-size: contain;"></div>
                                                                        </div>
                                                                    </div>-->
                            </div>
                            <p class="label_menu" style="color: #5d7077;float: left">Ver ultimo relatorio</p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="menu_relatorio_item lembrete " colspan="2" rowspan="2">
                        <div class="textlembrete" style="margin-bottom: 0">                                          
                            <p class="lembretetitulo">Você ainda não criou nenhum relatório<p>  
                            <p class="tempolembrete_dias" style="font-family: Roboto-Regular;color: #5d7077">Clique em <b>Criar novo relatório</b><p>  
                        </div>  
                        <div class="icon_lembrete" style="margin-bottom: 0">
                            <img class="icon_lembrete_img" style="width: 50%!important" src="Img/Icones/reportwhy.png">
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>

        <?php if ($countRelatorios > 0) { ?>
        <div style="width: 650px">
                <div class="menu_relatorio_item">
                    <p class="name_menu">Histórico</p>
                    <div class="ultimosrelatorios">

                        <?php
                        $listarUltimosRelatorios = $listar->listarESPECIFIC("*", 'relatorios', 'data', 'DESC LiMIT 4');
                        $count = 0;
                        foreach ($listarUltimosRelatorios as $UltimosRelatorios) {
                            $count++;
                            ?>
                        <div class="blocos_ultimosrelatorios animacao"  ondblclick="return redirectionform('Controlador/listarRelatorio.php?idRelatorio=<?php echo $UltimosRelatorios['idrelatorios']; ?>')">
                                <header class="data" id="data<?php echo $count; ?>">
                                    <?php
                                    $data = explode("-", $UltimosRelatorios['data']);
                                    echo "{$data[2]} de {$UltimosRelatorios['mes']} , {$UltimosRelatorios['ano']}";
                                    ?>
                                </header>

                                <div class="imgrelatorios">
                                    <?php
                                    $listarfotofuncionario = $listar->listarESPECIFIC('picture,tag', 'usuarios', 'idusuario', NULL, "WHERE idusuario = ", $UltimosRelatorios['idfuncionario']);
                                    foreach ($listarfotofuncionario as $fotofuncionario) {
                                        ?>
                                        <div class="centralizar">
                                            <div class="userbackpicrelatorio" id="userbackpicrelatorio<?php echo $count; ?>">
                                                <div class="picuserrelatorio" style="
                                                     background: url('Img/Userimg/<?php echo $fotofuncionario['picture']; ?>') no-repeat center;
                                                     -webkit-background-size: contain;
                                                     -moz-background-size: contain;
                                                     -o-background-size: contain;
                                                     background-size: contain;
                                                     ">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="imgrelatorios relatorioimg">
                                    <div class="centralizar">
                                        <div class="relatoriobackpicrelatorio" id="relatoriobackpicrelatorio<?php echo $count; ?>">
                                            <div class="picrelatorio" style="
                                                 background: url('Img/Icones/iconrelatorio.png') no-repeat center;
                                                 -webkit-background-size: contain;
                                                 -moz-background-size: contain;
                                                 -o-background-size: contain;
                                                 background-size: contain;
                                                 ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="criourelatorio" id="criourelatorio<?php echo $count; ?>"><b style="font-family: Roboto-Regular"><?php echo $fotofuncionario['tag'] ?></b> criou um novo relatório</p>
                            </div>
                        <?php } ?>
                        <div class="blocos_ultimosrelatorios animacao" ondblclick="return redirectionform('Controlador/listarRelatorios.php')" style="display: table">
                            <div class="centralizar">
                                <b style="font-family: Roboto-Regular;">mais...</b>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        <?php } ?>


    </div>
</div>


<div class="background">
    <div class="background_relatorio" style="background: url('Img/Backgrounds/RDA.jpg') no-repeat center;
         -webkit-background-size: contain;
         -moz-background-size: contain;
         -o-background-size: contain;
         background-size: contain;"></div>
</div>

