<?php
//Programa que calcula l'índex de massa corporal a partir del pes (kg.) i l'alçada (m).
$formMethod = 'get';
$inputMetod = ($formMethod=='post') ? INPUT_POST : INPUT_GET;

$message = "";

if (!is_null(filter_input($inputMetod, 'submit'))) { //if form submitted.
    //retrieve form parameters.
    $weight =  filter_input($inputMetod, "weight", FILTER_VALIDATE_FLOAT);
    $height =  filter_input($inputMetod, "height", FILTER_VALIDATE_FLOAT);
    echo var_dump($weight);
    
    //calculate IMC.
    if (!is_null($weight) && !is_null($height)) { //varible not sent by form
        echo var_dump($weight);
        if (($weight !==false) && ($height!==false)) { //variable not valid
            (float) $weight;
            (float) $height;
            $bmi = $weight / ($height * $height);
            
		}else $message = "invalid numbers"; 
	
    } else $message = "introduce values";
 } 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BMI calculator</title>
    </head>
    <body>
        <h1>Body mass index calculator</h1>
        <!-- php_self es una variable que et diu el nom del script -->
        <form name="bmi-form" method="<?php echo $formMethod;?>" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <!--serveix per agrupar un conjunt de camps-->
        <fieldset>
        <legend>BMI form</legend>
            <div>
            <label for="weight">Weight: </label>
            <input type="text" name="weight" id ="weight" value="<?php printf("%.2f", $weight); ?>"></input>
            </div>
            <div>
            <label for="height">Height: </label>
            <input type="text" name="height" id ="height" value="<?php printf("%.2f", $height); ?>"></input>
            </div>
            <div>
            <button type="submit" name="submit" value="submit">Submit</button>
            </div>
            <div>
            <label for="bmi">BMI: </label>
            <input type="text" name="bmi" value="<?php printf("%.2f", $bmi); ?>" disabled ></input>
            <p> <?php echo $message;?> </p>
            </div>

        </fieldset>
        </form>
    </body>
</html>
