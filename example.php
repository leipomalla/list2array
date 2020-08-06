
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="main.css">
<title>Edit a list</title>
</head>

<body>
<div class="wrapper">
<p style="font-size: 20pt">Edit your list</p>

<form method="post">

<div class="slidecontainer">
  
 <textarea name="abbr" cols="40" rows="4" placeholder="Drop a list containing your abbreviations here"></textarea>
 <br>
  <textarea name="expl" cols="40" rows="4" placeholder="Drop a list containing your explanations here"></textarea>
<br>
<input type="submit" name="set" />
</div>

</form>
<?php
session_start();

//Let's check that the strings are inserted and validate them
if ($_POST['set']) {
    if (empty($_POST['abbr']) || (empty($_POST['expl']))) {
        echo "Oops, seems like you didn't insert a string! Try again, please.";
    } else {

        //Values inserted in input slots are saved in variables
        $abbreviations = $_POST['abbr'];
        $explanations = $_POST['expl'];

        //Here we'll initiate an array and set the variables there
        $_SESSION['abbr'][] = $abbreviations;
        $_SESSION['expl'][] = $explanations;

       
        // List are exploded here
        $abbr_list = explode("\n", $abbreviations);
        $expl_list = explode("\n", $explanations);

        //Get a size of arrays
        $numrows = sizeof($abbr_list);

        //Lists are combined, this is not necessary
        $my_cool_array = array();
        for ($i = 0; $i < $numrows; $i++) {
            $my_cool_array[$abbr_list[$i]] = $expl_list[$i];

        }
        //Arrays are mapped together and trimmed while printing
        foreach ($my_cool_array as $key => $value) {
            echo "<div class='output'>";
            
                echo  trim($key) . " => '" . trim($value) . "',<br>";
            echo "</div>";
            }

        }

    }

   

// Clear button to clear arrays
echo "<form method='post'>";
echo "<input type='submit' name='clear' value='Clear' />";
echo "</form>";
if ($_POST['clear']) {
    session_destroy();
}

?>
</div>


</body>
</html>
