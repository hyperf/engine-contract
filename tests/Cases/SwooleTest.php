<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases;

use ReflectionClass;
use Swoole\Coroutine\Socket;

/**
 * @internal
 * @coversNothing
 */
class SwooleTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        if (! extension_loaded('swoole')) {
            $this->markTestSkipped('Only test Swoole.');
        }
    }

    public function testCoroutineSocketSendAllReturnType()
    {
        $ref = new ReflectionClass(Socket::class);

        $m = $ref->getMethod('sendAll');

        foreach ($m->getReturnType()->getTypes() as $namedType) {
            $this->assertTrue(in_array($namedType->getName(), ['int', 'false'], true));
        }
    }

    public function testCoroutineSocketRecvAllReturnType()
    {
        $ref = new ReflectionClass(Socket::class);

        $m = $ref->getMethod('recvAll');

        foreach ($m->getReturnType()->getTypes() as $namedType) {
            $this->assertTrue(in_array($namedType->getName(), ['string', 'false'], true));
        }
    }

    public function testCoroutineSocketSendAllParamaters()
    {
        $ref = new ReflectionClass(Socket::class);

        $m = $ref->getMethod('sendAll');

        $params = $m->getParameters();

        foreach ($params as $param) {
            $this->assertTrue(in_array($param->getName(), ['data', 'timeout'], true));
            switch ($param->getName()) {
                case 'data':
                    $this->assertSame('string', $param->getType()->getName());
                    $this->assertFalse($param->isDefaultValueAvailable());
                    break;
                case 'timeout':
                    $this->assertSame('float', $param->getType()->getName());
                    $this->assertSame(0, $param->getDefaultValue());
                    break;
            }
        }
    }

    public function testCoroutineSocketRecvAllParamaters()
    {
        $ref = new ReflectionClass(Socket::class);

        $m = $ref->getMethod('recvAll');

        $params = $m->getParameters();

        foreach ($params as $param) {
            $this->assertTrue(in_array($param->getName(), ['length', 'timeout'], true));
            switch ($param->getName()) {
                case 'length':
                    $this->assertSame('int', $param->getType()->getName());
                    $this->assertSame(65536, $param->getDefaultValue());
                    break;
                case 'timeout':
                    $this->assertSame('float', $param->getType()->getName());
                    $this->assertSame(0, $param->getDefaultValue());
                    break;
            }
        }
    }

    public function testCoroutineSocketRecvPacketReturnType()
    {
        $ref = new ReflectionClass(Socket::class);

        $m = $ref->getMethod('recvPacket');

        foreach ($m->getReturnType()->getTypes() as $namedType) {
            $this->assertTrue(in_array($namedType->getName(), ['string', 'false'], true));
        }
    }

    public function testCoroutineSocketRecvPacketParamaters()
    {
        $ref = new ReflectionClass(Socket::class);

        $m = $ref->getMethod('recvPacket');

        $params = $m->getParameters();

        foreach ($params as $param) {
            $this->assertSame('timeout', $param->getName());
            $this->assertSame('float', $param->getType()->getName());
            $this->assertSame(0, $param->getDefaultValue());
        }
    }

    public function testCoroutineSocketConnect()
    {
        $ref = new ReflectionClass(Socket::class);

        $m = $ref->getMethod('connect');

        $params = $m->getParameters();
        $this->assertSame(3, count($params));

        $host = $params[0];
        $this->assertSame('string', $host->getType()->getName());
        $this->assertFalse($host->allowsNull());
        $this->assertFalse($host->isDefaultValueAvailable());

        $port = $params[1];
        $this->assertSame('int', $port->getType()->getName());
        $this->assertFalse($port->allowsNull());
        $this->assertTrue($port->isDefaultValueAvailable());
        $this->assertSame(0, $port->getDefaultValue());

        $timeout = $params[2];
        $this->assertSame('float', $timeout->getType()->getName());
        $this->assertFalse($timeout->allowsNull());
        $this->assertTrue($timeout->isDefaultValueAvailable());
        $this->assertSame(0, $timeout->getDefaultValue());

        $this->assertSame('bool', $m->getReturnType()->getName());
    }
}
