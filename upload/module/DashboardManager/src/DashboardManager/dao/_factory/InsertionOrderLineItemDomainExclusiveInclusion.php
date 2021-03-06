<?php
/**
 * NGINAD Project
 *
 * @link http://www.nginad.com
 * @copyright Copyright (c) 2013-2016 NginAd Foundation. All Rights Reserved
 * @license GPLv3
 */

namespace _factory;

use Zend\Db\TableGateway\Feature;

class InsertionOrderLineItemDomainExclusiveInclusion extends \_factory\CachedTableRead
{

	static protected $instance = null;

	public static function get_instance() {

		if (self::$instance == null):
			self::$instance = new \_factory\InsertionOrderLineItemDomainExclusiveInclusion();
		endif;
		return self::$instance;
	}


    function __construct() {

            $this->table = 'InsertionOrderLineItemDomainExclusiveInclusion';
            $this->featureSet = new Feature\FeatureSet();
            $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
            $this->initialize();
    }

    public function get_row($params = null) {
        // http://files.zend.com/help/Zend-Framework/zend.db.select.html

        $obj_list = array();

        $resultSet = $this->select(function (\Zend\Db\Sql\Select $select) use ($params) {
        	foreach ($params as $name => $value):
        	$select->where(
        			$select->where->equalTo($name, $value)
        	);
        	endforeach;
        	$select->limit(1, 0);
        	$select->order('InsertionOrderLineItemDomainExclusiveInclusionID');

        }
        	);

    	    foreach ($resultSet as $obj):
    	         return $obj;
    	    endforeach;

        	return null;
    }

    public function get($params = null) {
        	// http://files.zend.com/help/Zend-Framework/zend.db.select.html

        $obj_list = array();

    	$resultSet = $this->select(function (\Zend\Db\Sql\Select $select) use ($params) {
        		foreach ($params as $name => $value):
        		$select->where(
        				$select->where->equalTo($name, $value)
        		);
        		endforeach;
        		//$select->limit(10, 0);
        		$select->order('InsertionOrderLineItemDomainExclusiveInclusionID');

        	}
    	);

    	    foreach ($resultSet as $obj):
    	        $obj_list[] = $obj;
    	    endforeach;

    		return $obj_list;
    }

    public function saveInsertionOrderLineItemDomainExclusiveInclusion(\model\InsertionOrderLineItemDomainExclusiveInclusion $BannerDomainExclusiveInclusion) {
    	$data = array(
    	        'InsertionOrderLineItemID'                        => $BannerDomainExclusiveInclusion->InsertionOrderLineItemID,
    			'InclusionType'                        		=> $BannerDomainExclusiveInclusion->InclusionType,
    	        'DomainName'                           		=> $BannerDomainExclusiveInclusion->DomainName,
    			'DateCreated'                          		=> $BannerDomainExclusiveInclusion->DateCreated
    	);
    	$banner_domain_exclusive_inclusion_id = (int)$BannerDomainExclusiveInclusion->InsertionOrderLineItemDomainExclusiveInclusionID;
    	if ($banner_domain_exclusive_inclusion_id === 0): 
    		$this->insert($data);
    	else: 
    		$this->update($data, array('InsertionOrderLineItemDomainExclusiveInclusionID' => $banner_domain_exclusive_inclusion_id));
    	endif;
    }

    public function deleteInsertionOrderLineItemDomainExclusiveInclusion($banner_domain_exclusive_inclusion_id) {
        $this->delete(array('InsertionOrderLineItemDomainExclusiveInclusionID' => $banner_domain_exclusive_inclusion_id));
    }

    public function deleteInsertionOrderLineItemDomainExclusiveInclusionByBannerID($banner_id) {
    	$this->delete(array('InsertionOrderLineItemID' => $banner_id));
    }
};