Ext.ns('NS.Com.TopMenu.Button');

NS.Com.TopMenu.Button.Abstract = Ext.extend(Ext.Button, {

	/**
	 * Button position
	 * @var {String}
	 */
	position: 'left',

	/**
	 * Component initialization
	 *
	 */
	initComponent : function(){
		Ext.apply(this, {
			scale: 'large',
			style: { marginRight: '5px' }
		});
		NS.Com.TopMenu.Button.Abstract.superclass.initComponent.apply(this, arguments);
	}
});

Ext.reg('ns-topmenu-button', NS.Com.TopMenu.Button.Abstract);
