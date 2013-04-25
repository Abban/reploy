<nav id="charon">
	<figure>
		<a href="{{ URL::to('dashboard') }}">{{ HTML::image('assets/images/donkey.png', 'Donkey') }}</a>
	</figure>
	<ul>
		<li>{{ HTML::link('deployments', 'Deploy') }}</li>
		<li>{{ HTML::link('settings', 'Settings') }}</li>
		<li>{{ HTML::link('about', 'About') }}</li>
	</ul>
	<small>{{ Session::get('user.name') }}</small>
</nav>