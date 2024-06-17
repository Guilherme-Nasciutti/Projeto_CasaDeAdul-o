<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Persons Model
 *
 * @property \App\Model\Table\GuestsTable&\Cake\ORM\Association\HasMany $Guests
 * @property \App\Model\Table\InstructorsTable&\Cake\ORM\Association\HasMany $Instructors
 *
 * @method \App\Model\Entity\Person get($primaryKey, $options = [])
 * @method \App\Model\Entity\Person newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Person[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Person|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Person[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Person findOrCreate($search, callable $callback = null, $options = [])
 */
class PersonsTable extends Table
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

        $this->setTable('persons');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('id');

        $this->hasMany('Guests', [
            'foreignKey' => 'person_id',
        ]);
        $this->hasMany('Instructors', [
            'foreignKey' => 'person_id',
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
            ->scalar('first_name')
            ->maxLength('first_name', 220)
            ->requirePresence('first_name', 'create', 'O campo nome é obrigatório!')
            ->notEmptyString('first_name', 'O campo nome é obrigatório!');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 220)
            ->requirePresence('last_name', 'create', 'O campo sobrenome é obrigatório!')
            ->notEmptyString('last_name', 'O campo sobrenome é obrigatório!');

        $validator
            ->date('birthday', ['dmy'], 'Data inválido!')
            ->requirePresence('birthday', 'create', 'O campo data de nascimento é obrigatório!')
            ->notEmptyDate('birthday', 'O campo data de nascimento é obrigatório!');

        $validator
            ->requirePresence('civil_status', 'create', 'O campo estado civil é obrigatório!')
            ->notEmptyString('civil_status', 'O campo estado civil é obrigatório!');

        return $validator;
    }
}
