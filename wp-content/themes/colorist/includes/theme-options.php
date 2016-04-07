<?php
require_once get_template_directory() . '/includes/options-config.php';
	if( ! class_exists('Wbls_Customizer_API_Wrapper') ) {
			require_once get_template_directory() . '/admin/class.wbls-customizer-api-wrapper.php';
	}
	//echo '<pre>', print_r($options), '</pre>';

Wbls_Customizer_API_Wrapper::getInstance($options);
