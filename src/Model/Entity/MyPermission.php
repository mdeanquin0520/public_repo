<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MyPermission Entity
 *
 * @property int $id
 * @property int $aro_id
 * @property int $aco_id
 * @property string $_create
 * @property string $_read
 * @property string $_update
 * @property string $_delete
 *
 * @property \Acl\Model\Entity\Aro $aro
 * @property \Acl\Model\Entity\Aco $aco
 */
class MyPermission extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'aro_id' => true,
        'aco_id' => true,
        '_create' => true,
        '_read' => true,
        '_update' => true,
        '_delete' => true,
        'aro' => true,
        'aco' => true,
    ];
}
