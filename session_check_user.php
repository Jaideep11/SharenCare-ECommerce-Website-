<?php
$Doner=0;
$Borrower=0;
if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION["email"]))
{
    if($_SESSION["Doner"]) 
    {
        $Doner=1;

    }
    else if( $_SESSION["Borrower"])
    {
        $Borrower=1;
    }
}
?>