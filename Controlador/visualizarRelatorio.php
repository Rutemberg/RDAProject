<hr class="visualizarrelatorio_linha">

<?php
date_default_timezone_set('America/Sao_Paulo');

include_once '../Modelo/DAO/classeRelatoriosDAO.php';
include_once '../Modelo/funcoesAuxiliares/funcoesAux.php';
include_once '../Modelo/DAO/classeUsuarioDAO.php';

$idRelatorio = $_REQUEST["idRelatorio"];

$listarRelatorioDAO = new classeRelatoriosDAO();
$listarRelatorio = $listarRelatorioDAO->listarRelatoriosPorID($idRelatorio, "idrelatorios");

foreach ($listarRelatorio as $Relatorio) {
    $idrelatorio = $Relatorio['idrelatorios'];

    $listarFuncionarioDAO = new classeUsuarioDAO();
    $listarFuncionario = $listarFuncionarioDAO->listarUsuario("*", $Relatorio['idfuncionario'], 'idusuario', 'DESC LIMIT 1');
    ?>

    <div class="visualizarrelatorio_titulo">
        <p>Relatorio <b><?php echo $Relatorio['idrelatorios']; ?></b></p>
    </div>

    <?php
    foreach ($listarFuncionario as $Funcionario) {
        ?>

        <div class="visualizarrelatorio_nomeUser">
            <p class="nomeUser"><?php echo $Funcionario['tag']; ?></p>
        </div>
        <div class="visualizarrelatorio_nomeUser">
            <p class="informationUser">
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

    <div class="visualizarrelatorio_corpo">

        <div class="visualizarrelatorio_picUser">
            <div class="relatorio_picUser">
                <div style="width: 100%;height: 100%;background: url('<?php echo "../Img/Userimg/{$Funcionario['picture']}"; ?>') no-repeat center;
                     -webkit-background-size: contain;
                     -moz-background-size: contain;
                     -o-background-size: contain;
                     background-size: contain;">
                </div>
            </div>
        </div>
        <div class="visualizarrelatorio_relatorio">

            <div class="visualizarrelatorio_data">
                <p><?php
                    $dia = explode("-", $Relatorio['data']);
                    echo $dia[2] . " de " . $Relatorio['mes'] . " | " . $Relatorio['ano'];
                    ?></p>
            </div>

            <div class="horawifi">
                <div style="display: table;width: 100%;height: 100%">
                    <div class="centralizar">
                        <p class="horawifi_label">Hora</p>
                        <p class="horawifi_hora">
                            <?php
                            $Relatorio['hora'] = substr($Relatorio['hora'], 0, -3);
                            echo $Relatorio['hora'];
                            ?>
                        </p>
                        <p class="horawifi_label" style="font-family: pirulen;font-size: 10px"><?php echo $Relatorio['turno'] ?></p>
                    </div>
                </div>
            </div>

            <div class="horawifi">
                <div style="display: table;width: 100%;height: 100%">
                    <div class="centralizar">
                        <?php if ($Relatorio['wifi'] == 'regular') { ?>
                            <img class="iconewifi" src="../Img/Icones/SInalwifiregular2.png">
                        <?php } ?>
                        <?php if ($Relatorio['wifi'] == 'bom') { ?>
                            <img class="iconewifi" src="../Img/Icones/Sinalwifi2.png">
                        <?php } ?>
                        <?php if ($Relatorio['wifi'] == 'ruim') { ?>
                            <img class="iconewifi" src="../Img/Icones/Sinalwifiruim2.png">
    <?php } ?>
                        <p class="horawifi_wifi"><?php echo $Relatorio['wifi']; ?></p>
                    </div>
                </div>
            </div>

            <div class="visualizarrelatorio_salas">
                <div class="visualizarrelatorio_titulocampos">
                    <img src="../Img/Icones/ClassRoom.png">
                    <p>SALAS MONTADAS</p>
                </div>
                <?php
                $listarSalas = new classeRelatoriosDAO();
                $resultadoSalas = $listarSalas->listarsalasFULL($idrelatorio);
                foreach ($resultadoSalas as $salas) {
                    $salas['numerosala'] = sprintf("%03d", $salas['numerosala']);
                    ?>
                    <div class="visualizarrelatorio_salas_blocos">
                    <?php echo $salas['numerosala'] . " "; ?>
                    </div>
                <?php }
                ?>

            </div>

        </div>

    </div>

    <div class="visualizarrelatorio_iconesmin">
        <?php if ($Relatorio['notebooksfuncionando'] == 'nao') { ?>
            <div class="iconesmin"><img src="../Img/Icones/laptopred.png"></div>
        <?php } else { ?>
            <div class="iconesmin"><img src="../Img/Icones/laptop.png"></div>
        <?php } ?>
            <?php if ($Relatorio['outrosproblemas'] == 'sim') { ?>
            <div class="iconesmin"><img src="../Img/Icones/problem.png"></div>
    <?php } ?>
    </div>

<?php } ?>