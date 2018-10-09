<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\View\Requirements;
use SilverStripe\Core\Manifest\ModuleResourceLoader;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Security\Security;

class PageController extends ContentController
{
    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * [
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * ];
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = [];

    protected function init()
    {
        // security model already hijacks controller which causes some weird shit to happen
        if ($this->URLSegment !== 'Security') {
            $lastEdit = gmdate("D, d M Y H:i:s ", strtotime(parent::getField('LastEdited'))) . 'GMT';
            $this->response->addHeader("X-Frame-Options", "SAMEORIGIN");
            $this->response->addHeader("X-Content-Type-Options", "nosniff");
            $this->response->addHeader("X-XSS-Protection", "1; mode=block");
            $this->response->addHeader("Cache-Control", "max-age=0, must-revalidate, private");
           // $this->response->removeHeader("Pragma");
            // todo - uncomment this. breaking on no ssl
            // $this->response->addHeader("content-security-policy", "upgrade-insecure-requests");
            $this->response->addHeader("strict-transport-security", "max-age=31536000");
            $this->response->addHeader("Last-Modified", $lastEdit);
            $this->response->addHeader("ETag", hash('md5',parent::getField('ID') . $lastEdit . parent::getField("Title") . parent::getField("Content")));
            $this->response->addHeader("Vary", "Last-Modified, ETag");
        }
        parent::init();
        $files = array(
            'themes/esentire/css/fonts.css',
            'themes/esentire/css/reset.css',
            'themes/esentire/css/flexgrid.css',
            'themes/esentire/css/components.css',
        );
        Requirements::combine_files("common.min.css", $files);

        $loader = SilverStripe\View\ThemeResourceLoader::inst();
        $themes = SilverStripe\View\SSViewer::get_themes();
        $scripts = [
            $loader->findThemedJavascript('es-main.js', $themes),
        ];
        Requirements::combine_files('scripts.js', $scripts, ['async' => true, 'defer' => true]);
    }
    public function phpI() {
        return phpInfo();
    }

    function getCategories() {
        $cats = Page::get('ContractCategory');
        return $cats;
    }
}
