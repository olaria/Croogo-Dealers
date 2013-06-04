<?php

$this->extend('/Common/admin_index');

$this->Html
    ->addCrumb('', '/admin', array('icon' => 'home'))
    ->addCrumb(__d('croogo', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'))
    ->addCrumb(__d('croogo', 'Dealers'), $this->here);

?>
<table class="table table-striped">
    <?php
    $tableHeaders = $this->Html->tableHeaders(
        array(
            $this->Paginator->sort('id'),
            $this->Paginator->sort('Place'),
            $this->Paginator->sort('Name'),
            $this->Paginator->sort('Phone'),
            $this->Paginator->sort('Email'),
            __d('croogo', 'Actions'),
        )
    );
    ?>
    <thead>
    <?php echo $tableHeaders; ?>
    </thead>
    <?php

    $rows = array();
    foreach ($dealers as $dealer) :
        $actions = array();
        $actions[] = $this->Croogo->adminRowActions($dealer['Dealer']['id']);
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'dealers', 'action' => 'edit', $dealer['Dealer']['id']),
            array('icon' => 'pencil', 'tooltip' => __d('croogo', 'Edit this item'))
        );
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'dealers', 'action' => 'delete', $dealer['Dealer']['id']),
            array('icon' => 'trash', 'tooltip' => __d('croogo', 'Remove this item')),
            __d('croogo', 'Are you sure?')
        );
        $actions = $this->Html->div('item-actions', implode(' ', $actions));
        $rows[] = array(
            $dealer['Dealer']['id'],
            $dealer['DealerPlace']['name'],
            $this->Html->link(
                $dealer['Dealer']['name'],
                array('controller' => 'dealers', 'action' => 'view', $dealer['Dealer']['id'])
            ),
            $dealer['Dealer']['phone'],
            $dealer['Dealer']['email'],
            $actions,
        );
    endforeach;

    echo $this->Html->tableCells($rows);
    ?>
</table>