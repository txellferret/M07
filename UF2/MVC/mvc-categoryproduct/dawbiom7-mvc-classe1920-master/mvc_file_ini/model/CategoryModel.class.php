<?php

require_once "model/persist/CategoryFileDAO.class.php";
require_once "model/ProductModel.php";

//require_once "model/persist/CategoryDbDAO.class.php";

class CategoryModel {

    private $dataCategory;

    public function __construct() {
        // File
        $this->dataCategory = CategoryFileDAO::getInstance();

        // Database
        //$this->dataCategory=CategoryDbDAO::getInstance();
    }

    /**
     * select all categories
     * @param void
     * @return array of Category objects or array void
     */
    public function listAll(): array {
        $categories = $this->dataCategory->listAll();

        return $categories;
    }

    /**
     * insert a category
     * @param $category Category object to insert
     * @return TRUE or FALSE
     */
    public function add($category): bool {
        $result = $this->dataCategory->add($category);

        if ($result == FALSE) {
            $_SESSION['error'] = CategoryMessage::ERR_DAO['insert'];
        }

        return $result;
    }

    /**
     * select a category by Id
     * @param $id string Category Id
     * @return Category object or NULL
     */
    public function searchById($id) {
        $result = $this->dataCategory->searchById($id);

        return $result;
    }

    /**
     * update a category
     * @param $category Category object to update
     * @return TRUE or FALSE
     */
    public function modify($category): bool {
        $result = $this->dataCategory->modify($category);

        if (!$result) {
            $_SESSION['error'] = CategoryMessage::ERR_DAO['update'];
        }

        return $result;
    }

    /**
     * delete a category
     * @param $id string Category Id to delete
     * @return TRUE or FALSE
     */
    public function delete($id): bool {
        $result = FALSE;
        
        $productModel = new ProductModel();
        $categoryUsed = $productModel->categoryInProduct($id);

        if (!$categoryUsed) {
            $result = $this->dataCategory->delete($id);

            if (!$result) {
                $_SESSION['error'] = CategoryMessage::ERR_DAO['delete'];
            }
        } else {
            $_SESSION['error'] = CategoryMessage::ERR_DAO['used'];
        }
        return $result;
    }

}
