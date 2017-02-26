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
