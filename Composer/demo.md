- 1、新建composer.json
```
{
	"require": {
	   "mhlavac/gearman": "0.1.0"
	}
}
```

- 2、composer update


- 3、新建client.php
```php
<?php

require_once __DIR__.'/vendor/autoload.php';

$client = new \MHlavac\Gearman\Client();
$client->addServer();

$str = 'java is best';
echo $str.PHP_EOL;
echo $client->doNormal("replace_str", $str);
echo PHP_EOL;
?>
```

- 4、新建worker.php
```php
<?php

require_once __DIR__.'/vendor/autoload.php';

$function = function($payload) {
    return '123';
    //return str_replace('java', 'php', $payload);
};

$worker = new \MHlavac\Gearman\Worker();
$worker->addServer();
$worker->addFunction('replace_str', $function);

while($worker->work());
?>
```

- 5、执行
```
php71 client.php & php71 worker.php
```
