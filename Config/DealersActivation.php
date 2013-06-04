<?php

/**
 * Croogo Dealers Extension Schema
 *
 * @category Config
 * @package  Croogo.Dealers
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */

class DealersActivation
{
    /**
     * onActivate will be called if this returns true
     *
     * @param object $controller Controller
     * @return boolean
     */
    public function beforeActivation($controller)
    {
        return true;
    }

    /**
     * onActivation of plugin
     *
     * @param Object $controller
     */
    public function onActivation($controller)
    {
        $controller->Croogo->addAco('Dealers');
        $controller->Croogo->addAco('Dealers/Dealers');
        $controller->Croogo->addAco('Dealers/Dealers/admin_index');
        $controller->Croogo->addAco('Dealers/Dealers/admin_add');
        $controller->Croogo->addAco('Dealers/Dealers/admin_edit');
        $controller->Croogo->addAco('Dealers/Dealers/admin_delete');
        $controller->Croogo->addAco('Dealers/DealerPlaces');
        $controller->Croogo->addAco('Dealers/DealerPlaces/admin_index');
        $controller->Croogo->addAco('Dealers/DealerPlaces/admin_add');
        $controller->Croogo->addAco('Dealers/DealerPlaces/admin_edit');
        $controller->Croogo->addAco('Dealers/DealerPlaces/admin_delete');

        App::import('Core', 'File');
        App::import('Model', 'CakeSchema', false);
        App::import('Model', 'ConnectionManager');

        $db = ConnectionManager::getDataSource('default');
        if (!$db->isConnected()) {
            $this->Session->setFlash(__('Could not connect to database.', true));
        } else {
            CakePlugin::load('Dealers');
            $schema =& new CakeSchema(array('plugin' => 'Dealers', 'name' => 'Dealers'));
            $schema = $schema->load();
            foreach ($schema->tables as $table => $fields) {
                $create = $db->createSchema($schema, $table);
                $db->execute($create);
            }
        }
    }

    /**
     * onDeactivate will be called if this returns true
     *
     * @param object $controller Controller
     * @return boolean
     */
    public function beforeDeactivation($controller)
    {
        return true;
    }

    /**
     * onDeactivation of plugin
     *
     * @param Object $controller
     */
    public function onDeactivation($controller)
    {
        App::import('Core', 'File');
        App::import('Model', 'CakeSchema', false);
        App::import('Model', 'ConnectionManager');

        $db = ConnectionManager::getDataSource('default');
        if (!$db->isConnected()) {
            $this->Session->setFlash(__('Could not connect to database.', true));
        } else {
            CakePlugin::load('Dealers');
            $schema =& new CakeSchema(array('plugin' => 'Dealers', 'name' => 'Dealers'));
            $schema = $schema->load();
            foreach ($schema->tables as $table => $fields) {
                $drop = $db->dropSchema($schema, $table);
                $db->execute($drop);
            }
        }

        $controller->Croogo->removeAco('Dealers');
    }
}