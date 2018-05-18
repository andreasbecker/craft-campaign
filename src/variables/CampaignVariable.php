<?php
/**
 * @link      https://craftcampaign.com
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\campaign\variables;

use putyourlightson\campaign\Campaign;
use putyourlightson\campaign\elements\CampaignElement;
use putyourlightson\campaign\elements\ContactElement;
use putyourlightson\campaign\elements\db\CampaignElementQuery;
use putyourlightson\campaign\elements\db\ContactElementQuery;
use putyourlightson\campaign\elements\db\MailingListElementQuery;
use putyourlightson\campaign\elements\db\SegmentElementQuery;
use putyourlightson\campaign\elements\db\SendoutElementQuery;
use putyourlightson\campaign\elements\MailingListElement;
use putyourlightson\campaign\elements\SegmentElement;
use putyourlightson\campaign\elements\SendoutElement;
use putyourlightson\campaign\models\CampaignTypeModel;
use putyourlightson\campaign\models\ContactMailingListModel;
use putyourlightson\campaign\models\ImportModel;
use putyourlightson\campaign\models\MailingListTypeModel;
use putyourlightson\campaign\models\SettingsModel;

use Craft;
use craft\helpers\Template;
use yii\base\InvalidConfigException;
use yii\web\ForbiddenHttpException;

/**
 * CampaignVariable
 *
 * @author    PutYourLightsOn
 * @package   Campaign
 * @since     1.0.0   
 */
class CampaignVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Returns true if pro version
     *
     * @return bool
     */
    public function isPro(): bool
    {
        return Campaign::$plugin->isPro();
    }

    /**
     * Checks whether the plugin is the pro version
     *
     * @throws ForbiddenHttpException
     */
    public function requirePro()
    {
        Campaign::$plugin->requirePro();
    }

    /**
     * Returns campaign element query
     *
     * @return CampaignElementQuery
     */
    public function getCampaigns(): CampaignElementQuery
    {
        return CampaignElement::find();
    }

    /**
     * Returns contact element query
     *
     * @return ContactElementQuery
     */
    public function getContacts(): ContactElementQuery
    {
        return ContactElement::find();
    }

    /**
     * Returns mailing list element query
     *
     * @return MailingListElementQuery
     */
    public function getMailingLists(): MailingListElementQuery
    {
        return MailingListElement::find();
    }

    /**
     * Returns segment element query
     *
     * @return SegmentElementQuery
     */
    public function getSegments(): SegmentElementQuery
    {
        return SegmentElement::find();
    }

    /**
     * Returns sendout element query
     *
     * @return SendoutElementQuery
     */
    public function getSendouts(): SendoutElementQuery
    {
        return SendoutElement::find();
    }

    /**
     * Returns campaigns report data
     *
     * @return array
     */
    public function getCampaignsReportData(): array
    {
        return Campaign::$plugin->reports->getCampaignsReportData();
    }

    /**
     * Returns campaign report data
     *
     * @param int
     *
     * @return array
     */
    public function getCampaignReportData(int $campaignId): array
    {
        return Campaign::$plugin->reports->getCampaignReportData($campaignId);
    }

    /**
     * Returns campaign contact activity
     *
     * @param int
     * @param string|null
     * @param int|null
     *
     * @return array
     */
    public function getCampaignContactActivity(int $campaignId, string $interaction = null, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getCampaignContactActivity($campaignId, $interaction, $limit);
    }

    /**
     * Returns campaign locations
     *
     * @param int
     * @param int|null
     *
     * @return array
     */
    public function getCampaignLocations(int $campaignId, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getCampaignLocations($campaignId, $limit);
    }

    /**
     * Returns campaign links
     *
     * @param int
     * @param int|null
     *
     * @return array
     */
    public function getCampaignLinks(int $campaignId, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getCampaignLinks($campaignId, $limit);
    }

    /**
     * Returns campaign devices
     *
     * @param int
     * @param bool
     * @param int|null
     *
     * @return array
     */
    public function getCampaignDevices(int $campaignId, bool $detailed = false, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getCampaignDevices($campaignId, $detailed, $limit);
    }

    /**
     * Returns contacts report data
     *
     * @return array
     */
    public function getContactsReportData(): array
    {
        return Campaign::$plugin->reports->getContactsReportData();
    }

    /**
     * Returns contacts activity
     *
     * @param int|null
     *
     * @return array
     */
    public function getContactsActivity(int $limit = 100): array
    {
        return Campaign::$plugin->reports->getContactsActivity($limit);
    }

    /**
     * Returns contacts locations
     *
     * @param int|null
     *
     * @return array
     */
    public function getContactsLocations(int $limit = 100): array
    {
        return Campaign::$plugin->reports->getContactsLocations($limit);
    }

    /**
     * Returns contacts devices
     *
     * @param bool
     * @param int|null
     *
     * @return array
     */
    public function getContactsDevices(bool $detailed = false, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getContactsDevices($detailed, $limit);
    }

    /**
     * Returns contact campaign activity
     *
     * @param int
     * @param int|null
     *
     * @return array
     */
    public function getContactCampaignActivity(int $contactId, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getContactCampaignActivity($contactId, $limit);
    }

    /**
     * Returns contact mailing list activity
     *
     * @param int
     * @param int|null
     *
     * @return array
     */
    public function getContactMailingListActivity(int $contactId, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getContactMailingListActivity($contactId, $limit);
    }

    /**
     * Returns contact timeline
     *
     * @param int
     * @param int|null
     *
     * @return array
     */
    public function getContactTimeline(int $contactId, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getContactTimeline($contactId, $limit);
    }

    /**
     * Returns mailing lists report data
     *
     * @return array
     */
    public function getMailingListsReportData(): array
    {
        return Campaign::$plugin->reports->getMailingListsReportData();
    }

    /**
     * Returns mailing list report data
     *
     * @param int
     *
     * @return array
     */
    public function getMailingListReportData(int $mailingListId): array
    {
        return Campaign::$plugin->reports->getMailingListReportData($mailingListId);
    }

    /**
     * Returns mailing list contact activity
     *
     * @param int
     * @param string|null
     * @param int|null
     *
     * @return ContactMailingListModel[]
     */
    public function getMailingListContactActivity(int $mailingListId, string $interaction = null, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getMailingListContactActivity($mailingListId, $interaction, $limit);
    }

    /**
     * Returns mailing list locations
     *
     * @param int
     * @param int|null
     *
     * @return array
     */
    public function getMailingListLocations(int $mailingListId, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getMailingListLocations($mailingListId, $limit);
    }

    /**
     * Returns mailing list devices
     *
     * @param int
     * @param bool
     * @param int|null
     *
     * @return array
     */
    public function getMailingListDevices(int $mailingListId, bool $detailed = false, int $limit = 100): array
    {
        return Campaign::$plugin->reports->getMailingListDevices($mailingListId, $detailed, $limit);
    }

    /**
     * Returns campaign by ID
     *
     * @param int $campaignId
     *
     * @return CampaignElement|null
     */
    public function getCampaignById(int $campaignId)
    {
        return Campaign::$plugin->campaigns->getCampaignById($campaignId);
    }

    /**
     * Returns all campaign types
     *
     * @return array
     */
    public function getAllCampaignTypes(): array
    {
        return Campaign::$plugin->campaignTypes->getAllCampaignTypes();
    }

    /**
     * Returns campaign type by ID
     *
     * @param int $campaignTypeId
     *
     * @return CampaignTypeModel|null
     */
    public function getCampaignTypeById(int $campaignTypeId)
    {
        return Campaign::$plugin->campaignTypes->getCampaignTypeById($campaignTypeId);
    }

    /**
     * Returns contact by ID
     *
     * @param int $contactId
     *
     * @return ContactElement|null
     */
    public function getContactById(int $contactId)
    {
        return Campaign::$plugin->contacts->getContactById($contactId);
    }

    /**
     * Returns all mailing lists
     *
     * @return array
     */
    public function getAllMailingLists(): array
    {
        return MailingListElement::findAll();
    }

    /**
     * Returns mailing list by ID
     *
     * @param int $mailingListId
     *
     * @return MailingListElement|null
     */
    public function getMailingListById(int $mailingListId)
    {
        return Campaign::$plugin->mailingLists->getMailingListById($mailingListId);
    }

    /**
     * Returns all mailing list types
     *
     * @return array
     */
    public function getAllMailingListTypes(): array
    {
        return Campaign::$plugin->mailingListTypes->getAllMailingListTypes();
    }

    /**
     * Returns mailing list type by ID
     *
     * @param int $mailingListTypeId
     *
     * @return MailingListTypeModel|null
     */
    public function getMailingListTypeById(int $mailingListTypeId)
    {
        return Campaign::$plugin->mailingListTypes->getMailingListTypeById($mailingListTypeId);
    }

    /**
     * Returns segment by ID
     *
     * @param int $segmentId
     *
     * @return SegmentElement|null
     */
    public function getSegmentById(int $segmentId)
    {
        return Campaign::$plugin->segments->getSegmentById($segmentId);
    }

    /**
     * Returns segment field operators
     *
     * @return array
     */
    public function getSegmentFieldOperators(): array
    {
        return Campaign::$plugin->segments->getSegmentFieldOperators();
    }

    /**
     * Returns segment available fields
     *
     * @return array
     * @throws InvalidConfigException
     */
    public function getSegmentAvailableFields(): array
    {
        return Campaign::$plugin->segments->getSegmentAvailableFields();
    }

    /**
     * Returns sendout by ID
     *
     * @param int $sendoutId
     *
     * @return SendoutElement|null
     */
    public function getSendoutById(int $sendoutId)
    {
        return Campaign::$plugin->sendouts->getSendoutById($sendoutId);
    }

    /**
     * Returns all sendout types
     *
     * @return array
     */
    public function getAllSendoutTypes(): array
    {
        return SendoutElement::getSendoutTypes();
    }

    /**
     * Returns all imports
     *
     * @return array
     */
    public function getAllImports(): array
    {
        return Campaign::$plugin->imports->getAllImports();
    }

    /**
     * Returns import by ID
     *
     * @param int $importId
     *
     * @return ImportModel|null
     */
    public function getImportById(int $importId)
    {
        return Campaign::$plugin->imports->getImportById($importId);
    }

    /**
     * Returns contact fields
     *
     * @return array
     * @throws InvalidConfigException
     */
    public function getContactFields(): array
    {
        return Campaign::$plugin->imports->getContactFields();
    }

    /**
     * Returns reCAPTCHA markup
     *
     * @return \Twig_Markup|null
     * @throws InvalidConfigException
     */
    public function getRecaptcha()
    {
        $settings = Campaign::$plugin->getSettings();

        if ($settings->reCaptcha) {
            return Template::raw('
                <div id="campaign-recaptcha"></div>
                <script type="text/javascript">
                    var onloadCampaignRecaptchaCallback = function() {
                        var widgetId = grecaptcha.render("campaign-recaptcha", {
                            sitekey : "'.$settings->reCaptchaSiteKey.'",
                            size : "'.$settings->reCaptchaSize.'",
                            theme : "'.$settings->reCaptchaTheme.'",
                            badge : "'.$settings->reCaptchaBadge.'",
                        });
                        grecaptcha.execute(widgetId);
                    };
                </script>
                <script src="https://www.google.com/recaptcha/api.js?onload=onloadCampaignRecaptchaCallback&render=explicit&hl='.Craft::$app->getSites()->getCurrentSite()->language.'" async defer></script>
            ');
        }
    }

    /**
     * Returns reCAPTCHA site key
     *
     * @return string
     * @throws InvalidConfigException
     */
    public function getRecaptchaSiteKey(): string
    {
        return Campaign::$plugin->getSettings()->reCaptchaSiteKey;
    }

    /**
     * Returns plugin settings
     *
     * @return SettingsModel
     * @throws InvalidConfigException
     */
    public function getSettings(): SettingsModel
    {
        return Campaign::$plugin->getSettings();
    }
}
