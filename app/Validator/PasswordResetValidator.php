<?php

namespace Kanboard\Validator;

use Gregwar\Captcha\CaptchaBuilder;
use SimpleValidator\Validator;
use SimpleValidator\Validators;

/**
 * Password Reset Validator
 *
 * @package  Kanboard\Validator
 * @author   Frederic Guillot
 */
class PasswordResetValidator extends BaseValidator
{
    /**
     * Validate creation
     *
     * @access public
     * @param array $values Form values
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    public function validateCreation(array $values)
    {
        return $this->executeValidators(['validateFields', 'validateCaptcha'], $values);
    }

    /**
     * Validate modification
     *
     * @access public
     * @param array $values Form values
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    public function validateModification(array $values)
    {
        $v = new Validator($values, $this->commonPasswordValidationRules());

        return [
            $v->execute(),
            $v->getErrors(),
        ];
    }

    /**
     * Validate fields
     *
     * @access protected
     * @param array $values Form values
     * @return array   $valid, $errors   [0] = Success or not, [1] = List of errors
     */
    protected function validateFields(array $values)
    {
        $v = new Validator($values, [
            new Validators\Required('captcha', t('This value is required')),
            new Validators\Required('username', t('The username is required')),
            new Validators\MaxLength('username', t('The maximum length is %d characters', 191), 191),
        ]);

        return [
            $v->execute(),
            $v->getErrors(),
        ];
    }

    /**
     * Validate captcha
     *
     * @access protected
     * @param array $values Form values
     * @return array
     */
    protected function validateCaptcha(array $values)
    {
        $errors = [];

        if (!session_exists('captcha')) {
            $result = false;
        } else {
            $builder = new CaptchaBuilder();
            $builder->setPhrase(session_get('captcha'));
            $result = $builder->testPhrase(isset($values['captcha']) ? $values['captcha'] : '');

            if (!$result) {
                $errors['captcha'] = [t('Invalid captcha')];
            }

            // Invalidate captcha to avoid reuse.
            session_remove('captcha');
        }

        return [$result, $errors];
    }
}
