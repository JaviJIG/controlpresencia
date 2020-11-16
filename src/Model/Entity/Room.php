<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Room Entity
 *
 * @property int $id
 * @property int $building_id
 * @property string $name
 * @property string|null $url
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Building $building
 * @property \App\Model\Entity\Log[] $logs
 */
class Room extends Entity
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
        'name' => true,
        'url' => true,
        'created' => true,
        'modified' => true,
        'building' => true,
        'logs' => true,
    ];
}
