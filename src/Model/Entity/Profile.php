<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Profile Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $referrer_profile_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \Acl\Model\Entity\Aro[] $aro
 * @property \App\Model\Entity\Profile $referrer_profile
 * @property \App\Model\Entity\ProfilesGate[] $profiles_gates
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\SourcingEvent[] $sourcing_events
 */
class Profile extends Entity
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
        'name' => true,
        'description' => true,
        'referrer_profile_id' => true,
        'created' => true,
        'modified' => true,
        'aro' => true,
        'referrer_profile' => true,
        'profiles_gates' => true,
        'users' => true,
        'sourcing_events' => true,
    ];

    public function parentNode()
    {
        return null;
    }
}
