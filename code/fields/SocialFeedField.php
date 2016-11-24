<?php

class SocialFeedField extends FormField {

    public static $allowed_actions = array(
       'feed',
   );

    function __construct($name, $title = "", $value = "") {
		parent::__construct($name, $title, $value);
	}

	public function Field($properties = array()) {

		$module_root = "socialfeed-slievr";

		Requirements::javascript($module_root.'/js/SocialFeedField.js');
		Requirements::css($module_root.'/css/SocialFeedField.css');

        //node mcrypt_module_close


		return $this->renderWith('SocialFormField');
	}

	function setValue($val) {

		return $this;
	}

	function saveInto(DataObjectInterface $dataobject) {
		$fieldName = $this->name;
		$fieldValue = $this->value;
		$dataobject->$fieldName = DBField::create_field("Location", $fieldValue);
	}

    protected function getFeedURL(){
        return Controller::join_links($this->Link(), 'feed');
    }

    function feed(SS_HTTPRequest $request){
        $fbFeed = $this->getFacebookFeed();
        //$tags = $this->getTags($request->getVar('term'));
        $response = new SS_HTTPResponse();
        $response->removeHeader('Content-Type');
        $response->addHeader('Content-Type', 'application/json');
        $response->setBody(json_encode($fbFeed));
        return $response;
    }

    function getTwitterFeed(){

    }

    function getFacebookFeed(){
        $token = '1420972004865719|h5UMQRraPJEPBuQxgrr80fpqZ9A';
	    $user = '297934263641339';

        $graph_url = 'https://graph.facebook.com/'.$user.'/posts?access_token='.$token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $graph_url);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output);
    }

    function getInstagramFeed(){

    }
}
