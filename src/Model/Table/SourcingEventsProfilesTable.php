<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SourcingEventsProfiles Model
 *
 * @property \App\Model\Table\SourcingEventsTable&\Cake\ORM\Association\BelongsTo $SourcingEvents
 * @property \App\Model\Table\ProfilesTable&\Cake\ORM\Association\BelongsTo $Profiles
 *
 * @method \App\Model\Entity\SourcingEventsProfile newEmptyEntity()
 * @method \App\Model\Entity\SourcingEventsProfile newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SourcingEventsProfile[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SourcingEventsProfilesTable extends Table
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

        $this->setTable('sourcing_events_profiles');
        $this->setDisplayField(['id']);
        $this->setPrimaryKey(['id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('SourcingEvents', [
            'foreignKey' => 'sourcing_event_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id',
            'joinType' => 'INNER',
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
            ->integer('sourcing_event_id')
            ->notEmptyString('sourcing_event_id');

        $validator
            ->integer('profile_id')
            ->notEmptyString('profile_id');

        $validator
            ->scalar('main_gate')
            ->maxLength('main_gate', 1)
            ->requirePresence('main_gate', 'create')
            ->allowEmptyString('main_gate');

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
        $rules->add($rules->existsIn('sourcing_event_id', 'SourcingEvents'), ['errorField' => 'sourcing_event_id']);
        $rules->add($rules->existsIn('profile_id', 'Profiles'), ['errorField' => 'profile_id']);

        return $rules;
    }
}
