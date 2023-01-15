<!DOCTYPE html>

<html>

<head>

    <title>Qrcode</title>

</head>

<body>

    <h1>You can scan QR code to get more information about {{$pd->getTranslations('title', ['en'])}} </h1>
    <br>
    <br>
    <br>
    <img src="data:image/svg;base64, {!! base64_encode(QrCode::format('svg')->size(700)
    ->generate($pd->QRCode)) !!} ">



</body>

</html>
