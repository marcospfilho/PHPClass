<?php
/**
*process-homepage.php
*EXERCISE 4 NUMBER 4
*FORM HANDLING
*Patrick Saint-Louis, 2023
*/

//If the form is submitted
if (isset($_POST['send'])) {
   
    //Assign to PHP variables data collected from the form   
    $itemName = $_POST["article_name"]; 
    $itemUnitPrice = $_POST["unit_price"]; 
    $itemQuantity = $_POST["article_quantity"]; 
    
    //Convert variables to float and int if they are not empty
    if ($itemUnitPrice != '')
        $itemUnitPrice=floatval($itemUnitPrice);
    if ($itemQuantity != '')
        $itemQuantity=intval($itemQuantity);

    //Constant declaration and assignment
    define("TPSRATE",0.05);
    define("TVQRATE",0.09975);

    //Create a session to be able to save data to share data in $_SESSION
    session_start();
    $_SESSION['article']=$itemName;
    $_SESSION['price']=$itemUnitPrice;
    $_SESSION['quantity']=$itemQuantity;
    $_SESSION['err_article']='';
    $_SESSION['err_price']='';
    $_SESSION['err_quantity']='';

    //Assign the error messages related to the input fields
    $emptyMsg="Cannot be empty.";
    $numberNameMsg="Must start with a letter a-z or A-Z.";
    $negativePriceMsg="Must be greater than or equal to 0.";
    $negativeQuantityMsg="Must be greater than 0.";
    
    //Validation
    //If at least 1 of the information collected via the form is incorrect 
    //Save them and redirect to the home page with error messages
    if ($itemName==='' || $itemUnitPrice==='' || $itemQuantity==='' || 
    preg_match("/[^a-zA-Z]/", $itemName[0]) || $itemUnitPrice<0 || $itemQuantity<0 || $itemQuantity===0) {
        //If name does not start with a letter
        if (preg_match("/[^a-zA-Z]/", $itemName[0]))
            $_SESSION['err_article']=$numberNameMsg;
        //If unit price is not positive and not a float 
        if ($itemUnitPrice<0)
            $_SESSION['err_price']=$negativePriceMsg;
        //If quantity is not greater than 0 and noty an int
        if ($itemQuantity<0 || $itemQuantity===0)
            $_SESSION['err_quantity']=$negativeQuantityMsg; 
        //If name is empty 
        if ($itemName==='') 
            $_SESSION['err_article']=$emptyMsg;
        //If unit price is empty
        if ($itemUnitPrice==='') 
            $_SESSION['err_price']=$emptyMsg;
        //If quantity is empty
        if ($itemQuantity==='')
            $_SESSION['err_quantity']=$emptyMsg; 
        
        //Redirect to the home page with the corresponding error messages
        header('Location: index.php');
    }
    //If the information collected via the form is correct 
    //Redirect to the result page with the corresponding information collected and calculated
    else {
        //Calculations
        $subtotal= $itemQuantity * $itemUnitPrice;
        $tps= $subtotal * TPSRATE;
        $tvq= $subtotal * TVQRATE;
        $total= $subtotal + $tps + $tvq;

        //Keep only 2 digits as decimal values
        $itemUnitPrice=number_format($itemUnitPrice, 2, '.', '');
        $subtotal=number_format($subtotal, 2, '.', ''); 
        $tps=number_format($tps, 2, '.', ''); 
        $tvq=number_format($tvq, 2, '.', ''); 
        $total=number_format($total, 2, '.', ''); 

        //Save data to share data in $_SESSION
        $_SESSION['subtotal']=$subtotal;
        $_SESSION['tps']=$tps;
        $_SESSION['tvq']=$tvq;
        $_SESSION['total']=$total;

        //Redirect to the result page
        header('Location: results.php'); 
    }  
  
}
//If you try to access this file when the form is not submitted yet
//Redirect to the Home Page
else{
    //Redirect to the result page
    header('Location: index.php'); 
}
?>

