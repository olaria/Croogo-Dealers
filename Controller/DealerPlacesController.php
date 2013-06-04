<?php

App::uses('DealersAppController', 'Dealers.Controller');

/**
 * Croogo Dealers Extension
 * Dealer Places Controller
 *
 * @category Controller
 * @package  Croogo.Dealers
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */
class DealerPlacesController extends DealersAppController
{
    public $uses = array('Dealers.DealerPlace');

    /**
     * Admin index
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('title_for_layout', __d('croogo', 'Dealer Places'));

        $this->DealerPlace->recursive = 0;
        $this->paginate['DealerPlace']['order'] = 'DealerPlace.lft ASC';
        $this->set('places', $this->paginate());
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function admin_add()
    {
        $this->set('title_for_layout', __d('croogo', 'Add dealer place'));

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['DealerPlace']['status'] = 1;
            $data['DealerPlace']['created'] = date('Y-m-d H:i:s');
            $data['DealerPlace']['updated'] = date('Y-m-d H:i:s');
            $this->DealerPlace->create();
            if ($this->DealerPlace->save($data)) {
                $this->Session->setFlash(
                    __d('croogo', 'The dealer place has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(
                    __d('croogo', 'The dealer place could not be saved. Please, try again.'),
                    'default',
                    array('class' => 'error')
                );
            }
        }

        $parents = array(null => '') + $this->DealerPlace->generateTreeList(null, null, null, " - ");
        $this->set(compact('parents'));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->set('title_for_layout', __d('croogo', 'Edit dealer place'));

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__d('croogo', 'Invalid dealer place'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['DealerPlace']['updated'] = date('Y-m-d H:i:s');
            $data['DealerPlace']['status'] = 1;

            $this->DealerPlace->recursive = -1;
            $place = $this->DealerPlace->read(null, $id);
            foreach ($place['DealerPlace'] as $k => $v) {
                if (!empty($data['DealerPlace'][$k])) {
                    $place['DealerPlace'][$k] = $data['DealerPlace'][$k];
                }
            }

            if ($this->DealerPlace->save($place)) {
                $this->Session->setFlash(
                    __d('croogo', 'The dealer place has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(
                    __d('croogo', 'The dealer place could not be saved. Please, try again.'),
                    'default',
                    array('class' => 'error')
                );
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->DealerPlace->read(null, $id);
        }

        $parents = array(null => '') + $this->DealerPlace->generateTreeList(null, null, null, " - ");
        $this->set(compact('parents'));
    }

    /**
     * Admin delete
     *
     * @param integer $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(
                __d('croogo', 'Invalid id for dealer place'),
                'default',
                array('class' => 'error')
            );
            $this->redirect(array('action' => 'index'));
        }
        if ($this->DealerPlace->delete($id)) {
            $this->Session->setFlash(__d('croogo', 'Dealer place deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * Admin moveup
     *
     * @param integer $id
     * @param integer $step
     * @return void
     */
    public function admin_moveup($id, $step = 1)
    {
        if ($this->DealerPlace->moveUp($id, $step)) {
            $this->Session->setFlash(__d('croogo', 'Moved up successfully'), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__d('croogo', 'Could not move up'), 'default', array('class' => 'error'));
        }

        $this->redirect(array('action' => 'index'));
    }

    /**
     * Admin moveup
     *
     * @param integer $id
     * @param integer $step
     * @return void
     */
    public function admin_movedown($id, $step = 1)
    {
        if ($this->DealerPlace->moveDown($id, $step)) {
            $this->Session->setFlash(__d('croogo', 'Moved down successfully'), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__d('croogo', 'Could not move down'), 'default', array('class' => 'error'));
        }

        $this->redirect(array('action' => 'index'));
    }

}