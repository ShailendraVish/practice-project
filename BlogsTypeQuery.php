<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ConnectivityType]].
 *
 * @see ConnectivityType
 */
class BlogsTypeQuery extends \components\models\BaseQuery {
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BlogsType[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BlogsType|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }
}
