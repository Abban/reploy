<?php

class Repositories_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	private $data = array();

	public function action_index()
	{
		$github = new Github();
		$this->data['repos'] = $github->repos();
		return View::make('repositories.index', $this->data);
	}

	public function action_view($name)
	{
		$github = new Github();
		$this->data['repository'] = $github->repo($name);
		$this->data['branches'] = $github->branches($name);
		return View::make('repositories.view', $this->data);
	}

}