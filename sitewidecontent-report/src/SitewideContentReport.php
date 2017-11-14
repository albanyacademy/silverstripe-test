<?php

namespace SilverStripe\SiteWideContentReport;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
// TODO uses Subsites module, it needs to be upgraded first
use Subsite;
use Page;
use SilverStripe\Versioned\Versioned;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Folder;
use SilverStripe\View\Requirements;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\SiteWideContentReport\Form\GridFieldBasicContentReport;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldPrintButton;
use SilverStripe\Forms\GridField\GridFieldExportButton;
use SilverStripe\CMS\Controllers\CMSPageEditController;
use SilverStripe\Control\Controller;
use SilverStripe\AssetAdmin\Controller\AssetAdmin;
use SilverStripe\Reports\Report;

/**
 * Content side-report listing all pages and files from all sub sites.
 *
 * Class SitewideContentReport
 * @package SilverStripe\SiteWideContentReport
 */
class SitewideContentReport extends Report
{
    /**
     * @return string
     */
    public function title()
    {
        return _t('SitewideContentReport.Title', 'Site-wide content report');
    }

    /**
     * @return string
     */
    public function description()
    {
        return _t('SitewideContentReport.Description', 'All pages and files across all Subsites');
    }

    /**
     * Returns an array with 2 elements, one with a list of Page on the site (and all subsites if
     * applicable) and another with files.
     *
     * @return array
     */
    public function sourceRecords()
    {
        if (class_exists('Subsite') && Subsite::get()->count() > 0) {
            $origMode = Versioned::get_reading_mode();
            Versioned::set_reading_mode('Stage.Stage');
            $items = [
                'Pages' => Subsite::get_from_all_subsites(SiteTree::class),
                'Files' => Subsite::get_from_all_subsites(File::class),
            ];
            Versioned::set_reading_mode($origMode);

            return $items;
        } else {
            return [
                'Pages' => Versioned::get_by_stage(SiteTree::class, 'Stage'),
                'Files' => File::get(),
            ];
        }
    }

    /**
     * Returns columns for the grid fields on this report.
     *
     * @param string $itemType (i.e 'Pages' or 'Files')
     *
     * @return array
     */
    public function columns($itemType = 'Pages')
    {
        $columns = [
            'Title' => [
                'title' => _t('SitewideContentReport.Name', 'Name'),
                'link' => true,
            ],
            'Created' => [
                'title' => _t('SitewideContentReport.Created', 'Date created'),
                'formatting' => function ($value, $item) {
                    return $item->dbObject('Created')->Nice();
                },
            ],
            'LastEdited' => [
                'title' => _t('SitewideContentReport.LastEdited', 'Date last edited'),
                'formatting' => function ($value, $item) {
                    return $item->dbObject('LastEdited')->Nice();
                },
            ],
        ];

        if ($itemType == 'Pages') {
            // Page specific fields
            $columns['i18n_singular_name'] = _t('SitewideContentReport.PageType', 'Page type');
            $columns['StageState'] = [
                'title' => _t('SitewideContentReport.Stage', 'Stage'),
                'formatting' => function ($value, $item) {
                    // Stage only
                    if (!$item->getExistsOnLive()) {
                        return _t('SitewideContentReport.Draft', 'Draft');
                    }

                    // Pending changes
                    if ($item->getIsModifiedOnStage()) {
                        return _t('SitewideContentReport.PublishedWithChanges', 'Published (with changes)');
                    }

                    // If on live and unmodified
                    return _t('SitewideContentReport.Published', 'Published');
                },
            ];
            $columns['RelativeLink'] = _t('SitewideContentReport.Link', 'Link');
            $columns['MetaDescription'] = [
                'title' => _t('SitewideContentReport.MetaDescription', 'Description'),
                'printonly' => true,
            ];
        } else {
            // File specific fields
            $columns['FileType'] = [
                'title' => _t('SitewideContentReport.FileType', 'File type'),
                'datasource' => function ($record) {
                    // Handle folders separately
                    if ($record instanceof Folder) {
                        return $record->i18n_singular_name();
                    }

                    return $record->getFileType();
                }
            ];
            $columns['Size'] = _t('SitewideContentReport.Size', 'Size');
            $columns['Filename'] = _t('SitewideContentReport.Directory', 'Directory');
        }

        $this->extend('updateColumns', $itemType, $columns);

        return $columns;
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        Requirements::javascript(SITEWIDE_CONTENT_REPORT.'/javascript/sitewidecontentreport.js');
        $fields = parent::getCMSFields();

        if (class_exists('Subsite')) {
            $subsites = Subsite::all_sites()->map();
            $fields->insertBefore(HeaderField::create('PagesTitle', _t('SitewideContentReport.Pages', 'Pages'), 3), 'Report-Pages');
            $fields->insertBefore(DropdownField::create('AllSubsites', _t('SitewideContentReport.FilterBy', 'Filter by:'), $subsites)
                ->addExtraClass('subsite-filter no-change-track')
                ->setEmptyString('All Subsites'), 'Report-Pages');
        }

        $fields->push(HeaderField::create('FilesTitle', _t('SitewideContentReport.Files', 'Files'), 3));
        $fields->push($this->getReportField('Files'));

        return $fields;
    }

