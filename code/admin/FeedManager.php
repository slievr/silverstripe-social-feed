<?php

class FeedManager extends LeftAndMain implements PermissionProvider{


	private static $menu_title = "Feed Manager";

	private static $url_segment = "feed-manager";

	private static $menu_priority = 3;

	private static $url_priority = 0;

	private static $menu_icon = "";

	private static $url_handlers = array (
		'$Action!' => '$Action',
		'' => 'index'
	);
	public function init() {
		parent::init();
		Requirements::css("socialfeed-slievr/css/feed-manager.css");
		// Requirements::javascript("dashboard/javascript/jquery.flip.js");
		// Requirements::javascript("dashboard/javascript/dashboard.js");
	}
	private static $allowed_actions = array(
		'manageSetList',
        'FeedForm',
        'Form'
	);

    function Content()
   	{
      parent::Content();
      return $this->renderWith('FeedManager_Content');
   	}

	/**
	 * Provides custom permissions to the Security section
	 *
	 * @return array
	 */
	public function providePermissions() {
		$title = _t("FeedManager.MENUTITLE", LeftAndMain::menu_title_for_class('FeedManager'));
		return array(
			"CMS_ACCESS_FeedManager" => array(
				'name' => _t('FeedManager.ACCESS', "Access to '{title}' section", array('title' => $title)),
				'category' => _t('Permission.CMS_ACCESS_CATEGORY', 'CMS Access'),
				'help' => _t(
					'FeedManager.ACCESS_HELP',
					'Allow use of the CMS FeedManager'
				)
			)
		);
	}

    public function canView($member = null) {
        return Permission::check("CMS_ACCESS_SetListManager");
    }

    public function EditForm($request = NULL){
        //return $this->SetListForm();
    }

    public function FeedForm(){

		$fields = FieldList::create(
			SocialFeedField::create('test','test')
		);

		$actions = new FieldList(new FormAction('ProcessFeedForm', 'Create Feed'));

       	return Form::create($this, __function__, $fields, $actions, null);

    }

	public function FeedGrid(){

		$feedconf = GridFieldConfig_RecordEditor::create();

		$fields = FieldList::create(
			GridField::create('test','test',SocialFeed::get(),$feedconf)
		);

		$actions = new FieldList(new FormAction('ProcessFeedForm', 'Create Feed'));

       	return Form::create($this, __function__, $fields, $actions, null);
	}

    public function ProcessFeedForm($data, Form $form){

    }
}
