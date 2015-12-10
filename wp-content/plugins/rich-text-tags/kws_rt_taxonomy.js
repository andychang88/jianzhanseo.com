// For use with Rich Text Tags, Categories, and Taxonomies WordPress Plugin

function kwsTriggerSave() {
	var rich = (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden();
	if (rich) {
		ed = tinyMCE.activeEditor;
		if ( 'mce_fullscreen' == ed.id || 'wp_mce_fullscreen' == ed.id ) {
			tinyMCE.get(0).setContent(ed.getContent({format : 'raw'}), {format : 'raw'});
		}
		tinyMCE.triggerSave();
	}
}

jQuery(document).ready(function($) {

	// Remove the non-rich fields
	$('.form-field').has('#tag-description').remove();
	$('.form-field').has('#category-description').remove();
	$('.form-field').has('#description').remove();
	
	// Make sure you're saving the latest content
	$('input#submit').click(function(e) {	
		kwsTriggerSave();
	});
		
});	/* end ready() */	

// On a successful save, reset field
jQuery(document).ajaxComplete(function(e, xhr, settings) {
	if(settings.data.match(/action=(add|update)-tag/)) {
		tinyMCE.get(0).setContent('');
		kwsTriggerSave();
	}
});