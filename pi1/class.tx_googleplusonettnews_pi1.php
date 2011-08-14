<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Falko König <falko@foscom.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'Google Plus One button for tt_news' for the 'googleplusonettnews' extension.
 *
 * @author	Falko König <falko@foscom.de>
 * @package	TYPO3
 * @subpackage	tx_googleplusonettnews
 */
class tx_googleplusonettnews_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_googleplusonettnews_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_googleplusonettnews_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'googleplusonettnews';	// The extension key.
	var $pi_checkCHash = true;
	
	/**
	 * The extraItemMarkerProcessor function from tt_news
	 * 
	 * @return	Google Plus One Button
	 */
	function extraItemMarkerProcessor($markerArray, $row, $conf, &$pObj) {
		$this->pObj = $pObj;
		$this->conf = $conf;
		$this->row = $row;
		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['googleplusonettnews']);
		$this->baseurl = t3lib_div::getIndpEnv('TYPO3_SITE_URL');
		
		$this->text = $this->row['title'];
		//print_r($pObj);
		if($pObj->conf['useHRDatesSingle'] == 1 || $pObj->conf['displayLatest.']['useHRDatesSingle'] == 1 || $pObj->conf['displayList.']['useHRDatesSingle'] == 1 || $pObj->conf['displaySingle.']['useHRDatesSingle'] == 1){
			$datum = getdate($this->row['datetime']);
			$addParams = '&tx_ttnews[year]='.$datum['year'].'&tx_ttnews[month]='.$datum['mon'];
			if($pObj->conf['useHRDatesSingleWithoutDay'] == 0){
				$addParams .= '&tx_ttnews[day]='.$datum['mday'];
			}
		}
		
		$conf = array(
			'parameter' => (!empty($pObj->config['singlePid'])) ? $pObj->config['singlePid'] : $GLOBALS['TSFE']->id,
			'additionalParams' => $addParams.'&tx_ttnews[tt_news]='.$this->row['uid'],
			'useCacheHash' => true,
			'returnLast' => 'url',
		);
		$linkje = $this->baseurl.$this->pObj->cObj->typoLink('', $conf);
		
		$markerArray['###GOOGLEPLUSONE###'] = $this->getGooglePlusButton($linkje);
		
		return $markerArray;
	}
	
	
	/**
	 * Get Google Plus One button
	 * 
	 * @return	HTML	Google Plus One button
	 */
	function getGooglePlusButton($linkje=''){
		
		$googleplusButton = '<div class="tx_googleplus_pi1"><script type="text/javascript" src="https://apis.google.com/js/plusone.js">
{lang: \'de\'}</script>
<g:plusone></g:plusone></div>';
		
		return $googleplusButton;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/googleplusonettnews/pi1/class.tx_googleplusonettnews_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/googleplusonettnews/pi1/class.tx_googleplusonettnews_pi1.php']);
}

?>
