# ows/commonmark-sup-sub-extensions

[![Build Status](https://app.travis-ci.com/OWS/commonmark-sup-sub-extensions.svg?branch=3.x)](https://app.travis-ci.com/OWS/commonmark-sup-sub-extensions)

This library adds support of superscript and subscript (`<sup>` and `<sub>` HTML tags) to [league/commonmark](https://github.com/thephpleague/commonmark).

## Versions compatibility

* 3.x is compatible with league/commonmark 2.x (2.10.2+) and requires PHP 8.3+ (*recommended version*)
* 2.x is compatible with league/commonmark 1.x
* 1.x is compatible with league/commonmark 0.17.x and 0.18.x and will no longer be supported

## Installation

This project can be installed via [Composer](https://getcomposer.org/):

``` bash
$ composer require ows/commonmark-sup-sub-extensions
```

## Usage

```php
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Ows\CommonMark\SupSubExtension\SupExtension;
use Ows\CommonMark\SupSubExtension\SubExtension;

$environment = new Environment();
$environment->addExtension(new CommonMarkCoreExtension());
$environment->addExtension(new SupExtension());
$environment->addExtension(new SubExtension());

$converter = new MarkdownConverter($environment);
echo $converter->convert('10^2^ H~2~O');
```

See [league/commonmark extensions documentation](https://commonmark.thephpleague.com/2.x/customization/extensions/).

**Note:** `SubExtension` cannot be used together with the `StrikethroughExtension` (also included in `GithubFlavoredMarkdownExtension`), as both use the `~` delimiter.

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
