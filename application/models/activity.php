<?php

class Member extends Eloquent {

	public static $table = 'activity';
	
	public function deployments()
    {
          return $this->has_one('Deployment');
    }

    public function members()
    {
          return $this->has_one('Member');
    }

}