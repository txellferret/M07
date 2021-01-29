<?php
interface ModelInterface {

    public function listAll():array;
    public function add($object):bool;
    public function searchById($id);
    public function modify($object):bool;
    public function delete($id):bool;

}
