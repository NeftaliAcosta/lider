<?php

/**
 * 
 * Plugin Class
 *
 * @version 1.3
 * @author  Rik de Vos
 */
class YTP_HTML {
	public static function checkbox($name, $checked, $toggle = '') {

		if(!empty($toggle)) {
			$toggle = ' data-toggle="'.$toggle.'"';
		}

		$checked = ($checked == 1) ? '1' : '0';

		//return '<a href="#" class="ytp-checkbox" data-checked="'.($checked == 1 ? 'true' : 'false').'" data-id="'.$name.'"'.$toggle.'>'.($checked == 1 ? 'YES' : 'NO').'</a><input style="display: none;" type="checkbox" name="'.$name.'" id="'.$name.'"'.($checked == 1 ? ' checked="checked"' : '').' />';

		return '<a href="#" class="ytp-checkbox" data-checked="'.$checked.'" data-id="'.$name.'"'.$toggle.'>'.($checked == 1 ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>').'</a><input style="display: none;" type="text" name="'.$name.'" id="'.$name.'" value="'.$checked.'" />';

	}

	public static function previous_colors() {
		$colors = YTP_DB::get('previous_colors');
		$html = '';
		foreach($colors as $color) {
			$html .= self::color($color);
		}
		return $html;
		// return '<a href="#" class="ytp-meta-event-color" style="background: #872fe9" data-color="#872FE9"></a>
		// <a href="#" class="ytp-meta-event-color" style="background: #977348" data-color="#977348"></a>
		// <a href="#" class="ytp-meta-event-color" style="background: #eace77" data-color="#eace77"></a>
		// <a href="#" class="ytp-meta-event-color" style="background: #1bbc9c" data-color="#1bbc9c"></a>';
	}

	// public static function color($color) {
	// 	return '<a href="#" class="ytp-meta-event-color" style="background: '.$color.'" data-color="'.$color.'"></a>';
	// }

	public static function textbox($name, $value = "", $class = "") {
		return '<div class="ytp-textbox"><input type="text" class="'.esc_attr($class).'" name="'.esc_attr($name).'" value="'.esc_attr($value).'" /></div>';
	}

	public static function textarea($name, $value = "", $class = "") {
		return '<div class="ytp-textarea"><textarea name="'.esc_attr($name).'">'.esc_textarea($value).'</textarea></div>';
	}

	public static function percentage($name, $value = "", $class = "") {
		return '<div class="ytp-number"><input type="number" min="0" max="100" step="5" class="'.esc_attr($class).'" name="'.esc_attr($name).'" value="'.esc_attr($value).'" /></div>';
	}

	public static function color($name, $value = "") {
		$html = '';
		$color = self::rgba_decode($value);
		$html .= self::percentage($name.'_opacity', round($color['alpha']*100));
		$html .= '<input type="text" class="ytp-color-picker" name="'.esc_attr($name).'_color" value="'.esc_attr($color['hex']).'" />';
		return $html;
	}

	public static function radio($name, $options, $value) {
		$html = '';
		foreach($options as $i => $option) {
			$key = $option[0];
			$title = $option[1];
			if($key == $value) {
				$html .= '<label style="margin: 4px 0; display: inline-block"><input type="radio" name="'.$name.'" value="'.esc_attr($key).'" checked="checked" />'.$title.'</label>';
			}else {
				$html .= '<label style="margin: 4px 0; display: inline-block"><input type="radio" name="'.$name.'" value="'.esc_attr($key).'" />'.$title.'</label>';
			}
			if($i !== count($options)-1) {
				$html .= '<br />';
			}
		}
		return $html;
	}

	public static function opacity_hex_to_rgba($opacity, $hex) {

		$rgb = self::hex_to_rgb($hex);

		$a = $opacity/100;
		if($a > 1) { $a = 1; }
		if($a < 0) { $a = 0; }
		$a_str = number_format($a, 2, '.', '');

		return 'rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$a_str.')';

	}

	public static function rgba_decode($rgba) {

		$pattern = '/^rgba\s*\(\s*([\d]+)\s*,\s*([\d]+)\s*,\s*([\d]+)\s*,\s*(\d\.*\d*)\s*\)$/';
		preg_match($pattern, $rgba, $matches);

		$r = $matches[1];
		$g = $matches[2];
		$b = $matches[3];
		$a = $matches[4];

		return array(
			'hex' => self::rgb_to_hex($r, $g, $b),
			'alpha' => $a,
		);

	}

	public static function hex_to_rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}

	public static function rgb_to_hex($r, $g, $b) {
		$hex = "#";
		$hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
		$hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
		$hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
		return $hex;
	}

}