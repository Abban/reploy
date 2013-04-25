@include('global.head')

@include('global.sidenav')

<div id="styx">
	@include('global.header')
	
	<div id="content">
		
		<div>
			<h1>{{ $deployment->name }}</h1>
		</div>

		<section>
			<div>
				

			</div>

		</section>

		<aside>

			<div>
				{{ HTML::link('deployments/edit/' .$deployment->id, 'Edit this Deployment', array('class' => 'button')) }}
			</div>
		
		</aside>

	</div>
</div>

@include('global.footer')
