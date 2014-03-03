<?php
/**
 * @category   Borriglione
 * @package    Borriglione_StoreOrderFilter
 * @copyright  Copyright (c) 2014 André Herrn <info@andre-herrn.de>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Borriglione_StoreOrderFilter_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Get storeId(s) to filter the MyAccount order collections 
     * 
     * @return array StoreIds
     */
    public function getStoreIdsToFilter()
    {
        if (1 == Mage::getStoreConfig('customer/account_share/show_current_store')) {
            return array(Mage::app()->getStore()->getStoreId());
        } else {
            return explode(',', Mage::getStoreConfig('customer/account_share/show_orders_of_stores'));
        }
    }
}