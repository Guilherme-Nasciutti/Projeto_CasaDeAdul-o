<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Person Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\FrozenDate $birthday
 * @property int $civil_status
 * @property string|null $phone
 * @property int|null $education
 * @property int $role_id
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Activity[] $activities
 */
class Person extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'birthday' => true,
        'civil_status' => true,
        'phone' => true,
        'education' => true,
        'role_id' => true,
        'role' => true,
        'activities' => true,
    ];
}
