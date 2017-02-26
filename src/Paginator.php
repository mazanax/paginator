<?php

namespace MZ;

class Paginator
{
    const DEFAULT_ON_PAGE = 20;
    const DEFAULT_SEPARATOR = null;
    const DEFAULT_SECTION_SIZE = 5;

    const OPTION_ON_PAGE = 'on_page';
    const OPTION_SEPARATOR = 'separator';
    const OPTION_SECTION_SIZE = 'section_size';

    private $onPage = self::DEFAULT_ON_PAGE;
    private $separator = self::DEFAULT_SEPARATOR;
    private $sectionSize = self::DEFAULT_SECTION_SIZE;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (array_key_exists(static::OPTION_ON_PAGE, $options)) {
            $this->onPage = (int)$options[static::OPTION_ON_PAGE];
        }
        if (array_key_exists(static::OPTION_SEPARATOR, $options)) {
            $this->separator = $options[static::OPTION_SEPARATOR];
        }
        if (array_key_exists(static::OPTION_SECTION_SIZE, $options)) {
            $this->sectionSize = $options[static::OPTION_SECTION_SIZE];
        }
    }

    /**
     * @param int $currentPage
     * @param int $itemsCount
     *
     * @return array
     */
    public function getPages(int $currentPage, int $itemsCount): array
    {
        $firstPage = 1;
        $lastPage = (int)ceil($itemsCount / $this->onPage);
        $limit = $this->sectionSize - 1;
        $partSize = (int)floor($this->sectionSize / 2);

        $separator = $this->separator && $lastPage > $this->sectionSize ? [$this->separator] : [];
        $firstSection = [$firstPage];
        $lastSection = [$lastPage];

        if ($currentPage >= $firstPage + $limit && $currentPage <= $lastPage - $limit) {
            $commonSection = range($currentPage - $partSize, $currentPage + $partSize);
        } elseif ($currentPage <= $firstPage + $limit) {
            $commonSection = range($firstPage, $firstPage + $limit);
        } else {
            $commonSection = range($lastPage - $limit, $lastPage);
        }

        $firstSection = array_diff($firstSection, $commonSection);
        $lastSection = array_diff($lastSection, $commonSection);

        $firstSeparator = !empty($firstSection) ? $separator : [];
        $lastSeparator = !empty($lastSection) ? $separator : [];
        if ($currentPage - $partSize - 1 <= $firstPage) {
            $firstSeparator = [];
        }
        if ($currentPage + $partSize + 1 >= $lastPage) {
            $lastSeparator = [];
        }

        return array_merge($firstSection, $firstSeparator, $commonSection, $lastSeparator, $lastSection);
    }
}
