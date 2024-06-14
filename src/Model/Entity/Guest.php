<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Guest Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $person_id
 *
 * @property \App\Model\Entity\Person $person
 * @property \App\Model\Entity\Activity[] $activities
 */
class Guest extends Entity
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
        'created' => true,
        'modified' => true,
        'person_id' => true,
        'person' => true,
        'activities' => true,
    ];
}
