<?php
namespace Cylancer\SendMessage\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * *
 *
 * This file is part of the "Send message" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 C. Gogolin <service@cylancer.net>
 *
 * *
 */
class Message extends AbstractEntity
{

    /**
     *
     * @var Boolean
     */
    protected $copyToSender = true;

    /**
     *
     * @var FrontendUser
     */
    protected $sender = null;

    /**
     *
     * @var string
     */
    protected $receivers = '';

    /**
     *
     * @var string
     */
    protected $subject = '';

    /**
     *
     * @var string
     */
    protected $message = '';

    /**
     *
     * @var array
     */
    protected $attachments = null;

    /**
     *
     * @var String
     */
    protected $attachmentsMetaData = null;

    /**
     *
     * @var String
     */
    protected $key = null;

    /**
     *
     * @return boolean
     */
    public function getCopyToSender(): bool
    {
        return $this->copyToSender;
    }

    /**
     *
     * @param boolean $copyToSender
     * @return void
     */
    public function setCopyToSender(bool $copyToSender): void
    {
        $this->copyToSender = $copyToSender;
    }

    /**
     *
     * @return FrontendUser
     */
    public function getSender(): ?FrontendUser
    {
        return $this->sender;
    }

    /**
     *
     * @param FrontendUser $sender
     * @return void
     */
    public function setSender(FrontendUser $sender): void
    {
        $this->sender = $sender;
    }

    /**
     *
     * @return string
     */
    public function getReceivers(): String
    {
        return $this->receivers;
    }

    /**
     *
     * @param string $receivers
     * @return void
     */
    public function setReceivers(String $receivers): void
    {
        $this->receivers = $receivers;
    }

    /**
     *
     * @return string
     */
    public function getSubject(): String
    {
        return $this->subject;
    }

    /**
     *
     * @param string $subject
     * @return void
     */
    public function setSubject(String $subject)
    {
        $this->subject = $subject;
    }

    /**
     *
     * @return string
     */
    public function getMessage(): String
    {
        return $this->message;
    }

    /**
     *
     * @param string $message
     * @return void
     */
    public function setMessage(String $message): void
    {
        $this->message = $message;
    }

    /**
     *
     * @return array
     */
    public function getAttachments(): ?array
    {
        return $this->attachments;
    }

    /**
     *
     * @param array $attachments
     */
    public function setAttachments(array $attachments): void
    {
        $this->attachments = $attachments;
    }

    /**
     *
     * @return string
     */
    public function getAttachmentsMetaData(): string
    {
        return $this->attachmentsMetaData;
    }

    /**
     *
     * @param string $attachmentsMetaData
     */
    public function setAttachmentsMetaData($attachmentsMetaData): void
    {
        $this->attachmentsMetaData = $attachmentsMetaData;
    }

    /** 
     *
     * @return string
     */
    public function getKey(): ?String
    {
        return $this->key;
    }

    /**
     *
     * @param string $key
     * @return void
     */
    public function setKey($key): void
    {
        $this->key = $key;
    }
}