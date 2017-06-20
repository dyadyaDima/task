<?php

    require_once './ext/BracketsTester.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['expression'])) //with empty() we can check both rules: isset() && empty()
    {
        $expression = $_POST['expression'];
        $object = new \ext\BracketsTester($_POST['expression']);

        if ($object->runTest())
        {
            $massage = 'Выражение "%s" - верное';
        }
        else {
            $massage = 'Выражение "%s" -  не верное';
        }
    }
    else {
        $expression = '';
        $massage = '';
    }

?>

<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Тестовое задание</h1>
<hr>
<h2>Задание 1</h2>
<?php if ($massage) : ?>
    <h3><?= sprintf($massage, $expression); ?></h3>
<?php endif; ?>

<form action="/" method="post">
    <label>
        Введите арифметическое выражение
        <input type="text" name="expression" value="<?= $expression; ?>">
    </label>
    <input type="submit" value="Проверить">
</form>

<br><hr><br>

<h2>Задание 2</h2>
<code>SELECT `id`, COUNT( `id` ) AS repeat FROM  `tablename` GROUP BY `id` HAVING repeat > 1</code>
</body>
</html>