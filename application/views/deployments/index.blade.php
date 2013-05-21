@include('global.head')
@include('global.header')
		
<div class="title">
	<div>
		<h1>Deployments</h1>
		{{ HTML::link('deployments/create', 'Create New Deployment', array('class' => 'button')) }}
	</div>
</div>

<section class="full_width">
	<div>
		
		@if ($deployments)
			@foreach ($deployments as $deployment)
				
				<div class="deployment">
				
					<div class="deployment_name">{{ HTML::link('deployments/view/' .$deployment->id, $deployment->name) }}</div>

					<div class="meta">
						Authored {{ DateFmt::Format('AGO[d.h]IF>6[on d##/mo##/Y##]', strtotime($deployment->created_at)) }}
					</div>

					<div class="tools">
						{{ HTML::link('deployments/history/' .$deployment->id, 'History', array('class' => 'button')) }}
						{{ HTML::link('deployments/edit/' .$deployment->id, 'Edit', array('class' => 'button')) }}
					</div>

				</div>

			@endforeach
		@else
			You have no deployments yet, {{ HTML::link('deployments/create', 'add one now') }}.
		@endif

	</div>

</section>

@include('global.footer')
