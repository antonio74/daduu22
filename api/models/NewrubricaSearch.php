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
        $rules[]= [['categoria', 'gruppo'], 'trim'];
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
        $expandCategoria=false; 
        $expandGruppo=false;
        $query = Newrubrica::find();
        // Join per poter filtrare anche attraverso categoria e gruppo
        if(isset($params['expand'])){
            $expand = array_map('trim',explode(",", $params['expand']));
            foreach ($expand as $value) {
                if($value =='categoria'){
                    $query->joinWith('categoria');
                    $expandCategoria=true;
                }
                elseif ($value =='gruppis'){                    
                    $query->joinWith('gruppis');   
                    $expandGruppo=true;
                }
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
            ->andFilterWhere(['=', 'id_categoria', $this->id_categoria]);

        // Filtro e ordinamento per categoria e gruppo solo se settato anche il rispettivo valore del parametro expand
        $dataProvider->sort->enableMultiSort=true;
        if(isset($expand))
            foreach ($expand as $value) {
                if($value =='categoria'){
                    $query->andFilterWhere(['like', 'categoria.nome', $this->categoria]);
                    $dataProvider->sort->attributes['categoria']=['asc' => ['categoria.nome' => SORT_ASC], 
                                                                    'desc' => ['categoria.nome' => SORT_DESC]];
                }
                elseif ($value =='gruppis'){
                    $query->andFilterWhere(['like', 'gruppo.nome', $this->gruppo]);
                    $dataProvider->sort->attributes['gruppo']=['asc' => ['gruppo.nome' => SORT_ASC], 
                                                                    'desc' => ['gruppo.nome' => SORT_DESC]];                    
                }           
            }

        // Ordinamento con parametro in formato json e controllo sintassi. I parametri non validi vengono ignorati
        /*if(isset($params['sort']) && $params['sort']!=null){
            $sort=$params['sort'];
            $i=0;
            $order='';
            foreach ($sort as $attribute => $orderType) {
                if(($attribute=='categoria' && $expandCategoria==true) || ($attribute=='gruppo' && $expandGruppo==true)){
                    $order=$order . $attribute . '.nome ' . $orderType;
                }
                elseif(in_array($attribute, $this->activeAttributes(), true)==true)
                    $order=$order . $attribute . ' ' . $orderType;
                $i=$i+1;
                if($i<count($sort))
                    $order=$order . ', ';
            }
            //$order="agaga" . implode(', ', Newrubrica::fields());
            $query->orderBy($order);
        }*/

        /*$s=Yii::$app->session;
        //$s->open();
        //$s->set('tenant','1');        
        $t=$s->get('tenant');
        $order="agaga" . implode(', ', $t);
        $query->orderBy($order);*/
        return $dataProvider;
    }
}
