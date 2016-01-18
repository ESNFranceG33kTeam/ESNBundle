<?php

namespace Esn\EsnBundle\Security;

use Esn\EsnBundle\DependencyInjection\EsnEsnExtension;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use phpCAS;
use Esn\EsnBundle\Entity\GalaxyUser;

class UserProvider extends EsnEsnExtension implements UserProviderInterface
{
    /**
     * @var array
     */
    protected $cas;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container){
        $this->cas = array(
            "host" => $container->getParameter('cas_host'),
            "port" => $container->getParameter('cas_port'),
            "context" => $container->getParameter('cas_context'),
        );
    }

    /**
     * @return GalaxyUser
     */
    public function loadGalaxyUser()
    {
        phpCAS::setDebug();
        phpCAS::client(CAS_VERSION_2_0, $this->cas["host"], $this->cas["port"], $this->cas["context"], false);
        phpCAS::setNoCasServerValidation();
        phpCAS::forceAuthentication();

        $username =  phpCAS::getUser();

        if ($username) {
            $this->attributes = phpCAS::getAttributes();

            return new GalaxyUser($username, $this->attributes, null, null, array());
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    /**
     * @return array
     */
    public function getAttributes(){
        return $this->attributes;
    }

    /**
     * @param string $username
     *
     * @return GalaxyUser
     */
    public function loadUserByUsername($username)
    {
        phpCAS::setDebug();
        phpCAS::client(CAS_VERSION_2_0, $this->cas["host"], $this->cas["port"], $this->cas["context"], false);
        phpCAS::setNoCasServerValidation();
        phpCAS::forceAuthentication();
        $username =  phpCAS::getUser();
        if ($username) {
            $attributes = phpCAS::getAttributes();
            return new GalaxyUser($username, $attributes, null, null, array());
        }
        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    /**
     * @param UserInterface $user
     *
     * @return GalaxyUser
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof GalaxyUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param $cas_host
     * @param $cas_port
     * @param $cas_context
     *
     * @return bool
     */
    public function logout($cas_host, $cas_port, $cas_context){
        phpCAS::setDebug();
        phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
        phpCAS::logout();
        return true;
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === 'Esn\EsnBundle\Security\UserProvider';
    }
}