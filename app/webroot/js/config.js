/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
CKEDITOR.config.bodyId = 'content';
CKEDITOR.config.entities = false;
CKEDITOR.on( 'instanceReady', function( ev )
    {
    var editor = ev.editor,
      dataProcessor = editor.dataProcessor,
      htmlFilter = dataProcessor && dataProcessor.htmlFilter;
      
    // Output self closing tags the HTML4 way, like <br>.
    dataProcessor.writer.selfClosingEnd = '>';

    // Output dimensions of images as width and height
    htmlFilter.addRules(
    {
      elements :
      {
        $ : function( element )
        {
          if ( element.name == 'img' )
          {
            var style = element.attributes.style;

            if ( style )
            {
              // Get the width from the style.
              var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec( style ),
                width = match && match[1];

              // Get the height from the style.
              match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec( style );
              var height = match && match[1];


              if ( height )
              {
                element.attributes.style = element.attributes.style.replace( /(?:^|\s)height\s*:\s*(\d+)px;?/i , '' );
                element.attributes.height = height;
              }

              if ( width )
              {
                element.attributes.style = element.attributes.style.replace( /(?:^|\s)width\s*:\s*(\d+)px;?/i , '' );
                
            if (width > 600)
               {   
                  var new_height = (((600*100)/width)/100);
                  element.attributes.width = 600;
                  element.attributes.height = (Math.ceil(height*new_height));}
            else 
               {element.attributes.width = width;}
              }


            }
          }


          if ( !element.attributes.style || !element.attributes.style.replace(/^\s*([\S\s]*?)\s*$/, '$1').length )
            delete element.attributes.style;

          return element;
        }
      }
    } );
    
    });
