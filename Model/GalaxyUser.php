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

use Esn\EsnBundle\Entity\GalaxyUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * Storage galaxyuser object
 *
 * @author Jérémie Samson <jeremie.samson@ix.esnlille.fr>
 */
abstract class GalaxyUser implements GalaxyUserInterface
{
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="galaxy_username", type="string")
     */
    protected $galaxy_username;

    /**
     * @var string
     *
     * @ORM\Column(name="galaxy_roles", type="text", nullable=true)
     */
    protected $galaxy_roles;

    /**
     * @var string
     *
     * @ORM\Column(name="galaxy_email", type="string", length=255)
     */
    protected $galaxy_email;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=255)
     */
    protected $nationality;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    protected $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="birthday", type="string", length=255, nullable=true)
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1)
     */
    protected $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=15, nullable=true)
     */
    protected $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    protected $country;

    /**
     * @var string
     *
     * @ORM\Column(name="section_name", type="string", length=255)
     */
    protected $section_name;

    /**
     * @var string
     *
     * @ORM\Column(name="section_code", type="string", length=255)
     */
    protected $section_code;

    /**
     * Constructor
     *
     * @param $galaxyUsername
     * @param $attributes
     */
    public function __construct($galaxyUsername, $attributes)
    {
        $this->galaxy_username  = $galaxyUsername;
        $this->galaxy_email     = (array_key_exists('mail', $attributes)) ? $attributes['mail'] : null;
        $this->firstname        = (array_key_exists('first', $attributes)) ? $attributes['first'] : null;
        $this->lastname         = (array_key_exists('last', $attributes)) ? $attributes['last'] : null;
        $this->nationality      = (array_key_exists('nationality', $attributes)) ? $attributes['nationality'] : null;
        $this->picture          = (array_key_exists('picture', $attributes)) ? $attributes['picture'] : null;
        $this->birthday         = (array_key_exists('birthdate', $attributes)) ? $attributes['birthdate'] : null;
        $this->gender           = (array_key_exists('gender', $attributes)) ? $attributes['gender'] : null;
        $this->telephone        = (array_key_exists('telephone', $attributes)) ? $attributes['telephone'] : null;
        $this->address          = (array_key_exists('address', $attributes)) ? $attributes['address'] : null;
        $this->section_name     = (array_key_exists('section', $attributes)) ? $attributes['section'] : null;
        $this->country          = (array_key_exists('country', $attributes)) ? $attributes['country'] : null;
        $this->section_code     = (array_key_exists('sc', $attributes)) ? $attributes['sc'] : null;
        $this->galaxy_roles     = (array_key_exists('roles', $attributes) && is_array($attributes['roles'])) ? implode(',', $attributes['roles']) : null;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getGalaxyUsername()
    {
        return $this->galaxy_username;
    }

    /**
     * @param string $galaxy_username
     */
    public function setGalaxyUsername($galaxy_username)
    {
        $this->galaxy_username = $galaxy_username;
    }

    /**
     * @return array
     */
    public function getGalaxyRoles()
    {
        return explode(',', $this->galaxy_roles);
    }

    /**
     * @param array $galaxy_roles
     */
    public function setGalaxyRoles($galaxy_roles)
    {
        $this->galaxy_roles = implode(',', $galaxy_roles);
    }

    /**
     * @return string
     */
    public function getGalaxyEmail()
    {
        return $this->galaxy_email;
    }

    /**
     * @param string $galaxy_email
     */
    public function setGalaxyEmail($galaxy_email)
    {
        $this->galaxy_email = $galaxy_email;
    }

    /**
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getSectionName()
    {
        return $this->section_name;
    }

    /**
     * @param string $section_name
     */
    public function setSectionName($section_name)
    {
        $this->section_name = $section_name;
    }

    /**
     * @return string
     */
    public function getSectionCode()
    {
        return $this->section_code;
    }

    /**
     * @param string $section_code
     */
    public function setSectionCode($section_code)
    {
        $this->section_code = $section_code;
    }

    /**
     * Serializes the user.
     *
     * The serialized data have to contain the fields used by the equals method and the username.
     *
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->firstname,
            $this->lastname,
            $this->galaxy_username,
            $this->galaxy_roles,
            $this->galaxy_email,
            $this->nationality,
            $this->picture,
            $this->birthday,
            $this->gender,
            $this->telephone,
            $this->address,
            $this->country,
            $this->section_name,
            $this->section_code,
            $this->id,
        ));
    }

    /**
     * Unserializes the user.
     *
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->firstname,
            $this->lastname,
            $this->galaxy_username,
            $this->galaxy_roles,
            $this->galaxy_email,
            $this->nationality,
            $this->picture,
            $this->birthday,
            $this->gender,
            $this->telephone,
            $this->address,
            $this->country,
            $this->section_name,
            $this->section_code,
            $this->id,
            ) = $data;
    }
}