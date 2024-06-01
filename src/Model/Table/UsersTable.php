<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('full_name')
            ->maxLength('full_name', 220)
            ->requirePresence('full_name', 'create', 'O campo nome completo é obrigatório!')
            ->notEmptyString('full_name', 'O campo nome completo é obrigatório!');

        $validator
            ->email('email')
            ->requirePresence('email', 'create', 'O campo e-mail é obrigatório!')
            ->notEmptyString('email', 'O campo e-mail é obrigatório!')
            ->add('email', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'E-mail já cadastrado!'
            ]);

        $validator
            ->scalar('password')
            ->maxLength('password', 180)
            ->requirePresence('password', 'create', 'O campo nome completo é obrigatório!')
            ->notEmptyString('password', 'O campo nome completo é obrigatório!');

        $validator
            ->scalar('password_reset_token')
            ->maxLength('password_reset_token', 180)
            ->allowEmptyString('password_reset_token');

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
        $rules->add($rules->isUnique(['email'], 'E-mail já cadastrado!'));
        return $rules;
    }

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        return $query;
    }
}
