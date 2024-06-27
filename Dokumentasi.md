# PHP Model Controller View

Untuk membuat PHP MVC, maka buatlah folder terlebih dahulu

struktur filenya sebagai berikut

```
php_mvc
├── app
│   ├── config
│   │   └── config.php
│   ├── controllers
│   ├── core
│   │   ├── App.php
│   │   ├── Controller.php
│   │   └── Database.php
│   ├── models
│   ├── views
│   ├── .htaccess
│   └── init.php
└── public
    ├── assets
    │   ├── css
    │   ├── js
    │   └── img
    ├── index.php
    └── .htaccess
```

buatlah kode di dalam file `index.php` di dalam folder public

```php
<?php

require_once 'init.php';

$app = new App;
```

di dalam file init.php buatlah kode seperti di bawah

```php
<?php

require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'config/config.php';
```

di dalam `core/App.php` tambahkan kodenya seperti ini

```php
<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
    $url = $this->parseUrl();

    // controller
    if (file_exists('../app/controllers/' . $url[0] . '.php')) {
        $this->controller = $url[0];
        unset($url[0]);
    }

    require_once '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    // method
    if (isset($url[1])) {
        if (method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }
    }

    // params
    if (!empty($url[1])) {
        $this->params = array_values($url);
    }

    call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
    if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
    }
    }
}
```

di dalam `core/Controller.php` maka tambahkan kode seperti ini

```php
<?php

class Controller
{
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        require_once '..app/models/'. $model .'.php';
        return new $model;
    }
}
```

lalu buatlah perintah pada `.htaccess` di dalam folder app

```
Options -Indexes
```

buatlah perintah pada `.htaccess` di dalam folder public

```
Options -Multiviews

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php?url=$1 [L]

```

buatlah file Home di dalam folder `app/controllers` dan buatlah kodenya

```php
<?php

class Home extends Controller
{
    public function index($data)
    {   $data['title'] = 'halaman home';
        $this->view('home/index', $data);
    }
}
```

lalu buatlah direktori dan file di dalam folder views di mana setiap halaman memiliki direktori pada folder views, contoh:

views

home

`index.php`

lalu isi kode di dalam `index.php` pada folder home seperti ini

```php
<!Doctype HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

</body>
</html>
```

lalu buatlah kode di `Database.php` di dalam folder core

```php
<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh;
    private $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public function query(query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
```

```php
<?php

class User_model()
{
    private $table = 'nama table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUser()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}
```

lalu buatlah kode di `config.php` di dalam folder config

```php
<?php

define('MAIN_URL', 'http://localhost/php_mvc/public');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', '(nama database)');
```
