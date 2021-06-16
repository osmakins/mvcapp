<?php
  declare(strict_types=1);

  require_once dirname(__DIR__) . '/vendor/autoload.php';

  // importing namespaces
  use DI\ContainerBuilder;
  use App\Controller\MainController;
  use FastRoute\RouteCollector;
  use Middlewares\FastRoute; // new major version uses PSR-17 (2.x)
  use Middlewares\RequestHandler; // new major version uses PSR-17 (2.x)
  use Relay\Relay;
  use Zend\Diactoros\ServerRequestFactory; // zend now abandoned check laminas
  use Zend\Diactoros\Response; // zend now abandoned check laminas
  use function DI\create;
  use function DI\get;
  use function FastRoute\simpleDispatcher;

  // configure and build the container
  $containerBuilder = new ContainerBuilder();
  $containerBuilder->useAutowiring(false);
  $containerBuilder->useAnnotations(false);
  $containerBuilder->addDefinitions([
    MainController::class => create(MainController::class)
    ->constructor(get('Foo'), get('Response')),
    'Foo' => 'bar', 'Response' => function(){
      return new Response();
    }, //dependency injection
  ]);

  $container = $containerBuilder->build();

  $routes = simpleDispatcher(function(RouteCollector $r){
    $r->get('/hello', MainController::class);
  });

  $middlewareQueue[] = new FastRoute($routes);
  $middlewareQueue[] = new RequestHandler($container);

  $requestHandler = new Relay($middlewareQueue);

  $requestHandler->handle(ServerRequestFactory::fromGlobals());

  // $message = $container->get(MainController::class);
  // $message->message();
?>