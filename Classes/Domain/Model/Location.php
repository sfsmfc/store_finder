<?php
namespace Evoweb\StoreFinder\Domain\Model;

/***************************************************************
 * Copyright notice
 *
 * (c) 2013 Sebastian Fischer <typo3@evoweb.de>
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

use SJBR\StaticInfoTables\Domain\Repository\CountryRepository;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class Location
 *
 * @package Evoweb\StoreFinder\Domain\Model
 */
class Location extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $storeid = '';

    /**
     * @var string
     */
    protected $address = '';

    /**
     * @var string
     */
    protected $additionaladdress = '';

    /**
     * @var string
     */
    protected $city = '';

    /**
     * @var string
     */
    protected $person = '';

    /**
     * @var string
     */
    protected $zipcode = '';

    /**
     * @var string
     */
    protected $products = '';

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $phone = '';

    /**
     * @var string
     */
    protected $mobile = '';

    /**
     * @var string
     */
    protected $fax = '';

    /**
     * @var string
     */
    protected $hours = '';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var string
     */
    protected $notes = '';

    /**
     * @var string
     */
    protected $icon = '';

    /**
     * @var double
     */
    protected $latitude = 0.0000000;

    /**
     * @var double
     */
    protected $longitude = 0.0000000;

    /**
     * @var integer
     */
    protected $geocode = 0;

    /**
     * @var integer
     */
    protected $center = 0;

    /**
     * @var integer
     */
    protected $zoom = 1;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Evoweb\StoreFinder\Domain\Model\Attributes>
     * @lazy
     */
    protected $attributes = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Evoweb\StoreFinder\Domain\Model\Category>
     * @lazy
     */
    protected $categories;

    /**
     * var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Tt_Content>
     *
     * @var string
     * @lazy
     */
    protected $content = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Evoweb\StoreFinder\Domain\Model\Location>
     * @lazy
     */
    protected $related;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $image = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $media = '';

    /**
     * @var string
     */
    protected $country = '';

    /**
     * @var string
     */
    protected $_country;

    /**
     * @var \SJBR\StaticInfoTables\Domain\Model\CountryZone
     * @lazy
     */
    protected $state = '';


    /**
     * @var double
     */
    protected $distance = 0.0;


    /**
     * Initialize categories, attributed and media relation
     */
    public function __construct()
    {
        $this->attributes =
            $this->categories =
            $this->content =
            $this->related =
            $this->image =
            $this->media = new ObjectStorage();
    }

    /**
     * @return \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected function getObjectManager()
    {
        if (is_null($this->objectManager)) {
            $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                \TYPO3\CMS\Extbase\Object\ObjectManager::class
            );
        }
        return $this->objectManager;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getAdditionaladdress()
    {
        return $this->additionaladdress;
    }

    /**
     * Setter
     *
     * @param string $additionaladdress
     *
     * @return void
     */
    public function setAdditionaladdress($additionaladdress)
    {
        $this->additionaladdress = $additionaladdress;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->escapeJsonString($this->address);
    }

    /**
     * Getter
     *
     * @param string $address
     *
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Getter
     *
     * @return ObjectStorage<\Evoweb\StoreFinder\Domain\Model\Attribute>
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Setter
     *
     * @param ObjectStorage <\Evoweb\StoreFinder\Domain\Model\Attribute> $attributes
     *
     * @return void
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Getter
     *
     * @return ObjectStorage<\Evoweb\StoreFinder\Domain\Model\Category>
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Setter
     *
     * @param ObjectStorage <\Evoweb\StoreFinder\Domain\Model\Category> $categories
     *
     * @return void
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getCity()
    {
        return $this->escapeJsonString($this->city);
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getCityRaw()
    {
        return $this->city;
    }

    /**
     * Setter
     *
     * @param string $city
     *
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Setter
     *
     * @param string $person
     *
     * @return void
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Setter
     *
     * @param string $content
     *
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->getCountry() ? $this->getCountry()->getShortNameEn() : '';
    }

    /**
     * Getter
     *
     * @return \SJBR\StaticInfoTables\Domain\Model\Country
     */
    public function getCountry()
    {
        if (is_null($this->_country)) {
            /** @var CountryRepository $repository */
            $repository = $this->getObjectManager()->get(CountryRepository::class);
            /** @var \TYPO3\CMS\Extbase\Persistence\Generic\Query $query */
            $query = $repository->createQuery();

            if (TYPO3_MODE === 'FE') {
                $enableFields = $this->getTypoScriptFrontendController()->sys_page->enableFields('static_countries');
            } else {
                $enableFields = \TYPO3\CMS\Backend\Utility\BackendUtility::BEenableFields('static_countries');
            }

            $this->_country = $query->statement(
                'SELECT * FROM static_countries WHERE '
                . (is_numeric($this->country) ? 'uid = ' : 'cn_iso_3 = ')
                . $this->getDatabaseConnection()->fullQuoteStr($this->country, 'static_countries')
                . $enableFields
            )->execute()->getFirst();
        }
        return $this->_country;
    }

    /**
     * Setter
     *
     * @param \SJBR\StaticInfoTables\Domain\Model\Country $country
     *
     * @return void
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Setter
     *
     * @param string $email
     *
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Setter
     *
     * @param string $fax
     *
     * @return void
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Getter
     *
     * @return int
     */
    public function getGeocode()
    {
        return $this->geocode;
    }

    /**
     * Setter
     *
     * @param int $geocode
     *
     * @return void
     */
    public function setGeocode($geocode)
    {
        $this->geocode = $geocode;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getHours()
    {
        return $this->escapeJsonString($this->hours);
    }

    /**
     * Setter
     *
     * @param string $hours
     *
     * @return void
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Setter
     *
     * @param string $icon
     *
     * @return void
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * Getter
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Setter
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $image
     *
     * @return void
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Getter
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Setter
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
     *
     * @return void
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Setter
     *
     * @param string $mobile
     *
     * @return void
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->escapeJsonString($this->notes);
    }

    /**
     * Setter
     *
     * @param string $notes
     *
     * @return void
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Setter
     *
     * @param string $phone
     *
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Setter
     *
     * @param string $products
     *
     * @return void
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * Getter
     *
     * @return ObjectStorage
     */
    public function getRelated()
    {
        return $this->related;
    }

    /**
     * Setter
     *
     * @param ObjectStorage $related
     *
     * @return void
     */
    public function setRelated($related)
    {
        $this->related = $related;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getStateName()
    {
        return $this->getState() ? $this->getState()->getNameEn() : '';
    }

    /**
     * Getter
     *
     * @return \SJBR\StaticInfoTables\Domain\Model\CountryZone
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Setter
     *
     * @param \SJBR\StaticInfoTables\Domain\Model\CountryZone $state
     *
     * @return void
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getStoreid()
    {
        return $this->storeid;
    }

    /**
     * Setter
     *
     * @param string $storeid
     *
     * @return void
     */
    public function setStoreid($storeid)
    {
        $this->storeid = $storeid;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getName()
    {
        return $this->escapeJsonString($this->name);
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getNameRaw()
    {
        return $this->name;
    }

    /**
     * Setter
     *
     * @param string $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Setter
     *
     * @param string $url
     *
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Getter
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Setter
     *
     * @param string $zipcode
     *
     * @return void
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * Getter
     *
     * @return bool
     */
    public function getCenter()
    {
        return (bool)$this->center;
    }

    /**
     * Setter
     *
     * @param bool $center
     *
     * @return void
     */
    public function setCenter($center)
    {
        $this->center = $center;
    }

    /**
     * Getter
     *
     * @return integer
     */
    public function getZoom()
    {
        return (int)$this->zoom;
    }

    /**
     * Setter
     *
     * @param integer $zoom
     *
     * @return void
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;
    }

    /**
     * Getter
     *
     * @return double
     */
    public function getLatitude()
    {
        return (float)$this->latitude;
    }

    /**
     * Setter
     *
     * @param double $latitude
     *
     * @return void
     */
    public function setLatitude($latitude)
    {
        $this->latitude = (float)$latitude;
    }

    /**
     * Getter
     *
     * @return double
     */
    public function getLongitude()
    {
        return (float)$this->longitude;
    }

    /**
     * Setter
     *
     * @param double $longitude
     *
     * @return void
     */
    public function setLongitude($longitude)
    {
        $this->longitude = (float)$longitude;
    }


    /**
     * Check if location has latitude and longitude
     *
     * @return bool
     */
    public function isGeocoded()
    {
        return $this->getLatitude() && $this->getLongitude() && !$this->getGeocode();
    }

    /**
     * Escape values for json
     *
     * @param string $value
     *
     * @return mixed
     */
    protected function escapeJsonString($value)
    {
        $escapers = array('\\', '/', '"', "\n", "\r", "\t", "\x08", "\x0c", "'");
        $replacements = array('\\\\', '\\/', '\\"', "\\n", "\\r", "\\t", "\\f", '\\b', "\'");
        $result = str_replace($escapers, $replacements, $value);

        return $result;
    }

    /**
     * Getter
     *
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Setter
     *
     * @param float $distance
     *
     * @return void
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }


    /**
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }

    /**
     * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $frontend
     */
    protected function getTypoScriptFrontendController()
    {
        return $GLOBALS['TSFE'];
    }
}
