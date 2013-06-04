<?php
/**
 * Add Dealers to admin menu
 */
CroogoNav::add(
    'dealers',
    array(
        'title' => __d('croogo', 'Dealers'),
        'url' => array(
            'admin' => true,
            'plugin' => 'dealers',
            'controller' => 'dealers',
            'action' => 'index',
        ),
        'weight' => 50,
        'children' => array(
            'list' => array(
                'title' => __d('croogo', 'List'),
                'url' => array(
                    'admin' => true,
                    'plugin' => 'dealers',
                    'controller' => 'dealers',
                    'action' => 'index',
                ),
            ),
            'new' => array(
                'title' => __d('croogo', 'Add New'),
                'url' => array(
                    'admin' => true,
                    'plugin' => 'dealers',
                    'controller' => 'dealers',
                    'action' => 'add',
                ),
            ),
            'places' => array(
                'title' => __d('croogo', 'Places'),
                'url' => array(
                    'admin' => true,
                    'plugin' => 'dealers',
                    'controller' => 'dealer_places',
                    'action' => 'index',
                ),
            ),
        ),
    )
);