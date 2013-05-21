@include('global.head')
@include('global.header')
	

<div class="title">
	<div>
		<h1>Settings</h1>
	</div>
</div>

<section>
	<div>

		{{ Form::open() }}

		<ul>
			<li>
				{{ Form::label('name', 'Deployment Name:') }}
				<div class="field">
					{{ Form::text('name', Input::old('name', '')) }}
					{{ $errors->first('name') }}
				</div>
			</li>
			<li class="form_submit">
				{{ Form::token() }}
				{{ Form::submit('Save Settings') }}
			</li>
		</ul>

		{{ Form::close() }}
	</div>

</section>

<aside>

	<div>
		<p>Lorem ipsum Excepteur enim sed minim elit nostrud dolor est dolor labore proident. Lorem ipsum Non cillum in aliqua ut minim in anim.</p>
	</div>

</aside>

@include('global.footer')
