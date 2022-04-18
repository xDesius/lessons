<?php
class Product{
    public $name;
    public $description;
    public $price;
    public $img;

    public function __construct($name,$description,$price,$img){
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->img = $img;
    }
}

$products = [
    new Product('Арбуз', 'Спелый вкусный арбуз', rand(1500,5000), 'https://avatars.mds.yandex.net/i?id=a9023b8ddfab04ab61f966c7ba600c82-5233588-images-thumbs&n=13&exp=1'),
    new Product('Апельсин', 'Спелый вкусный апельсин', rand(1500,5000), 'https://funforkids.ru/pictures/orange/orange034.png'),
    new Product('Яблоко', 'Спелое вкусное яблоко', rand(1500,5000), 'https://avatars.mds.yandex.net/i?id=c48ae350238da4cdb758dd1f1b7b0c9d-5889273-images-thumbs&n=13&exp=1'),
    new Product('Дыня', 'Спелая вкусная дыня', rand(1500,5000), 'https://avatars.mds.yandex.net/i?id=068533851d3d836b282d20a83839f1ca-5875996-images-thumbs&n=13&exp=1')
];
