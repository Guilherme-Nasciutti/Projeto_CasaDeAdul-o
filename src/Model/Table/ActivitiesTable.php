<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activities Model
 *
 * @property \App\Model\Table\InstructorsTable&\Cake\ORM\Association\BelongsTo $Instructors
 * @property \App\Model\Table\GuestsTable&\Cake\ORM\Association\BelongsToMany $Guests
 *
 * @method \App\Model\Entity\Activity get($primaryKey, $options = [])
 * @method \App\Model\Entity\Activity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Activity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Activity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Activity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Activity findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ActivitiesTable extends Table
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

        $this->setTable('activities');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Instructors', [
            'foreignKey' => 'instructor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Guests', [
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'guest_id',
            'joinTable' => 'activities_guests',
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
            ->scalar('title')
            ->maxLength('title', 220)
            ->requirePresence('title', 'create', 'O campo título é obrigatório!')
            ->notEmptyString('title', 'O campo título é obrigatório!');

        $validator
            ->date('initial_date', ['dmy'], 'Data inválida!')
            ->requirePresence('initial_date', 'create', 'O campo data de início é obrigatório!')
            ->notEmptyDate('initial_date', 'O campo data de início é obrigatório!');

        $validator
            ->date('final_date', ['dmy'], 'Data inválida!')
            ->requirePresence('final_date', 'create', 'O campo data final é obrigatório!')
            ->notEmptyDate('final_date', 'O campo data final é obrigatório!')
            ->add('final_date', 'custom', [
                'rule' => function ($value, $context) {
                    $initialDate = isset($context['data']['initial_date']) ? $context['data']['initial_date'] : null;
                    if ($initialDate) {
                        $initialDate = \DateTime::createFromFormat('d/m/Y', $initialDate);
                        $finalDate = \DateTime::createFromFormat('d/m/Y', $value);
                        if ($finalDate && $initialDate) {
                            return $finalDate >= $initialDate;
                        }
                    }
                    return false;
                },
                'message' => 'A data final não pode ser anterior à data de início.'
            ]);

        $validator
            ->requirePresence('start_time', 'create', 'O campo horário de início é obrigatório!')
            ->notEmptyString('start_time', 'O campo horário de início é obrigatório!');

        $validator
            ->integer('duration')
            ->requirePresence('duration', 'create', 'O campo duração é obrigatório!')
            ->notEmptyString('duration', 'O campo duração é obrigatório!');

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
        $rules->add($rules->existsIn(['instructor_id'], 'Instructors', 'É obrigatório informar um responsável.'));
        return $rules;
    }
}
