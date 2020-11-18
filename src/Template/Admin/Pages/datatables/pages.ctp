<?php 

foreach($results as $result) {

	$this->DataTables->prepareData([
		$result->id,
		$this->Element('AdminTheme.Actions/link_modify', [
            'params' => [
                'url' => [
                    'action' => 'edit',
                    $result->id
                ]
            ]
        ]).
		$this->Element('AdminTheme.Actions/link_delete', [
			'params' => [
				'url' => [
					'action' => 'delete',
					$result->id
				],
				'confirm_message' => 'Do you really want to delete the record : ' . $result->id . ' ?'
			]
		])
	]);


}

echo $this->DataTables->response();