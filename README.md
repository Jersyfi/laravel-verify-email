# E-Mail Verification for Laravel

![Packagist Downloads](https://img.shields.io/packagist/dt/jersyfi/laravel-verify-email)
![Packagist Version](https://img.shields.io/packagist/v/jersyfi/laravel-verify-email)
![GitHub License](https://img.shields.io/github/license/jersyfi/laravel-verify-email)

Simple designed email verification based on the laravel email verification features. Verify Email publishes the scaffolding to your laravel application that can be easily customized based on your own application's needs. The easiest way is to use [laravel breeze](https://github.com/laravel/breeze) because it is designed the same way.

It is suggested to use [laravel breeze](https://github.com/laravel/breeze) but you don't need to. When you are not using the suggested package please get familiar with [laravel email verification](https://laravel.com/docs/8.x/verification) before starting here.

## Installation

It is also easy to install this package.

```bash
composer require jersyfi/laravel-verify-email

php artisan verify-email:install
```

## Prepare your application

The user model needs to use the trait `MustVerifyNewEmail`. Also it is necessary to override the default function `sendEmailVerificationNotification`.

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Traits\Auth\MustVerifyNewEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, MustVerifyNewEmail;
    
    public function sendEmailVerificationNotification()
    {
        $this->newEmail($this->getEmailForVerification());
    }
}
```

In the routes you need to add the following example. You are free to customize your route name but keep in mind to update it in your config or in your auth trait `MustVerifyNewEmail`. The redirect route after verification can be changed in config or in the controller `VerifyNewEmailController`.

```php
use App\Http\Controllers\Auth\VerifyNewEmailController;

Route::get('/verify-email/{id}/{hash}', [VerifyNewEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');
```

At least you need to migrate the `%_create_pending_user_emails.php` migration.

```bash
php artisan migrate
```

## Usage

```php
$request->user()->syncEmail($request->input('email'));
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Credits

- [Jérôme Bastian Winkel](https://github.com/jersyfi)
- [All Contributors](../../contributors)

This package was inspired by the [Laravel Verify New Email](https://github.com/protonemedia/laravel-verify-new-email) package by [Protone Media](https://github.com/protonemedia).

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
