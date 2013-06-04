<?php

App::uses('DealersAppController', 'Dealers.Controller');

/**
 * Croogo Dealers Extension
 * Dealers Controller
 *
 * @category Controller
 * @package  Croogo.Dealers
 * @version  0.1
 * @author   Helder Santana <helder@olaria.me>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.oalria.me
 */
class DealersController extends DealersAppController
{
    public $uses = array('Dealers.Dealer', 'Dealers.DealerPlace');

    /**
     * Admin index
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('title_for_layout', __d('croogo', 'Dealers'));

        $this->Dealer->recursive = 0;
        $this->paginate['Dealer']['order'] = 'Dealer.updated DESC';
        $this->set('dealers', $this->paginate());
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function admin_add()
    {
        $this->set('title_for_layout', __d('croogo', 'Add dealer'));

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['Dealer']['status'] = 1;
            $data['Dealer']['created'] = date('Y-m-d H:i:s');
            $data['Dealer']['updated'] = date('Y-m-d H:i:s');
            $this->Dealer->create();
            if ($this->Dealer->save($data)) {
                $this->Session->setFlash(
                    __d('croogo', 'The dealer has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                print_r($this->Dealer->validationErrors);
                $this->Session->setFlash(
                    __d('croogo', 'The dealer could not be saved. Please, try again.'),
                    'default',
                    array('class' => 'error')
                );
            }
        }

        $places = $this->Dealer->DealerPlace->generateTreeList(null, null, null, " -> ");
        $this->set(compact('places'));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->set('title_for_layout', __d('croogo', 'Edit dealer'));

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__d('croogo', 'Invalid dealer'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['Dealer']['updated'] = date('Y-m-d H:i:s');
            $data['Dealer']['status'] = 1;

            $this->Dealer->recursive = -1;
            $dealer = $this->Dealer->read(null, $id);
            foreach ($dealer['Dealer'] as $k => $v) {
                if (!empty($data['Dealer'][$k])) {
                    $dealer['Dealer'][$k] = $data['Dealer'][$k];
                }
            }

            if ($this->Dealer->save($dealer)) {
                $this->Session->setFlash(
                    __d('croogo', 'The dealer has been saved'),
                    'default',
                    array('class' => 'success')
                );
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(
                    __d('croogo', 'The dealer could not be saved. Please, try again.'),
                    'default',
                    array('class' => 'error')
                );
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Dealer->read(null, $id);
        }

        $places = $this->Dealer->DealerPlace->generateTreeList(null, null, null, " - ");
        $this->set(compact('places'));
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
            $this->Session->setFlash(__d('croogo', 'Invalid id for dealer'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Dealer->delete($id)) {
            $this->Session->setFlash(__d('croogo', 'Dealer deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }
}