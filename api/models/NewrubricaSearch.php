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
  
    // add the public attributes that will be used to store the data to filter results
    public $categoria, $gruppo;
 
    // add the rules to make those attributes safe
    public function rules()
    {
        $rules = parent::rules();
        $rules[]= [['categoria', 'gruppo'], 'safe'];
        return $rules;
    }

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
        $query = Newrubrica::find();
        // Join per poter filtrare anche attraverso categoria e gruppo
        if(isset($params['expand'])){
            $expand = explode(",", $params['expand']);
            foreach ($expand as $value) {
                if($value =='categoria')
                    $query->joinWith('categoria');
                elseif ($value =='gruppis')
                    $query->joinWith('gruppis');                
            }    
        }
        
        
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
            ->andFilterWhere(['like', 'newrubrica.nome', $this->nome])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])            
            ->andFilterWhere(['like', 'id_categoria', $this->id_categoria]);
            
        // Filtri per categoria e gruppo
        if(isset($expand))
            foreach ($expand as $value) {
                if($value =='categoria')
                    $query->andFilterWhere(['like', 'categoria.nome', $this->categoria]);
                elseif ($value =='gruppis')
                    $query->andFilterWhere(['like', 'gruppo.nome', $this->gruppo]);
            }

        return $dataProvider;
    }
}
