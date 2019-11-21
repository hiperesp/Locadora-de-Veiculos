<?php
function showLoginPrompt() {
    global $do_not_show_back_button;
    include __DIR__."/../admin/views/head.php";
?>
<main class="main">
    <hr>
    <form action="#" method="post">
        <h2>Fazer Login</h2>
        <input type="hidden" name="action" value="login">
        <label>
            Login:<br>
            <input type="text" name="login" value=""><br>
        </label><br>
        <label>
            Senha:<br>
            <input type="password" name="password" value=""><br>
        </label><br>
        <label>
            <input type="submit" value="Fazer Login"><br>
        </label><br>
    </form>
</main>
<?php
    include __DIR__."/../admin/views/foot.php";
    die;
}
session_start();
if(isset($_SESSION["usuario"])) {
    $usuarioLogado = $_SESSION["usuario"];
    if(isset($_GET["logout"])) {
        session_destroy();
        header("Location: #");
        die;
    }
} else {
    $usuarioLogado = new Usuario();
    if(@$_POST["action"]=="login") {
        $usuarioLogado->loginUsuario = @$_POST["login"];
        $usuarioLogado->senhaUsuario = @$_POST["password"];
        $usuarioLogado = $usuarioLogado->auth();
        if($usuarioLogado===false) {
            Notification::addActionNotification("", "", "Não foi possível efetuar o login");
            showLoginPrompt();
            die;
        } else if(is_string($usuarioLogado)) {
            Notification::addActionNotification("", "", $usuarioLogado);
            showLoginPrompt();
            die;
        } else {
            $_SESSION["usuario"] = $usuarioLogado;
        }
    } else {
        showLoginPrompt();
    }
}
?>
