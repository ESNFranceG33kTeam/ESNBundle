<?php

namespace Esn\EsnBundle\Controller;

use Esn\EsnBundle\Entity\GalaxyUser;
use Esn\EsnBundle\Model\Section;
use Esn\EsnBundle\Security\UserProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Translation\Translator;
use UserBundle\Entity\User;

class LoginController extends Controller
{
    public function logoutAction(){
        $this->get('security.context')->setToken(null);
        $this->get('request')->getSession()->invalidate();

        return $this->redirect($this->generateUrl('faucondor_login'));
    }

    /**
     * @param User $user
     *
     * @return GalaxyUser
     */
    private function userTransformer(User $user){
        $username = $user->getUsername();
        $attributes = array();

        $attributes['mail'] = $user->getEmail();
        $attributes['first'] = $user->getFirstname();
        $attributes['last'] = $user->getLastname();
        $attributes['nationality'] = $user->getSection()->getCountry();
        $attributes['picture'] = $user->getGalaxyPicture();
        $attributes['birthdate'] = $user->getBirthdate()->format('d/m/Y');
        $attributes['gender'] = $user->getGender();
        $attributes['telephone'] = $user->getMobile();
        $attributes['address'] = $user->getAddress();
        $attributes['section'] = $user->getSection()->getCode();
        $attributes['country'] = $user->getSection()->getCountry();
        $attributes['sc'] = $user->getSection()->getCode();
        $attributes['roles'] = explode(',', $user->getGalaxyRoles());

        return new GalaxyUser($username, $attributes);
    }
}
