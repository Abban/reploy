<?php

class History extends Eloquent {

	public static $table = 'history';
	
	public function member()
    {
        return $this->has_one('Member');
    }

    public function deployment()
    {
        return $this->has_one('Deployment');
    }

}