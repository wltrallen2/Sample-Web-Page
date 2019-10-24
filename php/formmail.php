<?php

$firstname = $lastname = $email = $tel = $description = "";

function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$firstname = clean_input($_POST['firstname']);
$lastname = clean_input($_POST['lastname']);
$email = clean_input($_POST['email']);
$tel = clean_input($_POST['phone']);
$description = clean_input($_POST['description']);

$email_to = 'walter@syaaonline.com';
$email_from = $email;
$email_subject = "SOTB Application";
$email_message = 'Name: '. $firstname . ' ' . $lastname . "\n"
  . "Email: " . $email . "\n"
  . "Phone: " . $tel . "\n"
  . "Description: " . $description;


$headers = "From: ".$email_from."\r\n".
'Reply-To: '.$email_from."\r\n".
'X-Mailer: PHP/' . phpversion();

mail($email_to, $email_subject, $email_message, $headers);

include 'wasql.php';
$wasql = new WASQL('syaa');

$a_col_names = ['firstname', 'lastname', 'email', 'telephone', 'description'];
$a_col_values = [$firstname, $lastname, $email, $tel, $description];
$a_value_types = ['s', 's', 's', 's', 's'];

$id = $wasql->addRecordToTable('talentshow', $a_col_names, $a_col_values, $a_value_types);

?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Stars on the Bayou</title>
    <link rel="stylesheet" type="text/css" href="https://use.typekit.net/npo8lja.css" />
    <link rel="stylesheet" type="text/css" href="/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/css/talentresponse.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
    <div class="white-box">
      <h3 class="no-padding">QuesTECH Learning and The Radio People<br />
        in conjunction with Strauss Youth Academy for the Arts present</h3>
      <h1 class="no-padding">Stars on the Bayou</h1>
      <h2 class="no-padding">a regional talent show competition</h2>
    </div>

    <div class="white-box">

<?php
if($id) {
  ?>
      <p><span style='font-family: "custard"; font-size: 36px;'>Success!</span> Thank you for your submission. The following information was received:</p>
      <ul>
        <li>Name: <?php echo $firstname . " " . $lastname;?></li>
        <li>Email: <?php echo $email;?></li>
        <li>Phone: <?php echo $tel;?></li>
        <li>Description of Act: <?php echo $description;?></li>
      </ul>
      <p>Please do not forget to send a video of your act to <a href='mailto:walter@syaaonline.com?subject=SOTB Application Video'>walter@syaaonline.com</a> no later than October 1! If we do not receive a video of your act, we will not be able to consider you for a spot in the competition.</p>
      <p>Dont forget... To purchase tickets to the event, please contact QuesTECH Learning at <a href="tel:+13183226000">322-6000</a>. Tickets for adults will be $25 each, and tickets for ages 6-17 will be $10 each.</p>
      <p>If you have any questions or need further assistance, please feel free to contact us at <a href="mailto:walter@syaaonline.com?subject=Starts on the Bayou">walter@syaaonline.com</a> or by phone at <a href="tel:+13188127922">(318) 812-7922</a>. We are excited to potentially have you compete, and we can't wait to see your video!</p>
    </div>
<?php
} else {
 ?>
  <p>We're sorry. There has been an error with your application. Please try again
    by <a href="/talentshowapplication">clicking here</a> or call Walter at
    <a href="tel:+13188127922">(318) 812-7922</a>.</p>
<?php
}
 ?>
  </body>
</html>
