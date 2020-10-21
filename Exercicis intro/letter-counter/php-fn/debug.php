<?php
namespace proven\debug {
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);

  function var_dump( $obj ) {
    echo "<pre>"; \var_dump($obj); echo "</pre>";
  }

  function print_r( $obj ) {
    echo "<pre>"; \print_r($obj); echo "</pre>";
  }

}
