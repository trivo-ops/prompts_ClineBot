<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
            'propertyName' => 'product_category'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation.Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255, 'Product name cannot exceed 255 characters')
            ->requirePresence('name', 'create', 'Product name is required')
            ->notEmptyString('name', 'Product name cannot be empty')
            ->minLength('name', 2, 'Product name must be at least 2 characters long');

        $validator
            ->uuid('category_id')
            ->requirePresence('category_id', 'create', 'Category is required')
            ->notEmptyString('category_id', 'Category cannot be empty');

        $validator
            ->decimal('price', 2, 'Price must be a valid decimal number with up to 2 decimal places')
            ->requirePresence('price', 'create', 'Price is required')
            ->notEmptyString('price', 'Price cannot be empty')
            ->greaterThanOrEqual('price', 0, 'Price cannot be negative')
            ->greaterThan('price', 0, 'Price must be greater than zero');

        $validator
            ->integer('stock')
            ->requirePresence('stock', 'create', 'Stock quantity is required')
            ->notEmptyString('stock', 'Stock quantity cannot be empty')
            ->greaterThanOrEqual('stock', 0, 'Stock cannot be negative')
            ->naturalNumber('stock', 'Stock must be a whole number');

        $validator
            ->scalar('size')
            ->maxLength('size', 20, 'Size cannot exceed 20 characters')
            ->allowEmptyString('size')
            ->add('size', 'validSize', [
                'rule' => ['inList', ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'One Size'], false],
                'message' => 'Please select a valid size option'
            ]);

        $validator
            ->scalar('color')
            ->maxLength('color', 50, 'Color cannot exceed 50 characters')
            ->allowEmptyString('color')
            ->add('color', 'validColor', [
                'rule' => ['inList', ['Red', 'Blue', 'Green', 'Black', 'White', 'Yellow', 'Purple', 'Orange', 'Pink', 'Brown', 'Gray', 'Navy', 'Beige'], false],
                'message' => 'Please select a valid color option'
            ]);

        $validator
            ->scalar('sku')
            ->maxLength('sku', 50, 'SKU cannot exceed 50 characters')
            ->requirePresence('sku', 'create', 'SKU is required')
            ->notEmptyString('sku', 'SKU cannot be empty')
            ->add('sku', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'This SKU is already in use'
            ])
            ->add('sku', 'format', [
                'rule' => ['custom', '/^[A-Z0-9-]{3,50}$/'],
                'message' => 'SKU must contain only uppercase letters, numbers, and hyphens'
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name'], 'Product name must be unique'));

        // Add category existence validation in buildRules instead of validationDefault
        $rules->add($rules->existsIn(['category_id'], 'Categories', 'Please select a valid category'));

        return $rules;
    }
}
