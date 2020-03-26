<?php

use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class Users extends \Phalcon\Mvc\Model
{

    const DELETED = '1';
    
    const ACTIVE = '0';
    
    const DFT_PASS = 'pass@primaedu';

    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false)
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var string
     */
    public $Username;

    /**
     *
     * @var string
     */
    public $Password;

    /**
     *
     * @var string
     */
    public $Fullname;

    /**
     *
     * @var string
     */
    public $Email;

    /**
     *
     * @var integer
     */
    public $UserGroup;

    /**
     *
     * @var integer
     */
    public $AreaCabang;

    /**
     *
     * @var integer
     */
    public $Disabled;

    /**
     *
     * @var string
     */
    public $CreatedAt;

    /**
     *
     * @var string
     */
    public $CreatedBy;

    /**
     *
     * @var string
     */
    public $LastLogin;

    public function initialize() {
        $this->belongsTo('UserGroup', 'Usergroups', 'RecID');
        $this->belongsTo('AreaCabang', 'Areacabang', 'RecID');
        //$this->skipAttributesOnCreate(array('RecID'));

        $this->addBehavior(new SoftDelete([
            'field' => 'Disabled',
            'value' => Users::DELETED
        ]));
    }

    public function metaData() {
        return array(
            MetaData::MODELS_ATTRIBUTES => array(
                'RecID', 'Username', 'Password', 'Fullname', 'Email', 'UserGroup', 'AreaCabang', 'Disabled', 'CreatedAt', 'CreatedBy', 'LastLogin'
            ),
            MetaData::MODELS_PRIMARY_KEY => array(
                'RecID'
            ),
            MetaData::MODELS_NON_PRIMARY_KEY => array(
                'Username', 'Password', 'Fullname', 'Email', 'UserGroup', 'AreaCabang', 'Disabled', 'CreatedAt', 'CreatedBy', 'LastLogin'
            ),
            MetaData::MODELS_NOT_NULL => array(
                'RecID', 'Username'
            ),
            MetaData::MODELS_DATA_TYPES => array(
                'RecID' => Column::TYPE_INTEGER,
                'Username' => Column::TYPE_VARCHAR, 
                'Password' => Column::TYPE_VARCHAR,
                'Fullname' => Column::TYPE_VARCHAR,
                'Email' => Column::TYPE_VARCHAR,
                'UserGroup' => Column::TYPE_INTEGER,
                'AreaCabang' => Column::TYPE_INTEGER,
                'Disabled' => Column::TYPE_BOOLEAN,
                'CreatedAt' => Column::TYPE_VARCHAR,
                'CreatedBy' => Column::TYPE_VARCHAR,
                'LastLogin' => Column::TYPE_VARCHAR
            ),
            MetaData::MODELS_DATA_TYPES_NUMERIC => array(
                'RecID' => true,
                'UserGroup' => true,
                'AreaCabang' => true,
            ),
            MetaData::MODELS_IDENTITY_COLUMN => 'RecID',
            MetaData::MODELS_DATA_TYPES_BIND => array(
                'RecID' => Column::BIND_PARAM_INT,
                'Username' => Column::BIND_PARAM_STR, 
                'Password' => Column::BIND_PARAM_STR,
                'Fullname' => Column::BIND_PARAM_STR,
                'Email' => Column::BIND_PARAM_STR,
                'UserGroup' => Column::BIND_PARAM_INT,
                'AreaCabang' => Column::BIND_PARAM_INT,
                'Disabled' => Column::BIND_PARAM_INT,
                'CreatedAt' => Column::BIND_PARAM_STR,
                'CreatedBy' => Column::BIND_PARAM_STR,
                'LastLogin' => Column::BIND_PARAM_STR,
            ),
            MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => array(),
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => array()
        );
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'Username' => 'Username', 
            'Password' => 'Password', 
            'Fullname' => 'Fullname', 
            'Email' => 'Email', 
            'UserGroup' => 'UserGroup', 
            'AreaCabang' => 'AreaCabang', 
            'Disabled' => 'Disabled', 
            'CreatedAt' => 'CreatedAt', 
            'CreatedBy' => 'CreatedBy', 
            'LastLogin' => 'LastLogin'
        );
    }

    public function getUsergroup() {
        return Usergroups::findFirst($this->UserGroup)->GroupName;
    }

    public function getArea() {
        $areacabang = Areacabang::findFirst(array(
            'conditions' => 'RecID = ?0 AND Area IS NOT NULL',
            'bind' => array(
                0 => $this->AreaCabang
            ),
        ));
        if($areacabang !== FALSE) {
            $area = Areacabang::findFirstByKodeAreaCabang($areacabang->Area);
            return $area !== FALSE ? $area->RecID : NULL;
        }
        return NULL;
    }

    public function getSektor() {
        $areacabang = Areacabang::findFirst(array(
            'conditions' => 'RecID = ?0 AND Area IS NOT NULL',
            'bind' => array(
                0 => $this->AreaCabang
            ),
        ));
        if($areacabang !== FALSE) {
            $area = Areacabang::findFirstByKodeAreaCabang($areacabang->KodeAreaCabang);
            return $area !== FALSE ? $area->Sektor : NULL;
        }
        return NULL;
    }

    public function getAreaCabang() {
        $areacabang = Areacabang::findFirstByRecID($this->AreaCabang);
        return $areacabang !== FALSE ? $areacabang->NamaAreaCabang:"-";
    }
}
