<?php
    require_once('product.php');
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    echo '<div class="products">';
?>
<?php
    foreach ($products as $item){
        ?>
        <div class="product">
            <div class="img">
                <img src="<?=$item->img?>" alt="<?=$item->name?>">
            </div>
            <div class="product__info">
                <h1>
                    <?=$item->name?>
                </h1>
                <p>
                    <?=$item->description?>
                </p>
                <p>
                    <?=$item->price?> рублей
                </p>
            </div>
        </div>
        <?php

    }
?>

</body>
</html>
<?php
    