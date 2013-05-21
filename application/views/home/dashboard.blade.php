@include('global.head')
@include('global.header')
		
<div>
	<h1>Content</h1>
</div>

<section>
	
	<div>

		<p>Proof of concept</p>

<pre style="font-size:small; padding: 10px; background:#ddd">
// Get entire repo from github
$github = new Github();
$github->zipball('https://github.com/Abban/jQuery-Picture/archive/master.zip', 'bundle', path('storage').'github/extracted');

// FTP connection
$ftp = SFTP::make('ftp.d1025943-59.cp.blacknight.com', 'abandonab', 'gFeEDX72AQKvpdEr');

// connect to FTP server
if($ftp->connect()) {
print "Connection successful";

$ftp->cd("/webspace/httpdocs/sample");

$ftp->rename("test.txt", "testtest.txt");

// download a file from FTP server
// will download file "somefile.php" and  
// save locally as "localfile.php"
if($ftp->get("test.txt", "test.txt")) {
print "File downloaded";
} else {
print "Download failed: " . $ftp->error;
}

// upload file to FTP server
// will upload file "local.php" and
// save remotely as "remote.php"
if($ftp->put_folder(path('storage'). 'github/extracted')) {
print "Filed uploaded";
} else {
print "Upload failed: " . $ftp->error;
}
} else {
// connection failed, display last error
print "Connection failed: " . $ftp->error;
}
</pre>


	</div>

</section>

<aside>

	<div>
		{{ HTML::link('deployments/create', 'Create New Deployment', array('class' => 'button')) }}
	</div>

</aside>

@include('global.footer')
