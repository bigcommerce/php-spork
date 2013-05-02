<?php

namespace Spork;

class ProcessTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCallWhenPctnlDoesntExist()
    {
        if (function_exists('pcntl_fork')) {
            $this->markTestSkipped('test ineffective when pcntl_fork is present');
        }

        $child = false;

        if (Process::parent($child_pid)) {
            // nothing
        } else {
            $child = true;
        }

        $this->assertTrue($child);
    }

    public function testCanForkWhenPctnlExists()
    {
        if (!function_exists('pcntl_fork')) {
            $this->markTestSkipped('pcntl_fork not available for test');
        }

        $forked = false;

        if (Process::parent($child_pid)) {
            $forked = true;
        } else {
            // exiting so that the child process doesn't interrupt phpunit
            exit;
        }

        $this->assertTrue($forked);
    }

    public function testChildPidPopulatedOnFork()
    {
        if (!function_exists('pcntl_fork')) {
            $this->markTestSkipped('pcntl_fork not available for test');
        }

        $child_pid = 0;

        if (Process::parent($child_pid)) {
            // nothing
        } else {
            // exiting so that the child process doesn't interrupt phpunit
            exit;
        }

        $this->assertGreaterThan(0, $child_pid);
    }
}