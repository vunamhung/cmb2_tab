<?php

namespace vnh\cmb2;

class Tab {
	public function __construct() {
		add_action('admin_enqueue_scripts', [$this, 'enqueue']);
		add_action('doing_dark_mode', [$this, 'setup_dark_mode']);

		add_action('cmb2_before_form', [$this, 'before_form'], 10, 4);
		add_action('cmb2_after_form', [$this, 'after_form'], 10, 4);
	}

	public function enqueue() {
		wp_enqueue_style('cmb-tabs', $this->dir_url('css/tabs.css'), [], '1.0.0');
		wp_enqueue_script('cmb-tabs', $this->dir_url('js/tabs.js'), ['jquery'], '1.0.0', true);
	}

	public function setup_dark_mode() {
		wp_enqueue_style('cmb-tabs-dark-mode', $this->dir_url('css/dark-mode.css'), [], '1.0.0');
	}

	public function before_form($cmb_id, $object_id, $object_type, \CMB2 $cmb) {
		if ($cmb->prop('tabs') && is_array($cmb->prop('tabs'))):
			$html = sprintf(
				'<div class="cmb-tabs-wrap cmb-tabs-%s"><div class="cmb-tabs">',
				$cmb->prop('vertical_tabs') ? 'vertical' : 'horizontal'
			);

			foreach ($cmb->prop('tabs') as $tab):
				$fields_selector = [];

				foreach ($tab['fields'] as $tab_field) {
					$fields_selector[] = sprintf('.cmb2-id-%s:not(.cmb2-tab-ignore)', str_replace('_', '-', sanitize_html_class($tab_field)));
				}

				$html .= sprintf(
					'<div id="%s" class="cmb-tab" data-fields="%s">',
					sprintf('%s-tab-%s', $cmb_id, $tab['id']),
					implode(', ', $fields_selector)
				);

				if (!empty($tab['icon'])) {
					$html .= sprintf(
						'<span class="cmb-tab-icon"><i class="%s"></i></span>',
						strpos($tab['icon'], 'dashicons') !== false ? 'dashicons ' . $tab['icon'] : $tab['icon']
					);
				}

				$html .= !empty($tab['title']) ? sprintf('<span class="cmb-tab-title">%s</span>', $tab['title']) : null;

				$html .= '</div>';
			endforeach;

			$html .= '</div>';

			echo $html;
		endif;
	}

	public function after_form($cmb_id, $object_id, $object_type, \CMB2 $cmb) {
		if ($cmb->prop('tabs') && is_array($cmb->prop('tabs'))):
			echo '</div>';
		endif;
	}

	protected function dir_url($path) {
		return plugin_dir_url(__FILE__) . $path;
	}
}

new Tab();
