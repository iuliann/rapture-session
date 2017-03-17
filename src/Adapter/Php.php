<?php

namespace Rapture\Session\Adapter;

use Rapture\Auth\Definition\StorageInterface;
use Rapture\Session\Definition\SessionInterface;

/**
 * PHP session wrapper
 *
 * @package Rapture\Session
 * @author Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
class Php implements SessionInterface, StorageInterface
{
    protected $namespace;

    /**
     * Set session options
     *
     * @param string $namespace Namespace
     * @param array  $options   Options like ['cookie_httponly' => true]
     *
     * @see http://www.php.net/manual/en/session.configuration.php
     */
    public function __construct($namespace = 'php', array $options = [])
    {
        $this->namespace = "{$namespace}.";

        foreach ($options as $option => $value) {
            if ($value !== null) {
                ini_set("session.{$option}", $value);
            }
        }

        $this->start();
    }

    /**
     * Start session
     *
     * @return bool
     */
    public function start()
    {
        return session_status() === PHP_SESSION_NONE ? session_start() : false;
    }

    /**
     * Set session variable
     *
     * @param string $name Session key name
     * @param mixed $value Session key value
     *
     * @return $this
     */
    public function set($name, $value)
    {
        $_SESSION[$this->namespace . $name] = $value;

        return $this;
    }

    /**
     * Get session variable
     *
     * @param string $name Session key name
     * @param mixed $default Session key value if name not found
     *
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return isset($_SESSION[$this->namespace . $name])
            ? $_SESSION[$this->namespace . $name]
            : ($default instanceof \Closure ? $default() : $default);
    }

    /**
     * Get session variable and remove it afterwards
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getOnce($name, $default = null)
    {
        $value = $this->get($name, $default);
        $this->delete($name);

        return $value;
    }

    /**
     * Check if session variable exists
     *
     * @param string $name Session key name
     *
     * @return bool
     */
    public function exists($name)
    {
        return isset($_SESSION[$this->namespace . $name]);
    }

    /**
     * Delete a session key
     *
     * @param string $name Session key to remove
     *
     * @return $this
     */
    public function delete($name)
    {
        unset($_SESSION[$this->namespace . $name]);

        return $this;
    }

    /**
     * Clean session
     *
     * @return bool
     */
    public function destroy()
    {
        return session_destroy();
    }

    /**
     * Set flash value
     *
     * @param string $name Session key name
     * @param mixed $value Session key value
     *
     * @return $this
     */
    public function setFlash($name, $value)
    {
        return $this->set("flash.{$name}", $value);
    }

    /**
     * Get flash value
     *
     * @param string $name Session key name
     * @param mixed $default Session default value if name not found
     *
     * @return mixed
     */
    public function getFlash($name, $default = null)
    {
        $value = $this->get("flash.{$name}", $default);
        $this->delete("flash.{$name}");
        return $value;
    }

    /**
     * Get session ID
     *
     * @return string
     */
    public function getId()
    {
        return session_id();
    }

    /**
     * Set session ID
     *
     * @param mixed $id
     *
     * @return string
     */
    public function setId($id = null)
    {
        return session_id($id);
    }

    /**
     * Regenerate session id
     *
     * @param bool $deleteOldSession Whether to delete the old session
     *
     * @return bool
     */
    public function regenerate($deleteOldSession = false)
    {
        return session_regenerate_id($deleteOldSession);
    }
}
