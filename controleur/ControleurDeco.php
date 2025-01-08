<?php

session_start();
session_unset();
session_destroy();
header("Location: ../vue/pageConnexion.php");
exit;