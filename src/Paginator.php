<?php

namespace MZ;

class Paginator
{
    const OPTION_ON_PAGE = 'on_page';
    const OPTION_SEPARATOR = 'separator';
    const OPTION_SECTION_SIZE = 'section_size';

    private $separator;
    private $onPage = 20;
    private $sectionSize = 5;

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

        $commonSection = $this->buildCommonSection($firstPage, $lastPage, $currentPage);
        $firstSection = array_diff([$firstPage], $commonSection);
        $lastSection = array_diff([$lastPage], $commonSection);

        $firstSeparator = $this->getFirstSeparator($firstSection, $currentPage, $lastPage);
        $lastSeparator = $this->getLastSeparator($lastSection, $currentPage, $lastPage);

        return array_merge($firstSection, $firstSeparator, $commonSection, $lastSeparator, $lastSection);
    }

    /**
     * @param int $firstPage
     * @param int $lastPage
     * @param int $currentPage
     *
     * @return array
     */
    private function buildCommonSection(int $firstPage, int $lastPage, int $currentPage): array
    {
        $limit = $this->sectionSize - 1;
        $partSize = $this->getPartSize();

        if ($currentPage >= $firstPage + $limit && $currentPage <= $lastPage - $limit) {
            $commonSection = range($currentPage - $partSize, $currentPage + $partSize);
        } elseif ($currentPage < $firstPage + $limit) {
            $commonSection = range($firstPage, min($firstPage + $limit, $lastPage));
        } else {
            $commonSection = range(max($firstPage, $lastPage - $limit), $lastPage);
        }

        return $commonSection;
    }

    /**
     * @param array $firstSection
     * @param int $currentPage
     * @param int $lastPage
     *
     * @return array
     */
    private function getFirstSeparator(array $firstSection, int $currentPage, int $lastPage): array
    {
        $partSize = $this->getPartSize();

        if ($currentPage - $partSize - 1 <= 1) {
            return [];
        }

        return !empty($firstSection) ? $this->getSeparator($lastPage) : [];
    }

    /**
     * @param array $lastSection
     * @param int $currentPage
     * @param int $lastPage
     *
     * @return array
     */
    private function getLastSeparator(array $lastSection, int $currentPage, int $lastPage): array
    {
        $partSize = $this->getPartSize();

        if ($currentPage + $partSize + 1 >= $lastPage) {
            return [];
        }

        return !empty($lastSection) ? $this->getSeparator($lastPage) : [];
    }

    /**
     * @param int $lastPage
     *
     * @return array
     */
    private function getSeparator(int $lastPage): array
    {
        return $this->separator && $lastPage > $this->sectionSize ? [$this->separator] : [];
    }

    /**
     * @return int
     */
    private function getPartSize(): int
    {
        return (int)floor($this->sectionSize / 2);
    }
}
