Soundcloud.com API Extension for Yii 2
======================================

This extension provides a `Soundcloud` API solution for Yii 2.

To use this extension,  simply add the following code in your application configuration:

```php
return [
    //....
    'components' => [
        //...
        'soundcloud' => [
            'class' => 'Njasm\Soundcloud\yii2\Soundcloud',
            'clientId' => 'YOUR_SOUNDCLOUD_CLIENT_ID',
            'clientSecret' => 'YOUR_SOUNDCLOUD_CLIENT_SECRET',
            'callbackUrl' => 'YOUR_URL_CALLBACK'
        ],
    ],
];
```

You can then access Soundcloud component as follows:

```php
echo Yii::$app->soundcloud->getAuthUrl();
```

For further instructions refer to the related [Soundcloud Library](https://github.com/njasm/soundcloud/).


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist njasm/yii2-soundcloud "*"
```

or add

```json
"njasm/yii2-soundcloud": "*"
```

to the require section of your composer.json.
