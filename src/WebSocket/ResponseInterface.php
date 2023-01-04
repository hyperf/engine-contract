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
namespace Hyperf\Engine\Contract\WebSocket;

interface ResponseInterface
{
    /**
     * @param int $fd swoole process mode is required
     */
    public function push(FrameInterface $frame, int $fd = 0): bool;
}
