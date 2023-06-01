<?php

/**
 *exe6_2fr.php
 *EXERCISE 6 NUMBER 2
 *FORM & FORM HANDLING
 *Patrick Saint-Louis, 2023
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Question?</title>
    </head>
    <body>
        <?php
            // if the form is not yet submitted display the form
            if (!isset($_POST['submit'])) 
            {
        ?>
        <h1>Cherche un nom de fruit</h1>
        <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
            <p>Type de mot clé?</p>
            <label>
                Nombre
                <input type="radio" name="numberOrText" value="number" required="required">
            </label>
            <label>
                Texte
                <input type="radio" name="numberOrText" value="text" required="required">
            </label>
            <p>Quel est votre mot clé?</p>
            <label>
                Nombre: accepte 1 à 9<br/>
                Texte : accepte a à i<br/>
                <input type="text" name="keyword" maxlength="1" required />
            </label>
            <br /><br />
            <input type="submit" name="submit" value="Submit" />
        </form>
    </body>
</html>
        <?php
        // if form is submitted process form input
           } else {

echo <<<_END
  <!DOCTYPE html>
  <html>  
  <head>
    <title>Answer!</title>
    <style>
      .redtext{color:red;}
    </style>
  </head>
  <body>			
    <h1 class="redtext"></h1>
    <hr>
_END;

    //Assign data collected to variables
    $userInput=$_POST['keyword'];

    //Create numbered and associative arrays
    $fruitsNumber=array('apple', 
                        'banana', 
                        'cherry', 
                        'date', 
                        'eggplant', 
                        'fig', 
                        'grape', 
                        'hackberry', 
                        'icacina'
                        );          
    $fruitsText=array('a'=>'apple', 
                        'b'=>'banana', 
                        'c'=>'cherry', 
                        'd'=>'date', 
                        'e'=>'eggplant', 
                        'f'=>'fig', 
                        'g'=>'grape', 
                        'h'=>'hackberry', 
                        'i'=>'icacina'
                        );
    //Create the messages to display
    $messages=array('input'=>'Votre mot clé: ', 
                    'fruit'=>'Le nom de fruit correspondant: ',
                    'err'=>"<b>Option sélectionnée ou Mot clé écrit incorrect!</b>",
                    'errNbr'=>'Pour nombre, entrez seulement "1 à 9".',
                    'errTxt'=>'Pour texte, entrez seulement "a à i".'
                    );
    // Check the selection of the user and display the appropriate messages
    if ($_POST['numberOrText']=='number' && $userInput>0 && $userInput<10){
        echo "<p>". $messages['input'] . "<b>$userInput</b>" . "</p>";
        $index=$userInput-1;
        echo "<p>". $messages['fruit'] . "<b>$fruitsNumber[$index]</b>" . "</p>"; 
    } 
    elseif ($_POST['numberOrText']=='text' && preg_match("/[a-i]/",$userInput)) {
        echo "<p>". $messages['input'] . "<b>$userInput</b>" . "</p>";
        echo "<p>". $messages['fruit'] . "<b>$fruitsText[$userInput]</b>" . "</p>"; 
    }
    else{
        echo "<p>". $messages['input'] . "<b>$userInput</b>" . "</p>";
        echo "<p>". $messages['err'] . "</p>";
        echo "<p>". $messages['errNbr'] . "</p>";
        echo "<p>". $messages['errTxt'] . "</p>";
    }
  
echo <<<_END
        <a href="exe6_2fr.php">Essayez encore!</a>
    </body>
  </html>
_END;

    }
?>
