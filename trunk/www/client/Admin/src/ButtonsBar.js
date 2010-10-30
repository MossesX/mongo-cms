Ext.ns('NS');

NS.ButtonsBar = Ext.extend(Ext.Panel,{
	/**
	 * Component initialization
	 *
	 */
	initComponent : function(){
		Ext.apply(this, {
			height: 40,
			layout: 'hbox',
			width: '100%',
			border: false,
			padding: '0 0 10px 10px',
			defaults: {
				xtype: 'button',
				style: { paddingRight: '3px'},
				scale: 'medium'
			}
		});
		NS.ButtonsBar.superclass.initComponent.apply(this, arguments);
	}
});

Ext.reg('ns-buttonsbar', NS.ButtonsBar);
