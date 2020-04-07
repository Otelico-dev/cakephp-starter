/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	config.disableNativeSpellChecker = false;
	config.scayt_autoStartup = true;
	config.scayt_sLang = 'fr_FR';

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		// {
		// 	name: 'clipboard',
		// 	groups: ['clipboard', 'undo']
		// },
		{
			name: 'basicstyles',
			groups: ['basicstyles', 'cleanup']
		},
		{
			name: 'paragraph',
			groups: ['list', 'indent', 'blocks', 'align', 'bidi']
		},
		{
			name: 'styles'
		},

		{
			name: 'links'
		},
		{
			name: 'insert'
		},
		{
			name: 'forms'
		},

		{
			name: 'editing',
			groups: ['find', 'selection', 'spellchecker']
		},
		{
			name: 'document',
			groups: ['mode', 'document', 'doctools']
		},
		{
			name: 'tools'
		},
		{
			name: 'others'
		},
		// '/',

		// {
		// 	name: 'colors'
		// },
		// { name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Styles';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	// Allow extra HTML elements
	config.extraAllowedContent = 'div(*);sup(*);iframe[*];*(*);*{*}';

	// Enable native browser spell check
	config.disableNativeSpellChecker = true;

	config.filebrowserBrowseUrl = '/js/ckeditor/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=';
	config.filebrowserUploadUrl = '/js/ckeditor/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=';
	config.filebrowserImageBrowseUrl = '/js/ckeditor/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=';
};

// CKEDITOR.plugins.load('pgrfilemanager');