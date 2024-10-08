<?php

namespace Kanboard\User;

use Kanboard\Core\Security\Role;
use Kanboard\Core\User\UserProviderInterface;

/**
 * Reverse Proxy User Provider
 *
 * @package  user
 * @author   Frederic Guillot
 */
class ReverseProxyUserProvider implements UserProviderInterface
{
    /**
     * Username
     *
     * @access protected
     * @var string
     */
    protected $username = '';

    /**
     * Email
     *
     * @access protected
     * @var string
     */
    protected $email = '';

    /**
     * Full name
     *
     * @access protected
     * @var string
     */
    protected $fullname = '';

    /**
     * User profile if the user already exists
     *
     * @access protected
     * @var array
     */
    private $userProfile = [];

    /**
     * Constructor
     *
     * @access public
     * @param string $username
     * @param string $email
     * @param string $fullname
     */
    public function __construct($username, $email, $fullname, array $userProfile = [])
    {
        $this->username = $username;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->userProfile = $userProfile;
    }

    /**
     * Return true to allow automatic user creation
     *
     * @access public
     * @return boolean
     */
    public function isUserCreationAllowed()
    {
        return true;
    }

    /**
     * Get internal id
     *
     * @access public
     * @return integer
     */
    public function getInternalId()
    {
        return 0;
    }

    /**
     * Get external id column name
     *
     * @access public
     * @return string
     */
    public function getExternalIdColumn()
    {
        return 'username';
    }

    /**
     * Get external id
     *
     * @access public
     * @return string
     */
    public function getExternalId()
    {
        return $this->username;
    }

    /**
     * Get user role
     *
     * @access public
     * @return string
     */
    public function getRole()
    {
        if (REVERSE_PROXY_DEFAULT_ADMIN === $this->username) {
            return Role::APP_ADMIN;
        }

        if (isset($this->userProfile['role'])) {
            return $this->userProfile['role'];
        }

        return Role::APP_USER;
    }

    /**
     * Get username
     *
     * @access public
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get full name
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return $this->fullname;
    }

    /**
     * Get user email
     *
     * @access public
     * @return string
     */
    public function getEmail()
    {
        if (REVERSE_PROXY_DEFAULT_DOMAIN !== '' && $this->email === '') {
            return $this->username . '@' . REVERSE_PROXY_DEFAULT_DOMAIN;
        }

        return $this->email;
    }

    /**
     * Get external group ids
     *
     * @access public
     * @return array
     */
    public function getExternalGroupIds()
    {
        return [];
    }

    /**
     * Get extra user attributes
     *
     * @access public
     * @return array
     */
    public function getExtraAttributes()
    {
        return [
            'is_ldap_user'       => 1,
            'disable_login_form' => 1,
        ];
    }
}
