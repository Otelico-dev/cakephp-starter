<?php


namespace AdminTheme\View\Helper;

use Cake\View\Helper;

use Cake\Routing\Router;

class DtReorderHelper extends Helper
{
	public function getScript($table_id, $reorder_url)
	{

		$reorder_url = Router::url($reorder_url);

		return <<<EOT
		$('#$table_id').on('row-reorder.dt', function(dragEvent, data, nodes) {

		var updated_rows = [];

		for (i = 0; i < data.length; i++) {
			updated_rows.push({
				id: $(data[i].node.cells[0]).text(),
				new_position: data[i].newPosition
			});
		}
		if (updated_rows.length) {
			$.post('$reorder_url', {
				data: updated_rows
			}, function(data) {
				$('#$table_id').dataTable().api().draw(false);
			});
		}
	});
EOT;
	}
}
