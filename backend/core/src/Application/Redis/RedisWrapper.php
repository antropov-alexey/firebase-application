<?php declare(strict_types=1);

namespace App\Application\Redis;

use Redis;

class RedisWrapper
{
    private Redis $redis;

    public function __construct(string $host, int $port)
    {
        $this->redis = new Redis();
        $this->redis->connect($host, $port);
    }

    public function getAccessToken()
    {
        return $this->redis->get(RedisKeys::GOOGLE_ACCESS_TOKEN);
    }

    public function getRefreshToken()
    {
        return $this->redis->get(RedisKeys::GOOGLE_REFRESH_TOKEN);
    }

    public function setAccessToken(int $expiresIn, string $token)
    {
        return $this->redis->setex(RedisKeys::GOOGLE_ACCESS_TOKEN, $expiresIn, $token);
    }

    public function setRefreshToken(string $token)
    {
        return $this->redis->set(RedisKeys::GOOGLE_REFRESH_TOKEN, $token);
    }
}
