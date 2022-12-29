<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Stream;
use Hashids\Hashids;

class HashidService
{
    private const PARAMS = [
        Stream::class => [
            self::SALT      => '|Ik+S[cjG-jFp^K_v^F8"MWZuh[+^c2D',
            self::ALPHABET  => 'osiqBkl5RaTtOS1wjAy3KgDJpFGWvPYX9Lhd46mVNEQ0c8fU7zZ2HnMxbCIrue',
            self::DIGITS    => 6,
        ],
    ];

    private const
        SALT     = 1,
        ALPHABET = 2,
        DIGITS   = 3;

    protected static array $hashids = [];

    private static function getHashids(string $service): Hashids
    {
        $p = self::PARAMS[$service];
        return self::$hashids[$service] ??= new Hashids(
            $p[self::SALT],
            $p[self::DIGITS],
            $p[self::ALPHABET]
        );
    }

    public static function encode(string $service, int ...$ids): string
    {
        return self::getHashids($service)->encode($ids);
    }

    public function decode(string $service, string $hash): array
    {
        return self::getHashids($service)->decode($hash);
    }
}
