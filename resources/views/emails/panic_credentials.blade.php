<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        Dear <strong>{{ $name }}</strong>,<br /><br />
        Your enrolment has been activated. Please click the following link to download the app.<br /><br />
        <a href="{{ $app_link }}">Download App</a><br /><br />
        Your credentials are:<br /><br />
        Username: {{ $username }}<br />
        Password: {{ $password }}<br /><br />
        Please <a href="https://averthalogen.com/contact-us/">contact us</a> if you require any support.<br /><br />
        Thank you for choosing Halogen.<br /><br />
        Regards,<br /><br />
        <strong>Halogen Group</strong><br />
    </body>
</html>
