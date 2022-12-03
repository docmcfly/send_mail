<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('Cylancer.SendMessage', 'MessageForm', 'LLL:EXT:send_message/Resources/Private/Language/locallang_be_messageForm.xlf:plugin.name');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('send_message', 'Configuration/TypoScript', 'LLL:EXT:send_message/Resources/Private/Language/locallang_be_messageForm.xlf:plugin.name');

    /**
     * Garbage Collector
     */
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\CMS\Scheduler\Task\TableGarbageCollectionTask']['options']['tables']['tx_sendmessage_domain_model_message'] = [
        'dateField' => 'tstamp',
        'expirePeriod' => 28
    ];
});
