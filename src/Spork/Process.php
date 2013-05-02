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
     * @param  int  $child_pid reference set to child PID in the parent branch
     * @param  bool $forked    reference set in both branches to TRUE if forking worked, otherwise FALSE
     * @return TRUE in the parent when a child was forked, otherwise FALSE
     */
    public static function parent (&$child_pid = null, &$forked = null)
    {
        if (!function_exists('pcntl_fork')) {
            $forked = false;

            return false;
        }

        $pid = pcntl_fork();

        if ($pid == -1) {
            // forking failed
            $forked = false;

            return false;
        }

        if ($pid == 0) {
            // forked ok; this is the child process
            $forked = true;

            return false;
        }

        // forked ok; this is the parent process
        $child_pid = $pid;
        $forked = true;

        return true;
    }
}
