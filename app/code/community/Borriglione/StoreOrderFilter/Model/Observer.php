<?php
/**
 * @category   Borriglione
 * @package    Borriglione_StoreOrderFilter
 * @copyright  Copyright (c) 2014 André Herrn <info@andre-herrn.de>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Borriglione_StoreOrderFilter_Model_Observer
{
    public function filterFrontendOrders($observer)
    {
        //Get block instance
        $block = $observer->getEvent()->getBlock();

        //Stop processing if block isn't an instance of order history block
        if (!$block instanceof Mage_Sales_Block_Order_History
            && !$block instanceof Mage_Sales_Block_Order_Recent) {
            return;
        }

        $orders = $block
            ->getOrders()
            ->clear() //Reset collection, otherwise wrong orders still be available in the frontend
            ->addFieldToFilter('store_id', array('in' => Mage::helper('storeorderfilter')->getStoreIdsToFilter()))
            ->load();
        $block->setOrders($orders);
    }
}