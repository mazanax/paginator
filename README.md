# Paginator
Simple pagination library for your site

### Usage
```php
<?php
    $pagination = new Pagination(['separator' => '|', 'on_page' => 5, 'section_size' => 5]);
    $pagination->getPages(4, 100); // will returns [1, 2, 3, 4, 5, '|', 20]
```