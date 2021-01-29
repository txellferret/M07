<div id="content">
    <form method="post" action="">
        <fieldset>
            <legend>Modify category</legend>
            <label>Id *:</label>
            <input type="text" placeholder="Id" name="id" value="<?php if (isset($content)) { echo $content->getId(); } ?>" />
            <label>Name *:</label>
            <input type="text" placeholder="Name" name="name" value="<?php if (isset($content)) { echo $content->getName(); } ?>" />

            <label>* Required fields</label>
            <input type="submit" name="action" value="search" />
            <input type="submit" name="action" value="modify" />
            <input type="submit" name="action" value="delete" />
            <input type="submit" name="reset" value="reset" onClick="form_reset(this.form.id); return FALSE;" />
        </fieldset>
    </form>
</div>