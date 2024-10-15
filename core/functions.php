<?php

function is_loggedin()
{
    return (isset($_SESSION['user']) ? true : false);
}
