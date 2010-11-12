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
					xtype: 'ns-topmenu-bar'
				},
				layout: 'card',
				activeItem: 0,
				hideBorders: true,
				items: [{
					xtype: 'ns-section-content'
				}]
			}
		});
		NS.Viewport.superclass.initComponent.apply(this, arguments);

		this.on('afterrender', function(){
			this.addSection({}, 'ns-section-content');
		}, this);
	},

	/**
	 * Add section
	 *
	 * @param {Object} button
	 * @param {Object} section
	 * @return {NS.Viewport}
	 */
	addSection: function(button, section){
		this.addButton(button, 'tab');
		return this;
	},

	/**
	 * Add button
	 *
	 * @param {Object} button
	 * @param {String} placement "left", "right", "tab"
	 * @return {NS.Viewport}
	 */
	addButton: function(button, placement){
		return this;
	}
});
