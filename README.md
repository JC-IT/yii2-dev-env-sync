# Yii2 Environment sync

[![codecov](https://codecov.io/gh/jc-it/yii2-env-sync/branch/master/graph/badge.svg)](https://codecov.io/gh/jc-it/yii2-env-sync)
[![Continous integration](https://github.com/jc-it/yii2-env-sync/actions/workflows/ci.yaml/badge.svg)](https://github.com/jc-it/yii2-env-sync/actions/workflows/ci.yaml)
![Packagist Total Downloads](https://img.shields.io/packagist/dt/jc-it/yii2-env-sync)
![Packagist Monthly Downloads](https://img.shields.io/packagist/dm/jc-it/yii2-env-sync)
![GitHub tag (latest by date)](https://img.shields.io/github/v/tag/jc-it/yii2-env-sync)
![Packagist Version](https://img.shields.io/packagist/v/jc-it/yii2-env-sync)

This extension provides a package that implements a module to sync environments between devices via an external storage.

```bash
$ composer require jc-it/yii2-env-sync
```

or add

```
"jc-it/yii2-env-sync": "^<latest version>"
```

to the `require` section of your `composer.json` file.

## Configuration
To configure the module, add the module to your config file (preferably only in the Dev configuration).
```php
    'bootstrap' => ['dev-sync'],
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            ...
        ],       
        'externalStorageComponent' => function () {
            // Return a filesystem
            return new Filesystem(...);
        },
        'storageComponent1' => function () {
            // Return a filesystem
            return new Filesystem(...);
        },
    ],
    'modules' => [
        'env-sync' => [
            'class' => EnvSync::class,
            'branch' => null,
            'canSync' => YII_ENV_DEV,
            'syncFilesystem' => 'externalStorageComponent',
            'dbList' => [
                // Map of name to component or configuration
                'db' => 'db',
            ],
            'fileSystems' => [
                '/storage1' => 'storageComponent1',
                '/storage2' => new Filesystem(new LocalFilesystemAdapter(...)),
            ],
            'user' => 'dev-user',
        ]
    ]
```

## TODO
- Fix PHPStan, re-add to `captainhook.json`
    - ```      
      {
          "action": "vendor/bin/phpstan",
          "options": [],
          "conditions": []
      },
      ```
- Add tests

## Credits
- [Joey Claessen](https://github.com/joester89)

## License

The MIT License (MIT). Please see [LICENSE](https://github.com/jc-it/yii2-env-sync/blob/master/LICENSE) for more information.
