<?php

namespace app\modules\v1\controllers;

use Yii;
use app\models\DisasterAlter;
use app\models\DisasterAlterSearch;
use components\controllers\BaseController;

use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;
use yii\helpers\Url;


/**
 * ConnectivityTypeController implements the REST actions for ConnectivityType model.
 */
class DisasterAlterController extends BaseController {

    public $modelClass = "app\models\DisasterAlter";

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();

        return $behaviors;
    }


    /**
     * Displays a single ConnectivityType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);

        if ($model) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

    /**
     * Creates a new ConnectivityType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new DisasterAlter(['scenario' => DisasterAlter::SCENARIO_CREATE]);
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
     * Updates an existing ConnectivityType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->actionView($id);
        $model->scenario = DisasterAlter::SCENARIO_UPDATE;

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
     * Deletes an existing ConnectivityType model.
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
     * @return DisasterAlter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DisasterAlter::find()->defaultScope(['self' => true])->andwhere(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    // function actionDezactorNotification() {
    //     // echo "This is Dezactor Notification";
    //     $xml = simplexml_load_file('./runtime/Fastway.xml');
    //     // print_r($xml);
    //     print_r($xml->identifier);
    //     exit;
    //     $namespaces = $xml->getNamespaces(true);
    //     var_dump($namespaces);
    // }
    public function demo() {
        echo "this is testing";
    }
}
