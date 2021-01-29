<?php
require "../interfaces/Speaker.interface.php";
abstract class Clock implements Speaker {
    abstract public function talk(); 


}