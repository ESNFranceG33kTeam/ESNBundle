<?php

/*
 * This file is part of the ESN package.
 *
 * (c) ESNFranceG33kTeam <https://github.com/ESNFranceG33kTeam/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Esn\EsnBundle\Model;

/**
 * @author Jérémie Samson <jeremie.samson@ix.esnlille.fr>
 */
interface SectionInterface extends \Serializable
{
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Section
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set joindate
     *
     * @param \DateTime $joindate
     *
     * @return Section
     */
    public function setJoindate($joindate);

    /**
     * Get joindate
     *
     * @return \DateTime
     */
    public function getJoindate();

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Section
     */
    public function setCode($code);

    /**
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Section
     */
    public function setCountry($country);

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry();

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @param string $street
     */
    public function setStreet($street);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getWebsite();

    /**
     * @param string $website
     */
    public function setWebsite($website);

    /**
     * @return string
     */
    public function getFacebook();

    /**
     * @param string $facebook
     */
    public function setFacebook($facebook);

    /**
     * @return int
     */
    public function getLongitude();

    /**
     * @param int $longitude
     */
    public function setLongitude($longitude);

    /**
     * @return int
     */
    public function getLatitude();

    /**
     * @param int $latitude
     */
    public function setLatitude($latitude);
}