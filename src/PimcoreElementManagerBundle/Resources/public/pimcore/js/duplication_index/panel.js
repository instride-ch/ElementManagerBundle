/*
 * Pimcore Element Manager.
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright 2024 instride AG (https://instride.ch)
 * @license   https://github.com/instride-ch/pimcore-element-manager/blob/main/gpl-3.0.txt GNU General Public License version 3 (GPLv3)
 */

pimcore.registerNS('pimcore_element_manager.duplication_index.panel');

pimcore_element_manager.duplication_index.panel = Class.create(coreshop.resource.panel, {
    layoutId: 'pimcore_element_manager_duplication_indexes_panel',
    storeId: 'pimcore_element_manager_duplication_indexes',
    iconCls: 'pimcore_element_manager_duplication_icon_indexes',
    type: 'pimcore_element_manager_duplication_indexes',
    url: {
        get: '/admin/pimcore_element_manager/potential_duplicates/get',
    },

    getDefaultGridDisplayColumnName: function() {
        return 'className';
    },

    getGridDisplayColumnRenderer: function(value) {
        return value;
    },

    getTopBar: function() {
        return [];
    },

    getTreeNodeListeners: function() {
        return {
            itemclick: this.onTreeNodeClick.bind(this),
        };
    },

    getItemClass: function() {
        return pimcore_element_manager.duplication_index.item;
    },

    openItem: function(record) {
        const panelKey = this.getPanelKey(record);

        if (this.panels[panelKey]) {
            this.panels[panelKey].activate();
        } else {
            Ext.Ajax.request({
                url: this.url.get,
                params: {
                    className: record.className,
                },
                success: function(response) {
                    const res = Ext.decode(response.responseText);

                    if (res.success) {
                        const itemClass = this.getItemClass();

                        res.data.options = res.options;

                        this.panels[panelKey] = new itemClass(this, res.data, panelKey, this.type, this.storeId);
                    } else {
                        Ext.Msg.alert(t('open_target'), t('problem_opening_new_target'));
                    }
                }.bind(this),
            });
        }
    },
});
