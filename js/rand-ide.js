jQuery(document).ready(function(e) {
	if (jQuery('#project_end').length > 0) {
		jQuery('#project_end').val(randEndDate);
		// jQuery('#project_end').parents('li.form-row').hide();
		jQuery('#project_end').parents('li.form-row').css({'position':'relative', 'z-index':'1'}).prepend('<div style="width:100%; height:100%; position:absolute; z-index:2;"></div>');
		jQuery('#project_end').datepicker("destroy");
		jQuery('#project_end').removeClass("hasDatepicker").removeAttr('id');
		jQuery('#project_end').attr("readonly", "");
	}
	if (jQuery('#default-project-end-date').length > 0) {
		jQuery('input[name="default_project_end_date"]').datepicker();
	}
});