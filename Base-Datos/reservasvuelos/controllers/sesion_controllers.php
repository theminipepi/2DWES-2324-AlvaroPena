<?php
    $_SESSION = array();
    //setcookie('usuario', '', time() - 3600);
    setcookie(session_name(),'', time() - 3600, '/');
    session_destroy();
    header("Location: ../index");
?>