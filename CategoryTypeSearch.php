<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\CategoryType;
use \components\helper\ArrayHelper;

/**
 * @property integer $FRM_id
 * @property integer $TO_id
 * @property integer $FRM_status
 * @property integer $TO_status
 * @property timestamp $FRM_created_at
 * @property timestamp $TO_created_at
 * @property timestamp $FRM_updated_at
 * @property timestamp $TO_updated_at
 * @property integer $FRM_created_by
 * @property integer $TO_created_by
 * @property integer $FRM_updated_by
 * @property integer $TO_updated_by
 * ConnectivityTypeSearch represents the model behind the search form about `app\models\ConnectivityType`.
 */
class CategoryTypeSearch extends CategoryType {
    use \traits\SearchTrait;
    public   $FRM_id;
    public   $TO_id;
    public   $FRM_status;
    public   $TO_status;
    public   $FRM_created_at;
    public   $TO_created_at;
    public   $FRM_updated_at;
    public   $TO_updated_at;
    public   $FRM_created_by;
    public   $TO_created_by;
    public   $FRM_updated_by;
    public   $TO_updated_by;

    /**
     * additional range attributes
     */
    public function attributes() {
        $arributes = parent::attributes();
        $arributes[] = 'FRM_id';
        $arributes[] = 'TO_id';
        $arributes[] = 'FRM_status';
        $arributes[] = 'TO_status';
        $arributes[] = 'FRM_created_at';
        $arributes[] = 'TO_created_at';
        $arributes[] = 'FRM_updated_at';
        $arributes[] = 'TO_updated_at';
        $arributes[] = 'FRM_created_by';
        $arributes[] = 'TO_created_by';
        $arributes[] = 'FRM_updated_by';
        $arributes[] = 'TO_updated_by';
        return $arributes;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'status', 'created_by', 'updated_by'], 'customValidator', 'params' => ['function' => '\components\helper\ArrayHelper::isIntegerOr1dArray', 'message' => '{attribute} must in an integer or array of integer']],
            [['name', 'code', 'description', 'created_at', 'updated_at', 'FRM_created_at', 'TO_created_at', 'FRM_updated_at', 'TO_updated_at'], 'safe'],
            [['FRM_id', 'TO_id', 'FRM_status', 'TO_status', 'FRM_created_by', 'TO_created_by', 'FRM_updated_by', 'TO_updated_by'], 'integer'],
        ];
    }

    public function fileSupportedFields() {
        return [
            //  'smartcardno',

        ];
    }
    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $notparams = null, $extra = []) {
        $query = CategoryType::find();

        if ($this->thisalias) {
            $query->setAlias($this->thisalias);
        }
        $query->defaultScope(['self' => true]);

        if (!isset($extra['no_with'])) {
            $query->with($this->getSearchWith());
        }


        // add conditions that should always apply here
        $default = $this->attributes;
        $this->load($params, '');
        $this->processFileSearch();
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            throw new \yii\web\HttpException(422, json_encode($this->errors));

            //          return $query;
        }



        // grid filtering conditions
        $query->andFilterWhere([
            $query->alias . 'id' => $this->id,
            $query->alias . 'status' => $this->status,
            $query->alias . 'created_at' => $this->created_at,
            $query->alias . 'updated_at' => $this->updated_at,
            $query->alias . 'created_by' => $this->created_by,
            $query->alias . 'updated_by' => $this->updated_by,
        ]);

        $query->andArrayLike(['name' => $this->name], false)
            ->andArrayLike(['code' => $this->code], false)
            ->andArrayLike(['description' => $this->description], false);

        $query->andFilterWhere(['between', $query->alias . 'id', $this->FRM_id, $this->TO_id])
            ->andFilterWhere(['between', $query->alias . 'status', $this->FRM_status, $this->TO_status])
            ->andFilterWhere(['between', $query->alias . 'created_at', $this->FRM_created_at, $this->TO_created_at])
            ->andFilterWhere(['between', $query->alias . 'updated_at', $this->FRM_updated_at, $this->TO_updated_at])
            ->andFilterWhere(['between', $query->alias . 'created_by', $this->FRM_created_by, $this->TO_created_by])
            ->andFilterWhere(['between', $query->alias . 'updated_by', $this->FRM_updated_by, $this->TO_updated_by]);

        if ($notparams) {

            $this->load(array_merge($default, $notparams), '');
            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                throw new \yii\web\HttpException(422, json_encode($this->errors));

                //          return $query;
            }
            // grid filtering conditions
            $query->andArrayLike(['name' => $this->name], true)
                ->andArrayLike(['code' => $this->code], true)
                ->andArrayLike(['description' => $this->description], true);

            $query->andFilterWhere(['not in', $query->alias . 'id', $this->id])
                ->andFilterWhere(['not in', $query->alias . 'status', $this->status])
                ->andFilterWhere(['not in', $query->alias . 'created_at', $this->created_at])
                ->andFilterWhere(['not in', $query->alias . 'updated_at', $this->updated_at])
                ->andFilterWhere(['not in', $query->alias . 'created_by', $this->created_by])
                ->andFilterWhere(['not in', $query->alias . 'updated_by', $this->updated_by]);

            $query->andFilterWhere(['not between', $query->alias . 'id', $this->FRM_id, $this->TO_id])
                ->andFilterWhere(['not between', $query->alias . 'status', $this->FRM_status, $this->TO_status])
                ->andFilterWhere(['not between', $query->alias . 'created_at', $this->FRM_created_at, $this->TO_created_at])
                ->andFilterWhere(['not between', $query->alias . 'updated_at', $this->FRM_updated_at, $this->TO_updated_at])
                ->andFilterWhere(['not between', $query->alias . 'created_by', $this->FRM_created_by, $this->TO_created_by])
                ->andFilterWhere(['not between', $query->alias . 'updated_by', $this->FRM_updated_by, $this->TO_updated_by]);
        }
        return $query;
    }
}
