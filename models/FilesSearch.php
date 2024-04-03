<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Files;

/**
 * FilesSearch represents the model behind the search form of `app\models\Files`.
 */
class FilesSearch extends Files
{
    public $block_title = '';

    private $session;
    
    public function __construct($config = []) {
        parent::__construct($config);
        $this->session = Yii::$app->session;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'site_id', 'file_type'], 'integer'],
            [['file_name', 'file_realname', 'file_description', 'file_loaddate', 'file_date', 'file_close', 'username', 'updateusername', 'updatedate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        //$query = Files::find()->andWhere("file_date <= '".date("Y-m-d 00:00:00")."'")->andWhere("file_close IS NULL OR  file_close >= '".date("Y-mm-dd 23:59:59")."'")->orderBy('file_date DESC');
        $query = Files::find()->andWhere("file_date <= '".date("Y-m-d 00:00:00")."'")->andWhere("(file_close IS NULL OR  file_close >= '".date("Y-m-d 23:59:59")."')")->orderBy('file_date DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'site_id' => $this->site_id,
            'file_type' => $this->file_type,
            'file_loaddate' => $this->file_loaddate,
            'file_date' => $this->file_date,
            'file_close' => $this->file_close,
            'updatedate' => $this->updatedate,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_realname', $this->file_realname])
            ->andFilterWhere(['like', 'file_description', $this->file_description])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'updateusername', $this->updateusername]);

        return $dataProvider;
    }
    
    public function search_adm($params)
    {
        //$query = Files::find()->andWhere("file_date <= '".date("Y-m-d 00:00:00")."'")->andWhere("file_close IS NULL OR  file_close >= '".date("Y-mm-dd 23:59:59")."'")->orderBy('file_date DESC');
        $query = Files::find()->andWhere(['site_id' => $this->session->get('site_id')])->orderBy('file_date DESC');
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'site_id' => $this->site_id,
            'file_type' => $this->file_type,
            'file_loaddate' => $this->file_loaddate,
            'file_date' => $this->file_date,
            'file_close' => $this->file_close,
            'updatedate' => $this->updatedate,
        ]);
        
        $query->andFilterWhere(['like', 'file_name', $this->file_name])
        ->andFilterWhere(['like', 'file_realname', $this->file_realname])
        ->andFilterWhere(['like', 'file_description', $this->file_description])
        ->andFilterWhere(['like', 'username', $this->username])
        ->andFilterWhere(['like', 'updateusername', $this->updateusername]);
        
        return $dataProvider;
    }


}
