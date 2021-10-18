(function($){

$.anwidget("my.youtube",{
 options: {
			'visible': true,
			'position': 'absolute'
        },
		_props: ["left", "top", "width", "height", "position", "transform-origin", "transform"],
		_attrs: ["id", "src", "alt", "class", "frameborder","allowfullscreen"],
		getCreateOptions: function() {
			return $.extend(this.options, { 'id': "youtube" + _widgetID++ });
		},
		getCreateString: function() {
			return "<iframe>";
		},
		getProperties: function() {
			return this._props;
		},
		getAttributes: function() {
			return this._attrs;
		}    
	});   
})(jQuery);