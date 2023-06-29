<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MyPermissions Model
 *
 * @property \Acl\Model\Table\ArosTable&\Cake\ORM\Association\BelongsTo $Aros
 * @property \Acl\Model\Table\AcosTable&\Cake\ORM\Association\BelongsTo $Acos
 *
 * @method \App\Model\Entity\MyPermission newEmptyEntity()
 * @method \App\Model\Entity\MyPermission newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MyPermission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MyPermission get($primaryKey, $options = [])
 * @method \App\Model\Entity\MyPermission findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MyPermission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MyPermission[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MyPermission|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MyPermission saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MyPermission[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MyPermission[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MyPermission[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MyPermission[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MyPermissionsTable extends Table
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

        $this->setTable('aros_acos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Aros', [
            'foreignKey' => 'aro_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Acos', [
            'foreignKey' => 'aco_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('_create')
            ->maxLength('_create', 2)
            ->notEmptyString('_create');

        $validator
            ->scalar('_read')
            ->maxLength('_read', 2)
            ->notEmptyString('_read');

        $validator
            ->scalar('_update')
            ->maxLength('_update', 2)
            ->notEmptyString('_update');

        $validator
            ->scalar('_delete')
            ->maxLength('_delete', 2)
            ->notEmptyString('_delete');

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
        $rules->add($rules->existsIn(['aro_id'], 'Aros'), ['errorField' => 'aro_id']);
        $rules->add($rules->existsIn(['aco_id'], 'Acos'), ['errorField' => 'aco_id']);

        return $rules;
    }
}
