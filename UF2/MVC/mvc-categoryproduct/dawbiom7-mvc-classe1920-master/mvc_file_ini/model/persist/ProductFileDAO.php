<?php
require_once "model/ModelInterface.class.php";
require_once "model/persist/ConnectFile.class.php";
require_once "model/Product.php";

/**
 * Description of ProductFileDAO
 *
 * @author tarda
 */
class ProductFileDAO implements ModelInterface{
    
    private static $instance=NULL; // instancia de la clase
    private $connect; // conexión actual

    const FILE="model/resource/products.txt";    
    
    public function __construct() {
        $this->connect=new ConnectFile(self::FILE);
    }

    // singleton: patrón de diseño que crea una instancia única
    // para proporcionar un punto global de acceso y controlar
    // el acceso único a los recursos físicos
    public static function getInstance():ProductFileDAO {
        if (is_null(self::$instance)) {
            self::$instance=new self();
        }
        return self::$instance;
    }  
    
    public function add($object): bool {
        
    }

    public function delete($id): bool {
        
    }

    public function listAll(): array {
        $result=array();
        
        //abrir fichero en modo lectura
        if ($this->connect->openFile("r")){
            while(!feof($this->connect->getHandle())){
                $line = trim(fgets($this->connect->getHandle()));
                if ($line!="") {
                    $fields = explode(";",$line);
                    $product= new Product($fields[0],$fields[1]);
                    array_push($result,$product);
                }
                
            }
            $this->connect->closeFile();
        }
        return $result;
    }

    public function modify($object): bool {
        
    }

    public function searchById($id) {
        
    }

    public function categoryInProduct($idCategory):bool {
        $result =FALSE;
        
        //abrir fichero en modo lectura
        if ($this->connect->openFile("r")){
            while(!feof($this->connect->getHandle())){
                $line = trim(fgets($this->connect->getHandle()));
                if ($line!="") {
                    $fields = explode(";",$line);
                    if ($idCategory == $fields[4]) {
                        $result =TRUE;
                        break;
                       
                    }
                    
                }
            }
            $this->connect->closeFile();
        }   
        
        return $result;
    }
    
}
