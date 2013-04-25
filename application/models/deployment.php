<?php

class Deployment extends Eloquent {
	
	private $rules = array(
		'name'     => 'required|alpha|min:3',
		'host'     => 'required',
		'path'     => 'required',
		'username' => 'required',
		'password' => 'required',
		'port'     => 'required',
    );

    private $errors;

    public function member()
    {
          return $this->has_one('Member');
    }

    public function activity()
    {
          return $this->has_many('Activity');
    }

    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);

        if ($v->fails())
        {
        	error_log('validation failed');
            $this->errors = $v->errors;
            return false;
        }
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

}