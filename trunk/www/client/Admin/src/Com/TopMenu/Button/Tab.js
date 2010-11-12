Ext.ns('NS.Com.TopMenu.Button');

NS.Com.TopMenu.Button.Tab = Ext.extend(NS.Com.TopMenu.Button.Abstract, {

	/**
	 * Button position
	 * @var {String}
	 */
	position: 'tab',

	/**
	 * Component initialization
	 *
	 */
	initComponent : function(){
		Ext.apply(this, {
			allowDepress: false,
			enableToggle: true,
			toggleGroup: '__ns-topmenu'
		});
		NS.Com.TopMenu.Button.Tab.superclass.initComponent.apply(this, arguments);
	}
});

Ext.reg('ns-topmenu-button-tab', NS.Com.TopMenu.Button.Tab);
