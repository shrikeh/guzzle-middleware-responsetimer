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
namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception;

use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStartException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class FormatterStartExceptionSpec
 */
class FormatterStartExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FormatterStartException::class);
    }

    function it_is_a_runtime_exception()
    {
        $this->shouldHaveType(\RuntimeException::class);
    }
}
