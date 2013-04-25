<?php

class Member extends Eloquent {
	
	public function deployments()
    {
          return $this->has_many('Deployment');
    }

    public function activity()
    {
          return $this->has_many('Activity');
    }

}