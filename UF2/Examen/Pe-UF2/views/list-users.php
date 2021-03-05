<table>
        <h2>List all users</h2>
        <tr>
            <th>username</th>
            <th>password</th>
            <th>age</th>
            <th>role</th>
        </tr>
        <?php
        //display list of items in a table.
        $userList = $params['userList'];
        // $params contains variables passed in from the controller.
        
        foreach ($userList as $elem) {
            echo <<<EOT
            <tr>
                <td>{$elem->getUsername()}</td>
                <td>{$elem->getPassword()}</td>
                <td>{$elem->getAge()}</td>
                <td>{$elem->getRole()}</td>
            </tr>               
EOT;
    }
    ?>
</table>
<br>
<?php
echo "Total: ".$params['count']. " users found.";

?>


