<?php

class Home_Controller extends Base_Controller {

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

	public function action_index()
	{
		return View::make('home.index');
	}

	public function action_login()
	{
		return View::make('home.login');
	}

	public function action_auth()
	{
	    Bundle::start('laravel-oauth2');

	    $provider = OAuth2::provider('github', array(
			'id'           => '0133deb451435c48cb04',
			'secret'       => '27e9749621c5d16672eccd81de6f37f3fdc1f8f1',
			'redirect_uri' => URL::to('login')
	    ));

	    if ( ! isset($_GET['code']))
	    {
	        // By sending no options it'll come back here
	        return $provider->authorize();
	    }
	    else
	    {
	        // Howzit?
	        try
	        {
	            $params = $provider->access($_GET['code']);

	            $token = new OAuth2_Token_Access(array('access_token' => $params->access_token));
	            $user = $provider->get_user_info($token);

	            // look for user in database if not found add their name and id from github
	            $member = Member::where('gh_id', '=', $user['uid'])->first();
	            if(!$member)
	            {
	            	$member = new Member();
	            	$member->nickname = $user['nickname'];
	            	$member->name = $user['name'];
	            	$member->email = $user['email'];
	            	$member->gh_id = $user['uid'];
		            $member->access_token = $token->access_token;
		            $member->save();
	            }

	            if($token->access_token != $member->access_token){
	            	$member->access_token = $token->access_token;
		            $member->save();
	            }

	            Session::put('is_logged_in', true);
	            Session::put('user.access_token', $member->access_token);
	            Session::put('user.gh_id', $member->gh_id);
	            Session::put('user.id', $member->id);
	            Session::put('user.name', $member->name);
	            Session::put('user.nickname', $member->nickname);

	            return Redirect::to('/dashboard');
	        }



	        catch (OAuth2_Exception $e)
	        {
	            show_error('That didnt work: '.$e);
	        }

	    }
	}

	public function action_dashboard()
	{
		return View::make('home.dashboard');
	}

	public function action_logout()
	{
		Session::flush();
		return Redirect::to('/');
	}

	private function _debug($obj){
		echo '<pre>';
		print_r($obj);
		echo '</pre>';
	}

}