<?php

class Member extends Eloquent {
	
	public function deployments()
    {
		return $this->has_many_and_belongs_to('Deployment', 'member_deployment', 'member_id', 'deployment_id');
    }

    public function history()
    {
		return $this->has_many('History');
    }

}