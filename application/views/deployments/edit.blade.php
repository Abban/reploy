@include('global.head')
@include('global.header')

<div class="title">
	<div>
		<h1>{{ $title }}</h1>
	</div>
</div>

<section>
	<div>

		{{ Form::open() }}

		<ul>
			<li>
				<div class="half first">
					{{ Form::label('repository', 'Select Repository:') }}
					<div class="field">
						{{ Form::select('repository', $repos, $deployment->repository); }}
						{{ $errors->first('repository') }}
					</div>
				</div>
				<div class="half last">
					{{ Form::label('branch', 'Select Branch:') }}
					<div class="field" id="branches">
						{{ Form::select('branch', $branches, $deployment->branch); }}
						{{-- Form::text('branch', Input::old('branch', $deployment->branch)) --}}
						{{ $errors->first('branch') }}
					</div>
				</div>
			</li>
			<li>
				{{ Form::label('name', 'Deployment Name:') }}
				<div class="field">
					{{ Form::text('name', Input::old('name', $deployment->name)) }}
					{{ $errors->first('name') }}
				</div>
			</li>
			<li>
				{{ Form::label('host', 'FTP Host:') }}
				<div class="field">
					{{ Form::text('host', Input::old('host', $deployment->host)) }}
					{{ $errors->first('host') }}
				</div>
			</li>
			<li>
				{{ Form::label('path', 'FTP Path:') }}
				<div class="field">
					{{ Form::text('path', Input::old('path', $deployment->path)) }}
					{{ $errors->first('path') }}
				</div>
			</li>
			<li>
				{{ Form::label('username', 'FTP Username:') }}
				<div class="field">
					{{ Form::text('username', Input::old('username', $deployment->username)) }}
					{{ $errors->first('username') }}
				</div>
			</li>
			<li>
				{{ Form::label('password', 'FTP Password:') }}
				<div class="field">
					{{ Form::input('password', 'password', Input::old('password', $deployment->password)) }}
					{{ $errors->first('password') }}
				</div>
			</li>
			<li>
				{{ Form::label('port', 'FTP Port:') }}
				<div class="field">
					{{ Form::text('port', '21', array('readonly')) }}
					{{ $errors->first('port') }}
				</div>
			</li>
			<li class="form_submit">
				{{ Form::token() }}
				{{ Form::submit('Save Deployment') }}
				{{ HTML::link(URL::current(), 'Test Connection', array('class' => 'button')) }}
			</li>
		</ul>

		{{ Form::close() }}
	</div>

</section>

<aside>

	<div>
		@if ($deployment->id)
			{{ HTML::link('deployments/auto/' .$deployment->id, 'Turn on Autodeploy', array('class' => 'button')) }}
			{{ HTML::link('deployments/delete/' .$deployment->id, 'Delete this Deployment', array('class' => 'button')) }}
			<small>The webhook URL for this deployment is:</small>
			<code>{{ URL::to('deployments/notify/' .$deployment->id) }}</code>
		@endif
	</div>

</aside>

<script>
	
	$(function(){
		$('#repository').change(function(){
			var repo = $(this).val();
			$.ajax({
				url: window.site_url + '/api/branches/' + repo,
				dataType: "json",
				cache: false,
				success: function(data){
					if(data.error){
						alert('Something not working!');
					}else{
						$('#branch').empty();
						$('#branch').append('<option value="">Select Branch</option>');
						$.each(data.branches, function(key, value){
						    $('#branch').append('<option value="' + value.name + '">' + value.name + '</option>');
						});
					}
				},
				error: function(){
					alert('Something not working!');
				},
				complete: function(){
				}
			});
		});
	});

</script>

@include('global.footer')
