<div id="charon">
	<nav>
		<ul>
			<li><a href="{{ URL::to('repositories') }}"@if (URI::segment(1) == 'repositories') class="current"@endif>Repositories</a></li>
			<li><a href="{{ URL::to('deployments') }}"@if (URI::segment(1) == 'deployments') class="current"@endif>Deployments</a></li>
			<li><a href="{{ URL::to('settings') }}"@if (URI::segment(1) == 'settings') class="current"@endif>Settings</a></li>
			<li><a href="{{ URL::to('about') }}"@if (URI::segment(1) == 'about') class="current"@endif>About</a></li>
		</ul>
	</nav>
</div>