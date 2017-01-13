<?php
require __DIR__.'/vendor/autoload.php';


$app= new Slim\App();


$configDB = array(
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'sovp',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
);

new \Pixie\Connection('mysql', $configDB, '\DB');

$app->get('/',function ($request, $response, $args) {
    $data=['API'=>'sovp-json','version'=>'1.0.1'];
    return  $response->withJson($data);

});


/**
 * @var data all users from FosUserBundle by desc
 * @param $request
 * @param $response
 * @param $args
*/
$app->get(
    '/users', function ($request, $response, $args) {

   $data = DB::table('fos_user')->limit(5)->orderBy('id','desc')->get();
   header('Access-Control-Allow-Origin: *');
   return dump($data);
    // return  $response->withJson($data);

});

/**
 * @var data  All contact from Sovp App
 * @param $request
 * @param $response
 * @param $args
 */
$app->get('/contact', function ($request, $response, $args) {

    $data = DB::table('ad')->orderBy('id','desc')->get();
    header('Access-Control-Allow-Origin: *');
    return $response->withJson($data);

});

$app->run();
