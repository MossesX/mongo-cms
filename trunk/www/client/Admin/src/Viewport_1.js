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
				tbar: new NS.TopMenu(),
				layout: 'card',
				activeItem: 0,
				hideBorders: true,
				items: [{
					layout: 'border',
					items: [{
						region: 'west',
						width: 200,
						split: true,
						layout: 'accordion',
						layoutConfig: {
							animate: true
						},
						items: [{
							tools: [{
								id: 'add',
								qtip: 'Добавить страницу'
							}],
							title: 'Страницы',
							iconCls: 'ns-content-tree-page',
							xtype: 'treepanel',
							border: false,
							useArrows: true,
							rootVisible: false,
							root: {
								nodeType: 'async',
								children: [{
									text: 'Добавить страницу',
									iconCls: 'ns-content-tree-add',
									leaf: true
								},{
									text: 'Page1',
									iconCls: 'ns-content-tree-page',
									children: [],
									leaf: true
								},{
									text: 'Page2',
									iconCls: 'ns-content-tree-page',
									children: [{
										text: 'Page3',
										iconCls: 'ns-content-tree-page',
										children: [],
										leaf: true
									},{
										text: 'Page4',
										iconCls: 'ns-content-tree-page',
										children: [],
										leaf: true
									}]
								}]
							}
						},{
							title: 'Модули',
							iconCls: 'ns-content-tree-module',
							xtype: 'treepanel',
							border: false,
							useArrows: true,
							rootVisible: false,
							root: {
								nodeType: 'async',
								children: [{
									text: 'Магазин',
									iconCls: 'ns-content-tree-module',
									children: [{
										text: 'Товары',
										iconCls: 'ns-content-tree-folder',
										children: [{
											text: 'Категория 1',
											iconCls: 'ns-content-tree-folder',
											children: [{
												text: 'Товар 1',
												iconCls: 'ns-content-tree-file',
												children: [],
												leaf: true
											},{
												text: 'Товар 2',
												iconCls: 'ns-content-tree-file',
												children: [],
												leaf: true
											},{
												text: 'Товар 3',
												iconCls: 'ns-content-tree-file',
												children: [],
												leaf: true
											}]
										},{
											text: 'Категория 2',
											iconCls: 'ns-content-tree-folder',
											children: [],
											leaf: true
										},{
											text: 'Категория 3',
											iconCls: 'ns-content-tree-folder',
											children: [],
											leaf: true
										}]
									}]
								}]
							}
						}]
					},{
						region: 'center',
						xtype: 'tabpanel',
						activeItem: 0,
						resizeTabs: true,
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
					}]
				},{
					html: '2'
				}]
			}
		});
		NS.Viewport.superclass.initComponent.apply(this, arguments);
	}
});
