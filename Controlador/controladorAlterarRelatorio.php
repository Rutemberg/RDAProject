<html>
    <head><link rel="stylesheet" href="../Css/ElementStatic_estilo.css"></head>
    <body class="corpo">


        <?php
        session_start();
        include '../Modelo/funcoesAuxiliares/funcoesAux.php';
        require_once '../Modelo/Classes/classeRelatorios.php';
        require_once '../Modelo/DAO/classeRelatoriosDAO.php';

        $_SESSION["popup"] = array();
        $idRelatorioAlterar = $_POST["idRelatorioAlterar"];
        $idfuncionariologado = $_SESSION['IdUsuarioLogado'];

        $listardatamesanoDAO = new classeRelatoriosDAO();
        $listardatamesano = $listardatamesanoDAO->listarESPECIFIC('data,mes,ano', 'relatorios', 'idrelatorios', null, 'WHERE idrelatorios = ', $idRelatorioAlterar);

        foreach ($listardatamesano as $value) {
            $anoalterar = $value['ano'];
            $mesalterar = $value['mes'];
            $dataalterar = $value['data'];
        }

        if (!empty($_GET['alterar']) && $_GET['alterar'] == 'data_hora') {

            $novoAlterarRelatorioDAO = new classeRelatoriosDAO();

            if (empty($_POST['data'])) {
                $_SESSION["popup"][] = "data nao informada";
                $_SESSION["popup"][] = "mes nao identificado";
            }

            if (empty($_POST['hora'])) {
                $_SESSION["popup"][] = "hora nao informada";
                $_SESSION["popup"][] = "turno nao identificado";
            }
            if (empty($_POST['data'] && $_POST['hora'])) {
                $_SESSION["alteracaonaorealizada"] = 1;
                header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
            }

            if (!empty($_POST['data'])) {
                $data = $_POST['data'];
                $mes = mesData($data);

                $AlterarRelatoriodata = $novoAlterarRelatorioDAO->alterarColunaRelatorio('relatorios', 'data', $data, $idRelatorioAlterar);

                $AlterarRelatoriomes = $novoAlterarRelatorioDAO->alterarColunaRelatorio('relatorios', 'mes', $mes, $idRelatorioAlterar);

                if ($AlterarRelatoriodata && $AlterarRelatoriomes) {
                    header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
                    $_SESSION["alteracaorealizada"] = 1;
                    $_SESSION["popupalteracaofinalizada"][] = "Data e mes alterados";
                }
            }
            if (!empty($_POST['hora'])) {
                $hora = $_POST['hora'];
                $turno = turno($hora);

                $AlterarRelatoriohora = $novoAlterarRelatorioDAO->alterarColunaRelatorio('relatorios', 'hora', $hora, $idRelatorioAlterar);

                $AlterarRelatorioturno = $novoAlterarRelatorioDAO->alterarColunaRelatorio('relatorios', 'turno', $turno, $idRelatorioAlterar);

                if ($AlterarRelatoriohora && $AlterarRelatorioturno) {
                    header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
                    $_SESSION["alteracaorealizada"] = 1;
                    $_SESSION["popupalteracaofinalizada"][] = "Hora e turno alterados";
                }
            }
        }


        if (!empty($_GET['alterar']) && $_GET['alterar'] == 'salasmontadas') {

            $novoAlterarRelatoriosalasDAO = new classeRelatoriosDAO();

            if (empty($_POST['salasmontadas'])) {
                $_SESSION["popup"][] = "salas nao selecionadas";
            }

            if (empty($_POST['salasmontadas'])) {
                $_SESSION["alteracaonaorealizada"] = 1;
                header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
            }

            if (!empty($_POST['salasmontadas'])) {
                $salasmontadas = $_POST['salasmontadas'];

                $excluirsalas = $novoAlterarRelatoriosalasDAO->deletar('salasmontadas', $idRelatorioAlterar);

                $alterarsalas = $novoAlterarRelatoriosalasDAO->alterarSalas($salasmontadas, $idRelatorioAlterar, $idfuncionariologado, $dataalterar, $anoalterar, $mesalterar);


                if ($excluirsalas && $alterarsalas) {
                    header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
                    $_SESSION["alteracaorealizada"] = 1;
                    $_SESSION["popupalteracaofinalizada"][] = "salas alteradas";
                }
            }
        }


        if (!empty($_GET['alterar']) && $_GET['alterar'] == 'sinalwifi') {

            if (empty($_POST['sinalwifi'])) {
                $_SESSION["popup"][] = "Qualidade do sinal wifi nao informada";
            }

            if (empty($_POST['sinalwifi'])) {
                $_SESSION["alteracaonaorealizada"] = 1;
                header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
            }

            if (!empty($_POST['sinalwifi'])) {
                $sinalwifi = $_POST['sinalwifi'];

                $novoAlterarRelatoriosinalDAO = new classeRelatoriosDAO();
                $alterarsinal = $novoAlterarRelatoriosinalDAO->alterarColunaRelatorio("relatorios", "wifi", $sinalwifi, $idRelatorioAlterar);


                if ($alterarsinal) {
                    header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
                    $_SESSION["alteracaorealizada"] = 1;
                    $_SESSION["popupalteracaofinalizada"][] = "Sinal wifi alterado";
                }
            }
        }


        if (!empty($_GET['alterar']) && $_GET['alterar'] == 'notebooks') {


            if (empty($_POST['notebookfuncionando'])) {
                $_SESSION["popup"][] = "Resposta nao informada";
                $_SESSION["alteracaonaorealizada"] = 1;
            }
            if (!empty($_POST['notebookfuncionando']) && $_POST['notebookfuncionando'] == 'nao' && empty($_POST['notebooks'])) {
                $_SESSION["popup"][] = "noteboook(s) nao selecionado(s)";
                $_SESSION["alteracaonaorealizada"] = 1;
                $_POST['notebookfuncionando'] = NULL;
            }
            if (!empty($_POST['notebookfuncionando']) && $_POST['notebookfuncionando'] == 'nao' && empty($_POST['especificarproblema'])) {
                $_SESSION["popup"][] = "Você não especificou o problema";
                $_SESSION["alteracaonaorealizada"] = 1;
                $_POST['notebookfuncionando'] = NULL;
            }
            if (empty($_POST['relatorio_notebook'])) {
                $_SESSION["popup"][] = "relatorio notebook nao preenchido";
                $_SESSION["cadastronaorealizado"] = 1;
            }
            if (empty($_POST['notebookfuncionando'] && $_POST['relatorio_notebook'])) {
                $_SESSION["alteracaonaorealizada"] = 1;
                header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
            } else {

                $notesDAO = new classeRelatoriosDAO();

                $pesquisarnotes = $notesDAO->listarFULL('notebooks', $idRelatorioAlterar);
                $countNote = $notesDAO->resultadolistarFULL();

                $pesquisarproblemas = $notesDAO->listarFULL('problemas', $idRelatorioAlterar);
                $countproblema = $notesDAO->resultadolistarFULL();

                $alterarNote = $notesDAO->alterarColunaRelatorio("relatorios", "notebooksfuncionando", $_POST['notebookfuncionando'], $idRelatorioAlterar);
                $alterarRelatorio = $notesDAO->alterarColuna('relatorio_notebook', 'relatorio', $_POST['relatorio_notebook'], 'idrelatorio', $idRelatorioAlterar);


                if ($countNote > 0) {
                    $excluir = $notesDAO->deletar('notebooks', $idRelatorioAlterar);
                    $resultadoexcluir = $notesDAO->resultadoDeletar();
                    if ($resultadoexcluir > 0) {
                        $_SESSION["popupalteracaofinalizada"][] = "<b class='numerolinhas'>" . $resultadoexcluir . "</b> linha(s) deletada(s) em <b class='nometabela'>Notebooks</b>";
                    }
                }
                if ($countproblema > 0) {
                    $excluir = $notesDAO->deletar('problemas', $idRelatorioAlterar);
                    $resultadoexcluirproblemas = $notesDAO->resultadoDeletar();
                    if ($resultadoexcluirproblemas > 0) {
                        $_SESSION["popupalteracaofinalizada"][] = "<b class='numerolinhas'>" . $resultadoexcluirproblemas . "</b> linha(s) deletada(s) em <b class='nometabela'>problemas</b>";
                    }
                }

                if (!empty($_POST['notebookfuncionando']) && $_POST['notebookfuncionando'] == 'nao' && !empty($_POST['notebooks'])) {

                    $notebooks = $_POST['notebooks'];
                    $cadastrarNote = $notesDAO->alterarNotebooks($notebooks, $idRelatorioAlterar, $idfuncionariologado, $dataalterar, $anoalterar, $mesalterar);
                    $resultadocadastronotes = $notesDAO->resultadoAlterarNotebooks();

                    if ($cadastrarNote) {
                        $_SESSION["popupalteracaofinalizada"][] = "<b class='numerolinhas'>" . $resultadocadastronotes . "</b> linha(s) Inserida(s) em <b class='nometabela'>Notebooks</b>";
                    }
                }
                if (!empty($_POST['notebookfuncionando']) && $_POST['notebookfuncionando'] == 'nao' && !empty($_POST['especificarproblema'])) {
                    $problema = $_POST['especificarproblema'];
                    $problemasespecificos = $problema;
                    $cadastrarproblema = $notesDAO->alterarProblema($problemasespecificos, $idRelatorioAlterar, $idfuncionariologado, $dataalterar, $anoalterar, $mesalterar);
                    $resultadocadastroproblema = $notesDAO->LinhasafetadasCP();

                    if ($cadastrarproblema) {
                        $_SESSION["popupalteracaofinalizada"][] = "<b class='numerolinhas'>" . $resultadocadastroproblema . "</b> linha(s) Inserida(s) em <b class='nometabela'>Problemas</b>";
                    }
                }


                if ($alterarNote && $alterarRelatorio) {
                    header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
                    $_SESSION["alteracaorealizada"] = 1;
                    $_SESSION["popupalteracaofinalizada"][] = "Relatorio notebook alterado";
                }
            }
        }




        if (!empty($_GET['alterar']) && $_GET['alterar'] == 'problema') {

            $problemaDAO = new classeRelatoriosDAO();
            $pesquisarproblema = $problemaDAO->listarFULL('relatorio_problema', $idRelatorioAlterar);
            $countproblema = $problemaDAO->resultadolistarFULL();

            if (empty($_POST['problema'])) {
                $_SESSION["popup"][] = "Resposta nao informada";
                $_SESSION["alteracaonaorealizada"] = 1;
            }
            if (!empty($_POST['problema']) && $_POST['problema'] == 'sim' && empty($_POST['relatorio_problema'])) {
                $_SESSION["popup"][] = "Relatorio do problema nao preenchido";
                $_SESSION["alteracaonaorealizada"] = 1;
                header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
            }
            if (empty($_POST['problema'])) {
                header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
            }

            if (!empty($_POST['problema']) && $_POST['problema'] == 'nao') {

                if ($countproblema > 0) {
                    $excluir = $problemaDAO->deletar('relatorio_problema', $idRelatorioAlterar);
                    $resultadoexcluir = $problemaDAO->resultadoDeletar();

                    if ($resultadoexcluir > 0) {
                        $_SESSION["popupalteracaofinalizada"][] = "<b class='numerolinhas'>" . $resultadoexcluir . "</b> linha(s) deletada(s) em <b class='nometabela'>relatorio_problema</b>";
                    }
                }

                $alterar = $problemaDAO->alterarColunaRelatorio("relatorios", "outrosproblemas", $_POST['problema'], $idRelatorioAlterar);
                if ($alterar) {
                    $_SESSION["popupalteracaofinalizada"][] = "Relatorio problema deletado";
                    $_SESSION["alteracaorealizada"] = 1;
                    header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
                }
            }
            if (!empty($_POST['problema']) && $_POST['problema'] == 'sim' && !empty($_POST['relatorio_problema'])) {
                if ($countproblema > 0) {
                    $excluir = $problemaDAO->deletar('relatorio_problema', $idRelatorioAlterar);
                    $resultadoexcluir = $problemaDAO->resultadoDeletar();
                    if ($resultadoexcluir > 0) {
                        $_SESSION["popupalteracaofinalizada"][] = "<b class='numerolinhas'>" . $resultadoexcluir . "</b> linha(s) deletada(s) em <b class='nometabela'>relatorio_problema</b>";
                    }
                }

                $alterar = $problemaDAO->alterarColunaRelatorio("relatorios", "outrosproblemas", $_POST['problema'], $idRelatorioAlterar);
                $inserir = $problemaDAO->alterarRelatorio_Problema($_POST['relatorio_problema'], $idRelatorioAlterar, $idfuncionariologado);

                if ($inserir) {
                    $_SESSION["popupalteracaofinalizada"][] = "<b class='numerolinhas'>1</b> linha alterada em <b class='nometabela'>relatorio_problema</b>";
                }
                if ($alterar && $inserir) {
                    $_SESSION["popupalteracaofinalizada"][] = "Relatorio problema inserido";
                    $_SESSION["alteracaorealizada"] = 1;
                    header("Location: listarRelatorio.php?idRelatorio={$idRelatorioAlterar}");
                }
            }
        }
        ?>
    </body>
</html>