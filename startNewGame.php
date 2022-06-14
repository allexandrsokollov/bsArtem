<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
$fileName = __DIR__."/Questions.txt";
$fileData = file($fileName);
$randInt = rand(0, count($fileData) - 1);

$tempArr = explode('Æ', $fileData[$randInt]);
?>

<form id="form" action="task.php" method="post">
    <?php

    echo '<input type="hidden" name="word" value="'.htmlentities($tempArr[0]).'">';
    echo '<input type="hidden" name="question" value="'.htmlentities($tempArr[1]).'">';
    ?>
</form>
<script type="text/javascript">

    document.getElementById('form').submit();
</script>

</body>
</html>

