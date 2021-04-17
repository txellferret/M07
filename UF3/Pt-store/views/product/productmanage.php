<?php
$display = "";
if (!isset($_SESSION['userRole'])) $display = 'style="display: none;' ;

?>
<h2>Product management page</h2>
<form action="" method="post">
    <label for="role">Category to search:</label>
    <input type="number" name="category_id" id="category_id" value="">

    <button type="submit" name="action" value="product/category">Search</button>
    <button type="submit" name="action" value="product/add" <?php if (!isset($_SESSION['userRole'])) echo 'style="display: none;' ;?>">Add</button>
</form>
<!--list of users-->
<?php
$result = $params['result'] ?? null;
if (!is_null($result)) {
    echo <<<EOT
    <div><p class="alert">$result</p></div>
EOT;
}  
$list = $params['list'] ?? null;

if (isset($list)) {
    echo <<<EOT
        <table class="table table-sm table-bordered table-striped table-hover caption-top table-responsive-sm">
        <caption>List of products</caption>
        <thead class='table-primary'>
        <tr>
            <th>Code</th>
            <th>Description</th>
            <th >Actions</th>
        </tr>
        </thead>
        <tbody>
EOT;
    // $params contains variables passed in from the controller.
    foreach ($list as $elem) {
        echo <<<EOT
            <tr>
                <td>{$elem->getCode()}</td>
                <td>{$elem->getDescription()}</td>
                <td>
                <form action="index.php"  method="post" {$display}>
                    <input type='text' hidden name ="id" value="{$elem->getId()}">
                    <button class ="btn btn-primary" type="submit"  name="action" value="product/edit">Edit</button>
                    <button class ="btn btn-danger" type="submit" onclick="return confirmDialog()" name="action" value="deleteProduct">Delete</button>
                </form>

                </td>

            </tr>               
EOT;
    }
    echo "</tbody>";
    echo "</table>";
    echo "<div class='alert alert-info' role='alert'>";
    echo count($list), " elements found.";
    echo "</div>";   
} else {
    echo "No data found";
}
?>
<script>
function confirmDialog() {
    return window.confirm("Are you sure?");
}

</script>