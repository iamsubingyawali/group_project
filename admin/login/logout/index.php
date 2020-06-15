<?php
    //Destroying the current session
    session_start();
    session_unset();
    session_destroy();
    header('Location:../');