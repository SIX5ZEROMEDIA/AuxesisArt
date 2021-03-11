<?php 

// define variables and set to empty values
$first_name_error = $last_name_error =$email_error = $phone_error = "";
$first_name = $last_name =  $email = $phone = $message = $success = "";

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["first_name"])) {
      $first_name_error = "Name is required";
    } else {
      $first_name = test_input($_POST["first_name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
        $first_name_error = "Only letters and white space allowed"; 
      }
    }
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["last_name"])) {
      $last_name_error = "Name is required";
    } else {
      $last_name = test_input($_POST["last_name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
        $last_name_error = "Only letters and white space allowed"; 
      }
    }
}
  
    if (empty($_POST["email"])) {
      $email_error = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format"; 
      }
    }
    
    if (empty($_POST["phone"])) {
      $phone_error = "Phone is required";
    } else {
      $phone = test_input($_POST["phone"]);
      // check if e-mail address is well-formed
      if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone)) {
        $phone_error = "Invalid phone number"; 
      }
    }
  
    // if (empty($_POST["url"])) {
    //   $url_error = "";
    // } else {
    //   $url = test_input($_POST["url"]);
    //   // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    //   if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
    //     $url_error = "Invalid URL"; 
    //   }
    // }
  
    if (empty($_POST["message"])) {
      $message = "";
    } else {
      $message = test_input($_POST["message"]);
    }
    
    if ($first_name_error == '' and $last_name_error == '' and  $email_error == '' and $phone_error == ''  ){
        $message_body = '';
        unset($_POST['submit']);
        foreach ($_POST as $key => $value){
            $message_body .=  "$key: $value\n";
        }
        
        $to = 'alambrecht115@gmail.com';
        $subject = 'Email From AuxesisArt.com';
        if (mail($to, $subject, $message_body)){
            // $success = "Message sent, thank you for contacting us!";
            // header( 'Location: http://www.facebook.com' ) ; 
            header( 'Location: http://localhost/WebForm/thankyou.html' ) ; 
            $first_name = $last_name = $email = $phone = $message =  '';
        }
    }
    
  }
  
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }