<?php

class SocialItem extends DataObject{

    static $db = array(
        'Title' => 'VarChar(255)',
        'Author' => 'VarChar(255)',
        'ImageSource' => 'VarChar(255)',
        'Source' => 'VarChar(100)',
        'Date' => 'SS_DateTime'
    );


    static $has_one = array(
        'Image' => 'Image',
        'SocialFeed' => 'SocialFeed'
    );

    function getCMSFields(){

        $fields = FieldList::create(Tabset::create('Root'));

        $fields->addFieldsToTab('Root.Main',array(
            
        ));

        return $fields;

    }

}
