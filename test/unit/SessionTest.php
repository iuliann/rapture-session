<?php

use Rapture\Session\Adapter\Php;

include __DIR__ . '/../../../rapture-auth/src/Definition/StorageInterface.php';

class SessionTest extends \PHPUnit_Framework_TestCase
{
    /** @var Php */
    protected $session;

    public function setUp()
    {
        @$this->session = new Php();
    }

    public function testSetGet()
    {
        $this->session->set('test', 1);

        $this->assertEquals(1, $this->session->get('test'));
    }

    public function testFlash()
    {
        $this->session->setFlash('test', 1);

        $this->assertEquals(1, $this->session->getFlash('test'));
        $this->assertEquals(null, $this->session->getFlash('test'));
    }

    public function tearDown()
    {
        $this->session->destroy();
    }
}
