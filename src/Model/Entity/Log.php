<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Log Entity
 *
 * @property int $id
 * @property int $building_id
 * @property int|null $room_id
 * @property int $staff_id
 * @property int $action_id
 * @property \Cake\I18n\FrozenTime $timestamp
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Building $building
 * @property \App\Model\Entity\Room $room
 * @property \App\Model\Entity\Staff $staff
 * @property \App\Model\Entity\Action $action
 */
class Log extends Entity
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
        'building_id' => true,
        'room_id' => true,
        'staff_id' => true,
        'action_id' => true,
        'timestamp' => true,
        'created' => true,
        'modified' => true,
        'building' => true,
        'room' => true,
        'staff' => true,
        'action' => true,
        'latitude' => true,
        'longitude' => true,
    ];
}
