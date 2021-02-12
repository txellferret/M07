<?php
    require_once "model/persist/UserFileDao.php";
    require_once "model/persist/ProductFileDao.php";
    class DaoFactory {
        /**
         * creates a proper DAO according to value of parameter $type
         * @param $type: the type of DAO to create.
         * @return a DAO object or null if unknown type.
         */
        public static function getDao(string $type) {
            $result = null;
            switch ($type) {
                case "user":
                    $result = new UserFileDao();
                    break;
                case "product":
                    $result = new ProductFileDao();
                    break;
                default:
                    break;
            }
            return $result;
        }
    }

