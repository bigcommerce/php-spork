# Spork

[![Build Status](https://secure.travis-ci.org/gwilym/php-spork.png)](http://travis-ci.org/gwilym/php-spork)

Spoon-fed process forking for PHP.

I got sick of writing the same process fork-and-check pattern over and over and
so I made Spork.

Use `Spork\Process::parent` in a control structure to access the parent process when a
child is successfully forked. In all other cases—including when pcntl is not
available—the `FALSE` case can be used instead.

I'm sure there's already another PHP project named Spork somewhere out there,
but I don't expect this to get a wide audience.

### Example

```
if (Spork\Process::parent($child_pid)) {
    // this is the parent process with $child_pid populated
} else {
    // this is the child process, or forking failed
}
```
