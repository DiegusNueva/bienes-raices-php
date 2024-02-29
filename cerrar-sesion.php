<?php

session_start();

// Reiniciamos la sesión

$_SESSION = [];

header('Location: /bienesraices/');