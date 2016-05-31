
function ytp_widget_type_change(self) {
	var $this = jQuery(self),
		value = $this.val();

	$this.parent().siblings('.ytp-widget-type-field').hide();
	$this.parent().siblings('.ytp-widget-type-field-'+value).show();

}
