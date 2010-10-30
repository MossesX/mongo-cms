Ext.ns('NS');

NS.TopMenu = Ext.extend(Ext.Toolbar,{
	/**
	 * Component initialization
	 *
	 */
	initComponent : function(){
		Ext.apply(this, {
			defaults: {
				allowDepress: false,
				enableToggle: true,
				toggleGroup: 'topMenu',
				scale: 'large'
			},
			items: [{
				text: 'Сайт',
				enableToggle: false,
				toggleGroup: null,
				iconCls: 'ns-topmenu-site',
				style: { marginRight: '5px' }
			},{
				text: 'Содержимое',
				pressed: true,
				iconCls: 'ns-topmenu-content',
				style: { marginRight: '5px' }
			},{
				text: 'Система',
				iconCls: 'ns-topmenu-system'
			},'->',{
				iconCls: 'ns-topmenu-flag-ru',
				enableToggle: false,
				toggleGroup: null,
				menu: [{
					text: 'Русская версия',
					iconCls: 'ns-topmenu-flag-ru-16'
				},{
					text: 'Английская версия',
					iconCls: 'ns-topmenu-flag-en-16'
				}]
			},{
				iconCls: 'ns-topmenu-logoff',
				enableToggle: false,
				toggleGroup: null,
				tooltip: 'Выйти'
			}]
		});
		NS.TopMenu.superclass.initComponent.apply(this, arguments);
	}
});

Ext.reg('ns-topmenu', NS.TopMenu);
