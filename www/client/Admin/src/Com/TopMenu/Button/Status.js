Ext.ns('NS.Com.TopMenu.Button');

NS.Com.TopMenu.Button.Status = Ext.extend(NS.Com.TopMenu.Button.Abstract, {

	/**
	 * Button position
	 * @var {String}
	 */
	position: 'right'
});

Ext.reg('ns-topmenu-button-status', NS.Com.TopMenu.Button.Status);
