<?php

class Github {

	private $base_url = 'https://api.github.com/';

    public function repos()
    {
    	$vars = array('type' => 'all', 'per_page' => 100);
		$url = $this->base_url .'user/repos';
		return $this->_request($url, $vars);
    }

    
    public function repo($name)
    {
	    // repos/:owner/:repo
		$url = $this->base_url .'repos/' .Session::get('user.nickname') .'/' .$name;
		return $this->_request($url);
    }

    public function branches($name)
    {
    	$url = $this->base_url .'repos/' .Session::get('user.nickname') .'/' .$name .'/branches';
    	return $this->_request($url);
    }

    public function downloads($name)
    {
    	$url = $this->base_url .'repos/' .Session::get('user.nickname') .'/' .$name .'/downloads';
    	return $this->_request($url);
    }

    public function commits($name)
    {
    	// repos/:owner/:repo/commits
    	$url = $this->base_url .'repos/' .Session::get('user.nickname') .'/' .$name .'/commits';
    	return $this->_request($url);
    }

    public function commit($name, $commit)
    {
    	// repos/:owner/:repo/commits/:sha
    	$url = $this->base_url .'repos/' .Session::get('user.nickname') .'/' .$name .'/commits/' .$commit;
    	return $this->_request($url);
    }

    public function compare($name, $commit, $last_commit)
    {
    	// repos/:owner/:repo/compare/:base...:head
    	$url = $this->base_url .'repos/' .Session::get('user.nickname') .'/' .$name .'/compare/' .$commit .'...' .$last_commit;
    	return $this->_request($url);
    }

    public function collaborators($name)
    {
    	// repos/:owner/:repo/collaborators
    	$url = $this->base_url .'repos/' .Session::get('user.nickname') .'/' .$name .'/collaborators';
    	return $this->_request($url);	
    }

    private function _request($url, $vars = NULL)
    {
    	$vars['access_token'] = Session::get('user.access_token');
    	$url .= '?' .http_build_query($vars);

    	$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
		);

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPGET, true);
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

		return json_decode(curl_exec($curl));
    }

    /**
     * zipball
     *
     * Hacking the bundle importer to grab a repo
     * 
     * @param  string $url
     * @param  string $bundle
     * @param  string $path
     * @return void
     */
    public function zipball($url, $bundle, $path)
	{
		$work = path('storage').'github/';

		// When installing a bundle from a Zip archive, we'll first clone
		// down the bundle zip into the bundles "working" directory so
		// we have a spot to do all of our bundle extraction work.
		$target = $work.'git-repo.zip';

		File::put($target, $this->download($url));

		$zip = new \ZipArchive;

		$zip->open($target);

		// Once we have the Zip archive, we can open it and extract it
		// into the working directory. By convention, we expect the
		// archive to contain one root directory with the bundle.
		mkdir($work.'zip');

		$zip->extractTo($work.'zip');

		$latest = File::latest($work.'zip')->getRealPath();

		@chmod($latest, 0777);

		// Once we have the latest modified directory, we should be
		// able to move its contents over into the bundles folder
		// so the bundle will be usable by the developer.
		File::mvdir($latest, $path);

		File::rmdir($work.'zip');

		$zip->close();
		//@unlink($target);
	}

	/**
	 * Download a remote zip archive from a URL.
	 *
	 * @param  string  $url
	 * @return string
	 */
	protected function download($url)
	{
		$remote = file_get_contents($url);

		// If we were unable to download the zip archive correctly
		// we'll bomb out since we don't want to extract the last
		// zip that was put in the storage directory.
		if ($remote === false)
		{
			throw new \Exception("Error downloading the requested bundle.");
		}

		return $remote;
	}

}