# انواع هوک

* اکشن (Action)
* فیلتر (Filter)


# اکشن ها

```php

Eventy::action('my.hook', 'awesome');

Eventy::addAction('my.hook', function($what) {
    echo 'You are '. $what;
}, 20, 1);

```

# فیلتر ها

```php

$value = Eventy::filter('my.hook', 'awesome');

Eventy::addFilter('my.hook', function($what) {
    $what = 'not '. $what;
    return $what;
}, 20, 1);;

```

# منبع

[tormjens/eventy](https://github.com/tormjens/eventy)