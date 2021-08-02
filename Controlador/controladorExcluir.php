<html>
    <head><link rel="stylesheet" href="../Css/ElementStatic_estilo.css"></head>
    <body class="corpo">


        <?php
        session_start();
        include '../Modelo/DAO/classeRelatoriosDAO.php';
        $idfuncionariologado = $_SESSION['IdUsuarioLogado'];

        $_SESSION["popup"] = array();

        if (!empty($_GET['idRelatorio'])) {
            $idrelatorio = $_GET['idRelatorio'];
            $relatorioDAO = new classeRelatoriosDAO;

            $excluirSalas = $relatorioDAO->deletar('salasmontadas', $idrelatorio);
            $excluirrelatorionote = $relatorioDAO->deletar('relatorio_notebook', $idrelatorio);
            $excluirrelatorio = $relatorioDAO->deletar('relatorios', $idrelatorio, 'idrelatorios');

            $listarNotes = $relatorioDAO->listarFULL('notebooks', $idrelatorio);
            $countNotes = $relatorioDAO->resultadolistarFULL();
            if ($countNotes > 0) {
                $excluirNotes = $relatorioDAO->deletar('notebooks', $idrelatorio);
                $_SESSION["popup"][] = "<b class='numerolinhas'>{$countNotes}</b> note(s) encontrado(s) e <b class='excluido'>excluido(s)</b>";
            }

            $Listarrelatorioproblema = $relatorioDAO->listarFULL('relatorio_problema', $idrelatorio);
            $countproblema = $relatorioDAO->resultadolistarFULL();
            if ($countproblema > 0) {
                $excluirrelatorioproblema = $relatorioDAO->deletar('relatorio_problema', $idrelatorio);
                $_SESSION["popup"][] = "<b class='numerolinhas'>{$countproblema}</b> relatorio problema encontrado e <b class='excluido'>excluido</b>";
            }

            $Listarproblemaespecificos = $relatorioDAO->listarFULL('problemas', $idrelatorio);
            $countproblemaespecificos = $relatorioDAO->resultadolistarFULL();
            if ($countproblemaespecificos > 0) {
                $excluirproblemaespecifico = $relatorioDAO->deletar('problemas', $idrelatorio);
                $_SESSION["popup"][] = "<b class='numerolinhas'>{$countproblemaespecificos}</b> problema(s) encontrado(s) e <b class='excluido'>excluido(s)</b>";
            }



            if ($excluirrelatorio && $excluirSalas && $excluirrelatorionote) {

                $_SESSION["exclusaocompleta"] = 1;
                $_SESSION["popup"][] = "Relatorio notebook <b class='excluido'>excluido</b>";
                $_SESSION["popup"][] = "Sala(s) montada(s) <b class='excluido'>excluida(s)</b>";
                $_SESSION["popup"][] = "Relatorio total <b class='excluido'>excluido</b>";

                $idUltimoRelatorio = $relatorioDAO->listarRelatoriosFULL($idfuncionariologado, "idrelatorios", "DESC LIMIT 1");
                $countUltimoRelatorio = $relatorioDAO->resultadolistarRelatoriosFULL();
                if ($countUltimoRelatorio > 0) {
                    foreach ($idUltimoRelatorio as $ultimorelatorio) {
                        header("Location: listarRelatorio.php?idRelatorio={$ultimorelatorio['idrelatorios']}");
                    }
                } else {
                    header("Location: ../Home.php?Pagina=RDA");
                }
            }
        }
        ?>

    </body>
</html>