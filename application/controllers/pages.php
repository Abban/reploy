<?php

class Pages_Controller extends Base_Controller {

	private $data = array();

	public function action_index()
	{
		return View::make('settings.index');
	}

	public function action_about()
	{
		$github = new Github();
		$this->data['collaborators'] = $github->collaborators('reploy');
		return View::make('pages.about', $this->data);
	}

}