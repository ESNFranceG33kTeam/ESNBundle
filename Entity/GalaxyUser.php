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

use \Esn\EsnBundle\Model\GalaxyUser as BaseGalaxyUser;

/**
* Storage galaxy user object
*
 * @author Jérémie Samson <jeremie.samson@ix.esnlille.fr>
 */
class GalaxyUser extends BaseGalaxyUser
{
    /**
     * @var Section
     *
     * @ORM\ManyToOne(targetEntity="Section", inversedBy="users")
     */
    protected $section;

    /**
     * @return Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param Section $section
     */
    public function setSection($section)
    {
        $this->section = $section;
    }
}