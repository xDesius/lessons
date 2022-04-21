<?php
    class User{
        public $name;
        public $surname;
        private $age;
        private $phone;
        private $email;
        private $password;

        public function __construct($name,$surname)
        {
            $this->name = $name;
            $this->surname = $surname;
            
        }
        
        public function setAge($age)
        {
            if($this->isAgeCorrect($age)){
                $this->age = $age;
            }
        }

        private function isAgeCorrect($age)
        {
            return $age>= 18 and $age <=60;
        }
        
        public function getAge()
        {
            return $this->age;
        }
    }


    class Admin extends User{
        
        private $id = '';
        private $permission;

        public function getPermission()
        {   
            return $this->permissions;
        }

        public function __construct($id, $permissions, $name, $surname = NULL)
        {   
            $this->id = $id;
            $this->permission = $permissions;
            parent::__construct($name,$surname);
        }

        public function __get($prop)
        {
            if ($this->permission == true){
                return 'Доступ разрёшен ' . $prop . ': ' . $this->$prop;
            } else{
                return 'Недостачно прав';
            }
        }

        public function __isset($prop)
        {
            return isset($this->$prop);
        }
        public function __unset($prop)
        {
            unset($this->$prop);
        }

        public function __toString()
        {
            return 'Это объект придурок';
        }

    }


    $item = new User('Дионис', 'Гюнтер');
    $item->setAge(24);
    $item2 = new Admin(5, '' , 'Dionis', '');
    echo $item2->permission;
    $user2 = new User('Dionis', 'Admin');
    $user2->setAge(25);
    echo '<br>' . false;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <div class="card">
        <div class="name">
            <div class="property">
                Имя: <?=$user2->name;?>
            </div>
        </div>
        <div class="surname">
            <div class="property">
                Фамилия: <?=$user2->surname;?>
            </div>
        </div>
        <div class="age">
            <div class="property">
                Возраст: <?=$user2->getAge();?>
            </div>
        </div>
    </div>    

</body>
</html>