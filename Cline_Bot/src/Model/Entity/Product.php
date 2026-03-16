<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property string $id
 * @property string $name
 * @property string $category_id
 * @property float $price
 * @property int $stock
 * @property string|null $size
 * @property string|null $color
 * @property string|null $sku
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Category $category
 */
class Product extends Entity
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
    protected array $_accessible = [
        'name' => true,
        'category_id' => true,
        'price' => true,
        'stock' => true,
        'size' => true,
        'color' => true,
        'sku' => true,
        'created' => true,
        'modified' => true,
    ];
}
