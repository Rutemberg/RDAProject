<html>
    <head><link rel="stylesheet" href="../Css/ElementStatic_estilo.css"></head>
    <body class="corpo">
        <?php
        require_once '../Modelo/DAO/classeLoginDAO.php';
        $loginDAO = new classeLoginDAO();

        if (isset($_GET['logout']) && ($_GET['logout'] == TRUE)) {
            $loginDAO->fazerLogout();
        } else {
            $tag = $_POST["tag"];
            $pin = $_POST["pin"];
        }
        $usuario = $loginDAO->fazerLogin($tag, $pin);

        if ($usuario == FALSE) {
            echo "<script>alert('Erro no Login! Email e/ou Senha Incorretos!!!');
                        window.location.href='../index.php';
                        </script>";
        } else {
            echo "<script>window.location.href='../Home.php';</script>";
        }
        ?>
    </body>
</html>



