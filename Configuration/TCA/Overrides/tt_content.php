<?php


$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['sendmessage_messageform'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    // plugin signature: <extension key without underscores> '_' <plugin name in lowercase>
    'sendmessage_messageform',
    // Flexform configuration schema file
    'FILE:EXT:send_message/Configuration/FlexForms/MessageForm.xml'
    );
