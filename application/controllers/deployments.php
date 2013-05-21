<?php

class Deployments_Controller extends Base_Controller {

	private $data = array();

	/**
	 * index
	 *
	 * Loads the index page
	 * TODO: Add a list of general activity
	 * 
	 * @return string
	 */
	public function action_index()
	{
		$this->data['deployments'] = Member::find(Session::get('user.id'))->deployments()->get();
		return View::make('deployments.index', $this->data);
	}



	/**
	 * view
	 *
	 * Shows a the Github commits for a single deployment
	 * TODO: Mark the commit that was deployed last
	 * 
	 * @param  int $id
	 * @return string
	 */
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



	/**
	 * create
	 *
	 * Just calls the edit
	 * TODO: Maybe just move this to routes
	 * 
	 * @return void
	 */
	public function action_create()
	{
		return $this->action_edit();
	}



	/**
	 * edit
	 *
	 * Create or edit a new deployment
	 * 
	 * @param  int $id
	 * @return string
	 */
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
		if($id)
		{
			foreach($github->branches($d->repository) as $branch)
			{
				$this->data['branches'][$branch->name] = $branch->name;
			}
		}

		$this->data['title'] = ($id) ? 'Edit: ' .$d->name : 'Create New Deployment';
		$this->data['deployment'] = $d;
		return View::make('deployments.edit', $this->data);
	}



	/**
	 * delete
	 *
	 * Removes a repo
	 * TODO: Recursive delete of history?
	 * 
	 * @param  int $id
	 * @return void
	 */
	public function action_delete($id)
	{
		Member::find(Session::get('user.id'))->deployments()->where('deployment_id', '=', $id)->first()->delete();

		Session::flash('message', 'Your deployment was deleted.');
	    return Redirect::to('/deployments');
	}



	/**
	 * deploy
	 *
	 * Deploys the selected commit.
	 * TODO: Maybe make this ajax driven.
	 * TODO: Figure out an events model for this so there is a progress bar?
	 * 
	 * @param  int $id
	 * @param  hash $commit
	 * @return string
	 */
	public function action_deploy($id = NULL, $commit = NULL)
	{
		if(!$id || !$commit)
		{
			Session::flash('message', 'That repo or commit does not exist.');
		    return Redirect::to('/deployments');
		}
		else
		{
			if(!$d = Member::find(Session::get('user.id'))->deployments()->where('deployment_id', '=', $id)->first())
			{
				Session::flash('message', 'You are not allowed to view this deployment.');
			    return Redirect::to('/deployments');
			}
			else
			{
				$github = new Github();
				$this->data['commit'] = (!$d->last_deployment) ? $github->commit($d->repository, $commit) : $github->compare($d->repository, $commit, $d->last_deployment);
				$this->data['deployment'] = $d;
				return View::make('deployments.deploy', $this->data);
			}
		}
	}
}