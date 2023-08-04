<?php

setcookie("testovacicookies", "test", time() + 60 * 60 * 24, "/");

var_dump($_COOKIE);