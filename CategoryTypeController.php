<?php

namespace app\modules\v1\controllers;

use Yii;
use app\models\CategoryType;
use app\models\CategoryTypeSearch;
use components\controllers\BaseController;

use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/**
 * ConnectivityTypeController implements the REST actions for ConnectivityType model.
 */
class CategoryTypeController extends BaseController {

    public $modelClass = "app\models\CategoryType";

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();

        return $behaviors;
    }


    /**
     * Displays a single CategoryType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        // $model = $this->findModel($id);
        $model = new ActiveDataProvider([
            'query' => CategoryType::find()->joinWith('blogs_type'),
        ]);

        if ($model) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }



    /**
     * Creates a new CategoryType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CategoryType(['scenario' => CategoryType::SCENARIO_CREATE]);
        $model->load(\Yii::$app->getRequest()->getBodyParams(), '');

        if ($model->validate() && $model->save()) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute([$id], true));
            return $this->actionView($id);
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $model;
    }

    /**
     * Updates an existing CategoryType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->actionView($id);
        $model->scenario = CategoryType::SCENARIO_UPDATE;

        $model->load(\Yii::$app->getRequest()->getBodyParams(), '');

        if ($model->validate() && $model->save()) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $model;
    }

    /**
     * Deletes an existing CategoryType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {

        /*  if ($this->findModel($id)->delete()) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }*/
        $model = $this->actionView($id);

        $model->status = \app\models\Status::DELETED;

        if ($model->save(false) === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }
        $response = \Yii::$app->getResponse();
        $response->setStatusCode(204);
        return "ok";
    }

    /**
     * Finds the ConnectivityType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CategoryType::find()->defaultScope(['self' => true])->andwhere(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
}
