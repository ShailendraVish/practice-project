<?php

namespace app\models;

use Yii;
//use yii\behaviors\TimestampBehavior;
// use app\models\User;

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
class CategoryType extends \components\models\BaseModel {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'category_type';
    }


    public function scenarios() {
        return [
            self::SCENARIO_DEFAULT => ['*'], // Also tried without this line
            self::SCENARIO_CREATE => ['name', 'code', 'description', 'status', 'category_id'],
            self::SCENARIO_CONSOLE => ['id', 'name', 'code', 'description', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'],
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
            [['name', 'code', 'created_by'], 'required'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 1000],
            [['name'], 'unique'],
            [['code'], 'unique'],
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
            'name',
            'code',
            'description',

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

        return $this->getFilterExtraFields($fields);
    }

    /**
     * @inheritdoc
     * @return CategoryTypeQuery the active query used by this AR class.
     */
    /* public static function find(){
    return new ConnectivityTypeQuery(get_called_class())->applycache();
    }
    */
}
