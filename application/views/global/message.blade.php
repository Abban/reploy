@if (Session::has('message'))
	<div class="message">
		<div>
			{{ Session::get('message') }}
		</div>
	</div>
@endif