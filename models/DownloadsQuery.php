<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DownloadsLog]].
 *
 * @see DownloadsLog
 */
class DownloadsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return DownloadsLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DownloadsLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
