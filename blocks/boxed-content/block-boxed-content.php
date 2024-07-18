<?php
/**
* Boxed Content Block
*
* @package flyykf
*/

$class_name = 'block-boxed-content position-relative mx-3 mb-6';

if ( ! empty( $block['className'] ) ) {
   $class_name .= ' ' . $block['className'];
}

?>

<div class="<?php echo esc_attr($class_name); ?>">
    <div class="container bg-white shadow rounded-1 p-4 p-lg-5" id="section-content">
        <InnerBlocks />
    </div>
</div>