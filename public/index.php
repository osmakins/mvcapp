<?php
  declare(strict_types=1);

  require_once dirname(__DIR__) . '/vendor/autoload.php';

  // importing namespaces
  use DI\ContainerBuilder;
  use App\Controller\MainController;
  use function DI\create;

  // configure and build the container
  $containerBuilder = new ContainerBuilder();
  $containerBuilder->useAutowiring(false);
  $containerBuilder->useAnnotations(false);
  $containerBuilder->addDefinitions([
    MainController::class => create(MainController::class)
  ]);

  $container = $containerBuilder->build();

  $message = $container->get(MainController::class);
  $message->message();
?>