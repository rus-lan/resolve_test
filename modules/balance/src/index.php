<?php

namespace Ifmo\ResolveTest;

use function TarsyClub\Framework\front_controller;

require_once dirname(__DIR__) . '/vendor/autoload.php';

/** @noinspection PhpUnhandledExceptionInspection */
front_controller(parameters(), __FILE__, '../.env');
