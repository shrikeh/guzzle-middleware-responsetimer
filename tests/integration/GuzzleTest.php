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
namespace Tests\Shrikeh\GuzzleMiddleware\TimerLogger;

use Blackfire\Profile;

class GuzzleTest extends \Codeception\Test\Unit
{
    use \Blackfire\Bridge\PhpUnit\TestCaseTrait;


    /**
     * @var \Tests\Shrikeh\GuzzleMiddleware\TimerLogger\IntegrationDeveloper
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testBlackfire()
    {

    }
}
