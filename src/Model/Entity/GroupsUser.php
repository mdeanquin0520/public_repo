<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GroupsUser Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $group_id
 * @property int|null $net_id
 * @property string|null $main_gate
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\Net $net
 */
class GroupsUser extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'user_id' => true,
        'group_id' => true,
        'net_id' => true,
        'main_gate' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'group' => true,
        'net' => true,
    ];
}
