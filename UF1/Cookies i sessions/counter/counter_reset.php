<?php
    //fem caducar la cookie
    setcookie('counter', 0, time() - 365 * 24 * 60 * 60);
    
    print_r($_COOKIE);
