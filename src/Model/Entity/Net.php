<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Net Entity
 *
 * @property int $id
 * @property string|null $net_name
 * @property int|null $group_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\StatesxDay[] $statesx_days
 * @property \App\Model\Entity\Event[] $events
 * @property \App\Model\Entity\GroupsUser[] $groups_users
 * @property \App\Model\Entity\Pacient[] $pacients
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\StatusGroup[] $status_groups
 * @property \App\Model\Entity\StocksUser[] $stocks_users
 * @property \App\Model\Entity\Turn[] $turns
 */
class Net extends Entity
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
        'net_name' => true,
        'group_id' => true,
        'created' => true,
        'modified' => true,
        'group' => true,
        'statesx_days' => true,
        'events' => true,
        'groups_users' => true,
        'pacients' => true,
        'orders' => true,
        'status_groups' => true,
        'stocks_users' => true,
        'turns' => true,
    ];
}
