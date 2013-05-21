@include('global.head')
@include('global.header')

<div class="title">
	<div>
		<h1>Repositories</h1>
	</div>
</div>
		
<section class="full_width">
	
	<div>
		
		@foreach ($repos as $repo)

			<div class="repository">
				
				<div class="repository_name">{{ HTML::link('repositories/view/' .$repo->name, $repo->full_name) }}</div>

				<div class="meta">
					<strong>Last Commit:</strong> {{ DateFmt::Format('AGO[d.h]IF>6[on d##/mo##/Y##]', strtotime($repo->pushed_at)) }}
				</div>

				<div class="tools">
					{{ HTML::link('deployments/create/', 'Create Deployment', array('class' => 'button')) }}
				</div>

			</div>
		@endforeach

	</div>

</section>

@include('global.footer')