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
    new Product('Арбуз', 'Спелый вкусный арбуз', rand(1500,5000), 'https://avatars.mds.yandex.net/get-zen_doc/5257032/pub_60eb14bca83d1f6b7306fa3c_60f03e86584b027c4da2781f/scale_1200'),
    new Product('Апельсин', 'Спелый вкусный апельсин', rand(1500,5000), 'https://funforkids.ru/pictures/orange/orange034.png'),
    new Product('Яблоко', 'Спелое вкусное яблоко', rand(1500,5000), 'https://avatars.mds.yandex.net/i?id=c48ae350238da4cdb758dd1f1b7b0c9d-5889273-images-thumbs&n=13&exp=1'),
];
