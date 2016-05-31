<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function themler_shortcode_single_row($atts, $content='', $tag='') {
    global $is_column_in_row;
    $is_column_in_row = true;
    $result = do_shortcode($content);
    $is_column_in_row = false;
    return ShortcodesUtility::makeShortcode($tag, $result, $atts);
}

function themler_shortcode_single_column($atts, $content='', $tag='') {
    global $is_column_in_row;
    if (isset($is_column_in_row) && $is_column_in_row)
        return ShortcodesUtility::makeShortcode($tag, $content, $atts);

    if (!is_array($atts)) {
        $atts = array();
    }
    $last = isset($atts['last']) ? $atts['last'] : false;

    $new_atts = array();
    foreach($atts as $key => $value) {
        if (is_numeric($key) && 'last' === $value)
            $last = true;
        else
            $new_atts[$key] = $value;
    }

    $row_atts = 'vertical_align="' . (isset($atts['vertical_align']) ? $atts['vertical_align'] : '') . '"' .
        ' auto_height="' . (isset($atts['auto_height']) ? $atts['auto_height'] : '') . '"' .
        ' collapse_spacing="' . (isset($atts['collapse_spacing']) ? $atts['collapse_spacing'] : '') . '"';

    remove_shortcode($tag, 'themler_shortcode_single_column');
    $content = '<!--Column--><' . $row_atts . '>' . ShortcodesUtility::makeShortcode('column', do_shortcode($content), $new_atts) . '<!--/Column' . ($last ? 'Last' : '') . '-->';
    add_shortcode($tag, 'themler_shortcode_single_column');
    return $content;
}

function themler_shortcode_one_half($atts, $content = '', $tag = '') {
    $atts['width'] = "12";
    return themler_shortcode_single_column($atts, $content, $tag);
}
function themler_shortcode_one_third($atts, $content = '', $tag = '') {
    $atts['width'] = "8";
    return themler_shortcode_single_column($atts, $content, $tag);
}
function themler_shortcode_two_third($atts, $content = '', $tag = '') {
    $atts['width'] = "16";
    return themler_shortcode_single_column($atts, $content, $tag);
}
function themler_shortcode_one_fourth($atts, $content = '', $tag = '') {
    $atts['width'] = "6";
    return themler_shortcode_single_column($atts, $content, $tag);
}
function themler_shortcode_three_fourth($atts, $content = '', $tag = '') {
    $atts['width'] = "18";
    return themler_shortcode_single_column($atts, $content, $tag);
}
function themler_shortcode_full_width($atts, $content = '', $tag = '') {
    $atts['width'] = "24";
    return themler_shortcode_single_column($atts, $content, $tag);
}

function themler_column_filter($content) {
    if (!ShortcodesUtility::$enable_filters)
        return $content;

    global $shortcode_tags;
    $orig_shortcode_tags = $shortcode_tags; // save original shortcodes
    $shortcode_tags = array();

    foreach($orig_shortcode_tags as $tag => $func) {
        if (preg_match('#column_\d+#', $tag)) {
            add_shortcode($tag, 'themler_shortcode_single_column');
        } else if (preg_match('#row_\d+#', $tag)) {
            add_shortcode($tag, 'themler_shortcode_single_row');
        }
    }

    add_shortcode('column', 'themler_shortcode_single_column');
    add_shortcode('row', 'themler_shortcode_single_row');
    add_shortcode('one_half', 'themler_shortcode_one_half');
    add_shortcode('one_third', 'themler_shortcode_one_third');
    add_shortcode('two_third', 'themler_shortcode_two_third');
    add_shortcode('one_fourth', 'themler_shortcode_one_fourth');
    add_shortcode('three_fourth', 'themler_shortcode_three_fourth');
    add_shortcode('full_width', 'themler_shortcode_full_width');

    $content = do_shortcode($content);
    $shortcode_tags = $orig_shortcode_tags; // restore original shortcodes

    $content = preg_replace('/(<!--\/Column)(?:Last){0,1}(-->)(?!.*<!--\/Column)/s', '$1Last$2', $content, 1); // add 'last' for the last column
    $GLOBALS['inRow'] = false;
    return preg_replace_callback('/<!--Column--><([^>]*?)>(.*?)<!--\/Column(Last){0,1}-->/s', 'themler_column_filter_callback', $content);
}

function themler_column_filter_callback($matches) {
    $result = '';
    if (!$GLOBALS['inRow']) {
        $result .= '[row ' . $matches[1] . ']';
        $GLOBALS['inRow'] = true;
    }
    $result .= $matches[2];
    if (isset($matches[3])) {
        $result .= '[/row]';
        $GLOBALS['inRow'] = false;
    }
    return $result;
}

// [box css="" full_width="yes|no" content_width="yes|no"]content with shortcodes[/box]
function themler_shortcode_box($atts, $content = '') {
    $atts = shortcode_atts(array(
        'css' => '',
        'content_width' => 'yes',
        'class_names' => ''
    ), $atts);

    $css = esc_attr($atts['css']);
    $content_width = $atts['content_width'] === 'yes';
    $class_names = esc_attr($atts['class_names']);

    $result = '<div';
    if ($class_names !== '') {
        $result .= ' class="' . $class_names . '"';
    }
    if ($css !== '') {
        $result .= ' style="' . $css . '"';
    }
    $result .= '>';
    if ($content_width) {
        $result .= '<div class="bd-container-inner">';
    }
    $result .= do_shortcode($content);
    if ($content_width) {
        $result .= '</div>';
    }
    $result .= '</div>';
    return $result;
}
add_shortcode('box', 'themler_shortcode_box');