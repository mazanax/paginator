# Paginator
Simple pagination library for your site

### Usage
`<?php
    $pagination = new Pagination(['separator' => '|', 'on_page' => 5]);
    $pagination->getPages(4);
`