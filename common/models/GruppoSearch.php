<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Gruppo;

/**
 * GruppoSearch represents the model behind the search form about `common\models\Gruppo`.
 */
class GruppoSearch extends Gruppo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nome', 'descrizione'], 'safe'],
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
        $query = Gruppo::find()->andFilterWhere(['or',  ['visibilita' => 'gruppo', 'gruppo.autorizzati' => Yii::$app->session['group'][0]],
                                                        ['visibilita' => 'privato', 'gruppo.autorizzati' => Yii::$app->user->id],
                                                        ['visibilita' => 'tenant', 'gruppo.autorizzati' => Yii::$app->session['tenant']]]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'descrizione', $this->descrizione]);

        return $dataProvider;
    }
}
