<?=

    $this->Html->link(
        '<i class="fa fa-pencil" aria-hidden="true"></i>',
        $params['url'],
        [
            'class' => 'btn btn-sm btn-primary',
            'escape' => false,
            'target' => (isset($params['target'])) ? $params['target'] : ''
        ]
    );
