<?php
/**
 * NGINAD Project
 *
 * @link http://www.nginad.com
 * @copyright Copyright (c) 2013-2016 NginAd Foundation. All Rights Reserved
 * @license GPLv3
 */

namespace buyrtb\workflows\tasklets\display\insertionorderlineitem;

class BannerRestrictionsWorkflow {
	
	public static function execute(&$Logger, &$ParentWorkflow, \model\openrtb\RtbBidRequest &$RtbBidRequest, \model\openrtb\RtbBidRequestImp &$RtbBidRequestImp, &$InsertionOrderLineItem, &$InsertionOrderLineItemRestrictionsFactory) {
	
		/*
		 * Check banner restrictions (optional fields)
		*/
		
		$params = array();
		$params["InsertionOrderLineItemID"] = $InsertionOrderLineItem->InsertionOrderLineItemID;
		$InsertionOrderLineItemRestrictions = $InsertionOrderLineItemRestrictionsFactory->get_row_cached($ParentWorkflow->config, $params);
		
		// no banner restriction info to base rejection on
		if ($InsertionOrderLineItemRestrictions === null):
			return true;
		endif;
		
		// Check if the banner is in an IFRAME
		if (\buyrtb\workflows\tasklets\display\insertionorderlineitemrestrictions\CheckInIFrame::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem, $InsertionOrderLineItemRestrictions) === false):
			return false;
		endif;
		
		// Check banner system fold position
		if (\buyrtb\workflows\tasklets\display\insertionorderlineitemrestrictions\CheckFoldPosition::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem, $InsertionOrderLineItemRestrictions) === false):
			return false;
		endif;
		
		// Check browser language
		if (\buyrtb\workflows\tasklets\display\insertionorderlineitemrestrictions\CheckHttpLanguage::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem, $InsertionOrderLineItemRestrictions) === false):
			return false;
		endif;
		
		// Check browser user-agent for string
		if (\buyrtb\workflows\tasklets\display\insertionorderlineitemrestrictions\CheckBrowserUserAgent::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem, $InsertionOrderLineItemRestrictions) === false):
			return false;
		endif;
		
		// Check banner for https:// secure
		if (\buyrtb\workflows\tasklets\common\insertionordermediarestrictions\CheckSecureOnly::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem, $InsertionOrderLineItemRestrictions) === false):
			return false;
		endif;
		
		// Check user for Coppa opt out status
		if (\buyrtb\workflows\tasklets\common\insertionordermediarestrictions\CheckCoppaOptOut::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem, $InsertionOrderLineItemRestrictions) === false):
			return false;
		endif;
		
		// Check banner for it being in the right vertical
		if (\buyrtb\workflows\tasklets\common\insertionordermediarestrictions\CheckVertical::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem, $InsertionOrderLineItemRestrictions) === false):
			return false;
		endif;
		
		// Check banner geography
		if (\buyrtb\workflows\tasklets\common\insertionordermediarestrictions\CheckGeo::execute($Logger, $ParentWorkflow, $RtbBidRequest, $RtbBidRequestImp, $InsertionOrderLineItem, $InsertionOrderLineItemRestrictions) === false):
			return false;
		endif;
		
		return true;
	}
	
}
