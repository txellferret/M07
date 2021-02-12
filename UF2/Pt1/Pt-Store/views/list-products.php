<table>
        <h2>List all products</h2>
        <tr>
            <th>id</th>
            <th>description</th>
            <th>price</th>
            <th>stock</th>
        </tr>
        <?php
        //display list of items in a table.
        $productList = $params['productList'];
        // $params contains variables passed in from the controller.
        foreach ($productList as $elem) {
            echo <<<EOT
            <tr>
                <td>{$elem->getId()}</td>
                <td>{$elem->getDescription()}</td>
                <td>{$elem->getPrice()}</td>
                <td>{$elem->getStock()}</td>
            </tr>               
EOT;
    }
    ?>
</table>

