<?=
    $this->Form->postButton(
        '<i class="fa fa-trash" aria-hidden="true"></i>',
        $params['url'],
        [
            'class' => 'btn btn-sm btn-danger',
            'escape' => false,
            'confirm' => $params['confirm_message'],

        ]
    );
