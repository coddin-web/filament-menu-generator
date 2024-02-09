A NavigationMenu generator for (Laravel) Filament
==================================================
Because of how Filament wants you to build a menu, by setting sortOrders per Resource, you have to (eventually) keep an extensive mind map of how your NavigationMenu is structured.

Because this is quite strenuous, we've created a package that will generate a NavigationMenu for you based on an array that holds all your Resources and/or Pages to create a simple 1-look view of your menu.

Installation
============
Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 1: Require the module
Open a command console, enter your project directory and execute:

```console
$ composer require coddin-web/filament-menu-generator
```

### Step 2: using the module
The abstract class `Navigation` should be extended by a class per Panel that you would like to supervise that Panel's NavigationMenu.

e.g.

```php
use CoddinWeb\FilamentMenuGenerator\Navigation;

final class AdminNavigation extends Navigation
{
    #[\Override]
    public static function getMenu(): array
    {
        return [
            CustomerResource::class => [
                'group' => 'Management'
            ],
            InvoiceResource::class => [
                'group' => 'Management'
            ],
            
            UserResource::class => [
                'group' => 'Administration'
            ],
        ];
    }
}
```

And then within your specific Panel, you can call the `AdminNavigation` class to generate the menu.

```php
// ... \App\Filament\Admin\Resources\CustomerResource.php

public static function getNavigationGroup(): string
{
    return AdminNavigation::group(self::class);
}

public static function getNavigationSort(): int
{
    return AdminNavigation::sort(self::class);
}
```
