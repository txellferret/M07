<?php
echo "<p>User detail page</p>";
if (isset($params['mode'])) {
    printf("<p>mode: %s</p>", $params['mode']);
}