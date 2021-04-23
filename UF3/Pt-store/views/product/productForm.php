<?php
$categories = $params['listCategories']??null;
$action = $params['action']??null;
$result = $params['result']??null;
$productFound = $params['productToModify']??null;


$error = $params['error'] ?? null;
if (!is_null($error)) {
    echo <<<EOT
    <div><p class="alert">$error</p></div>
EOT;
} 
if (!is_null($result)) {
    echo <<<EOT
    <div><p class="alert">$result</p></div>
EOT;
}  
?>
<form action="" method="post">

    <input type="text" class="form-control" name="id"  value= "<?php if(!is_null($productFound)) echo $productFound->getId();?>" hidden>
   
    <div class="form-group row">
        <label for="code" class="col-sm-2 col-form-label">Code: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="code"  value= "<?php if(!is_null($productFound)) echo $productFound->getCode();?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Description: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="description" value= "<?php if(!is_null($productFound)) echo $productFound->getDescription();?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Price: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" value= "<?php if(!is_null($productFound)) echo $productFound->getPrice();?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="stock" class="col-sm-2 col-form-label">Stock: </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="stock" value= "<?php if(!is_null($productFound)) echo $productFound->getStock();?>"required>
        </div>
    </div>

    <div class="form-group row">
        <label for="dish" class="col-sm-2 col-form-label">Category id: </label>
        <div class="col-sm-10">
            <select class="form-control" name="category_id" value= "<?php if(!is_null($productFound)) echo $productFound->getCategoryId();?>">
                <?php 
                foreach ($categories as $v) {
                    echo "<option value='".$v."'>".$v."</option>";
                }
               ?>
            </select>
        </div>
    </div>

    <?php
    if($action == "add") {
        echo "<button type='submit' class='btn btn-success' name ='action' value='addProduct'>Add Product</button>";
    } elseif($action == "edit") {
        echo "<button type='submit' class='btn btn-primary' name ='action' value='editProduct'>Edit Product</button>";
    }
    ?>
    <button type="button" class="btn btn-secondary"><a href ="index.php?action=product" style="color: white; text-decoration: none">Cancel</a></button> 
    
</form>