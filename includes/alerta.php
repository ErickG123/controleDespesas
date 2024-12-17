<?php 
    function getAlerta() {
        if (isset($_SESSION["alert_msg"])) {
            $titulo_alerta = $_SESSION["alert_title"];
            $msg_alerta = $_SESSION["alert_msg"];
            $cor_alerta = $_SESSION["alert_color"];

            echo '<div id="alert" class="z-20 bg-' . $cor_alerta .'-100 border-' . $cor_alerta .'-500 rounded-b text-' . $cor_alerta .'-900 px-4 py-3 shadow-md fixed top-12 right-0 w-80 md:w-96 rounded m-4 mr-2 transform transition-transform duration-500 enter:translate-x-0 leave:translate-x-ful" role="alert">';
            echo '<div class="flex"><div class="py-1"><svg class="fill-current h-6 w-6 text-' . $cor_alerta .'-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>';
            echo '<div><p class="font-bold">' . $titulo_alerta . '</p>';
            echo '<p class="text-sm">' . $msg_alerta . '</p></div></div></div>';

            unset($_SESSION["alert_title"]);
            unset($_SESSION["alert_msg"]);
            unset($_SESSION["alert_color"]);
        }
    }

    function redirecionar($titulo, $mensagem, $cor) {
        $_SESSION["alert_title"] = $titulo;
        $_SESSION["alert_msg"] = $mensagem;
        $_SESSION["alert_color"] = $cor;

        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }
?>
