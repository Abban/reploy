<header id="worlds_birth">

	<div>
			
		<div>
			
			<figure id="logo">
				<a href="{{ URL::to('dashboard') }}">{{ HTML::image('assets/images/logo.png', 'Reploy') }}</a>
			</figure>
			
			<div>
				Deploy your Github repositories
			</div>

			{{ HTML::link('logout', 'Log Out', array('id' => 'logout', 'class' => 'button')) }}
			
		</div>
	
	</div>

</header>

<div id="content">
	@include('global.message')
	@include('global.nav')