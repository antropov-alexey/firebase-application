<?php declare(strict_types=1);

namespace App\Application\Redis;

abstract class RedisKeys
{
    public const GOOGLE_ACCESS_TOKEN  = 'GOOGLE_ACCESS_TOKEN';
    public const GOOGLE_REFRESH_TOKEN = 'GOOGLE_REFRESH_TOKEN';
}
