<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ConnectivityType]].
 *
 * @see ConnectivityType
 */
class CasWiseDisasterQuery extends \components\models\BaseQuery {
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CasWiseDisaster[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CasWiseDisaster|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }
}
