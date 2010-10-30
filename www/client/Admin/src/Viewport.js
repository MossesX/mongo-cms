Ext.ns('NS');

NS.Viewport = Ext.extend(Ext.Viewport,{
	/**
	 * Component initialization
	 *
	 */
	initComponent : function(){
		Ext.apply(this, {
			layout: 'fit',
			hideBorders: true,
			items: {
				tbar: {
					xtype: 'ns-topmenu'
				},
				layout: 'card',
				activeItem: 0,
				hideBorders: true,
				items: [{
					layout: 'border',
					items: [{
						region: 'west',
						border: false,
						layout: {
							type: 'vbox'
						},
						items: [{
							xtype: 'ns-pagestree',
							border: false,
							flex: 1
						},{
							xtype: 'ns-buttonsbar',
							items: [{
								iconCls: 'ns-content-tree-add',
								tooltip: 'Добавить страницу'
							}, {
								iconCls: 'ns-content-tree-delete',
								tooltip: 'Удалить страницу',
								disabled: true
							}]
						}]
					},{
						region: 'center',
						border: false,
						layout: 'fit',
						padding: 10,
						items: {
							flex: 1,
							xtype: 'tabpanel',
							activeItem: 0,
							resizeTabs: true,
							plain: true,
							items: [{
								title: 'Свойства',
								iconCls: 'ns-content-page-preferences',
								xtype: 'form',
								defaults: {
									collapsible: true,
									style: {
										margin: '10px'
									}
								},
								items: [{
									xtype: 'fieldset',
									title: 'Основные',
									defaults: {
										width: 200
									},
									items: [{
										xtype: 'textfield',
										fieldLabel: 'Название'
									},{
										xtype: 'combo',
										fieldLabel: 'Шаблон'
									}]
								}]
							},{
								title: 'Блоки',
								html: '2',
								iconCls: 'ns-content-page-blocks'
							}]
						}
					}]
				}]
			}
		});
		NS.Viewport.superclass.initComponent.apply(this, arguments);
	}
});
