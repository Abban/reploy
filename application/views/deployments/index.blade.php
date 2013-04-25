@include('global.head')

@include('global.sidenav')

<div id="styx">
	@include('global.header')
	
	<div id="content">
		
		<div>
			<h1>Deployments</h1>
		</div>

		<section>
			<div>
				
				@foreach ($deployments as $deployment)

					{{ HTML::link('deployments/view/' .$deployment->id, $deployment->name) }}

				@endforeach

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
