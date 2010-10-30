Ext.ns('NS');

NS.PagesTree = Ext.extend(Ext.tree.TreePanel,{
	/**
	 * Component initialization
	 *
	 */
	initComponent : function(){
		Ext.apply(this, {
			width: 180,
			//split: true,
			padding: '10px 0 0 0',
			useArrows: true,
			rootVisible: false,
			root: {
				nodeType: 'async',
				children: [{
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
		});
		NS.PagesTree.superclass.initComponent.apply(this, arguments);
	}
});

Ext.reg('ns-pagestree', NS.PagesTree);
