@include('global.head')
@include('global.header')
	
<div class="title">
	<div>
		<h1>{{ $deployment->name }} <span>/ Commit History</span></h1>
		<div class="select">
			{{ HTML::link('javascript:void(0)', 'Options') }}
			<ul>
				<li>{{ HTML::link('deployments/history/' .$deployment->id, 'View Deployment History') }}</li>
				<li>{{ HTML::link('deployments/edit/' .$deployment->id, 'Edit This Deployment') }}</li>
				<li>{{ HTML::link('deployments/auto/' .$deployment->id, 'Turn on Auto Deploy') }}</li>
			</ul>
		</div>
	</div>
</div>

<section class="full_width">
	<div>

		<?php $date = 0; foreach ($commits as $commit): ?>
			
			<?php $c_date = date('D, jS M, Y', strtotime($commit->commit->committer->date)); ?>
			<?php if ($date !== $c_date): ?>
				<div class="list_date"><?php echo $date = $c_date ?></div>
			<?php endif; ?>
			
			<div class="commit">

				<figure>
					<a href="{{ URL::to($commit->committer->url) }}"><img src="{{ $commit->committer->avatar_url }}" alt="{{ $commit->committer->login }}"></a>
				</figure>
				
				<div class="commit_message">{{ HTML::link($commit->html_url, substr($commit->sha, 0, 10)) }} : {{ $commit->commit->message }}</div>

				<div class="meta">
					<strong>{{ $commit->author->login }}</strong> authored {{ DateFmt::Format('AGO[d.h]IF>6[on d##/mo##/Y##]', strtotime($commit->commit->committer->date)) }}
				</div>

				<div class="tools">
					{{ HTML::link('deployments/deploy/' .$deployment->id .'/' .$commit->sha, 'Deploy', array('class' => 'button')) }}
				</div>

			</div>

		<?php endforeach; ?>

	</div>

</section>

@include('global.footer')