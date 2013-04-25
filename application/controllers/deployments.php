<?php

class Deployments_Controller extends Base_Controller {

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
		$this->data['deployments'] = Deployment::where('member_id', '=', Session::get('user.id'))->get();
		return View::make('deployments.index', $this->data);
	}

	public function action_view($id = NULL)
	{
		if(!$id){
			Session::flash('message', 'That deployment does not exist.');
		    return Redirect::to('/deployments');
		}

		if(!$this->data['deployment'] = Deployment::find($id)->where('member_id', '=', Session::get('user.id'))->first())
		{
			Session::flash('message', 'You are not allowed to edit that deployment.');
		    return Redirect::to('/deployments');
		}
		else
		{
			return View::make('deployments.view', $this->data);
		}
	}

	public function action_create()
	{
		return $this->action_edit();
	}

	public function action_edit($id = NULL)
	{
		$d = ($id) ? Deployment::find($id)->where('member_id', '=', Session::get('user.id'))->first() : new Deployment();

		if($post = Input::get())
		{
			if($d->validate($post))
			{
				$d->member_id = Session::get('user.id');
				$d->name      = Input::get('name');
				$d->host      = Input::get('host');
				$d->path      = Input::get('path');
				$d->username  = Input::get('username');
				$d->password  = Input::get('password');
				$d->port      = Input::get('port');
			    $d->save();

			    Session::flash('message', 'Your deployment was saved.');
			    return Redirect::to('/deployments/edit/' .$d->id);
			}
			else
			{
				Input::flash();
			    $this->data['errors'] = $d->errors();
			}
		}
		$this->data['deployment'] = $d;
		return View::make('deployments.edit', $this->data);
	}
}