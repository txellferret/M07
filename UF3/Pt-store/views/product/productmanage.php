
<h2>Product management page</h2>
<form action="" method="post">
    <label for="role">Category to search:</label>
    <input type="number" name="category_id" id="category_id">
    <button type="submit" name="search">Search</button>
    <button type="submit" name="add">Add</button>
</form>
<!--list of users-->
<?php
$list = $params['list'] ?? null;
if (isset($list)) {
    echo <<<EOT
        <table class="table table-sm table-bordered table-striped table-hover caption-top table-responsive-sm">
        <caption>List of users</caption>
        <thead class='table-primary'>
        <tr>
            <th>Code</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category Id</th>
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
                <td>{$elem->getPrice()}</td>
                <td>{$elem->getStock()}</td>
                <td>{$elem->getcategoryId()}</td>
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