Ext.ns('NS.Com.TopMenu');

NS.Com.TopMenu.Bar = Ext.extend(Ext.Toolbar,{
	/**
	 * Component initialization
	 *
	 */
	initComponent : function(){
		Ext.apply(this, {
			items: ['->']
		});
		NS.Com.TopMenu.Bar.superclass.initComponent.apply(this, arguments);

		this.addTopMenuButtons([{
			text: 'Сайт',
			iconCls: 'ns-topmenu-site'
		}, {
			xtype: 'ns-topmenu-button-tab',
			position: 'tab',
			text: 'Содержимое',
			pressed: true,
			iconCls: 'ns-topmenu-content'
		}, {
			xtype: 'ns-topmenu-button-tab',
			position: 'tab',
			text: 'Система',
			iconCls: 'ns-topmenu-system'
		}, {
			position: 'right',
			iconCls: 'ns-topmenu-flag-ru',
			menu: [{
				text: 'Русская версия',
				iconCls: 'ns-topmenu-flag-ru-16'
			},{
				text: 'Английская версия',
				iconCls: 'ns-topmenu-flag-en-16'
			}]
		}, {
			position: 'right',
			iconCls: 'ns-topmenu-logoff',
			tooltip: 'Выйти'
		}]);
	},

	/**
	 * Add tab buttons
	 *
	 * @param {Array} buttons
	 * @return {NS.Com.TopMenu.Bar}
	 */
	addTopMenuButtons: function(buttons){
		Ext.each(buttons, this.addTopMenuButton, this);
	},

	/**
	 * Add tab button
	 *
	 * @param {Object} button
	 * @return {NS.Com.TopMenu.Bar}
	 */
	addTopMenuButton: function(button){
		var idxFill=null, idxTab=null, xtype;
		this.items.each(function(item, idx){
			xtype = item.getXType();
			if (idxFill === null && xtype == 'tbfill')
				idxFill = idx;
			if (idxTab === null && xtype == 'ns-topmenu-button-tab')
				idxTab = idx;
		}, this);

		// Button XType
		if (typeof(button.getXType) == 'undefined')
			button = Ext.apply({ xtype: 'ns-topmenu-button' }, button);

		// Button position
		button = Ext.apply({ position: 'left' }, button);

		// New button index
		var idx = 0;
		switch (button.position){
			case 'tab':
				idx = +idxFill;
				break;
			case 'right':
				idx = idxFill + 1;
				break;
			default:
				idx = +idxTab;
		}

		// Inserting button
		this.insertButton(idx, button);
		return this;
	}
});

Ext.reg('ns-topmenu-bar', NS.Com.TopMenu.Bar);
