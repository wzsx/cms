<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <div id="qrcode"></div>
    <script type="text/javascript" src="/js/qrcode/qrcode.min.js"></script>
</head>
<body>

</body>
</html>
<script>
    var qrcode = new QRCode("test", {
        text: "{{$url}}",
        width: 256,
        height: 256,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
</script>
