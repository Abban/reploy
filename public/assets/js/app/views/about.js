window.AboutView = Backbone.View.extend({

	template: _.template(
		'<div><h1>About</h1></div>' +
		'<section>' +
			'<div>' +
				'<p>Proof of concept</p>' +
			'</div>' +
		'</section>' +
		'<aside>' +
			'<div>' +
				'<p>Lorem ipsum Eu dolor qui nisi dolore culpa qui cillum enim.</p>' +
			'</div>' +
		'</aside>'
	),
	
	initialize : function(){
		this.$el.html(this.template());
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