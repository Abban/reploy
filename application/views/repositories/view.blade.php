@include('global.head')
@include('global.header')
		
<div class="title">
	<div>
		<h1>Branches for: {{ $repository->full_name }}</h1>
	</div>
</div>

<section class="full_width">
	
	<div>
		
		@foreach ($branches as $branch)

			<div class="branch">
				
				<div class="branch_name">{{ HTML::link($branch->commit->url, $branch->name) }}</div>

				<div class="tools">
					{{ HTML::link('deployments/create/', 'Create Deployment', array('class' => 'button')) }}
				</div>

			</div>

		@endforeach

	</div>

</section>

@include('global.footer')