<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use Cylancer\SendMessage\Controller\MessageFormController;

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function () {

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin( //
    'Cylancer.SendMessage', //
    'MessageForm', //
    [
        MessageFormController::class => 'show, send'
    ], 
        // non-cacheable actions
        [
            MessageFormController::class => 'show, send'
        ]);
    
    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    messageform {
                        iconIdentifier = sendmessage-plugin-messageform
                        title = LLL:EXT:send_message/Resources/Private/Language/locallang_be_messageForm.xlf:plugin.name
                        description = LLL:EXT:send_message/Resources/Private/Language/locallang_be_messageForm.xlf:plugin.description
                        tt_content_defValues {
                            CType = list
                            list_type = sendmessage_messageform
                        }
                    }
                }
                show = *
            }
       }');
    
    $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
    $iconRegistry->registerIcon('sendmessage-plugin-messageform', SvgIconProvider::class, [
        'source' => 'EXT:send_message/Resources/Public/Icons/plugin_messageForm.svg'
    ]);
    
    
});



