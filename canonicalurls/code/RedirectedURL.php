<?php
/**
 * Specifies one URL redirection
 *
 * @package CanonicalURLS
 * @author crlindsay
 *
 * based off redirectedurls by
 * @author sam@silverstripe.com
 * @author scienceninjas@silverstripe.com
 */
class CanonicalURL extends DataObject implements PermissionProvider {

	private static $singular_name = 'Canonical URL Mapping';

	private static $db = array(
		'File' => 'Varchar(255)', // todo can this be mapped to a File?
		'To' => 'Varchar(255)', // todo can this be mapped to a SiteTree?
	);

	private static $indexes = array(
		'From' => array(
			'type' => 'unique',
            'value' => '"File"' // todo querystring is not needed, but this might have to be a value from the File object
        )
	);

	private static $summary_fields = array(
		'File' => 'From URL base',
		'To' => 'To URL',
	);

	// todo just update the fieldnames
	private static $searchable_fields = array(
		'File',
		'To',
	);

    // todo just update the fieldnames
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fileField = $fields->fieldByName('Root.Main.File');
		$fileField->setDescription('e.g. /about-us.pdf');

		$toField = $fields->fieldByName('Root.Main.To');
		$toField->setDescription('e.g. /about-us-web-version/');

		return $fields;
	}

    // todo looks like the fieldvalues are being set as variables for later. this could be a problem to modify if we make them use file/sitetree - link values will need to be get and stored as vars and passed through this function.
	public function setFrom($val) {
		$base = $val;
		$this->setFile($base);
	}

	public function getFrom() {
		$url = $this->File;
		return $url;
	}

	public function setFile($val) {
		if($val[0] != '/') $val = "/$val";
		$this->setField('File', strtolower($val));
	}

	/**
	 * Helper for bulkloader {@link: RedirectedURLAdmin.getModelImporters}
	 *
	 * @param string $from The From URL to search
	 * @return DataObject {@link: RedirectedURL}
	 */
	public function findByFrom($from) {
		if($from[0] != '/') $from = "/$from";
		$from = rtrim($from,'?'); //todo is this necessary?
        $base = $from; //todo clean this up

		$SQL_base = Convert::raw2sql($base);
        $qsClause = "AND \"FromQuerystring\" IS NULL"; // todo is this line necessary?

 		return DataObject::get_one("CanonicalURL", "\"File\" = '$SQL_base' $qsClause");
	}

	public function providePermissions() {
		return array(
			'CANONICALURLS_CREATE' => array(
				'name'     => 'Create a canonical link',
				'category' => 'Canonical Links'
			),
			'CANONICALURLS_EDIT'   => array(
				'name'     => 'Edit a canonical link',
				'category' => 'Canonical Links',
			),
			'CANONICALURLS_DELETE' => array(
				'name'     => 'Delete a canonical link',
				'category' => 'Canonical Links',
			)
		);
	}

	public function canView($member = null) {
		return true;
	}

	public function canCreate($member = null) {
		return Permission::check('CANONICALURLS_CREATE');
	}

	public function canEdit($member = null) {
		return Permission::check('CANONICALURLS_EDIT');
	}

	public function canDelete($member = null) {
		return Permission::check('CANONICALURLS_DELETE');
	}

}
