<?php

namespace MZ;

use PHPUnit\Framework\TestCase;

class PaginatorTest extends TestCase
{
    /**
     * @covers Paginator::getPages()
     */
    public function testGetPagesWithoutSeparator()
    {
        $paginator1 = new Paginator(['on_page' => 5, 'section_size' => 3]);

        static::assertEquals([1, 2, 3], $paginator1->getPages(1, 9));
        static::assertEquals([1, 2, 3], $paginator1->getPages(2, 9));
        static::assertEquals([1, 2, 3], $paginator1->getPages(3, 9));
        static::assertEquals([1, 2, 3, 4], $paginator1->getPages(3, 16));

        static::assertEquals([1, 2, 3, 4], $paginator1->getPages(1, 16));
        static::assertEquals([1, 2, 3, 4, 20], $paginator1->getPages(3, 100));
        static::assertEquals([1, 18, 19, 20], $paginator1->getPages(19, 100));

        $paginator2 = new Paginator(['on_page' => 5, 'section_size' => 5]);

        static::assertEquals([1, 2, 3, 4, 5, 20], $paginator2->getPages(1, 100));
        static::assertEquals([1, 2, 3, 4, 5, 20], $paginator2->getPages(2, 100));
        static::assertEquals([1, 2, 3, 4, 5, 20], $paginator2->getPages(3, 100));
        static::assertEquals([1, 2, 3, 4, 5, 20], $paginator2->getPages(4, 100));
        static::assertEquals([1, 3, 4, 5, 6, 7, 20], $paginator2->getPages(5, 100));
        static::assertEquals([1, 16, 17, 18, 19, 20], $paginator2->getPages(17, 100));

        $paginator3 = new Paginator(['on_page' => 5, 'section_size' => 4]);

        static::assertEquals([1, 2, 3, 4, 20], $paginator3->getPages(1, 100));
        static::assertEquals([1, 2, 3, 4, 20], $paginator3->getPages(2, 100));
        static::assertEquals([1, 2, 3, 4, 20], $paginator3->getPages(3, 100));
        static::assertEquals([1, 2, 3, 4, 5, 6, 20], $paginator3->getPages(4, 100));
        static::assertEquals([1, 17, 18, 19, 20], $paginator3->getPages(20, 100));
        static::assertEquals([1, 17, 18, 19, 20], $paginator3->getPages(19, 100));
        static::assertEquals([1, 17, 18, 19, 20], $paginator3->getPages(18, 100));
        static::assertEquals([1, 15, 16, 17, 18, 19, 20], $paginator3->getPages(17, 100));
    }

    /**
     * @covers Paginator::getPages()
     */
    public function testGetPagesWithSeparator()
    {
        $separator = '...';
        $paginator1 = new Paginator(['on_page' => 5, 'section_size' => 3, 'separator' => $separator]);

        static::assertEquals([1, 2, 3], $paginator1->getPages(1, 9));
        static::assertEquals([1, 2, 3], $paginator1->getPages(2, 9));
        static::assertEquals([1, 2, 3], $paginator1->getPages(3, 9));
        static::assertEquals([1, 2, 3, 4], $paginator1->getPages(3, 16));

        static::assertEquals([1, 2, 3, $separator, 4], $paginator1->getPages(1, 16));
        static::assertEquals([1, 2, 3, 4, $separator, 20], $paginator1->getPages(3, 100));
        static::assertEquals([1, $separator, 18, 19, 20], $paginator1->getPages(19, 100));

        $paginator2 = new Paginator(['on_page' => 5, 'section_size' => 5, 'separator' => $separator]);

        static::assertEquals([1, 2, 3, 4, 5, $separator, 20], $paginator2->getPages(1, 100));
        static::assertEquals([1, 2, 3, 4, 5, $separator, 20], $paginator2->getPages(2, 100));
        static::assertEquals([1, 2, 3, 4, 5, $separator, 20], $paginator2->getPages(3, 100));
        static::assertEquals([1, 2, 3, 4, 5, $separator, 20], $paginator2->getPages(4, 100));
        static::assertEquals([1, $separator, 3, 4, 5, 6, 7, $separator, 20], $paginator2->getPages(5, 100));
        static::assertEquals([1, $separator, 16, 17, 18, 19, 20], $paginator2->getPages(17, 100));

        $paginator3 = new Paginator(['on_page' => 5, 'section_size' => 4, 'separator' => $separator]);

        static::assertEquals([1, 2, 3, 4, $separator, 20], $paginator3->getPages(1, 100));
        static::assertEquals([1, 2, 3, 4, $separator, 20], $paginator3->getPages(2, 100));
        static::assertEquals([1, 2, 3, 4, $separator, 20], $paginator3->getPages(3, 100));
        static::assertEquals([1, 2, 3, 4, 5, 6, $separator, 20], $paginator3->getPages(4, 100));
        static::assertEquals([1, $separator, 3, 4, 5, 6, 7, $separator, 20], $paginator3->getPages(5, 100));
        static::assertEquals([1, $separator, 17, 18, 19, 20], $paginator3->getPages(20, 100));
        static::assertEquals([1, $separator, 17, 18, 19, 20], $paginator3->getPages(19, 100));
        static::assertEquals([1, $separator, 17, 18, 19, 20], $paginator3->getPages(18, 100));
        static::assertEquals([1, $separator, 15, 16, 17, 18, 19, 20], $paginator3->getPages(17, 100));
        static::assertEquals([1, $separator, 14, 15, 16, 17, 18, $separator, 20], $paginator3->getPages(16, 100));
    }
}
