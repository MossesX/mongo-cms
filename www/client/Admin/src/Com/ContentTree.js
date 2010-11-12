Ext.ns('NS.Com');

NS.Com.ContentTree = Ext.extend(Ext.tree.TreePanel,{

	/**
	 * Component initialization
	 *
	 */
	initComponent : function(){
		Ext.apply(this, {
			width: 180,
			padding: '10px 0 0 0',
			useArrows: true,
			rootVisible: false,
			root: {
				nodeType: 'async',
				children: []
			},
			loader: {
				preloadChildren: true
			}
		});
		NS.Com.ContentTree.superclass.initComponent.apply(this, arguments);

		this.on('afterrender', function(){
			this.addItems([{
				text: 'Страницы',
				type: 'folder',
				id: '__ns-pages'
			},{
				text: 'Модули',
				type: 'folder',
				id: '__ns-modules'
			}]);

			this.addPage('Page1');
			this.addPage('Page2');


		}, this);

		a = this;
	},

	/**
	 * Retrieves pages node
	 *
	 * @return {Ext.tree.TreeNode}
	 */
	getPagesNode: function(){
		return this.getNodeById('__ns-pages');
	},

	/**
	 * Retrieves modules node
	 *
	 * @return {Ext.tree.TreeNode}
	 */
	getModulesNode: function(){
		return this.getNodeById('__ns-modules');
	},

	/**
	 * Add a page
	 *
	 * @param {String} title
	 * @return {NS.Com.ContentTree}
	 */
	addPage: function(title){
		this.addItem({
			text: title,
			type: 'page'
		}, this.getPagesNode());
		return this;
	},

	/**
	 * Add items
	 *
	 * @param {Array} items
	 * @param {TreeNode} parentNode
	 * @return {NS.Com.ContentTree}
	 */
	addItems: function(items, parentNode){
		Ext.each(items, function(item){
			this.addItem(item, parentNode);
		}, this);
	},

	/**
	 * Add item
	 *
	 * @param {Object} itemData
	 * @param {TreeNode} parentNode
	 * @return {NS.Com.ContentTree}
	 */
	addItem: function(itemData, parentNode){
		parentNode = parentNode || this.root;
		var item = new NS.Com.ContentTreeItem(itemData);
		parentNode.appendChild(item.getNodeData());
		return this;
	}
});

Ext.reg('ns-contenttree', NS.Com.ContentTree);
