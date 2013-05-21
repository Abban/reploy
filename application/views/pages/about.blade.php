@include('global.head')
@include('global.header')
	
<div class="title">
	<div>
		<h1>About</h1>
	</div>
</div>

<section>
	
	<div>
		<p>Lorem ipsum Pariatur veniam magna commodo sunt adipisicing cillum proident. Lorem ipsum Ut in do veniam eiusmod est sed reprehenderit. Lorem ipsum Voluptate aliquip adipisicing labore in dolore pariatur Excepteur cillum ullamco.</p>
		
		<p>Lorem ipsum Ad Duis sit adipisicing irure eiusmod ut aliqua aliquip sunt reprehenderit. Lorem ipsum Ut do occaecat sed adipisicing sed laborum est aliqua. Lorem ipsum Nisi dolore eu ut eiusmod ut quis adipisicing officia.</p>
		
		<p>Lorem ipsum Adipisicing tempor in mollit sit eu labore. Lorem ipsum Deserunt ea ullamco adipisicing dolore mollit commodo non. Lorem ipsum Est anim sunt Duis fugiat occaecat ut et voluptate adipisicing velit.</p>
	</div>

</section>

<aside>

	<div class="box">
		<h4>Contributors</h4>
		<ul class="contributors">
			@for ($i=0; $i<10; $i++)
			@foreach ($collaborators as $collaborator)
				<li>
					<figure>
						<a href="{{ URL::to($collaborator->url) }}"><img src="{{ $collaborator->avatar_url }}" alt="{{ $collaborator->login }}"></a>
					</figure>
					{{ HTML::link($collaborator->url, $collaborator->login) }}
				</li>
			@endforeach
			@endfor
		</ul>
	</div>

</aside>

@include('global.footer')