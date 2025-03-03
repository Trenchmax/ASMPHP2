<?php
session_start();

use FastRoute\RouteCollector;
use League\Plates\Extension\URI;
use Src\Controllers\Client\HomeController;
use Src\Controllers\Client\ProductController;
use Src\Controllers\Client\CheckoutController;
use Src\Controllers\Client\CartController;
use Src\Controllers\Client\AboutController;
use Src\Controllers\Client\ContactController;
use Src\Controllers\Client\OrderController;
use Src\Controllers\Client\AuthController;
use Src\Helpers\NotFoundHelper;
use Src\Controllers\Client\UserController as uerCon;
use Src\Controllers\Admin\DashboardController;
use Src\Controllers\Admin\VouchersController;
use Src\Controllers\Admin\UserController;
use Src\Controllers\Admin\ProductsController;
use Src\Controllers\Admin\OrdersController;
use Src\Controllers\Admin\BrandController;
use Src\Controllers\Admin\CommentController;
use Src\Controllers\Admin\CategoryController;
use Src\Controllers\Admin\AttributeController;
require_once 'vendor/autoload.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', TRUE);
ini_set('error_log', './logs/php-errors.log');


Src\Helpers\Client\AuthHelper::middleware();


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();




//Router

$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET', '/home', [HomeController::class, 'show']);
    $r->addRoute('GET', '/', [HomeController::class, 'show']);
    $r->addRoute('GET', '/404', [NotFoundHelper::class, 'show']);
    $r->addRoute('GET', '/productList', [ProductController::class, 'show']);
    $r->addRoute('GET', '/productCategory/{id}', [ProductController::class, 'showByCategory']);
    $r->addRoute('GET', '/product/detail/{id}', [ProductController::class, 'detail']);
    $r->addRoute('GET', '/checkout', [CheckoutController::class, 'show']);
    $r->addRoute('GET', '/cart', [CartController::class, 'show']);
    $r->addRoute('GET', '/about', [AboutController::class, 'show']);
    $r->addRoute('GET', '/contact', [ContactController::class, 'show']);
    $r->addRoute('GET', '/Account', [uerCon::class, 'index']);
    $r->addRoute('GET', '/Address', [uerCon::class, 'userAddress']);
    $r->addRoute('GET', '/Orders', [OrderController::class, 'show']);
    $r->addRoute('GET', '/resetPass', [AuthController::class, 'resetPassForm']);
    $r->addRoute('GET', '/registerForm', [AuthController::class, 'registerForm']);
    $r->addRoute('GET', '/loginForm', [AuthController::class, 'loginForm']);
    $r->addRoute('GET', '/logout', [AuthController::class, 'logout']);
    $r->addRoute('POST', '/login', [AuthController::class, 'login']);
    $r->addRoute('POST', '/register', [AuthController::class, 'register']);
    $r->addRoute('POST', '/update-information', [AuthController::class, 'updateInformation']);
    $r->addRoute('POST', '/cart/delete', [CartController::class, 'deleteOneCart']);
    $r->addRoute('POST', '/cart/delete-all', [CartController::class, 'deleteAllCart']);
    $r->addRoute('POST', '/cart/create', [CartController::class, 'store']);
    $r->addRoute('POST', '/checkout/process', [CheckoutController::class, 'processCheckout']);
    $r->addRoute('POST', '/cancel/order/{id}', [OrderController::class, 'cancel']);
 

    $r->get('/admin', [DashboardController::class, 'show']);
    $r->get('/admin/dashboard', [DashboardController::class, 'show']);
    $r->get('/admin/vouchers', [VouchersController::class, 'show']);
    $r->get('/admin/users', [UserController::class, 'show']);
    $r->get('/admin/users/edit/{id}', [UserController::class, 'edit']);
    $r->get('/admin/users/delete/{id}', [UserController::class, 'delete']);

    $r->get('/admin/create-user', [UserController::class, 'add']);
    $r->get('/admin/products', [productsController::class, 'show']);
    $r->get('/admin/product/add', [productsController::class, 'add']);
    $r->get('/admin/product/delete/{id}', [productsController::class, 'delete']);
    $r->get('/admin/product/edit/{id}', [productsController::class, 'edit']);

    $r->get('/admin/allattribute', [UserController::class, 'show']);
    $r->get('/admin/attribute', [AttributeController::class, 'add']);
    $r->get('/admin/categories', [CategoryController::class, 'show']);
    $r->get('/admin/category/add', [CategoryController::class, 'add']);
    $r->get('/admin/category/edit/{id}', [CategoryController::class, 'edit']);
    $r->get('/admin/category/delete/{id}', [CategoryController::class, 'delete']);
    $r->get('/admin/brands', [BrandController::class, 'show']);
    $r->get('/admin/brand/add', [BrandController::class, 'add']);
    $r->get('/admin/brand/edit/{id}', [BrandController::class, 'edit']);
    $r->get('/admin/brand/delete/{id}', [BrandController::class, 'delete']);
    $r->get('/admin/comments', [CommentController::class, 'show']);
    $r->get('/admin/orders', [OrdersController::class, 'show']);
    $r->get('/admin/orderDetails/{id}', [OrdersController::class, 'detail']);
    $r->post('/admin/orders/updateStatus', [OrdersController::class, 'updateStatus']);

    $r->post('/admin/category/create', [CategoryController::class, 'create']);
    $r->post('/admin/category/update/{id}', [CategoryController::class, 'update']);
    $r->post('/admin/brand/update/{id}', [BrandController::class, 'update']);
    $r->post('/admin/brand/create', [BrandController::class, 'create']);
    $r->post('/admin/user/add', [UserController::class, 'create']);
    $r->post('/admin/user/update/{id}', [UserController::class, 'update']);
    $r->post('/admin/product/update/{id}', [productsController::class, 'update']);
    $r->post('/admin/product/create', [productsController::class, 'create']);

});

















$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        header("Location: /404");
        exit;
    
    
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo 'Forbidden Method';
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $method = $handler[1];
        // ... call $handler with $vars

        $controller = new $handler[0];
        $controller->$method($vars);
        break;
}
