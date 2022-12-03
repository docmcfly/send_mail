<?php
declare(strict_types = 1);
namespace Cylancer\SendMessage\Utility;

use Cylancer\SendMessage\Domain\Repository\FrontendUserRepository;
use Cylancer\SendMessage\Domain\Repository\MessageRepository;
use Cylancer\SendMessage\Domain\Repository\FrontendUserGroupRepository;
use Cylancer\MessageBoard\Utility\EmailSendService;
use Cylancer\SendMessage\Domain\Model\Message;
use Cylancer\SendMessage\Domain\Model\FrontendUser;
use Cylancer\SendMessage\Domain\Model\FrontendUserGroup;

/**
 * *
 *
 * This file is part of the "Send message" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 C. Gogolin <service@cylancer.net>
 */
class SendMessageThread // extends \Thread
{

    const GROUP_MARKER = '#';

    /**
     *
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     *
     * @var FrontendUserRepository
     */
    private $frontendUserRepository;

    /**
     *
     * @var FrontendUserGroupRepository
     */
    private $frontendUserGroupRepository;

    /**
     *
     * @var FrontendUserService
     */
    private $frontendUserService;

    /**
     *
     * @var EmailSendService
     */
    private $emailSendService;

    /*
     * @var Message
     */
    private $message;

    public function __construct(Message $message, FrontendUserRepository $frontendUserRepository, MessageRepository $messageRepository, FrontendUserService $frontendUserService, FrontendUserGroupRepository $frontendUserGroupRepository, EmailSendService $emailSendService)
    {
        $this->messageRepository = $messageRepository;
        $this->frontendUserRepository = $frontendUserRepository;
        $this->frontendUserService = $frontendUserService;
        $this->frontendUserGroupRepository = $frontendUserGroupRepository;
        $this->emailSendService = $emailSendService;
        $this->message = $message;
    }

    public function run()
    {
        $receiversSource = explode(',', $this->message->getReceivers());
        $receiverGroups = [];

        $receivers = [];

        foreach ($receiversSource as $receiver) {
            $receiver = trim($receiver);
            if (substr($receiver, 0, 1) === SendMessageThread::GROUP_MARKER) {
                /** @var FrontendUserGroup $tmp  */
                $tmp = $this->frontendUserGroupRepository->findByReceiverGroupName(substr($receiver, 1));
                if (count($tmp) == 1) {
                    debug($tmp, 'findByReceiverGroupName');
                    $receiverGroups[] = $tmp[0]->getUid();
                } else {
                    $tmp = $this->frontendUserGroupRepository->findByTitle(substr($receiver, 1));
                    if (count($tmp) == 1) {
                        debug($tmp, 'findByTitle');
                        $receiverGroups[] = $tmp[0]->getUid();
                    }
                }
            } else {
                /** @var FrontendUser $tmp */
                $tmp = $this->frontendUserRepository->findByName($receiver);
                if (count($tmp) == 1) {
                    $tmp = $tmp[0];
                    if ($tmp != null && $tmp->getEmail() != null && strlen($tmp->getEmail()) > 0) {
                        $receivers[$tmp->getUid()] = $tmp;
                    }
                }
            }
        }
        foreach ($this->frontendUserRepository->findByUserGroups($receiverGroups) as $frontendUserUid) {
            /** @var \Cylancer\SendMessage\Domain\Model\FrontendUser $tmp */
            $tmp = $receivers[$frontendUserUid];
            if ($tmp == null) {
                $tmp = $this->frontendUserRepository->findByUid($frontendUserUid);
                if (! empty($tmp->getEmail())) {
                    $receivers[$frontendUserUid] = $this->frontendUserRepository->findByUid($frontendUserUid);
                }
            }
        }
       

        // $this->emailSendService->sendTemplateEmail($recipient, $sender, $subject, $templateName, $extensionName);
    }
}