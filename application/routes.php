<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::get('/', 'home@index');
Route::get('login', 'home@login');
Route::get('auth', 'home@auth');

Route::filter('oauth', function()
{
	if(!Session::has('is_logged_in')) return Redirect::to('/login');
});

Route::filter('api', function()
{
	//Event::override('laravel.done', function(){});
	//if(!Session::has('is_logged_in')) return Response::json(['error' => true], 401);
});

Route::group(array('before' => 'oauth'), function()
{
	Route::get('dashboard', 'home@dashboard');
	Route::get('logout', 'home@logout');

	// Repos
	Route::any('repositories', 'repositories@index');
	Route::get('repositories/view/(:all)', 'repositories@view');

	// Deployments
	Route::any('deployments', 'deployments@index');
	Route::get('deployments/view/(:num)', 'deployments@view');
	Route::get('deployments/create', 'deployments@create');
	Route::post('deployments/create', array('before' => 'csrf', 'uses' => 'deployments@create'));
	Route::get('deployments/edit/(:num)', 'deployments@edit');
	Route::post('deployments/edit/(:num)', array('before' => 'csrf', 'uses' => 'deployments@edit'));
	Route::get('deployments/delete/(:num)', 'deployments@delete');
	Route::get('deployments/deploy/(:num)/(:any)', 'deployments@deploy');

	// Other pages
	Route::any('settings', 'settings@index');
	Route::any('about', 'pages@about');
});

Route::group(array('before' => 'api'), function()
{
	Route::get('api/repositories', 'api@repositories');
	Route::get('api/branches/(:all)', 'api@branches');
});


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});