<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Nets Model
 *
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\BelongsTo $Groups
 * @property \App\Model\Table\EventsTable&\Cake\ORM\Association\HasMany $Events
 * @property \App\Model\Table\GroupsUsersTable&\Cake\ORM\Association\HasMany $GroupsUsers
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 * @property \App\Model\Table\PacientsTable&\Cake\ORM\Association\HasMany $Pacients
 * @property \App\Model\Table\StatesxDaysTable&\Cake\ORM\Association\HasMany $StatesxDays
 * @property \App\Model\Table\StatusGroupsTable&\Cake\ORM\Association\HasMany $StatusGroups
 * @property \App\Model\Table\StocksUsersTable&\Cake\ORM\Association\HasMany $StocksUsers
 * @property \App\Model\Table\TurnsTable&\Cake\ORM\Association\HasMany $Turns
 *
 * @method \App\Model\Entity\Net newEmptyEntity()
 * @method \App\Model\Entity\Net newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Net[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Net get($primaryKey, $options = [])
 * @method \App\Model\Entity\Net findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Net patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Net[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Net|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Net saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Net[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Net[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Net[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Net[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NetsTable extends Table
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

        $this->setTable('nets');
        $this->setDisplayField('net_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'net_id',
        ]);
        $this->hasMany('GroupsUsers', [
            'foreignKey' => 'net_id',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'net_id',
        ]);
        $this->hasMany('Pacients', [
            'foreignKey' => 'net_id',
        ]);
        $this->hasMany('StatesxDays', [
            'foreignKey' => 'net_id',
        ]);
        $this->hasMany('StatusGroups', [
            'foreignKey' => 'net_id',
        ]);
        $this->hasMany('StocksUsers', [
            'foreignKey' => 'net_id',
        ]);
        $this->hasMany('Turns', [
            'foreignKey' => 'net_id',
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
            ->scalar('net_name')
            ->maxLength('net_name', 1000)
            ->allowEmptyString('net_name');

        $validator
            ->integer('group_id')
            ->allowEmptyString('group_id');

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
        $rules->add($rules->existsIn('group_id', 'Groups'), ['errorField' => 'group_id']);

        return $rules;
    }
}
