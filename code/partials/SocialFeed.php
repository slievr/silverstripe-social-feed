<?php

class SocialFeed extends DataObject{

    static $db = array(
        'Title' => 'VarCHar(255)'
    );

    static $has_many = array(
        'Items' => 'SocialItem'
    );

    function getCMSFields(){

        $fields = FieldList::create(tabset::create('Root'));

        $feilds->addFieldsToTab('Root.Main',array(
            TextField::create('Title')
        ));

        return $fields;
    }

}
