<?php

function autoload($classname) {
  if (file_exists($file = __DIR__ . '/' . $classname . '.php')) {
    require_once $file;
  }
}

spl_autoload_register('autoload');
