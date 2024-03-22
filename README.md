# iamx-wallet-pro

IAMX wallet pro is a Laravel package to login to a laravel application using the IAMX identity wallet and sign, verify,
encrypt and decrypt data using the IAMX identity wallet.

- [IAMX-wallet-pro](#iamx-wallet-pro)
    - [Installation](#Installation)
    - [Configuration](#Configuration)
    - [Usage](#Usage)
    - [Bugs, Suggestions, Contributions and Support](#bugs-and-suggestions)
    - [Copyright and License](#copyright-and-license)

## Installation

Install the current version of the `iamxid/iamx-wallet-pro` package via composer:

```sh
    composer require iamxid/iamx-wallet-pro:dev-main
```

## Configuration

Publish the migration file:

```sh
    php artisan vendor:publish --provider="IAMXID\IamxWalletPro\IamxWalletProServiceProvider" --tag="migrations"
```

Run the migration:

```sh
    php artisan migrate
```

Add the scope to the .env file. Example:

```
IAMX_IDENTITY_SCOPE={"did":"","person":{},"vUID":{},"address":{},"email":{},"mobilephone":{}}
```

Add the redirect URL to the .env file. Example:

```
IAMX_IDENTITY_CONNECT_REDIRECT_URL="/page_to_load_after_login"
```

## Usage

Add the attribute "iamx_vuid" to the $fillable array in /app/Models/User.php

```php
    protected $fillable = [
        'name',
        'email',
        'password',
        'iamx_vuid'
    ];
```

Add the HasDID trait to the user model in /app/Models/User.php

```php
use IAMXID\IamxWalletPro\Traits\HasDID;

class User extends Model
{
    use HasDID;
    ...
}
```

Place the component ```<x-iamxwalletpro-identity-connector />``` in your blade template to insert the wallet connect
snippet.

Place the component ```<x-iamxwalletpro-identity-sign />``` in your blade template to insert the sign data snippet.

Place the component ```<x-iamxwalletpro-identity-verify />``` in your blade template to insert the verify data snippet.

Place the component ```<x-iamxwalletpro-identity-encrypt />``` in your blade template to insert the encrypt data
snippet.

Place the component ```<x-iamxwalletpro-identity-decrypt />``` in your blade template to insert the decrypt data
snippet.

Style the connect button and the container in your css file using the classes ```btn-identity-connect```
and ```container-identity-connect```.

Style the sign data button, the container and the input fields in your css file using the
classes ```btn-identity-signData```,  ```container-identity-signData``` and ```input-label-signData```.

Style the verify data button, the container and the input fields in your css file using the
classes ```btn-identity-verifyData```,  ```container-identity-verifyData``` and ```input-label-verifyData```.

Style the encrypt data button, the container and the input fields in your css file using the
classes ```btn-identity-encryptData```,  ```container-identity-encryptData``` and ```input-label-encryptData```.

Style the decrypt data button, the container and the input fields in your css file using the
classes ```btn-identity-decryptData```,  ```container-identity-decryptData``` and ```input-label-decryptData```.

```
@tailwind base;
@tailwind components;

.container-identity-connect {
    @apply m-5
}

.container-identity-signData {
    @apply m-5 p-2 border-2 border-black
}

.container-identity-verifyData {
    @apply m-5 p-2 border-2 border-black
}

.container-identity-encryptData {
    @apply m-5 p-2 border-2 border-black
}
.container-identity-decryptData {
    @apply m-5 p-2 border-2 border-black
}


.btn-identity-connect {
    @apply bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded
}

.btn-identity-signData {
    @apply bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-1
}

.btn-identity-verifyData {
    @apply bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded mt-1
}

.btn-identity-encryptData {
    @apply bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-1
}

.btn-identity-decryptData {
    @apply bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded mt-1
}

.input-verifyData {
    @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
}

.input-label-verifyData {
    @apply block mb-2 text-sm font-medium text-gray-900 dark:text-white
}

.input-signData {
    @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
}

.input-label-signData {
    @apply block mb-2 text-sm font-medium text-gray-900 dark:text-white
}

.input-encryptData {
    @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
}

.input-label-encryptData {
    @apply block mb-2 text-sm font-medium text-gray-900 dark:text-white
}

.input-decryptData {
    @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
}

.input-label-decryptData {
    @apply block mb-2 text-sm font-medium text-gray-900 dark:text-white
}

@tailwind utilities;
```

## Examples

Use the functions in the HasDID trait in your application to access the IAMX wallet attributes:

Fetch single attributes:

```php
$user = User::find(1);
$street = $user->getDIDAttribute('address', 'street', $user->id);
$housenr = $user->getDIDAttribute('address', 'housenr', $user->id);
$zip = $user->getDIDAttribute('address', 'zip', $user->id);
```

Fetch all attributes of a category:

```php
$user = User::find(1);
$allCategoryValues = $user->getDIDCategoryValues('address', $user->id);
```

Fetch all available attributes:

```php
$user = User::find(1);
$allValues = $user->getAllDIDValues($user->id);
```

## Bugs and Suggestions

## Copyright and License

[MIT](https://choosealicense.com/licenses/mit/)