    /**
     * Creates a GridField for pages and another one for files with different columns.
     * Grid fields have an export and a print button.
     *
     * @param string $itemType (i.e 'Pages' or 'Files')
     *
     * @return GridField
     */
    public function getReportField($itemType = 'Pages')
    {
        $params = isset($_REQUEST['filters']) ? $_REQUEST['filters'] : array();
        $items = $this->sourceRecords($params, null, null);

        $gridField = new GridFieldBasicContentReport('Report-'.$itemType, false, $items[$itemType]);

        $gridFieldConfig = GridFieldConfig::create()->addComponents(
            new GridFieldToolbarHeader(),
            new GridFieldSortableHeader(),
            new GridFieldDataColumns(),
            new GridFieldPaginator(),
            new GridFieldButtonRow('after'),
            $printButton = new GridFieldPrintButton('buttons-after-left'),
            $exportButton = new GridFieldExportButton('buttons-after-left')
        );

        $gridField->setConfig($gridFieldConfig);

        /* @var $columns GridFieldDataColumns */
        $columns = $gridField->getConfig()->getComponentByType(GridFieldDataColumns::class);

        $exportFields = [];
        $displayFields = [];
        $fieldCasting = [];
        $fieldFormatting = [];
        $dataFields = [];

        // Parse the column information
        foreach ($this->columns($itemType) as $source => $info) {
            if (is_string($info)) {
                $info = ['title' => $info];
            }

            if (isset($info['formatting'])) {
                $fieldFormatting[$source] = $info['formatting'];
            }
            if (isset($info['casting'])) {
                $fieldCasting[$source] = $info['casting'];
            }

            if (isset($info['link']) && $info['link']) {
                $fieldFormatting[$source] = function ($value, &$item) {
                    if ($item instanceof Page) {
                        return sprintf(
                            "<a href='%s'>%s</a>",
                            Controller::join_links(singleton(CMSPageEditController::class)->Link('show'), $item->ID),
                            $value
                        );
                    }

                    return sprintf(
                        "<a href='%s'>%s</a>",
                        Controller::join_links(
                            singleton(AssetAdmin::class)->Link('EditForm'), 'field/File/item', $item->ID, 'edit'
                        ),
                        $value
                    );
                };
            }

            // Set custom datasource
            if (isset($info['datasource'])) {
                $dataFields[$source] = $info['datasource'];
            }

            // Set field name for export
            $fieldTitle = isset($info['title']) ? $info['title'] : $source;

            // If not print-only, then add to display list
            if (empty($info['printonly'])) {
                $displayFields[$source] = $fieldTitle;
            }

            // Assume that all displayed fields are printed also
            $exportFields[$source] = $fieldTitle;
        }

        // Set custom evaluated columns
        $gridField->addDataFields($dataFields);

        // Set visible fields
        $columns->setDisplayFields($displayFields);
        $columns->setFieldCasting($fieldCasting);
        $columns->setFieldFormatting($fieldFormatting);

        // Get print columns, and merge with print-only columns
        $printExportColumns = $this->getPrintExportColumns($gridField, $itemType, $exportFields);

        $printButton->setPrintColumns($printExportColumns);
        $exportButton->setExportColumns($printExportColumns);

        return $gridField;
    }

    /**
     * Returns the columns for the export and print functionality.
     *
     * @param GridField $gridField
     * @param string    $itemType      (i.e 'Pages' or 'Files')
     * @param array     $exportColumns
     *
     * @return array
     */
    public function getPrintExportColumns($gridField, $itemType, $exportColumns)
    {
        // Swap RelativeLink for AbsoluteLink for export
        $exportColumns['AbsoluteLink'] = _t('SitewideContentReport.Link', 'Link');
        unset($exportColumns['RelativeLink']);

        $this->extend('updatePrintExportColumns', $gridField, $itemType, $exportColumns);

        return $exportColumns;
    }
}
