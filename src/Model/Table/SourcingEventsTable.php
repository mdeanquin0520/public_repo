<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SourcingEvents Model
 *
 * @property \App\Model\Table\ProfilesTable&\Cake\ORM\Association\BelongsToMany $Profiles
 *
 * @method \App\Model\Entity\SourcingEvent newEmptyEntity()
 * @method \App\Model\Entity\SourcingEvent newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SourcingEvent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SourcingEvent get($primaryKey, $options = [])
 * @method \App\Model\Entity\SourcingEvent findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SourcingEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SourcingEvent[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SourcingEvent|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SourcingEvent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SourcingEvent[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SourcingEvent[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SourcingEvent[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SourcingEvent[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SourcingEventsTable extends Table
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

        $this->setTable('sourcing_events');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Profiles', [
            'through' => 'SourcingEventsProfiles',
            'foreignKey' => 'sourcing_event_id',
            'targetForeignKey' => 'profile_id',
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
            ->scalar('description')
            ->maxLength('description', 100)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        return $validator;
    }
}
