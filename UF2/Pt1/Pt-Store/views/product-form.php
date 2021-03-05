<script type="text/javascript">
function submitForm(event) {
    var target = event.target;
    var buttonId = target.id;
    var myForm = document.getElementById('product-form');
    myForm.action.value = buttonId;
    myForm.submit();
    return false;
}
</script>
<?php
   $p = $params['product']??null;  //?? is the 'null coalescing operator'.
   $action = $params['action']??"findProduct";// si la var action no esta ddefinida, return null (normalment)

   // Si posem ??, dona com a valor per defecte el valor de la dreta si retorna null i la inicialitza

   $result = $params['result']??null;
   if (is_null($p)) {
       $p = new Product();
   }
   $disable = (($action == "product/find")||($action == "product/form"))?"disabled":"";
   if (!is_null($result)) {
       echo <<<EOT
       <div><p class="alert">$result</p></div>
EOT;
   }   
   echo <<<EOT
   <form id="product-form" method="post" action="index.php">
    <fieldset>
        <label for="id">Id: </label><input type="text" name="id" id="id" placeholder="enter id" value="{$p->getId()}" />
        <label for="description">Description: </label><input type="text" name="description" id="description" placeholder="enter description" value="{$p->getDescription()}"/>
        <label for="price">Price: </label><input type="text" name="price" id="price" placeholder="enter price" value="{$p->getPrice()}"/>
        <label for="stock">Stock: </label><input type="number" name="stock" id="stock" placeholder="enter stock" value="{$p->getStock()}"/>

   </fieldset>
    <fieldset>
        <button type="button" id="product/find" name="product/find" onclick="submitForm(event);return false;">Find</button>
        <button type="button" id="product/add" name="product/add" onclick="submitForm(event);return false;">Add</button>
        <button type="button" id="product/modify" name="product/modify" {$disable} onclick="submitForm(event);return false;">Modify</button>
        <button type="button" id="product/remove" name="product/remove" {$disable} onclick="submitForm(event);return false;">Remove</button>
        <input name="action" id="action" hidden="hidden" value="add"/>
    </fieldset>
</form>
EOT;
