<?php

namespace Hyperf\Engine\Contract;

interface BarrierInterface
{
    /**
     * Wait for the barrier to be released.
     */
    public static function wait(object &$barrier, int $timeout = -1): void;

    /**
     * Create a new barrier instance.
     *
     * @return BarrierInterface
     */
    public static function create(): object;
}
