<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SourcingEventsProfile Entity
 *
 * @property int $id
 * @property int $sourcing_event_id
 * @property int $profile_id
 * @property string $main_gate
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\SourcingEvent $sourcing_event
 * @property \App\Model\Entity\Profile $profile
 */
class SourcingEventsProfile extends Entity
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
        'sourcing_event_id' => true,
        'profile_id' => true,
        'main_gate' => true,
        'created' => true,
        'modified' => true,
        'sourcing_event' => true,
        'profile' => true,
    ];
}
