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
use FOS\UserBundle\Model\GroupableInterface;
use FOS\UserBundle\Model\GroupInterface;
use FOS\UserBundle\Model\UserInterface;

/**
 * Storage galaxyuser object
 *
 * @author Jérémie Samson <jeremie.samson@ix.esnlille.fr>
 */
abstract class GalaxyUser implements GalaxyUserInterface, UserInterface, GroupableInterface
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
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $usernameCanonical;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $emailCanonical;

    /**
     * @var boolean
     */
    protected $enabled;

    /**
     * The salt to use for hashing
     *
     * @var string
     */
    protected $salt;

    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
     */
    protected $password;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * @var \DateTime
     */
    protected $lastLogin;

    /**
     * Random string sent to the user email address in order to verify it
     *
     * @var string
     */
    protected $confirmationToken;

    /**
     * @var \DateTime
     */
    protected $passwordRequestedAt;

    /**
     * @var Collection
     */
    protected $groups;

    /**
     * @var boolean
     */
    protected $locked;

    /**
     * @var boolean
     */
    protected $expired;

    /**
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * @var array
     */
    protected $roles;

    /**
     * @var boolean
     */
    protected $credentialsExpired;

    /**
     * @var \DateTime
     */
    protected $credentialsExpireAt;

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

        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->enabled = false;
        $this->locked = false;
        $this->expired = false;
        $this->roles = array();
        $this->credentialsExpired = false;
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

    public function addRole($role)
    {
        $role = strtoupper($role);
        if ($role === static::ROLE_DEFAULT) {
            return $this;
        }

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * Serializes the user.
     *
     * The serialized data have to contain the fields used during check for
     * changes and the id.
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
            $this->password,
            $this->salt,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id,
            $this->expiresAt,
            $this->credentialsExpireAt,
            $this->email,
            $this->emailCanonical,
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
            $this->password,
            $this->salt,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id,
            $this->expiresAt,
            $this->credentialsExpireAt,
            $this->email,
            $this->emailCanonical
            ) = $data;
    }

    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getUsernameCanonical()
    {
        return $this->usernameCanonical;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getEmailCanonical()
    {
        return $this->emailCanonical;
    }

    /**
     * Gets the encrypted password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Gets the last login time.
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Returns the user roles
     *
     * @return array The roles
     */
    public function getRoles()
    {
        $roles = $this->roles;

        foreach ($this->getGroups() as $group) {
            $roles = array_merge($roles, $group->getRoles());
        }

        // we need to make sure to have at least one role
        $roles[] = static::ROLE_DEFAULT;

        return array_unique($roles);
    }

    /**
     * Never use this to check if this user has access to anything!
     *
     * Use the SecurityContext, or an implementation of AccessDecisionManager
     * instead, e.g.
     *
     *         $securityContext->isGranted('ROLE_USER');
     *
     * @param string $role
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    public function isAccountNonExpired()
    {
        if (true === $this->expired) {
            return false;
        }

        if (null !== $this->expiresAt && $this->expiresAt->getTimestamp() < time()) {
            return false;
        }

        return true;
    }

    public function isAccountNonLocked()
    {
        return !$this->locked;
    }

    public function isCredentialsNonExpired()
    {
        if (true === $this->credentialsExpired) {
            return false;
        }

        if (null !== $this->credentialsExpireAt && $this->credentialsExpireAt->getTimestamp() < time()) {
            return false;
        }

        return true;
    }

    public function isCredentialsExpired()
    {
        return !$this->isCredentialsNonExpired();
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function isExpired()
    {
        return !$this->isAccountNonExpired();
    }

    public function isLocked()
    {
        return !$this->isAccountNonLocked();
    }

    public function isSuperAdmin()
    {
        return $this->hasRole(static::ROLE_SUPER_ADMIN);
    }

    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function setUsernameCanonical($usernameCanonical)
    {
        $this->usernameCanonical = $usernameCanonical;

        return $this;
    }

    /**
     * @param \DateTime $date
     *
     * @return User
     */
    public function setCredentialsExpireAt(\DateTime $date = null)
    {
        $this->credentialsExpireAt = $date;

        return $this;
    }

    /**
     * @param boolean $boolean
     *
     * @return User
     */
    public function setCredentialsExpired($boolean)
    {
        $this->credentialsExpired = $boolean;

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function setEmailCanonical($emailCanonical)
    {
        $this->emailCanonical = $emailCanonical;

        return $this;
    }

    public function setEnabled($boolean)
    {
        $this->enabled = (Boolean) $boolean;

        return $this;
    }

    /**
     * Sets this user to expired.
     *
     * @param Boolean $boolean
     *
     * @return User
     */
    public function setExpired($boolean)
    {
        $this->expired = (Boolean) $boolean;

        return $this;
    }

    /**
     * @param \DateTime $date
     *
     * @return User
     */
    public function setExpiresAt(\DateTime $date = null)
    {
        $this->expiresAt = $date;

        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function setSuperAdmin($boolean)
    {
        if (true === $boolean) {
            $this->addRole(static::ROLE_SUPER_ADMIN);
        } else {
            $this->removeRole(static::ROLE_SUPER_ADMIN);
        }

        return $this;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;

        return $this;
    }

    public function setLastLogin(\DateTime $time = null)
    {
        $this->lastLogin = $time;

        return $this;
    }

    public function setLocked($boolean)
    {
        $this->locked = $boolean;

        return $this;
    }

    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function setPasswordRequestedAt(\DateTime $date = null)
    {
        $this->passwordRequestedAt = $date;

        return $this;
    }

    /**
     * Gets the timestamp that the user requested a password reset.
     *
     * @return null|\DateTime
     */
    public function getPasswordRequestedAt()
    {
        return $this->passwordRequestedAt;
    }

    public function isPasswordRequestNonExpired($ttl)
    {
        return $this->getPasswordRequestedAt() instanceof \DateTime &&
        $this->getPasswordRequestedAt()->getTimestamp() + $ttl > time();
    }

    public function setRoles(array $roles)
    {
        $this->roles = array();

        foreach ($roles as $role) {
            $this->addRole($role);
        }

        return $this;
    }

    /**
     * Gets the groups granted to the user.
     *
     * @return Collection
     */
    public function getGroups()
    {
        return $this->groups ?: $this->groups = new ArrayCollection();
    }

    public function getGroupNames()
    {
        $names = array();
        foreach ($this->getGroups() as $group) {
            $names[] = $group->getName();
        }

        return $names;
    }

    /**
     * @param string $name
     *
     * @return boolean
     */
    public function hasGroup($name)
    {
        return in_array($name, $this->getGroupNames());
    }

    public function addGroup(GroupInterface $group)
    {
        if (!$this->getGroups()->contains($group)) {
            $this->getGroups()->add($group);
        }

        return $this;
    }

    public function removeGroup(GroupInterface $group)
    {
        if ($this->getGroups()->contains($group)) {
            $this->getGroups()->removeElement($group);
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getUsername();
    }
}