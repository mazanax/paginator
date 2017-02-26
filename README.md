[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg?style=flat-square)](https://php.net/)
[![Latest Stable Version](https://poser.pugx.org/mazanax/paginator/v/stable)](https://packagist.org/packages/mazanax/paginator)
[![Build Status](https://travis-ci.org/mazanax/paginator.svg?branch=master)](https://travis-ci.org/mazanax/paginator)
[![codecov](https://codecov.io/gh/mazanax/paginator/branch/master/graph/badge.svg)](https://codecov.io/gh/mazanax/paginator)

# Paginator
Simple pagination library for your site

### Installation
`composer require mazanax/paginator`

### Usage
```php
<?php
    $pagination = new Pagination(['separator' => '|', 'on_page' => 5, 'section_size' => 5]);
    $pagination->getPages(4, 100); // will returns [1, 2, 3, 4, 5, '|', 20]
```
