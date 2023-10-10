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
class CasWiseDisaster extends \components\models\BaseModel {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cas_wise_disaster';
    }


    public function scenarios() {
        // return [
        //     self::SCENARIO_DEFAULT => ['*'], // Also tried without this line
        //     self::SCENARIO_CREATE => ['name', 'code', 'description', 'category_id', 'status'],
        //     self::SCENARIO_CONSOLE => ['id', 'name', 'code', 'description', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'],
        //     self::SCENARIO_UPDATE => ['name', 'code', 'description', 'status'],
        // ];
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
            [['disaster_alter_id'], 'required'], // disaster_alter_id is required
            [['disaster_alter_id', 'cas_id', 'cas_account_count'], 'integer'], // Integer validation
            [['effective', 'expired'], 'date', 'format' => 'yyyy-MM-dd'], // Date format validation
            [['template'], 'string', 'max' => 255], // String validation with a maximum length of 255 characters
            [['status'], 'in', 'range' => [0, 1, 2]], // Value should be one of 0, 1, or 2
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
            'disaster_alter_id',
            'cas_id',
            'cas_account_count',
            'effective',
            'expired',
            'template',
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

        $fields['category_type_lbl'] = function () {
            return $this->categoryType->name ?? null;
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
