# CMB2 Tab

Tabs for [CMB2](https://github.com/WebDevStudios/CMB2).

## How it works?

This plugin adds new parameters to CMB2 boxes:

* vertical_tabs (bool)
* tabs (array)

## Example
```php
add_action( 'cmb2_admin_init', 'cmb2_sample_metabox' );
function cmb2_sample_metabox() {
	$cmb_demo = new_cmb2_box([
		'id' => 'metabox',
		'title' => __('Test Metabox', 'cmb2'),
		'object_types' => ['page', 'post'], // Post type
		'vertical_tabs' => true, // Set vertical tabs, default false
		'tabs' => [
			[
				'id' => 'tab-1',
				'icon' => 'dashicons-admin-site',
				'title' => 'Tab 1',
				'fields' => ['field_1', 'field_2'],
			],
			[
				'id' => 'tab-2',
				'icon' => 'dashicons-align-left',
				'title' => 'Tab 2',
				'fields' => ['field_3', 'field_4'],
			],
		],
	]);

	$cmb_demo->add_field([
		'name' => __('Test field 1', 'cmb2'),
		'id' => 'field_1',
		'type' => 'text',
	]);

	$cmb_demo->add_field([
		'name' => __('Test field 2', 'cmb2'),
		'id' => 'field_2',
		'type' => 'text',
	]);

	$cmb_demo->add_field([
		'name' => __('Test field 3', 'cmb2'),
		'id' => 'field_3',
		'type' => 'text',
	]);

	$cmb_demo->add_field([
		'name' => __('Test field 4', 'cmb2'),
		'id' => 'field_4',
		'type' => 'text',
	]);
}
```
