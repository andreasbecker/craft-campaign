<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\campaign\services;

use putyourlightson\campaign\Campaign;
use putyourlightson\campaign\elements\ContactElement;
use putyourlightson\campaign\elements\MailingListElement;
use putyourlightson\campaign\models\PendingContactModel;

use Craft;
use craft\base\Component;
use yii\base\Exception;

/**
 * ContactsService
 *
 * @author    PutYourLightsOn
 * @package   Campaign
 * @since     1.0.0
 */
class ContactsService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * Returns a contact by ID
     *
     * @param int $contactId
     *
     * @return ContactElement|null
     */
    public function getContactById(int $contactId)
    {
        return ContactElement::find()
            ->id($contactId)
            ->status(null)
            ->one();
    }

    /**
     * Returns an array of contacts by IDs
     *
     * @param int[] $contactIds
     *
     * @return ContactElement[]
     */
    public function getContactsByIds(array $contactIds): array
    {
        if (empty($contactIds)) {
            return [];
        }

        return ContactElement::find()
            ->id($contactIds)
            ->status(null)
            ->all();
    }

    /**
     * Returns contact by user ID
     *
     * @param int $userId
     *
     * @return ContactElement|null
     */
    public function getContactByUserId(int $userId)
    {
        if (!$userId) {
            return null;
        }

        return ContactElement::find()
            ->userId($userId)
            ->status(null)
            ->one();
    }

    /**
     * Returns contact by CID
     *
     * @param string $cid
     *
     * @return ContactElement|null
     */
    public function getContactByCid(string $cid)
    {
        if (!$cid) {
            return null;
        }

        return ContactElement::find()
            ->cid($cid)
            ->status(null)
            ->one();
    }

    /**
     * Returns contact by email
     *
     * @param string $email
     * @param bool|null $trashed
     *
     * @return ContactElement|null
     */
    public function getContactByEmail(string $email, bool $trashed = false)
    {
        if (!$email) {
            return null;
        }

        return ContactElement::find()
            ->email($email)
            ->status(null)
            ->trashed($trashed)
            ->one();
    }

    /**
     * Saves a pending contact
     *
     * @param PendingContactModel $pendingContact
     *
     * @return bool
     *
     * @deprecated in 1.10.0. Use [[PendingContactsService::savePendingContact()]] instead.
     */
    public function savePendingContact(PendingContactModel $pendingContact): bool
    {
        Craft::$app->getDeprecator()->log('ContactsService::savePendingContact()', 'The “ContactsService::savePendingContact()” method has been deprecated. Use “PendingContactsService::savePendingContact()” instead.');

        return Campaign::$plugin->pendingContacts->savePendingContact($pendingContact);
    }

    /**
     * Sends a verification email
     *
     * @param PendingContactModel $pendingContact
     * @param MailingListElement $mailingList
     *
     * @return bool
     * @throws Exception
     *
     * @deprecated in 1.10.0. Use [[PendingContactsService::sendVerifySubscribeEmail()]] instead.
     */
    public function sendVerificationEmail(PendingContactModel $pendingContact, MailingListElement $mailingList): bool
    {
        Craft::$app->getDeprecator()->log('ContactsService::sendVerificationEmail()', 'The “ContactsService::sendVerificationEmail()” method has been deprecated. Use “PendingContactsService::sendVerifySubscribeEmail()” instead.');

        return Campaign::$plugin->forms->sendVerifySubscribeEmail($pendingContact, $mailingList);
    }

    /**
     * Verifies a pending contact
     *
     * @param string $pid
     *
     * @return PendingContactModel|null
     *
     * @deprecated in 1.10.0. Use [[PendingContactsService::verifyPendingContact()]] instead.
     */
    public function verifyPendingContact(string $pid)
    {
        Craft::$app->getDeprecator()->log('ContactsService::verifyPendingContact()', 'The “ContactsService::verifyPendingContact()” method has been deprecated. Use “PendingContactsService::verifyPendingContact()” instead.');

        return Campaign::$plugin->pendingContacts->verifyPendingContact($pid);
    }

    /**
     * Deletes expired pending contacts
     *
     * @deprecated in 1.10.0. Use [[PendingContactsService::purgeExpiredPendingContacts()]] instead.
     */
    public function purgeExpiredPendingContacts()
    {
        Craft::$app->getDeprecator()->log('ContactsService::purgeExpiredPendingContacts()', 'The “ContactsService::purgeExpiredPendingContacts()” method has been deprecated. Use “PendingContactsService::purgeExpiredPendingContacts()” instead.');

        Campaign::$plugin->pendingContacts->purgeExpiredPendingContacts();
    }
}
