<?php

class Member_Deployment extends Eloquent {

	public static $table = 'member_deployment';
    
    public function member()
    {
        return $this->has_one('Member');
    }
     
    public function deployment()
    {
        return $this->has_one('Deployment');
    }
}