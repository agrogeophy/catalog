<?php 

// echo 'email';
// echo '<br>';
// echo 'file count=', count($_FILES),"\n";
// var_dump($_FILES);
// echo '<br>';

require("PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->Host = "smtp.unipd.it";
$mail->Port = "25";
$mail->SMTPAuth = false;
$mail->From = "benjamin.mary@unipd.it";
$mail->FromName = "benjamin.mary@unipd.it";    
$mail->AddAddress( "benjamin.mary@unipd.it","Admin catalog");
$mail->Subject = "Notification new contribution - User: ".$_POST["name"] . "','" . $_POST["surname"] . "','" . $_POST["organisation"];

$email_message = "New contribution to add into the db from:\n\n"; 
$email_message .= "User: ".$_POST["name"] . "','" . $_POST["surname"] . "','" . $_POST["organisation"]."\n\n";
//Encode the array into a JSON string.

$arr = $_POST;

// echo var_dump($_FILES);
echo "<br>";

$arr['icon_img']= $_FILES['keyFigure']['name'];
// echo var_dump($arr);

$arr['notebook_file']= $_FILES['notebook_file']['name'];
// echo var_dump($arr);


$encodedString = json_encode($arr);
// echo $encodedString;
date_default_timezone_set('France/Paris');
$date = date('Y-m-d H:i:s');

$jsonname= 'json_array_'. $_POST["name"] . "_" . $_POST["surname"] . "_" . $date.'.txt';
//Save the JSON string to a text file.
file_put_contents($jsonname, $encodedString);
$mail->addStringAttachment($encodedString, $jsonname); 


function AddAttachment($path,
                              $name = '',
                              $encoding = 'base64',
                              $type = 'application/octet-stream')
{
}

if (isset($_FILES['keyFigure']) &&
    $_FILES['keyFigure']['error'] == UPLOAD_ERR_OK) {
    $mail->AddAttachment($_FILES['keyFigure']['tmp_name'],
                         $_FILES['keyFigure']['name']);
}

// echo isset($_FILES['notebook_file'];
// echo $_FILES['notebook_file']['error'] == UPLOAD_ERR_OK;

if (isset($_FILES['notebook_file']) &&
    $_FILES['notebook_file']['error'] == UPLOAD_ERR_OK) {
    $mail->AddAttachment($_FILES['notebook_file']['tmp_name'],
                         $_FILES['notebook_file']['name']);
}


// https://thisinterestsme.com/saving-php-array-text-file/
$email_message .= $encodedString;


$mail->Body = $email_message;
$mail->WordWrap = 120;
if(!$mail->Send()) 
{
        echo 'Message was not sent.';
        echo 'Mailer error: ' .$mail->ErrorInfo;
        exit;
}
else 
{
        echo '<div> E-mail sent to Agrogeophysical Catalog Admin, we will get back to you very soon! Thanks for your contribution <div>';
}         
        
?>