<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users',UserController::class);
    $router->resource('article',ArticleController::class);
    $router->resource('category',CategoryController::class);
    $router->resource('major',MajorController::class);
    $router->resource('build',BuildController::class);
    $router->resource('dorm',DormController::class);
    $router->resource('student',StudentController::class);
    $router->get('/api/student/dorm','StudentController@dorm');   
    $router->resource('foreign',ForeignController::class);
    $router->resource('repair',RepairController::class);
    $router->resource('disciplines',DisciplineController::class);
    $router->resource('question',QuestionController::class);
});

