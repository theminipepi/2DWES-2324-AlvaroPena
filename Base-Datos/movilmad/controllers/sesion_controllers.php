<?php

    setcookie('usuario', '', time() - 3600);
    setcookie(session_name(),'', time() - 3600, '/');
    header("Location: ../index");
?>