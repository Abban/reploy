window.DashboardView = Backbone.View.extend({

	template: _.template(
		'<div><h1>Content</h1></div>' +
		'<section>' +
			'<div>' +
				'<p>Proof of concept</p>' +
			'</div>' +
		'</section>' +
		'<aside>' +
			'<div>' +
				'<a href="/deployments/create" class="button">Create New Deployment</a>' +
			'</div>' +
		'</aside>'
	),
	
	initialize : function(){
		/*this.model.on('change', this.render, this);
		this.model.on('destroy hide', this.remove, this);
		$header.removeAttr('style');
		$header.find('a').removeAttr('style');
		$('body').removeAttr('style');*/
		this.$el.html(this.template(/*this.model.toJSON()*/));
		return this;
	},

	render : function(){
		/*this.$el.html(this.model.get('html'));
		return this;*/
	},

	remove : function(){
		//this.$el.remove();
	}

});