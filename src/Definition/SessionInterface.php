<?php

namespace Rapture\Session\Definition;

/**
 * Session interface
 *
 * @package Rapture\Session
 * @author Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
interface SessionInterface
{
    /**
     * Start session
     *
     * @return mixed
     */
    public function start();

    /**
     * Set session variable
     *
     * @param string $name Session key name
     * @param mixed $value Session key value
     *
     * @return $this
     */
    public function set($name, $value);

    /**
     * Get session variable
     *
     * @param string $name Session key name
     * @param mixed $default Session key value if name not found
     *
     * @return mixed
     */
    public function get($name, $default = null);

    /**
     * Check if session variable exists
     *
     * @param string $name Session key name
     *
     * @return bool
     */
    public function exists($name);

    /**
     * Delete a session key
     *
     * @param string $name Session key to remove
     *
     * @return bool
     */
    public function delete($name);

    /**
     * Clean session
     *
     * @return bool
     */
    public function destroy();

    /**
     * Set flash value
     *
     * @param string $name Session key name
     * @param mixed $value Session key value
     *
     * @return $this
     */
    public function setFlash($name, $value);

    /**
     * Get flash value
     *
     * @param string $name Session key name
     * @param mixed $default Session default value if name not found
     *
     * @return mixed
     */
    public function getFlash($name, $default = null);

    /**
     * Get session ID
     *
     * @return mixed
     */
    public function getId();

    /**
     * Set session ID
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function setId($id = null);
}
