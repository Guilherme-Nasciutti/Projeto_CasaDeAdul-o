<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Activity Entity
 *
 * @property int $id
 * @property string $title
 * @property \Cake\I18n\FrozenDate $initial_date
 * @property \Cake\I18n\FrozenDate $final_date
 * @property int $start_time
 * @property int $duration
 * @property \Cake\I18n\FrozenTime $created
 * @property int $instructor_id
 *
 * @property \App\Model\Entity\Instructor $instructor
 * @property \App\Model\Entity\Guest[] $guests
 */
class Activity extends Entity
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
        'title' => true,
        'description' => true,
        'initial_date' => true,
        'final_date' => true,
        'start_time' => true,
        'duration' => true,
        'created' => true,
        'instructor_id' => true,
        'instructor' => true,
        'guests' => true,
    ];
}
