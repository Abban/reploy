window.App = new (Backbone.Router.extend({
	routes: {
		'dashboard': 'index',
		'about': 'about',
	},

	initialize: function(){
		_.bindAll(this);
	},
	
	start: function(){
		Backbone.history.start({
			pushState: true
		});

		if(Backbone.history && Backbone.history._hasPushState){

			$(document).delegate("a:not(.external)", "click", function(evt){
				// Get the anchor href and protcol
				var href = $(this).attr("href");
				var protocol = this.protocol + "//";

				// Ensure the protocol is not part of URL, meaning its relative.
				if(href.slice(protocol.length) !== protocol){
					evt.preventDefault();
					href = href.replace(window.site_url,'');
					window.App.navigate(href, { trigger: true });
				}

			});

		}

	},

	index: function(){
		this.dashboard = new Dashboard();
		this.dashboardView = new DashboardView({ model: this.dashboard });

		$('#content').html(this.dashboardView.el);
		/*this.dashboard.fetch({
			error: function(model, response){
		    	//alertify.error( response.responseText.replace(/"/g, '') );
		    }
		});*/
	},

	about: function(){
		console.log('about');
		this.aboutView = new AboutView();
		$('#content').html(this.aboutView.el);
	}

}));