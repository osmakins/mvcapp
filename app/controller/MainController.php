<?php
declare(strict_types=1);

namespace App\Controller;

class MainController{
  public function __invoke(): void {
    echo 'Hello, from the autoloaded';
    exit;
  }
}