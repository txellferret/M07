<?php
//Programa que indica amb un missatge si s'està en edat laboral, edat d'estudiar o en edat de jubilació

if (!is_null(filter_input(INPUT_GET,'submit'))) { //if form submitted.
    //retrive parameters
    $age = filter_input(INPUT_GET, "age", FILTER_VALIDATE_INT );
    echo var_dump($age);
    
    if (!is_null($age) && $age !== false)  {

        $status = personStatus((int)$age);
        echo var_dump($age);
    } else  $status = "Don't understand your age";

    

} else {
    $age = " ";
    $status = " ";
}

function personStatus(int $x) : string{
    $status = "";
    if ($x < 16 && $x >= 0) {
        $status = "You are still student";
         
    } elseif ($x >= 16 && $x < 65) {
        $status =  "You can work";
        
    } elseif ($x >= 65) {
        $status =  "You are retired";
        
    } else  $status = "Don't understand your age";
  
    return $status;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Person status life</title>
</head>
<body>
    <h1>Person status life </h1>
    <form name="bmi-form" method="get" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <div>
            <label for="age">Age: </label>
            <input type="text" name="age" id ="age" value="<?php print($age); ?>"></input>
        </div>
        <div>
            <button type="submit" name="submit" value="submit">Submit</button>
        </div>
        <div>
            <label for="bmi">Status life: </label>
            <p> <?php echo $status;?> </p>
        </div>
    </form>
   
</body>
</html>