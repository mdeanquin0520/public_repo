<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StatesxDays Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\BelongsTo $Groups
 * @property \App\Model\Table\NetsTable&\Cake\ORM\Association\BelongsTo $Nets
 * @property \App\Model\Table\PacientsTable&\Cake\ORM\Association\BelongsTo $Pacients
 *
 * @method \App\Model\Entity\StatesxDay newEmptyEntity()
 * @method \App\Model\Entity\StatesxDay newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\StatesxDay[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StatesxDay get($primaryKey, $options = [])
 * @method \App\Model\Entity\StatesxDay findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\StatesxDay patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StatesxDay[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\StatesxDay|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StatesxDay saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StatesxDay[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StatesxDay[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\StatesxDay[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StatesxDay[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StatesxDaysTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('statesx_days');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Nets', [
            'foreignKey' => 'net_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Pacients', [
            'foreignKey' => 'pacient_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('group_id')
            ->notEmptyString('group_id');

        $validator
            ->integer('net_id')
            ->notEmptyString('net_id');

        $validator
            ->scalar('main_gate')
            ->maxLength('main_gate', 1)
            ->allowEmptyString('main_gate');

        $validator
            ->integer('pacient_id')
            ->allowEmptyString('pacient_id');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->time('hour')
            ->requirePresence('hour', 'create')
            ->notEmptyTime('hour');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('group_id', 'Groups'), ['errorField' => 'group_id']);
        $rules->add($rules->existsIn('net_id', 'Nets'), ['errorField' => 'net_id']);
        $rules->add($rules->existsIn('pacient_id', 'Pacients'), ['errorField' => 'pacient_id']);

        return $rules;
    }
}
