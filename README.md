# ows/commonmark-sup-sub-extensions

[![Build Status](https://api.travis-ci.org/OWS/commonmark-sup-sub-extensions.svg?branch=2.x)](https://travis-ci.org/OWS/commonmark-sup-sub-extensions)

This library adds support of superscript and subscript (`<sup>` and `<sub>` HTML tags) to [league/commonmark](https://github.com/thephpleague/commonmark).

## Versions compatibility

* 2.x is compatible with league/commonmark 1.x (*recommended version*)
* 1.x is compatible with league/commonmark 0.17.x and 0.18.x and will no longer be supported

## Installation

This project can be installed via [Composer]:

``` bash
$ composer require ows/commonmark-sup-sub-extensions
```

## Usage

```php
use League\CommonMark\Environment;
use Ows\CommonMark\SupExtension;
use Ows\CommonMark\SubExtension;

$environment = Environment::createCommonMarkEnvironment();
$environment->addExtension(new SupExtension());
$environment->addExtension(new SubExtension());
```

See [CommonMark customization](https://github.com/thephpleague/commonmark#advanced-usage--customization).

## Syntax

Code:
```markdown
10^2^
10~2~
```

Result:
```html
10<sup>2</sup>
10<sub>2</sub>
```
