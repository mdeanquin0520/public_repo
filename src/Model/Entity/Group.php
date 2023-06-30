<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Group Entity
 *
 * @property int $id
 * @property string|null $group_name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Event[] $events
 * @property \App\Model\Entity\GroupsUser[] $groups_users
 * @property \App\Model\Entity\Net[] $nets
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\Pacient[] $pacients
 * @property \App\Model\Entity\StatesxDay[] $statesx_days
 * @property \App\Model\Entity\StatusGroup[] $status_groups
 * @property \App\Model\Entity\StocksUser[] $stocks_users
 * @property \App\Model\Entity\Turn[] $turns
 * @property \App\Model\Entity\User[] $users
 */
class Group extends Entity
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
        'group_name' => true,
        'created' => true,
        'modified' => true,
        'events' => true,
        'groups_users' => true,
        'nets' => true,
        'orders' => true,
        'pacients' => true,
        'statesx_days' => true,
        'status_groups' => true,
        'stocks_users' => true,
        'turns' => true,
        'users' => true,
    ];
}
