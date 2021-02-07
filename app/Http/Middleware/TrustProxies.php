<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

/**
 * Class TrustProxies
 *
 * @package App\Http\Middleware
 */
class TrustProxies extends Middleware
{
    /**
     * @var string[]
     */
    protected $proxies = [
        //
    ];

    /**
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR
    | Request::HEADER_X_FORWARDED_HOST
    | Request::HEADER_X_FORWARDED_PORT
    | Request::HEADER_X_FORWARDED_PROTO
    | Request::HEADER_X_FORWARDED_AWS_ELB;

}
