<?php

namespace Spork;

/**
 * Spoon-fed process forking. Useful when you don't care about whether forking
 * worked or not because a job has to be done in the 'child' branch regardless.
 *
 * Simplest usage:
 *
 * if (Spork\Process::parent($child_pid)) {
 *    // this is the parent process with $child_pid populated
 * } else {
 *    // this is the child process, or forking failed
 * }
 */
class Process
{
    /**
     * Attempts to fork a child process.
     *
     * @return TRUE in the parent when a child was forked, otherwise FALSE
     */
    public static function parent (&$child_pid)
    {
        if (!function_exists('pcntl_fork')) {
            return false;
        }

        $pid = pcntl_fork();

        if ($pid <= 0) {
            // fork failed or this is the child process
            return false;
        }

        // fork ok, this is the parent process
        $child_pid = $pid;

        return true;
    }
}
