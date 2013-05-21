<?php

class Api_Controller extends Base_Controller {

	public function action_repositories()
	{
		$github = new Github();
		$repos = array();
		foreach($github->repos() as $repo){
			$repos[] = array(
				'name' => $repo->name,
				'fullname' => $repo->full_name
			);
		}
		return Response::json(
			[
				'error' => false,
				'repos' => $repos
			],
			200
		);
	}

	public function action_branches($name)
	{
		$github = new Github();
		$branches = array();
		foreach($github->branches($name) as $branch){
			$branches[] = array(
				'name' => $branch->name,
			);
		}
		return Response::json(
			[
				'error' => false,
				'branches' => $branches
			],
			200
		);
	}

	public function action_about()
	{
		return View::make('pages.about');
	}

}