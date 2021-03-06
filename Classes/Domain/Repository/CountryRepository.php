<?php
namespace Evoweb\StoreFinder\Domain\Repository;

/***************************************************************
 * Copyright notice
 *
 * (c) 2011-13 Sebastian Fischer <typo3@evoweb.de>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * A repository for static info tables country
 */
class CountryRepository extends \SJBR\StaticInfoTables\Domain\Repository\CountryRepository
{
    /**
     * Constructs a new Repository
     *
     * @param \TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager
     */
    public function __construct(\TYPO3\CMS\Extbase\Object\ObjectManagerInterface $objectManager)
    {
        parent::__construct($objectManager);

        $nsSeparator = strpos($this->getRepositoryClassName(), '\\') !== false ? '\\\\' : '_';
        $this->objectType = preg_replace(
            array(
                '/' . $nsSeparator . 'Repository' . $nsSeparator . '(?!.*' . $nsSeparator . 'Repository' .
                $nsSeparator . ')/',
                '/Repository$/'
            ),
            array($nsSeparator . 'Model' . $nsSeparator, ''),
            get_parent_class($this)
        );
    }

    /**
     * Find all countries despecting the storage page
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
     */
    public function findAll()
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return $query->execute();
    }

    /**
     * Find countries by iso2 codes despection the storage page
     *
     * @param array $isoCodeA2
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
     */
    public function findByIsoCodeA2(array $isoCodeA2)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        $query->matching($query->in('isoCodeA2', $isoCodeA2));

        return $query->execute();
    }
}
