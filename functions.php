<?php

/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

require 'vendor/autoload.php';

// Remove functionality that isn't needed.
new Wp\Cleanup();

// Setup theme.
new Wp\Theme();
