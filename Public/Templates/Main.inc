<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" sizes="180x180" href="/Public/Icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/Public/Icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/Public/Icons/favicon-16x16.png">
    <link rel="manifest" href="/Public/Icons/site.webmanifest">

    <script src="/Public/Includes/Lib/jquery-3.4.1.min.js"></script>
    <script src="/Public/Includes/Lib/bootstrap.bundle.js"></script>
    <script src="/Public/Includes/custom.js"></script>
    <link rel="stylesheet" href="/Public/Includes/Lib/bootstrap.min.css"/>
    <link rel="stylesheet" href="/Public/Includes/Lib/fontawesome-free-5.13.0-web/css/all.min.css"/>
</head>
<body>
<div class="container">
    <?= $body[ "navigation" ] ?>
</div>

<?php if ( $isDebug ) : echo $body[ "debug" ]; endif; ?>
</body>
</html>