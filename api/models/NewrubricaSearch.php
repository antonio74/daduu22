<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NewrubricaSearch represents the model behind the search form about `\api\models\Newrubrica`.
 */
class NewrubricaSearch extends \common\models\NewrubricaSearch
{
    
    /**
     * Creates data provider instance with search query applied 
     * and join with categoria and gruppo tables
     *  
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Newrubrica::find()->with('categoria','gruppis');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'id_categoria', $this->id_categoria]);

        return $dataProvider;
    }
}
