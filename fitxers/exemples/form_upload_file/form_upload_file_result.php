<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--<!DOCTYPE html>-->
<!--<html>--> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <!--<meta charset="UTF-8" />-->
            <title>DNA form result</title>
      </head>
      <body>
            <h1>DNA form result</h1>
            <?php
                  /* Retrieve data from the query */
                  if (isset($_POST['form_submit'])) {
                        $sequence_name = $_POST['sequence_name'];
                        $sequence = $_POST['sequence'];
                        $sequence_type = $_POST['sequence_type'];

                        //error container (string)
                        $errors = "";
                        //validations.
                        if (trim($sequence_name) === "") {
                              $errors = $errors . "<li>Sequence name required.</li>";
                        }
                        if (trim($sequence) === "") {
                              $errors = $errors . "<li>sequence_type</li>";
                        }
                        if (trim($sequence_type) === "") {
                              $errors = $errors . "<li>Sequence type required.</li>";
                        }
                        if ($_FILES['image']['error'] == UPLOAD_ERR_FORM_SIZE) {
                              $errors = $errors . "<li>Max file size exceeded.</li>";
                        }
                        //show errors.
                        if ($errors != "") {
                              echo "<p>Errors:</p>";
                              echo "<ul>", $errors, "</ul>"; 
                              echo "<p>[<a href='form2.php'>DNA form</a>]</p>";
                        }
                        else {
                              //get uploaded file path.
                              $file = "img/" . basename($_FILES["image"]["name"]);
                              //move file to permanent directory.
                              move_uploaded_file($_FILES["image"]["tmp_name"], $file);
                              //show retrieved data.
echo <<<EOT
<ul>
<li>$sequence_name</li>
<li>$sequence</li>
<li>$sequence_type</li>
</ul> 
EOT;
                              echo "<p><img src='$file' alt='NO IMAGE' /></p>";
                              //link to form.
                              echo "<p>[<a href='form2.php'>DNA form</a>]</p>";
                        }
                  }

            ?>

      </body>
</html>