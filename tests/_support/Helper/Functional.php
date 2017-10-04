<?php
namespace Tests\Shrikeh\GuzzleMiddleware\TimerLogger\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Functional extends \Codeception\Module
{
    /**
     * @var \SplFileObject
     */
    private $logFile;

    /**
     * @param array $settings
     */
    public function _beforeSuite($settings = [])
    {
        $logPath = getenv('TEST_OUTPUT_LOG_PATH');

        if(!is_dir(dirname($logPath))) {
            mkdir(dirname($logPath));
        }

        $this->logFile = new \SplFileObject(
            $logPath,
            'w+'
        );
    }

    public function logFile()
    {
        return $this->logFile;
    }


}
