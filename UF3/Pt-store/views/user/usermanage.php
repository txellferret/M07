
<h2>User management page</h2>
<form action="index.php" method="post" >
    <label for="role">Role to search:</label>
    <input type="text" name="role" id="role">

    <button type="submit" name="action" value="user/role">Send</button>
    <button type="submit" name="action" value="user/add">Add</button>
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
            <th>Username</th>
            <th>Full name</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>
EOT;
    // $params contains variables passed in from the controller.
    foreach ($list as $elem) {
        echo <<<EOT
            <tr>
                <td>{$elem->getUsername()}</td>
                <td>{$elem->getFirstname()} {$elem->getLastname()}</td>
                <td>{$elem->getRole()}</td>
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