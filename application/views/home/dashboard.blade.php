@include('global.head')

@include('global.sidenav')

<div id="styx">
	@include('global.header')

	<div id="content">
		
		<section>
			
			<div>
				<h1>Content</h1>
			</div>

		</section>

		<aside>

			<div>
				{{ HTML::link('deployments/create', 'Create New Deployment', array('class' => 'button')) }}
			</div>
		
		</aside>

	</div>

</div>

@include('global.footer')
