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
namespace Hyperf\Engine\Contract\Http;

interface Socket
{
    public const BIND_FLAG_NONE = 0;

    public const BIND_FLAG_IPV6ONLY = 1;

    public const BIND_FLAG_REUSEADDR = 2;

    public const BIND_FLAG_REUSEPORT = 4;
}
