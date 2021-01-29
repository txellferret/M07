<div id="content">
    <fieldset>
        <legend>Product list</legend>    
        <?php
            if (isset($content)) {
                echo <<<EOT
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                        </tr>
EOT;
                foreach ($content as $product) {
                    echo <<<EOT
                        <tr>
                            <td>{$product->getId()}</td>
                            <td>{$product->getName()}</td>
                        </tr>
EOT;
                }
                echo <<<EOT
                    </table>
EOT;
            }
        ?>
    </fieldset>
</div>