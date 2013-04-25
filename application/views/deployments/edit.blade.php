@include('global.head')

@include('global.sidenav')

<div id="styx">
	@include('global.header')
	
	<div id="content">
		
		<div>
			<h1>Create Deployment</h1>
		</div>

		<section>
			<div>
				
				@if (Session::has('message'))
					<div class="message">
						{{ Session::get('message') }}
					</div>
				@endif

				{{ Form::open() }}

				<ul>
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
							{{ Form::text('port', Input::old('port', $deployment->port)) }}
							{{ $errors->first('port') }}
						</div>
					</li>
					<li class="form_submit">
						{{ Form::token() }}
						{{ Form::submit('Submit') }}
						{{ HTML::link(URL::current(), 'Test Connection', array('class' => 'button')) }}
					</li>
				</ul>

				{{ Form::close() }}
			</div>

		</section>

		<aside>

			<div>
				<p>Lorem ipsum Laboris aliquip ullamco id eu minim ex in aliquip sint proident occaecat. Lorem ipsum Elit adipisicing Excepteur sint eu do labore elit.</p>
				<p>Lorem ipsum Proident mollit enim consequat sit eiusmod reprehenderit. Lorem ipsum Ut eiusmod ad minim commodo irure elit.</p>
			</div>
		
		</aside>

	</div>
</div>

@include('global.footer')
