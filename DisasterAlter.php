<?php

namespace app\models;

use Yii;
//use yii\behaviors\TimestampBehavior;
use app\models\User;

/**
 * This is the model class for table "connectivity_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class DisasterAlter extends \components\models\BaseModel {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'disaster_alter';
    }


    public function scenarios() {
        return [
            self::SCENARIO_DEFAULT => ['*'], // Also tried without this line
            self::SCENARIO_CREATE => ['	headline', 'identifier', 'contact', 'severity', 'parameter', 'status'],
            self::SCENARIO_CONSOLE => ['id', 'headline', 'contact', 'user_count', 'sent_user_count', 'description', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'],
            self::SCENARIO_UPDATE => ['name', 'code', 'description', 'status'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['headline', 'severity', 'parameter', 'identifier', 'contact', 'created_by'], 'required'],
            [['status', 'created_by', 'user_count', 'sent_user_count', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 1000],
            // [['name'], 'unique'],
            // [['code'], 'unique'],
            [['effective', 'expired'], 'date'],
            [['event', 'meta_data'], 'safe'],
        ];
    }

    /**
     * with
     * @return type
     */
    function defaultWith() {
        return [];
    }

    static function extraFieldsWithConf() {
        $retun = parent::extraFieldsWithConf();
        return $retun;
    }

    /**
     * @inheritdoc
     */
    public function fields() {
        $fields = [
            'id',
            'identifier',
            'user_count',
            'sent_user_count',
            'effective',
            'expired',
            'event',
            'meta_data',
            // 'subscriber_account',
            'headline',
            'contact',
            'severity',
            'parameter',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ];

        $fields = array_merge(parent::fields(), $fields);
        return $this->getFields($fields);
    }

    /**
     * @inheritdoc
     */
    public function extraFields() {
        $fields = parent::extraFields();

        $fields['desaster_type_lbl'] = function () {
            return $this->DisasterAlter->name ?? null;
        };
        // $fields['category_status'] = function () {
        //     return $this->categoryType->status ?? null;
        // };
        // $fields['category_description'] = function () {
        //     return $this->categoryType->description ?? null;
        // };

        return $this->getFilterExtraFields($fields);
    }

    /**
     * @inheritdoc
     * @return ConnectivityTypeQuery the active query used by this AR class.
     */
    /* public static function find(){
    return new ConnectivityTypeQuery(get_called_class())->applycache();
    }
    */

    // public function getCategoryType() {
    //     return $this->hasOne(CategoryType::class, ['id' => 'category_id']);
    // }
}
