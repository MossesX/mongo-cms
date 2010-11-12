Ext.ns('NS.Com');

NS.Com.ContentTreeItem = Ext.extend(Object, {
	/**
	 * Tree item text
	 * @var {String}
	 */
	text: '',

	/**
	 * Tree item type
	 * @var {String}
	 */
	type: '',

	/**
	 * Constructor
	 *
	 * @param {Object} options
	 */
	constructor: function(options){
		Ext.apply(this, options || {});
	},

	/**
	 * Retrieves data object
	 *
	 * @return {Object}
	 */
	getData: function(){
		var res = {};
		for (var i in this)
			if (typeof(this[i]) != 'function')
				res[i] = this[i];
		return res;
	},

	/**
	 * Retrieves data object for TreeNode initialization
	 *
	 * @return {Object}
	 */
	getNodeData: function(){
		return Ext.apply({}, {
			text: this.text,
			type: this.type,
			children: [],
			leaf: this.isLeaf(),
			iconCls: this.getIconCls()
		}, this.getData());
	},

	/**
	 * Checks if item is leaf
	 *
	 * @return {Boolean}
	 */
	isLeaf: function(){
		return false;
	},

	/**
	 * Retrieves item icon CSS class
	 *
	 * @return {String}
	 */
	getIconCls: function(){
		return 'ns-content-tree-' + this.type;
	}
});
