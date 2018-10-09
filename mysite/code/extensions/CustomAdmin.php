<?php

use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;
use SilverStripe\SiteConfig\SiteConfig;


Class CustomAdmin extends Extension {
    public function init()
    {
        Requirements::css('mysite/code/extensions/customadmin.css');
    }
}