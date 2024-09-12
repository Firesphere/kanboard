<?php

namespace Kanboard\Validator;

use Kanboard\Core\Security\Role;
use SimpleValidator\Validator;
use SimpleValidator\Validators;

/**
 * Comment Validator
 *
 * @package  Kanboard\Validator
 * @author   Frederic Guillot
 */
class CommentValidator extends BaseValidator
{
    /**
     * Validate comment email creation
     *
     * @access public
     * @param array $values Required parameters to save an action
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    public function validateEmailCreation(array $values)
    {
        $rules = [
            new Validators\Required('task_id', t('This value is required')),
            new Validators\Required('user_id', t('This value is required')),
            new Validators\Required('subject', t('This field is required')),
            new Validators\Required('emails', t('This field is required')),
            new Validators\Required('visibility', t('Visibility is required')),
            new Validators\InArray('visibility', [Role::APP_USER, Role::APP_MANAGER, Role::APP_ADMIN], t('The visibility should be an app role')),
        ];

        $v = new Validator($values, array_merge($rules, $this->commonValidationRules()));

        return [
            $v->execute(),
            $v->getErrors(),
        ];
    }

    /**
     * Validate comment creation
     *
     * @access public
     * @param array $values Required parameters to save an action
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    public function validateCreation(array $values)
    {
        $rules = [
            new Validators\Required('task_id', t('This value is required')),
            new Validators\Required('visibility', t('Visibility is required')),
            new Validators\InArray('visibility', [Role::APP_USER, Role::APP_MANAGER, Role::APP_ADMIN], t('The visibility should be an app role')),
        ];

        $v = new Validator($values, array_merge($rules, $this->commonValidationRules()));

        return [
            $v->execute(),
            $v->getErrors(),
        ];
    }

    /**
     * Validate comment modification
     *
     * @access public
     * @param array $values Required parameters to save an action
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    public function validateModification(array $values)
    {
        $rules = [
            new Validators\Required('id', t('This value is required')),
        ];

        $v = new Validator($values, array_merge($rules, $this->commonValidationRules()));

        return [
            $v->execute(),
            $v->getErrors(),
        ];
    }

    /**
     * Common validation rules
     *
     * @access private
     * @return array
     */
    private function commonValidationRules()
    {
        return [
            new Validators\Integer('id', t('This value must be an integer')),
            new Validators\Integer('task_id', t('This value must be an integer')),
            new Validators\Integer('user_id', t('This value must be an integer')),
            new Validators\MaxLength('reference', t('The maximum length is %d characters', 191), 191),
            new Validators\Required('comment', t('Comment is required')),
        ];
    }
}
