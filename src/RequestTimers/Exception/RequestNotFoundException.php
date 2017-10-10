<?php
/**
 * @codingStandardsIgnoreStart
 *
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 *
 * @codingStandardsIgnoreEnd
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\Exception;

use Exception;
use Psr\Http\Message\RequestInterface;
use RuntimeException;

/**
 * Class RequestNotFoundException.
 */
final class RequestNotFoundException extends RuntimeException
{
    const MSG = 'A Request object for a request to %s could not be found';
    const CODE = 16;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * RequestNotFoundException constructor.
     *
     * @param RequestInterface $request The Request we can't find a timer for
     * @param \Exception       $e       A previous exception, if any
     */
    public function __construct(
        RequestInterface $request,
        Exception $e = null
    ) {
        $this->request = $request;

        parent::__construct(
            sprintf(self::MSG, $request->getUri()),
            self::CODE,
            $e
        );
    }

    /**
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}
