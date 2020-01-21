<?php


function send_mail($to, $subject, $body) {
  $foname = "Maestro";
  $foemail = "revaztomc@gmail.com";
  $header = "From: noreply $foname <$foemail>\n";

  $header .= "Reply-To: $foname <$foemail>\r\n";
  $header .= "Return-Path: $foname <$foemail>\r\n";

  $header .= "Organization: Digital-eds\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  $header .= "X-Priority: 3\r\n";
  $header .= "X-Mailer: PHP". phpversion() ."\r\n";

  if(!mail($to, $subject, $body, $header))
    http_response_code(500);
}

?>
