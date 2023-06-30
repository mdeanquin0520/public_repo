<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property \App\Model\Table\EventsTable&\Cake\ORM\Association\HasMany $Events
 * @property \App\Model\Table\NetsTable&\Cake\ORM\Association\HasMany $Nets
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 * @property \App\Model\Table\PacientsTable&\Cake\ORM\Association\HasMany $Pacients
 * @property \App\Model\Table\StatesxDaysTable&\Cake\ORM\Association\HasMany $StatesxDays
 * @property \App\Model\Table\StatusGroupsTable&\Cake\ORM\Association\HasMany $StatusGroups
 * @property \App\Model\Table\StocksUsersTable&\Cake\ORM\Association\HasMany $StocksUsers
 * @property \App\Model\Table\TurnsTable&\Cake\ORM\Association\HasMany $Turns
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Group newEmptyEntity()
 * @method \App\Model\Entity\Group newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Group[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Group get($primaryKey, $options = [])
 * @method \App\Model\Entity\Group findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Group patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Group[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Group|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Group saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GroupsTable extends Table
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

        $this->setTable('groups');
        $this->setDisplayField('group_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Events', [
            'foreignKey' => 'group_id',
        ]);
        $this->hasMany('GroupsUsers', [
            'foreignKey' => 'group_id',
        ]);
        $this->hasMany('Nets', [
            'foreignKey' => 'group_id',
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'group_id',
        ]);
        $this->hasMany('Pacients', [
            'foreignKey' => 'group_id',
        ]);
        $this->hasMany('StatesxDays', [
            'foreignKey' => 'group_id',
        ]);
        $this->hasMany('StatusGroups', [
            'foreignKey' => 'group_id',
        ]);
        $this->hasMany('StocksUsers', [
            'foreignKey' => 'group_id',
        ]);
        $this->hasMany('Turns', [
            'foreignKey' => 'group_id',
        ]);
		$this->belongsToMany('Users', [
			'through' => 'GroupsUsers',
			'foreignKey' => 'group_id',
			'targetForeignKey' => 'user_id',
			'joinTable' => 'groups_users'
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
            ->scalar('group_name')
            ->maxLength('group_name', 1000)
            ->allowEmptyString('group_name');

        return $validator;
    }
}
