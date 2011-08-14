<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['extraItemMarkerHook'][] =  'EXT:googleplusonettnews/pi1/class.tx_googleplusonettnews_pi1.php:tx_googleplusonettnews_pi1';

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_googleplusonettnews_pi1.php', '_pi1', 'includeLib', 1);
?>
