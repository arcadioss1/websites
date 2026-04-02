<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {

    // Twój sekret reCAPTCHA
    $recaptcha_secret = "kodrecaptcha";

    // Odbierz token z formularza
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Sprawdzenie odpowiedzi z Google
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
    $captcha_success = json_decode($verify);

    if ($captcha_success->success) {
        // Adres docelowy
        $to = "kontakt@hurtowniarochu.pl";

        // Pobieranie danych z formularza
        $name    = htmlspecialchars(trim($_POST['name']));
        $email   = htmlspecialchars(trim($_POST['email']));
        $subject = htmlspecialchars(trim($_POST['subject']));
        $number  = htmlspecialchars(trim($_POST['number']));
        $message = htmlspecialchars(trim($_POST['text']));

        // Budowa tematu i treści wiadomości
        $mail_subject = "📩 Nowa wiadomość z formularza: " . $subject;
        $mail_message  = "Imię: " . $name . "\n";
        $mail_message .= "Email: " . $email . "\n";
        $mail_message .= "Telefon: " . $number . "\n\n";
        $mail_message .= "Wiadomość:\n" . $message;

        // Nagłówki wiadomości
        $headers  = "From: " . $name . " <" . $email . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Wysyłka maila
        if (mail($to, $mail_subject, $mail_message, $headers)) {
            echo "<h3>Dziękujemy! Twoja wiadomość została wysłana.</h3>";
        } else {
            echo "<h3>❌ Wystąpił błąd podczas wysyłania wiadomości. Spróbuj ponownie.</h3>";
        }
    } else {
        echo "<h3>❌ Weryfikacja reCAPTCHA nie powiodła się. Spróbuj ponownie.</h3>";
    }
} else {
    echo "<h3>Nieprawidłowe wywołanie formularza.</h3>";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
      <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17543787499">
        </script>
        <script>
            window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'AW-17543787499');
        </script>
           <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MXJR7J9R');</script>
<!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <title>Wiadomość z formularza</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
      
    </style>
</head>
<body>
   <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MXJR7J9R"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) --
    <h2>Dziękujemy za wypełnienie formularza</h2>
    <h3>Treść twojej wiadomości:</h3>
    <?php echo $message; ?>
        <p><a href="/strona-glowna">Wróć na stronę główną</a></p>

    <p><a href="/strona-glowna"><img src="../assets/img/logopoprawione.gif"></a></p>
    <
</body>
</html>
