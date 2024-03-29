<?php

$this->extend('/Common/admin_edit');

$this->Html
    ->addCrumb('', '/admin', array('icon' => 'home'))
    ->addCrumb(__d('croogo', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
    $this->Html
        ->addCrumb(__d('croogo', 'Dealers'), array('plugin' => 'dealers', 'controller' => 'dealers', 'action' => 'index',))
        ->addCrumb('Edit', $this->request->data['Dealer']['name']);
}

if ($this->request->params['action'] == 'admin_add') {
    $this->Html
        ->addCrumb(__d('croogo', 'Dealers'), array('plugin' => 'dealers', 'controller' => 'dealers', 'action' => 'index',))
        ->addCrumb(__d('croogo', 'Add'), $this->here);
}

echo $this->Form->create('Dealer');

?>
    <div class="row-fluid">
        <div class="span8">
            <ul class="nav nav-tabs">
                <?php
                echo $this->Croogo->adminTab(__d('croogo', 'Dealer'), '#dealer-basic');
                echo $this->Croogo->adminTabs();
                ?>
            </ul>

            <div class="tab-content">

                <div id="dealer-basic" class="tab-pane">
                    <?php
                    echo $this->Form->input('id');
                    $this->Form->inputDefaults(
                        array(
                            'class' => 'span10',
                            'label' => false,
                        )
                    );
                    echo $this->Form->input(
                        'place_id',
                        array(
                            'label' => __d('croogo', 'Place'),
                        )
                    );
                    echo $this->Form->input(
                        'name',
                        array(
                            'label' => __d('croogo', 'Name'),
                        )
                    );
                    echo $this->Form->input(
                        'phone',
                        array(
                            'label' => __d('croogo', 'Phone'),
                        )
                    );
                    echo $this->Form->input(
                        'email',
                        array(
                            'label' => __d('croogo', 'Email'),
                        )
                    );
                    echo $this->Form->input(
                        'description',
                        array(
                            'label' => __d('croogo', 'Description'),
                        )
                    );
                    ?>
                </div>

                <?php echo $this->Croogo->adminTabs(); ?>
            </div>
        </div>

        <div class="span4">
            <?php
            echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
                $this->Form->button(__d('croogo', 'Save'), array('button' => 'default')) .
                $this->Html->link(
                    __d('croogo', 'Cancel'),
                    array('action' => 'index'),
                    array('button' => 'danger')
                ) .
                $this->Html->endBox();
            ?>
        </div>

    </div>
<?php echo $this->Form->end(); ?>