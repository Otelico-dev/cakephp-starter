<?php

namespace AdminTheme\View\Helper;

use Cake\View\Helper;
use Cake\Utility\Text;

class CkEditorHelper extends Helper
{

	public function getJavascript(string $id, array $options = [])
	{

		$id = mb_strtolower(Text::slug($id, '-'));

		return <<<JAVASCRIPT
		ClassicEditor
			.create( document.querySelector('#$id'))
			.then(editor => {
				console.log(editor);
			})
			.catch(error => {
				console.error(error);
			});
JAVASCRIPT;
	}
}
