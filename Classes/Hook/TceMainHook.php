<?php
namespace Evoweb\StoreFinder\Hook;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Sebastian Fischer <typo3@evoweb.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Evoweb\StoreFinder\Domain\Model\Location;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * Class TceMainHook
 *
 * @package Evoweb\StoreFinder\Hook
 */
class TceMainHook {
	/**
	 * @var array
	 */
	protected $configuration = array();

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager = NULL;

	/**
	 * @var \Evoweb\StoreFinder\Domain\Repository\LocationRepository
	 */
	protected $repository = NULL;

	/**
	 * After database operations hook
	 *
	 * @param string $status
	 * @param string $table
	 * @param string $id
	 * @param array $fieldArray
	 * @param \TYPO3\CMS\Core\DataHandling\DataHandler $parentObject
	 * @return void
	 */
	public function processDatamap_afterDatabaseOperations($status, $table, $id, $fieldArray, $parentObject) {
		if ($table === 'tx_storefinder_domain_model_location') {
			$locationId = $this->remapId($id, $table, $parentObject);

			$this->initializeConfiguration();
			$location = $this->fetchLocation($locationId);

			if ($location !== NULL) {
				$this->storeLocation($this->setCoordinates($location));
			}
		}
	}

	/**
	 * Remap id for id and table
	 *
	 * @param string $id
	 * @param string &$table
	 * @param \TYPO3\CMS\Core\DataHandling\DataHandler $parentObject
	 * @return integer
	 */
	protected function remapId($id, &$table, $parentObject) {
		if (array_key_exists($id, $parentObject->substNEWwithIDs)) {
			$table = $parentObject->substNEWwithIDs_table[$id];
			$id = $parentObject->substNEWwithIDs[$id];
		}

		return $id;
	}

	/**
	 * Initialization of configurations
	 *
	 * @return void
	 */
	protected function initializeConfiguration() {
		$this->configuration = \Evoweb\StoreFinder\Utility\ExtensionConfigurationUtility::getConfiguration();
	}


	/**
	 * Fetch location for uid
	 *
	 * @param integer $uid
	 * @return Location
	 */
	protected function fetchLocation($uid) {
		return $this->getRepository()->findByUid($uid);
	}

	/**
	 * Getter for repository
	 *
	 * @return \Evoweb\StoreFinder\Domain\Repository\LocationRepository
	 */
	protected function getRepository() {
		if ($this->repository === NULL) {
			$this->repository = $this->getObjectManager()->get('Evoweb\\StoreFinder\\Domain\\Repository\\LocationRepository');
		}

		return $this->repository;
	}

	/**
	 * Getter for object manager
	 *
	 * @return \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected function getObjectManager() {
		if ($this->objectManager === NULL) {
			$this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		}

		return $this->objectManager;
	}


	/**
	 * Sets coordinates by using geocoding service
	 *
	 * @param Location $location
	 * @return Location
	 */
	protected function setCoordinates(Location $location) {
		return $this->getObjectManager()
			->get('Evoweb\\StoreFinder\\Service\\GeocodeService', $this->configuration)
			->geocodeAddress($location);
	}

	/**
	 * Stores location
	 *
	 * @param Location $location
	 * @return void
	 */
	protected function storeLocation(Location $location) {
		$this->getRepository()->update($location);

		/** @var PersistenceManager $persistanceManager */
		$persistanceManager = $this->getObjectManager()->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		$persistanceManager->persistAll();
	}
}