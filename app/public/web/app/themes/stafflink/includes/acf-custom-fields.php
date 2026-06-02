<?php
if( function_exists('acf_add_local_field_group') ):
	acf_add_local_field_group([
		'key' => 'group_job_details',
		'title' => 'Job Details',
		'fields' => [
			['key' => 'field_min_salary', 'label' => 'Min Salary', 'name' => 'min_salary', 'type' => 'number'],
			['key' => 'field_max_salary', 'label' => 'Max Salary', 'name' => 'max_salary', 'type' => 'number'],
			['key' => 'field_hours', 'label' => 'Working Hours', 'name' => 'working_hours', 'type' => 'text'],
			['key' => 'field_ea_personnel', 'label' => 'EA Personnel', 'name' => 'ea_personnel', 'type' => 'text'],
			['key' => 'field_ea_reg_no', 'label' => 'EA Reg No.', 'name' => 'ea_reg_no', 'type' => 'text'],
		],
		'location' => [
			[['param' => 'post_type', 'operator' => '==', 'value' => 'job']]
		],
	]);
endif;
?>