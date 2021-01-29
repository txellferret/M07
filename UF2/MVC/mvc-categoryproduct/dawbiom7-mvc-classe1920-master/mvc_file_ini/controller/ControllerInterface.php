<?php
interface ControllerInterface {
    
    public function processRequest();
    public function listAll();
    public function add();
    public function searchById();
    public function modify();
    public function delete();
    
}
