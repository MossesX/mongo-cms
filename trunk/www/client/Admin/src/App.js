Ext.ns('NS');

NS.App = function(){
	Ext.QuickTips.init();
	Ext.state.Manager.setProvider(new Ext.state.CookieProvider());

	this._viewport = new NS.Viewport();
};

NS.App.prototype = {

	/**
	 * Viewport
	 * @var {NS.Viewport}
	 */
	_viewport: null
};
