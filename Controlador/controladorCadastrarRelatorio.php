<html>
    <head><link rel="stylesheet" href="../Css/ElementStatic_estilo.css"></head>
    <body class="corpo">


        <?php
        session_start();
        include '../Modelo/funcoesAuxiliares/funcoesAux.php';

        $_SESSION["popup"] = array();


        if (empty($_POST['data'])) {
            $_SESSION["popup"][] = "Data";
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
        }
        if (empty($_POST['hora'])) {
            $_SESSION["popup"][] = "Horário";
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
        }
        if (empty($_POST['salasmontadas'])) {
            $_SESSION["popup"][] = "Salas não selecionadas";
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
        }
        if (empty($_POST['sinalwifi'])) {
            $_SESSION["popup"][] = "Sinal wifi não selecionado";
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
        }
        if (empty($_POST['notebookfuncionando'])) {
            $_SESSION["popup"][] = "Resposta não selecionada(notebook)";
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
        }
        if (!empty($_POST['notebookfuncionando']) && $_POST['notebookfuncionando'] == 'nao' && empty($_POST['notebooks'])) {
            $_SESSION["popup"][] = "Noteboook não selecionado";
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
        }
        if (!empty($_POST['notebookfuncionando']) && $_POST['notebookfuncionando'] == 'nao' && empty($_POST['especificarproblema'])) {
            $_SESSION["popup"][] = "Você nao especificou o problema com o(s) notebook(s)";
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
        }
        if (empty($_POST['relatorio_notebook'])) {
            $_SESSION["popup"][] = "Relatorio notebook não preenchido";
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
        }
        if (empty($_POST['problema'])) {
            $_SESSION["popup"][] = "Resposta não selecionada(problema)";
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
        }
        if (!empty($_POST['notebookfuncionando']) && $_POST['notebookfuncionando'] == 'nao' && empty($_POST['notebooks'])) {
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
            $_POST['notebookfuncionando'] = NULL;
        }
        if (!empty($_POST['notebookfuncionando']) && $_POST['notebookfuncionando'] == 'nao' && empty($_POST['especificarproblema'])) {
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
            $_POST['notebookfuncionando'] = NULL;
        }
        if (!empty($_POST['problema']) && $_POST['problema'] == 'sim' && empty($_POST['relatorio_problema'])) {
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
            $_SESSION["popup"][] = "Relatorio problema não preenchido";
            $_POST['problema'] = NULL;
        }

        if (empty($_POST['data'] && $_POST['hora'] && $_POST['sinalwifi'] && $_POST['notebookfuncionando'] && $_POST['problema'] && $_POST['salasmontadas'] && $_POST['relatorio_notebook'])) {
            $_SESSION["cadastronaorealizado"] = 1;
            $_SESSION["ultimocadastronaorealizado"] = 1;
            header('Location: ../Visao/Formularios/NovoRelatorio.php');
        }

//Relatorio geral
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $wifi = $_POST['sinalwifi'];
        $notebooksfuncionando = $_POST['notebookfuncionando'];
        $Outrosproblemas = $_POST['problema'];
        $idfuncionariologado = $_SESSION['IdUsuarioLogado'];
        $salasmontadas = $_POST['salasmontadas'];
        $relatorio_notebook = $_POST['relatorio_notebook'];
        $relatorio_problema = $_POST['relatorio_problema'];
        $problema = $_POST['especificarproblema'];
        $problemasespecificos = $problema;
        
        if (!empty($_POST['notebooks'])) {
            $notebooks = $_POST['notebooks'];
        }



        $mes = mesData($data);
        $turno = turno($hora);
        $a = explode("-", $data);
        $ano = $a[0];


        require_once '../Modelo/Classes/classeRelatorios.php';
        require_once '../Modelo/DAO/classeRelatoriosDAO.php';


        $novoRelatorio = new classeRelatorios();
        $novoRelatorio->setData($data);
        $novoRelatorio->setHora($hora);
        $novoRelatorio->setWifi($wifi);
        $novoRelatorio->setNotebooksfuncionando($notebooksfuncionando);
        $novoRelatorio->setOutrosproblemas($Outrosproblemas);
        $novoRelatorio->setMes($mes);
        $novoRelatorio->setTurno($turno);
        $novoRelatorio->setAno($ano);

        $novoRelatorioDAO = new classeRelatoriosDAO();

        $novoRelatorioDAO->cadastrarRelatorio($novoRelatorio, $idfuncionariologado, $salasmontadas);
        $cadastrarsala = $novoRelatorioDAO->cadastrarSalas($salasmontadas, $idfuncionariologado,$data,$ano,$mes);
        $cadastrarrelatorio_notebook = $novoRelatorioDAO->cadastrarRelatorio_Notebook($relatorio_notebook, $idfuncionariologado);

        $_SESSION["popupcadastrofinalizado"] = array();

        if ($notebooksfuncionando == "nao") {
            $cadastrarNotebooks = $novoRelatorioDAO->cadastrarNotebooks($notebooks, $idfuncionariologado,$data,$ano,$mes);
            if ($cadastrarNotebooks) {
                $_SESSION["popupcadastrofinalizado"][] = "<b class='numerolinhas'>". $novoRelatorioDAO->LinhasafetadasN() . "</b> linha(s) inserida(s) em <b class='nometabela'>Notebooks</b>";

            }
            $cadastrarProblemaEspecifico = $novoRelatorioDAO->cadastrarProblema($problemasespecificos, $idfuncionariologado,$data,$ano,$mes);
            if ($cadastrarProblemaEspecifico) {
                $_SESSION["popupcadastrofinalizado"][] = "<b class='numerolinhas'>". $novoRelatorioDAO->LinhasafetadasCP() . "</b> linha(s) inserida(s) em <b class='nometabela'>problemas especificos</b>";
            }
        }
        if ($Outrosproblemas == "sim" && isset($relatorio_problema)) {
            $cadastrarProblema = $novoRelatorioDAO->cadastrarRelatorio_Problema($relatorio_problema, $idfuncionariologado);
            if ($cadastrarProblema) {
                $_SESSION["popupcadastrofinalizado"][] = "<b class='numerolinhas'>". $novoRelatorioDAO->LinhasafetadasRP() . "</b> linha(s) inserida(s) em <b class='nometabela'>Relatorio_problema</b>";
            }
        }


        if ($novoRelatorioDAO && $cadastrarsala && $cadastrarrelatorio_notebook) {
            $_SESSION["popupcadastrofinalizado"][] = "<b class='numerolinhas'>". $novoRelatorioDAO->Linhasafetadas() . "</b> linha(s) inserida(s) em <b class='nometabela'>Relatorios</b>";
            $_SESSION["popupcadastrofinalizado"][] = "<b class='numerolinhas'>". $novoRelatorioDAO->LinhasafetadasS() . "</b> linha(s) inserida(s) em <b class='nometabela'>Salas</b>";
            $_SESSION["popupcadastrofinalizado"][] = "<b class='numerolinhas'>". $novoRelatorioDAO->LinhasafetadasRN() . "</b> linha(s) inserida(s) em <b class='nometabela'>Relatorios_notebooks</b>";
            $_SESSION["cadastrorealizado"] = 1;
            unset($_SESSION["ultimocadastronaorealizado"]);
            header('Location: ../Home.php?Pagina=RDA');
        }
        ?>
    </body>
</html>