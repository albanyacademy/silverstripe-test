<?php
use SilverStripe\CMS\Model\SiteTree;


class ContractCategory extends Page {
    private static $allowed_children = [
        Contract::class,
    ];
}

class ContractCategoryController extends PageController {

}