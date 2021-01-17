/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

 CKEDITOR.editorConfig = function (config) {

	config.contentsCss = [ 
	'http://localhost/aplikasi/assets/ckeditor_4.15.1_full/contents.css', 
	'http://localhost/aplikasi/assets/ckeditor_4.15.1_full/mystyles.css' 
	];
 	config.language = 'en';
 	config.protectedSource.push( /<\?[\s\S]*?\?>/g );

 	config.toolbarGroups = [
 	{ name: 'document', groups: ['document', 'mode', 'doctools'] },
 	{ name: 'clipboard', groups: ['clipboard', 'undo'] },
 	{ name: 'styles', groups: ['styles'] },
 	{ name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing'] },
 	{ name: 'forms', groups: ['forms'] },
 	{ name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
 	{ name: 'links', groups: ['links'] },
 	{ name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
 	{ name: 'insert', groups: ['insert'] },
 	{ name: 'colors', groups: ['colors'] },
 	{ name: 'tools', groups: ['tools'] },
 	{ name: 'others', groups: ['others'] },
 	{ name: 'about', groups: ['about'] }
 	];

 	config.removeButtons = 'NewPage,Preview,Print,Templates,Cut,Copy,Find,Replace,SelectAll,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Save,Undo,Redo,Subscript,Superscript,BidiLtr,BidiRtl,Language,Anchor,Flash,Smiley,SpecialChar,ShowBlocks,About,Iframe,TextColor,BGColor';

	// This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
	config.bodyClass = 'document-editor';

	// Reduce the list of block elements listed in the Format dropdown to the most commonly used.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Define the list of styles which should be available in the Styles dropdown list.
    // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
    // (and on your website so that it rendered in the same way).
    // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
    // that file, which means one HTTP request less (and a faster startup).
    // For more information see https://ckeditor.com/docs/ckeditor4/latest/features/styles.html

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

};