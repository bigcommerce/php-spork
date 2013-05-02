<?php

namespace Spork;

class ProcessTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCallWhenPctnlDoesntExist()
    {
        if (function_exists('pcntl_fork')) {
            $this->markTestSkipped();
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
            $this->markTestSkipped();
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
            $this->markTestSkipped();
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

    public function testForkedPopulatedOnFork()
    {
        if (!function_exists('pcntl_fork')) {
            $this->markTestSkipped();
        }

        $forked = null;

        if (Process::parent($child_pid, $forked)) {
            // nothing
        } else {
            // exiting so that the child process doesn't interrupt phpunit
            exit;
        }

        $this->assertTrue($forked);
    }

    public function testCanForkWithNoArguments()
    {
        if (!function_exists('pcntl_fork')) {
            $this->markTestSkipped();
        }

        if (Process::parent()) {
            // nothing
        } else {
            // exiting so that the child process doesn't interrupt phpunit
            exit;
        }
    }
}
