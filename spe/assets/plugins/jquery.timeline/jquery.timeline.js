/*!
 * jQuery UI Widget-factory plugin boilerplate (for 1.8/9+)
 * Author: @addyosmani
 * Further changes: @peolanha
 * Licensed under the MIT license
 */

;(function ( $, window, document, undefined ) {

	// define your widget under a namespace of your choice
	//  with additional parameters e.g.
	// $.widget( "namespace.widgetname", (optional) - an
	// existing widget prototype to inherit from, an object
	// literal to become the widget's prototype );

	$.widget( "grantorino.timeline" , {

		//Options to be used as defaults
		options: {
			someValue: null
		},

		_tpl_event: ['<li class="tl-item">',
						'<div class="tl-wrap">',
							'<span class="tl-date">{{time}}</span>',
							'<div class="tl-content panel padder b-a">',
								'<span class="arrow left pull-up"></span>',
								'<div><legend>{{content}}</legend></div>',
								'<div>{{description}}</div>',
								'<div>{{description2}}</div>',
								'<div>{{description3}}</div>',
							'</div>',
						'</div>',
					'</li>'
				   ].join('\n'),

		//Setup widget (eg. element creation, apply theming
		// , bind events etc.)
		_create: function () {

			// _create will automatically run the first time
			// this widget is called. Put the initial widget
			// setup code here, then you can access the element
			// on which the widget was called via this.element.
			// The options defined above can be accessed
			// via this.options this.element.addStuff();
			// 
			// 
			this._buildContainer();
			this._buildTimeline();
		},

		// Destroy an instantiated plugin and clean up
		// modifications the widget has made to the DOM
		destroy: function () {

			// this.element.removeStuff();
			// For UI 1.8, destroy must be invoked from the
			// base widget
			$.Widget.prototype.destroy.call(this);
			// For UI 1.9, define _destroy instead and don't
			// worry about
			// calling the base widget
		},

		add: function ( event_data ) {
			//_trigger dispatches callbacks the plugin user
			// can subscribe to
			// signature: _trigger( "callbackName" , [eventObject],
			// [uiObject] )
			// eg. this._trigger( "hover", e /*where e.type ==
			// "mouseenter"*/, { hovered: $(e.target)});
			// 
			
			if ($.isArray( event_data )){
				var that = this;
				$.each(event_data, function( index, tl_event ) {
					that.add(tl_event);
				});
			} else {

				this.element.find("ul.timeline").append( 
					this._render_event(event_data) 
				);
			}

		},

		methodA: function ( event ) {
			this._trigger("dataChanged", event, {
				key: "someValue"
			});
		},

		_render_event: function(data){
			
			var event_html = this._tpl_event.replace('{{time}}', this._format_time(data.time) );	
			event_html = event_html.replace('{{content}}', data.content);
			event_html = event_html.replace('{{description}}', data.description);
			event_html = event_html.replace('{{description2}}', data.description2);
			event_html = event_html.replace('{{description3}}', data.description3);
			return event_html;

		},

		_format_time: function(time){
			var time = new Date(time);
			var Y = time.getFullYear();
			var m = time.getMonth() + 1;
			var d = time.getDate();
			var mm = m < 10 ? '0' + m : m;
			if (mm=='01') {
				var mmText = "Januari";
			} else if (mm=='02') {
				var mmText = "Februari";
			} else if (mm=='03') {
				var mmText = "Maret";
			} else if (mm=='04') {
				var mmText = "April";
			} else if (mm=='05') {
				var mmText = "Mei";
			} else if (mm=='06') {
				var mmText = "Juni";
			} else if (mm=='07') {
				var mmText = "Juli";
			} else if (mm=='08') {
				var mmText = "Agustus";
			} else if (mm=='09') {
				var mmText = "September";
			} else if (mm=='10') {
				var mmText = "Oktober";
			} else if (mm=='11') {
				var mmText = "November";
			} else if (mm=='12') {
				var mmText = "Desember";
			}
			var dd = d < 10 ? '0' + d : d;
			var tgl_indo = dd+' '+mmText+' '+Y;

			var hours = time.getHours();
			var minutes = time.getMinutes();
			var ampm = hours >= 12 ? 'pm' : 'am';
			hours = hours % 12;
			hours = hours ? hours : 12; // the hour '0' should be '12'
			minutes = minutes < 10 ? '0'+minutes : minutes;

			return tgl_indo+"<br/>"+ ( hours + ':' + minutes + ' ' + ampm);
		},
		
		_buildTimeline: function () {
			var that = this;
			$.each(this.options.data, function( index, tl_event ) {
				that.element.find("ul.timeline").append(that._render_event(tl_event));
				if (tl_event.Status != 0) {
					$('.timeline .tl-item .tl-wrap .b-a').css({'border':'1px solid #337ab7'});
					$('.timeline .tl-item .tl-wrap .arrow.left').css({'border-right-color': 'blue'});
				}
			});
		
		},

		_buildContainer: function(){
			this.element.append('<ul class="timeline"></ul>');
		},

		// Respond to any changes the user makes to the
		// option method
		_setOption: function ( key, value ) {
			switch (key) {
			case "someValue":
				//this.options.someValue = doSomethingWith( value );
				break;
			default:
				//this.options[ key ] = value;
				break;
			}

			// For UI 1.8, _setOption must be manually invoked
			// from the base widget
			$.Widget.prototype._setOption.apply( this, arguments );
			// For UI 1.9 the _super method can be used instead
			// this._super( "_setOption", key, value );
		}
	});

})( jQuery, window, document );