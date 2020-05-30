<!doctype html>
<html lang="en">
<head>
    <title>Web Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" sizes="180x180" href="/Public/Icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/Public/Icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/Public/Icons/favicon-16x16.png">
    <link rel="manifest" href="/Public/Icons/site.webmanifest">

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="/Public/Includes/custom.js"></script>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css"/>
</head>
<body>
<div class="container">
    <?= $content[ "navigation" ] ?>
</div>

<?php if ( $isDebug ) : echo $content[ "debug" ]; endif; ?>
</body>
</html>