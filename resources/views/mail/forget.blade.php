<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Password Reset</title>
</head>
<body>
    <p>Change your password: <a href="http://localhost:8000/reset/{{ $token }}">Click here</a></p>
    <p>Pincode: {{ $token }}</p>
</body>
</html>
