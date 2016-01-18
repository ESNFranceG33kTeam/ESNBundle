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

use Doctrine\Common\Collections\ArrayCollection;
use \Esn\EsnBundle\Model\Section as BaseSection;

/**
* Storage section object
*
 * @author Jérémie Samson <jeremie.samson@ix.esnlille.fr>
 */
class Section extends BaseSection
{
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="GalaxyUser", mappedBy="section")
     */
    private $users;

    public function __construct(){
        $this->users = new ArrayCollection();
    }

    /**
     * @param GalaxyUser $user
     * @return $this
     */
    public function addUser(GalaxyUser $user)
    {
        $this->users->add($user);

        $user->setSection($this);

        return $this;
    }

    /**
     * @param GalaxyUser $user
     */
    public function removeUser(GalaxyUser $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }
}