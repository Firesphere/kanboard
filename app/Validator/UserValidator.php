<?php

namespace Kanboard\Validator;

use Kanboard\Model\UserModel;
use SimpleValidator\Validator;
use SimpleValidator\Validators;

/**
 * User Validator
 *
 * @package  Kanboard\Validator
 * @author   Frederic Guillot
 */
class UserValidator extends BaseValidator
{
    /**
     * Common validation rules
     *
     * @access protected
     * @return array
     */
    protected function commonValidationRules()
    {
        return [
            new Validators\MaxLength('role', t('The maximum length is %d characters', 25), 25),
            new Validators\MaxLength('username', t('The maximum length is %d characters', 191), 191),
            new Validators\Unique('username', t('This username is already taken'), $this->db->getConnection(), UserModel::TABLE, 'id'),
            new Validators\Email('email', t('Email address invalid')),
            new Validators\Integer('is_ldap_user', t('This value must be an integer')),
            new Validators\MaxLength('theme', t('The maximum length is %d characters', 50), 50),
        ];
    }

    /**
     * Validate user creation
     *
     * @access public
     * @param array $values Form values
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    public function validateCreation(array $values)
    {
        $rules = [
            new Validators\Required('username', t('The username is required')),
        ];

        if (isset($values['is_ldap_user']) && $values['is_ldap_user'] == 1) {
            $v = new Validator($values, array_merge($rules, $this->commonValidationRules()));
        } else {
            $v = new Validator($values, array_merge($rules, $this->commonValidationRules(), $this->commonPasswordValidationRules()));
        }

        return [
            $v->execute(),
            $v->getErrors(),
        ];
    }

    /**
     * Validate user modification
     *
     * @access public
     * @param array $values Form values
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    public function validateModification(array $values)
    {
        $rules = [
            new Validators\Required('id', t('The user id is required')),
            new Validators\Required('username', t('The username is required')),
        ];

        $v = new Validator($values, array_merge($rules, $this->commonValidationRules()));

        return [
            $v->execute(),
            $v->getErrors(),
        ];
    }

    /**
     * Validate user API modification
     *
     * @access public
     * @param array $values Form values
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    public function validateApiModification(array $values)
    {
        $rules = [
            new Validators\Required('id', t('The user id is required')),
        ];

        $v = new Validator($values, array_merge($rules, $this->commonValidationRules()));

        return [
            $v->execute(),
            $v->getErrors(),
        ];
    }

    /**
     * Validate password modification
     *
     * @access public
     * @param array $values Form values
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    public function validatePasswordModification(array $values)
    {
        $rules = [
            new Validators\Required('id', t('The user id is required')),
            new Validators\Required('current_password', t('The current password is required')),
        ];

        $v = new Validator($values, array_merge($rules, $this->commonPasswordValidationRules()));

        if ($v->execute()) {
            if (!$this->userSession->isAdmin() && $values['id'] != $this->userSession->getId()) {
                return [false, ['current_password' => ['Invalid User ID']]];
            }

            if ($this->authenticationManager->passwordAuthentication($this->userSession->getUsername(), $values['current_password'], false)) {
                return [true, []];
            } else {
                return [false, ['current_password' => [t('Wrong password')]]];
            }
        }

        return [false, $v->getErrors()];
    }
}
