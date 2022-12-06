<!DOCTYPE html>

<html>

<head>

    <title>Qrcode</title>

</head>

<body>

    <h1>You can sacn qrcode to get more information</h1>
    <br>
    <img src="data:image/svg;base64, {!! base64_encode(QrCode::format('svg')->size(200)
    ->generate($pd)) !!} ">



</body>

</html>