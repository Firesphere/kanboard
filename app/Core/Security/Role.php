<?php

namespace Kanboard\Core\Security;

/**
 * Role Definitions
 *
 * @package  security
 * @author   Frederic Guillot
 */
class Role
{
    public const APP_ADMIN = 'app-admin';
    public const APP_MANAGER = 'app-manager';
    public const APP_USER = 'app-user';
    public const APP_PUBLIC = 'app-public';

    public const PROJECT_MANAGER = 'project-manager';
    public const PROJECT_MEMBER = 'project-member';
    public const PROJECT_VIEWER = 'project-viewer';

    /**
     * Get application roles
     *
     * @access public
     * @return array
     */
    public function getApplicationRoles()
    {
        return [
            self::APP_ADMIN   => t('Administrator'),
            self::APP_MANAGER => t('Manager'),
            self::APP_USER    => t('User'),
        ];
    }

    /**
     * Get project roles
     *
     * @access public
     * @return array
     */
    public function getProjectRoles()
    {
        return [
            self::PROJECT_MANAGER => t('Project Manager'),
            self::PROJECT_MEMBER  => t('Project Member'),
            self::PROJECT_VIEWER  => t('Project Viewer'),
        ];
    }

    /**
     * Check if the given role is custom or not
     *
     * @access public
     * @param string $role
     * @return bool
     */
    public function isCustomProjectRole($role)
    {
        return !empty($role) && $role !== self::PROJECT_MANAGER && $role !== self::PROJECT_MEMBER && $role !== self::PROJECT_VIEWER;
    }

    /**
     * Get role name
     *
     * @access public
     * @param string $role
     * @return string
     */
    public function getRoleName($role)
    {
        $roles = $this->getApplicationRoles() + $this->getProjectRoles();

        return isset($roles[$role]) ? $roles[$role] : t('Unknown');
    }
}
