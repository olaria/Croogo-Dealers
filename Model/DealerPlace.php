<?php

app::uses("AppModel", "Model");

/**
 * Croogo Dealers Extension
 * DealerPlace Model
 *
 * @category Model
 * @package  Croogo.Dealers
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */
class DealerPlace extends AppModel
{

    /**
     * Model name
     *
     * @var string
     */
    public $name = "DealerPlace";

    /**
     * Behaviors used by the Model
     *
     * @var array
     */
    public $actsAs = array(
        'Tree',
        'Search.Searchable',
    );

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'id' => array(
            'blank' => array(
                'rule' => 'blank',
                'on' => 'create',
            ),
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'This field cannot be left blank.',
                'on' => 'update',
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'This field must be numeric.',
                'on' => 'update',
            ),
        ),
        'parent_id' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'allowEmpty' => true,
                'message' => 'This field must be numeric.',
            ),
        ),
        'lft' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'allowEmpty' => true,
                'message' => 'This field must be numeric.',
            ),
        ),
        'rght' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'allowEmpty' => true,
                'message' => 'This field must be numeric.',
            ),
        ),
        'name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'This field cannot be left blank.',
            ),
            'minLength' => array(
                'rule' => array('minLength', 3),
                'required' => true,
                'message' => 'This field must be at least 3 characters long.'
            ),
        ),
        'status' => array(
            'inList' => array(
                'rule' => array('inList', array(0, 1)),
                'required' => true,
                'message' => 'This field must be either Active or Inactive.',
            ),
        ),
        'created' => array(
            'datetime' => array(
                'rule' => 'datetime',
                'required' => true,
                'message' => 'This field must be datetime',
            )
        ),
        'updated' => array(
            'datetime' => array(
                'rule' => 'datetime',
                'required' => true,
                'message' => 'This field must be datetime',
            )
        ),
    );

    /**
     * Model associations: hasMany
     *
     * @var array
     */
    public $hasMany = array(
        'Dealer' => array(
            'className' => 'Dealers.Dealer',
            'foreignKey' => 'place_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
        ),
        'Children' => array(
            'className' => 'Dealers.DealerPlace',
            'foreignKey' => 'parent_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
        ),
    );

    /**
     * Model associations: belongsTo
     *
     * @var array
     */
    public $belongsTo = array(
        'Parent' => array(
            'className' => 'Dalers.DealerPlace',
            'foreignKey' => 'parent_id',
        ),
    );
}