<!DOCTYPE html>
<html>

<head>
    <title>Laravel</title>
</head>

<body>

    <center>
        <h2 style="padding: 23px;border: 6px red solid;">
            <a href="{{ url('http://127.0.0.1:8000/email/verify/'.$userId) }}">Click on the Link to Verify</a>

        </h2>
    </center>

    <p>Hi,</p>
    <p>This is test mail. This mail send using queue listen in laravel 8.</p>
    <strong>Thanks & Regards.</strong>

</body>

</html>
