<?php

/*
 * This file is part of the ESN package.
 *
 * (c) ESNFranceG33kTeam <https://github.com/ESNFranceG33kTeam/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Esn\EsnBundle\Entity;

use FOS\UserBundle\Model\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * Storage galaxyuser object
 *
 * @author Jérémie Samson <jeremie.samson@ix.esnlille.fr>
 */
interface GalaxyUserInterface extends \Serializable
{
    /**
     * @return array
     */
    public function getGalaxyRoles();

    /**
     * @param array $roles
     */
    public function setGalaxyRoles($roles);

    /**
     * @return string
     */
    public function getGalaxyEmail();

    /**
     * @param string $email
     */
    public function setGalaxyEmail($email);

    /**
     * @return string
     */
    public function getSectionName();

    /**
     * @param string $section_name
     */
    public function setSectionName($section_name);

    /**
     * @return string
     */
    public function getSectionCode();

    /**
     * @param string $section_code
     */
    public function setSectionCode($section_code);

    /**
     * @return string
     */
    public function getFirstname();

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname);

    /**
     * @return string
     */
    public function getLastname();

    /**
     * @param string $lastname
     */
    public function setLastname($lastname);

    /**
     * @return string
     */
    public function getNationality();

    /**
     * @param string $nationality
     */
    public function setNationality($nationality);

    /**
     * @return string
     */
    public function getPicture();

    /**
     * @param string $picture
     */
    public function setPicture($picture);

    /**
     * @return \DateTime
     */
    public function getBirthday();

    /**
     * @param \DateTime $birthday
     */
    public function setBirthday($birthday);

    /**
     * @return string
     */
    public function getGender();

    /**
     * @param string $gender
     */
    public function setGender($gender);

    /**
     * @return string
     */
    public function getTelephone();

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     */
    public function setAddress($address);

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param string $country
     */
    public function setCountry($country);
}