@include('global.head')
@include('global.header')
		
<div class="title">
	<div>
		<h1>Deploy</h1>
	</div>
</div>

<section class="full_width">
	<div>

		<pre style="font-size:small; padding: 10px; background:#ddd">
			<?php print_r($commit); ?>
		</pre>

	</div>

</section>

@include('global.footer')
