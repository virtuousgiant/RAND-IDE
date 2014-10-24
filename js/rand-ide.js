jQuery(document).ready(function(e) {
	if (jQuery('#project_end').length > 0) {
		jQuery('#project_end').val(randEndDate);
		jQuery('#project_end').parents('li.form-row').hide();
	}
	if (jQuery('#default-project-end-date').length > 0) {
		jQuery('input[name="default_project_end_date"]').datepicker();
	}
});