# VirtualAGM API for Laravel

<p>
    <a href="https://packagist.org/packages/ince/virtual-agm"><img src="https://img.shields.io/packagist/l/ince/virtual-agm" alt="License"></a>
    <a href="https://packagist.org/packages/ince/virtual-agm"><img src="https://img.shields.io/packagist/v/ince/virtual-agm" alt="Latest Version"></a>
    <a href="https://packagist.org/packages/ince/virtual-agm"><img src="https://img.shields.io/packagist/dt/ince/virtual-agm" alt="Total Downloads"></a>
</p>

## Installation

1. `composer require ince/virtual-agm`
2. `php artisan vendor:publish --provider="Ince\VAGM\VagmApiServiceProvider"`
3. Add the following lines to your `.env` file:

```
VAGM_URL="<vagm_api_url>"
VAGM_DEBUG="<bool>"
```

## Usage

```php
\VirtualAGM::functions();
```

## License

[ince/virtual-agm](https://github.com/ince/virtual-agm) is released under the MIT license. See [LICENSE](https://github.com/ince/virtual-agm/blob/master/LICENSE) for details.
