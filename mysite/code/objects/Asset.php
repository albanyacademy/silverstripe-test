<?php

use Silverstripe\Assets\File;
use SilverStripe\AssetAdmin\Forms\UploadField;

class Asset extends \SilverStripe\ORM\DataObject {

    // this might be overkill.

    private static $db = [
        "Title" => 'HTMLText',
    ];

    private static $has_one = [
      'Contract' => File::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab("Root.Main", [
           UploadField::create("Contract", "Contract")->setFolderName("Contracts")
        ]);
        return $fields;
    }
}