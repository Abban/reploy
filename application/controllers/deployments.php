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
		$this->data['deployments'] = Member::find(Session::get('user.id'))->deployments()->get();
		return View::make('deployments.index', $this->data);
	}

	public function action_view($id = NULL)
	{
		if(!$id)
		{
			Session::flash('message', 'That deployment does not exist.');
		    return Redirect::to('/deployments');
		}

		if(!$this->data['deployment'] = Member::find(Session::get('user.id'))->deployments()->where('deployment_id', '=', $id)->first())
		{
			Session::flash('message', 'You are not allowed to view this deployment.');
		    return Redirect::to('/deployments');
		}
		else
		{
			$github = new Github();
			$this->data['commits'] = $github->commits($this->data['deployment']->repository);
			return View::make('deployments.view', $this->data);
		}
	}

	public function action_create()
	{
		return $this->action_edit();
	}

	public function action_edit($id = NULL)
	{
		$m = Member::find(Session::get('user.id'));
		$d = ($id) ? $m->deployments()->where('deployment_id', '=', $id)->first() : new Deployment();

		if($post = Input::get())
		{
			if($d->validate($post))
			{
				$deployment = array(
					'name'       => Input::get('name'),
					'repository' => Input::get('repository'),
					'branch'     => Input::get('branch'),
					'host'       => Input::get('host'),
					'path'       => Input::get('path'),
					'username'   => Input::get('username'),
					'password'   => Input::get('password'),
					'port'       => Input::get('port'),
				);
				($id) ? $d->fill($deployment)->save() : $m->deployments()->insert($deployment);

			    Session::flash('message', 'Your deployment was saved.');
			    return Redirect::to('/deployments');
			}
			else
			{
				Input::flash();
			    $this->data['errors'] = $d->errors();
			}
		}

		$github = new Github();
		$this->data['repos'][''] = 'Select Repository';
		foreach($github->repos() as $repo)
		{
			$this->data['repos'][$repo->name] = $repo->full_name;
		}

		$this->data['branches'][''] = 'Select Branch';
		if($id){
			foreach($github->branches($d->repository) as $branch)
			{
				$this->data['branches'][$branch->name] = $branch->name;
			}
		}

		$this->data['title'] = ($id) ? 'Edit: ' .$d->name : 'Create New Deployment';
		$this->data['deployment'] = $d;
		return View::make('deployments.edit', $this->data);
	}

	public function action_delete($id)
	{
		Member::find(Session::get('user.id'))->deployments()->where('deployment_id', '=', $id)->first()->delete();

		Session::flash('message', 'Your deployment was deleted.');
	    return Redirect::to('/deployments');
	}
}