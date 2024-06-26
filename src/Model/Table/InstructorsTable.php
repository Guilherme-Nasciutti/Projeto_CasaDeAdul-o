<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Instructors Model
 *
 * @property \App\Model\Table\PersonsTable&\Cake\ORM\Association\BelongsTo $Persons
 * @property \App\Model\Table\ActivitiesTable&\Cake\ORM\Association\HasMany $Activities
 *
 * @method \App\Model\Entity\Instructor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Instructor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Instructor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Instructor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Instructor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Instructor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Instructor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Instructor findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InstructorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('instructors');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persons', [
            'foreignKey' => 'person_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Activities', [
            'foreignKey' => 'instructor_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 15, 'Máximo de 15 dígitos!')
            ->requirePresence('phone', 'create', 'O campo telefone pessoal é obrigatório!')
            ->notEmptyString('phone', 'O campo telefone pessoal é obrigatório!')
            ->add('phone', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Telefone já cadastrado!'
            ]);

        $validator
            ->scalar('other_phone')
            ->maxLength('other_phone', 15, 'Máximo de 15 dígitos!')
            ->allowEmptyString('other_phone');

        $validator
            ->requirePresence('education', 'create', 'O campo formação é obrigatório!')
            ->notEmptyString('education', 'O campo formação é obrigatório!');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['phone'], 'Telefone já cadastrado!'));
        $rules->add($rules->existsIn(['person_id'], 'Persons'));

        return $rules;
    }

    public function findInstructorsCreatingIdAndNameForList()
    {
        return $this->find('all')
            ->contain(['Persons'])
            ->map(function ($row) {
                return [
                    $row->id => $row->person->first_name . ' ' . $row->person->last_name
                ];
            })
            ->reduce(function ($acc, $item) {
                return $acc + $item;
            }, []
        );
    }

    public function findAllInstructorsByConditions($conditions = null)
    {
        return $this->find('all', [
            'contain' => ['Persons']
        ])->where($conditions);
    }
}
