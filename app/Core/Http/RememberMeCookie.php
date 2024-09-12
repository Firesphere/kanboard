<?php

namespace Kanboard\Core\Http;

use Kanboard\Core\Base;

/**
 * Remember Me Cookie
 *
 * @package  http
 * @author   Frederic Guillot
 */
class RememberMeCookie extends Base
{
    /**
     * Cookie name
     *
     * @var string
     */
    public const COOKIE_NAME = 'KB_RM';

    /**
     * Return true if the current user has a RememberMe cookie
     *
     * @access public
     * @return bool
     */
    public function hasCookie()
    {
        return $this->request->getCookie(self::COOKIE_NAME) !== '';
    }

    /**
     * Write and encode the cookie
     *
     * @access public
     * @param string $token Session token
     * @param string $sequence Sequence token
     * @param string $expiration Cookie expiration
     * @return boolean
     */
    public function write($token, $sequence, $expiration)
    {
        return setcookie(
            self::COOKIE_NAME,
            $this->encode($token, $sequence),
            $expiration,
            $this->helper->url->dir(),
            '',
            $this->request->isHTTPS(),
            true,
        );
    }

    /**
     * Encode the cookie
     *
     * @access public
     * @param string $token Session token
     * @param string $sequence Sequence token
     * @return string
     */
    public function encode($token, $sequence)
    {
        return implode('|', [$token, $sequence]);
    }

    /**
     * Read and decode the cookie
     *
     * @access public
     * @return mixed
     */
    public function read()
    {
        $cookie = $this->request->getCookie(self::COOKIE_NAME);

        if (empty($cookie)) {
            return false;
        }

        return $this->decode($cookie);
    }

    /**
     * Decode the value of a cookie
     *
     * @access public
     * @param string $value Raw cookie data
     * @return array
     */
    public function decode($value)
    {
        list($token, $sequence) = explode('|', $value);

        return [
            'token'    => $token,
            'sequence' => $sequence,
        ];
    }

    /**
     * Remove the cookie
     *
     * @access public
     * @return boolean
     */
    public function remove()
    {
        return setcookie(
            self::COOKIE_NAME,
            '',
            time() - 3600,
            $this->helper->url->dir(),
            '',
            $this->request->isHTTPS(),
            true,
        );
    }
}
