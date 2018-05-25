<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>My Thumbor server</title>
</head>
<?php
include("thumbor_json_connector.php");
?>
<body>
<h1>Thumbor Json Connector</h1>
<img src='<?php thumb_url("conf1","http://image-url.jpg") ?>' alt=""/>
</body>
</body>
</html>
