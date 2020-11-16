<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Building Entity
 *
 * @property int $id
 * @property string $name ¡
 * @property string|null $url
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Log[] $logs
 * @property \App\Model\Entity\Room[] $rooms
 */
class Building extends Entity
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
        'name' => true,
        'url' => true,
        'created' => true,
        'modified' => true,
        'logs' => true,
        'rooms' => true,
    ];
}
