<h2>Category management page</h2>

<form action="index.php" method="post" >
    <button type="submit" name="action" value="category/add">Add</button>   
</form>
<form id ="categoryForm" action="index.php" method="post" >
    <input type='text' id ="idCategory" name ="idCategory" value="" hidden>
    <input name="action" hidden="hidden" value="category/edit"/>
</form>


<?php
$result = $params['result'] ?? null;
if (!is_null($result)) {
    echo <<<EOT
    <div><p class="alert">$result</p></div>
EOT;
}  

$error = $params['error'] ?? null;
if (!is_null($error)) {
    echo <<<EOT
    <div><p class="alert alert-danger">$error</p></div>
EOT;
}  

//display list in a table.
$list = $params['list'] ?? null;
if (isset($list)) {
    echo <<<EOT
        <table class="table table-sm table-bordered table-striped table-hover caption-top table-responsive-sm">
        <caption>List of categories</caption>
        <thead class='table-primary'>
        <tr>
            <th>Code</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
EOT;
    // $params contains variables passed in from the controller.
    foreach ($list as $elem) {
        echo <<<EOT
            <tr id='{$elem->getId()}' class='clickable-row'>
                <td>{$elem->getCode()}</td>
                <td>{$elem->getDescription()}</td>
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
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        var idCat = $(this).attr('id');
        $("#idCategory").val(idCat)
        $("#categoryForm").submit();
    });
});
</script>