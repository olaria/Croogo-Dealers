<?php

$this->extend('/Common/admin_index');

$this->Html
    ->addCrumb('', '/admin', array('icon' => 'home'))
    ->addCrumb(__d('croogo', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'))
    ->addCrumb(__d('croogo', 'Dealers'), array('plugin' => 'dealers', 'controller' => 'dealers', 'action' => 'index'))
    ->addCrumb(__d('croogo', 'Places'), $this->here);

?>
<table class="table table-striped">
    <?php
    $tableHeaders = $this->Html->tableHeaders(
        array(
            $this->Paginator->sort('id'),
            $this->Paginator->sort('Parent'),
            $this->Paginator->sort('Name'),
            __d('croogo', 'Actions'),
        )
    );
    ?>
    <thead>
    <?php echo $tableHeaders; ?>
    </thead>
    <?php

    $rows = array();
    foreach ($places as $place) :
        $actions = array();
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'dealer_places', 'action' => 'moveup', $place['DealerPlace']['id']),
            array('icon' => 'chevron-up', 'tooltip' => __d('croogo', 'Move up'))
        );
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'dealer_places', 'action' => 'movedown', $place['DealerPlace']['id']),
            array('icon' => 'chevron-down', 'tooltip' => __d('croogo', 'Move down'))
        );
        $actions[] = $this->Croogo->adminRowActions($place['DealerPlace']['id']);
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'dealer_places', 'action' => 'edit', $place['DealerPlace']['id']),
            array('icon' => 'pencil', 'tooltip' => __d('croogo', 'Edit this item'))
        );
        $actions[] = $this->Croogo->adminRowAction(
            '',
            array('controller' => 'dealer_places', 'action' => 'delete', $place['DealerPlace']['id']),
            array('icon' => 'trash', 'tooltip' => __d('croogo', 'Remove this item')),
            __d('croogo', 'Are you sure?')
        );
        $actions = $this->Html->div('item-actions', implode(' ', $actions));
        $rows[] = array(
            $place['DealerPlace']['id'],
            !empty($place['Parent']['name']) ? $place['Parent']['name'] : "",
            $this->Html->link(
                $place['DealerPlace']['name'],
                array('controller' => 'dealer_places', 'action' => 'edit', $place['DealerPlace']['id'])
            ),
            $actions,
        );
    endforeach;

    echo $this->Html->tableCells($rows);
    ?>
</table>