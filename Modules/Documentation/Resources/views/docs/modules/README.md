# ریجستر کردن middleware ها
برای ریجستر کردن middleware ها ابتدا فایل middleware را در پوشه ماژول مورد نظر ساخته و سپس به شکل زیر در فایل serviceProvider ماژول ریجستر میکنیم

```php
public function boot(Router $router)
{
	$this->registerTranslations();
	$this->registerConfig();
	$this->registerViews();
	$this->registerFactories();
	$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
	
	$router->aliasMiddleware('middleware-alias', \Modules\Documentation\Http\Middleware\MiddlewareClass::class);
}
```

# منبع

[nWidart/laravel-modules](https://nwidart.com/laravel-modules/v4/introduction)