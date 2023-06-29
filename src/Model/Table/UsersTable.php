<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @property \App\Model\Table\ProfilesTable&\Cake\ORM\Association\BelongsTo $Profiles
 * @property \App\Model\Table\ObservationsTable&\Cake\ORM\Association\HasMany $Observations
 * @property \App\Model\Table\PacientsTable&\Cake\ORM\Association\HasMany $Pacients
 * @property \App\Model\Table\StatesxDaysTable&\Cake\ORM\Association\HasMany $StatesxDays
 * @property \App\Model\Table\StatusGroupsTable&\Cake\ORM\Association\HasMany $StatusGroups
 * @property \App\Model\Table\TurnsTable&\Cake\ORM\Association\HasMany $Turns
 * @property \App\Model\Table\EventsTable&\Cake\ORM\Association\BelongsToMany $Events
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\BelongsToMany $Groups
 * @property \App\Model\Table\StocksTable&\Cake\ORM\Association\BelongsToMany $Stocks
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Acl.Acl', ['type' => 'requester', 'enabled' => false]); // Add this
		$this->addBehavior('Search.Search');

		$this->searchManager()
			->value('username')
			->value('email')
			->add('search', 'Search.Like', [ 
				'before' => true,
				'after' => true,
				'fieldMode' => 'OR',
				'comparison' => 'LIKE',
				'wildcardAny' => '*',
				'wildcardOne' => '?',
				'fields' => ['username','email']
			]);

        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Referrer', [
            'foreignKey' => 'referrer_id',
            'joinType' => 'LEFT',
            'className' => 'Users'
        ]);
        $this->hasMany('EventsUsers', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('GroupsUsers', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Observations', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Pacients', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('StatesxDays', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('StatusGroups', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Turns', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('DoctorT', [
            'foreignKey' => 'doctor_id',
			'className' => 'Turns'
        ]);
        $this->belongsToMany('Events', [
            'through' => 'EventsUsers',
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'event_id',
            'joinTable' => 'events_users',
			'saveStrategy' => 'append'
        ]);
		$this->belongsToMany('Groups', [
			'through' => 'GroupsUsers',
			'foreignKey' => 'user_id',
			'targetForeignKey' => 'group_id',
			'joinTable' => 'groups_users'
        ]);
        $this->belongsToMany('Stocks', [
            'through' => 'StocksUsers',
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'stock_id',
            'joinTable' => 'stocks_users',
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
            ->scalar('username')
            ->maxLength('username', 100)
            ->allowEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->allowEmptyString('password');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 100)
            ->allowEmptyString('firstname');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 100)
            ->allowEmptyString('lastname');

        $validator
            ->integer('profile_id')
            ->notEmptyFile('profile_id');

        $validator
            ->integer('referrer_id')
            ->allowEmptyString('referrer_id');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        $validator
            ->scalar('image_file_name_url')
            ->maxLength('image_file_name_url', 1000)
            ->allowEmptyFile('image_file_name_url');

        $validator
            ->scalar('image_file_name')
            ->maxLength('image_file_name', 1000)
            ->allowEmptyFile('image_file_name');

        $validator
            ->scalar('image_file_name_filename')
            ->maxLength('image_file_name_filename', 1000)
            ->allowEmptyFile('image_file_name_filename');

        $validator
            ->decimal('map_lat')
            ->allowEmptyString('map_lat');

        $validator
            ->decimal('map_long')
            ->allowEmptyString('map_long');

        $validator
            ->scalar('code')
            ->maxLength('code', 20)
            ->notEmptyString('code');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->boolean('isolated')
            ->allowEmptyString('isolated');

        $validator
            ->scalar('token')
            ->maxLength('token', 1000)
            ->allowEmptyString('token');

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
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        $rules->add($rules->existsIn('profile_id', 'Profiles'), ['errorField' => 'profile_id']);

        return $rules;
    }

    public function beforeSave(\Cake\Event\Event $event, \Cake\ORM\Entity $entity, \ArrayObject $options)
    {
		if(!empty($entity->password)){
			$hasher = new DefaultPasswordHasher;
			$entity->password = $hasher->hash($entity->password);
        }
		return true;
    }
}
