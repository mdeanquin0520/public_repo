<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\Entity;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use ArrayObject;

/**
 * Profiles Model
 *
 * @property \App\Model\Table\ProfilesGatesTable&\Cake\ORM\Association\HasMany $ProfilesGates
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 * @property \App\Model\Table\SourcingEventsTable&\Cake\ORM\Association\BelongsToMany $SourcingEvents
 *
 * @method \App\Model\Entity\Profile newEmptyEntity()
 * @method \App\Model\Entity\Profile newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Profile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Profile get($primaryKey, $options = [])
 * @method \App\Model\Entity\Profile findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Profile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Profile[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Profile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Profile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProfilesTable extends Table
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

        $this->setTable('profiles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Acl.Acl', ['type' => 'requester']);

        $this->belongsTo('ReferrerProfile', [
			'className' => 'Profiles',
            'foreignKey' => 'referrer_profile_id',
            'joinType' => 'LEFT',
        ]);
        $this->hasMany('ProfilesGates', [
            'foreignKey' => 'profile_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'profile_id',
        ]);
        $this->belongsToMany('SourcingEvents', [
            'through' => 'SourcingEventsProfiles',
            'foreignKey' => 'profile_id',
            'targetForeignKey' => 'sourcing_event_id',
            'joinTable' => 'sourcing_events_profiles',
			'saveStrategy' => 'append'
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 1000)
            ->allowEmptyString('description');

        $validator
            ->integer('referrer_profile_id')
            ->allowEmptyString('referrer_profile_id');

        return $validator;
    }

	public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
	{
        $aro = $this->node($entity)->toArray();
		$aro[0]['alias'] = $entity->name;
        $aroE = new Entity(['id' => $aro[0]['id'], 'alias' => $aro[0]['alias']]);
		$this->Aro->save($aroE);
	}
}
