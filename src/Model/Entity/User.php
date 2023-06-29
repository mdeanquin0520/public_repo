<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $email
 * @property string|null $firstname
 * @property string|null $lastname
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $profile_id
 * @property int|null $referrer_id
 * @property bool $active
 * @property string|null $image_file_name_url
 * @property string|null $image_file_name
 * @property string|null $image_file_name_filename
 * @property string|null $map_lat
 * @property string|null $map_long
 * @property string $code
 * @property int|null $status
 * @property bool|null $isolated
 * @property string|null $token
 *
 * @property \Acl\Model\Entity\Aro[] $aro
 * @property \App\Model\Entity\Profile $profile
 * @property \App\Model\Entity\User $referrer
 * @property \App\Model\Entity\EventsUser[] $events_users
 * @property \App\Model\Entity\GroupsUser[] $groups_users
 * @property \App\Model\Entity\Observation[] $observations
 * @property \App\Model\Entity\Pacient[] $pacients
 * @property \App\Model\Entity\StatesxDay[] $statesx_days
 * @property \App\Model\Entity\StatusGroup[] $status_groups
 * @property \App\Model\Entity\Turn[] $turns
 * @property \App\Model\Entity\Turn[] $doctor_t
 * @property \App\Model\Entity\Event[] $events
 * @property \App\Model\Entity\Group[] $groups
 * @property \App\Model\Entity\Stock[] $stocks
 */
class User extends Entity
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
        'username' => true,
        'password' => true,
        'email' => true,
        'firstname' => true,
        'lastname' => true,
        'created' => true,
        'modified' => true,
        'profile_id' => true,
        'referrer_id' => true,
        'active' => true,
        'image_file_name_url' => true,
        'image_file_name' => true,
        'image_file_name_filename' => true,
        'map_lat' => true,
        'map_long' => true,
        'code' => true,
        'status' => true,
        'isolated' => true,
        'token' => true,
        'aro' => true,
        'profile' => true,
        'referrer' => true,
        'events_users' => true,
        'groups_users' => true,
        'observations' => true,
        'pacients' => true,
        'statesx_days' => true,
        'status_groups' => true,
        'turns' => true,
        'doctor_t' => true,
        'events' => true,
        'groups' => true,
        'stocks' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
        'token',
    ];

	function _getFullName(){
		return $this->lastname.", ".$this->firstname;
	}

    public function parentNode()
    {
        if (!$this->id) {
            return null;
        }
        if (isset($this->profile_id)) {
            $groupId = $this->profile_id;
        } else {
            $Users = TableRegistry::get('Users');
            $user = $Users->find('all', ['fields' => ['profile_id']])->where(['id' => $this->id])->first();
            $groupId = $user->profile_id;
        }
        if (!$groupId) {
            return null;
        }
        return ['Profiles' => ['id' => $groupId]];
    }

	public function bindNode($user) {
		return ['model' => 'Profiles', 'foreign_key' => $user['Users']['profile_id']];
	}
}
