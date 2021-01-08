<?php

namespace AdminTheme\View\Helper;

use Cake\View\Helper;
use Cake\Utility\Text;

class CkEditorHelper extends Helper
{


	public function getJavascript(string $id, array $options = [])
	{
		$id = $this->formatId($id);

		$lang = 'fr_FR';
		$editor_js = <<<JAVASCRIPT

			CKEDITOR.replace('$id', { 
				language: '$lang', 
				scayt_sLang: '$lang',
				height: 600
			}); 
			
JAVASCRIPT;

		return $editor_js . $this->openFileBrowserInModal();
	}

	protected function openFileBrowserInModal()
	{
		$file_manager_url = FILE_MANAGER_URL;

		return <<<JS
            CKEDITOR.on('dialogDefinition', function(event) {
                var editor = event.editor;
                var dialogDefinition = event.data.definition;
                // console.log(event.editor);
                var dialogName = event.data.name;

                var cleanUpFuncRef = CKEDITOR.tools.addFunction(function ()
                {
                    // Do the clean-up of filemanager here (called when an image was selected or cancel was clicked)
                    $('#fm-modal-container').remove();
                    $("body").css("overflow-y", "scroll");
                });
                
                $('body').on('click','#close-fm-modal',function() {
                    $('#fm-modal-container').remove();
                    $("body").css("overflow-y", "scroll");
                });
                
                var tabCount = dialogDefinition.contents.length;
                for (var i = 0; i < tabCount; i++) {
                    var browseButton = dialogDefinition.contents[i].get('browse');

                    if (browseButton !== null) {
                        browseButton.hidden = false;
                        browseButton.onClick = function(dialog, i) {
                            editor._.filebrowserSe = this;
                            
                            var iframe = $("<iframe id='filemanager_iframe' class='fm-modal'/>").attr({
                                src: '$file_manager_url&editor=ckeditor' + // Change it to wherever  Filemanager is stored.
                                    '&CKEditorFuncNum=' + CKEDITOR.instances[event.editor.name]._.filebrowserFn +
                                    '&CKEditorCleanUpFuncNum=' + cleanUpFuncRef +
                                    '&langCode=fr' +
                                    '&CKEditor=' + event.editor.name
                            });

                            var iframe_container = $('<div id="fm-modal-container"><a href="#" id="close-fm-modal">&#10006;</a></div>');
                            
                            iframe_container.append(iframe);
                            
	                        $("body").append(iframe_container);
                            $("body").css("overflow-y", "hidden");  
                            
                        }
                    }
                }
            });
JS;
	}

	protected function formatId($id)
	{
		return mb_strtolower(Text::slug($id, '-'));
	}

	public function getJavascriptV5(string $id, array $options = [])
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
