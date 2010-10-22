Ext.ns('NS');

NS.App = function(){
	Ext.QuickTips.init();
	Ext.state.Manager.setProvider(new Ext.state.CookieProvider());

	// Init sections
	this._initSections();

	// Init viewport
	this._initViewport();

	// Init history
	this._initHistory();
};

NS.App.prototype = {

	/**
	 * Viewport
	 * @var {NS.Viewport}
	 */
	_viewport: null,

	/**
	 * Sections
	 * @var {Array[NS.Section.Abstract]}
	 */
	_sections: [],

	/**
	 * Init sections
	 *
	 * @return {NS.App}
	 */
	_initSections: function(){
		/*var sections = ['Information', 'Balance', 'Users', 'Subscriptions', 'Settings'], section;

		this._sections = [];
		Ext.each(sections, function(s){
			section = new cpanel.Section[s]();
			section.setName(s.toLowerCase());
			section.on('show', section.doRefresh);
			this._sections.push(section);
		}, this);*/

		return this;
	},

	/**
	 * Init viewport
	 *
	 * @return {NS.App}
	 */
	_initViewport: function(){
		// North
		/*var north = new Ext.BoxComponent({
			region: 'north',
			height: 100,
			margins: '0 0 8 0'
		});

		// West
		var west = new cpanel.Section.Buttons({
			region: 'west',
			margins: '0 0 8 8',
			cSections: this._sections
		});
		west.on('sectionselect', function(buttons, section){
			center.layout.setActiveItem(section.getId());
		});
		Ext.each(this._sections, function(section){
			section.on('show', function(){
				var btn = west.items.get(this._sections.indexOf(section));
				btn.toggle(true);
			}, this);
		}, this);
		

		// East
		var east = new Ext.BoxComponent({
			region: 'east',
			width: 200,
			margins: '0 8 8 0'
		});

		// Center
		var center = new cpanel.Section.Container({
			region: 'center',
			margins: '0 0 8 8',
			items: this._sections
		});

		// Viewport
		this._viewport = new cpanel.Viewport({
			layout: 'border',
			items: [north, west, east, center]
		});*/

		return this;
	},

	/**
	 * Init history
	 *
	 * @return {cpanel.App}
	 */
	_initHistory: function(){

		/*var fnDispatch = function(token){
			token = token || 'information';
			var section = this._getSection(token);
			section.ownerCt.layout.setActiveItem(section.getId());
		}.createDelegate(this);

		Ext.History.init(function() {
			var token = document.location.hash.replace('#', '');
			fnDispatch(token);
		});

		Ext.each(this._sections, function(section){
			section.on('show', function(){
				Ext.History.add(section.getName());
			});
		});

		Ext.History.on('change', fnDispatch);*/

		return this;
	},

	/**
	 * Retrieves section by name
	 *
	 * @param {String} name
	 * @return {cpanel.Section.Abstract}
	 */
	_getSection: function(name){
		var idx = Ext.each(this._sections, function(section){
			return section.getName() != name;
		});
		return this._sections[idx];
	}
};
