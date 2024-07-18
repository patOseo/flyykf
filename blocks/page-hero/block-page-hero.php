<?php
/**
* Intro Block
*
* @package flyykf
*/

$class_name = 'block-hero';

if ( ! empty( $block['className'] ) ) {
   $class_name .= ' ' . $block['className'];
}

$layout = get_field('layout');
$layout_class = '';

if($layout == 'simple') {
    $bg = '/wp-content/themes/flyykf/assets/images/clouds.jpg';
    $gradient = '180deg, rgba(3,106,180,1) 15%, rgba(255,255,255,0) 50%, rgba(255,255,255,1) 100%';
} else {
    if(get_field('bg_img')) {
        $bg = get_field('bg_img');
    } else {
        // Default Background (Option Field
        $bg = get_field('default_bg', 'option');
    }
    $gradient = 'rgb(3 106 180 / 98%) 0%, rgb(3 106 180 / 40%) 90%';
    $height = get_field('height');

    if($height == 'tall') { 
        $class_name .= ' hero-tall';
    }
}

$intro_blocks = array(
    array('core/group', 
        array(
            'name' => 'core/group',
            'align' => 'full',
            'className' => 'pt-3 pb-6 py-lg-6 text-center',
            'layout' => array(
                'type' => 'constrained'
            )
        ),
        array(
            array('core/heading', array(
                'level' => 1,
                'className' => 'hero-title fs-4 ls-lg fw-bold text-uppercase text-yellow',
                'content' => 'Page Title',
            )),
            array('core/heading', array(
                'level' => 2,
                'className' => 'hero-heading display-1 mb-4 lh-1',
                'content' => 'Enter the main heading for the page here.',
            )),
            array('core/paragraph', array(
                'className' => 'hero-subheading fs-5 lh-sm',
                'content' => 'The subheading will go here. It can be a bit longer than the main heading and should contain general information about the content on this page.',
            )),
            array('core/buttons', array(
                'layout' => array(
                    'type' => 'flex',
                    'justifyContent' => 'center',
                ),
                'className' => 'mt-5'
            ), array(
                array('core/button', 
                    array(
                        'text' => 'Button Text',
                        'url' => '#section-content',
                        'style' => array(
                            'spacing' => array(
                                'padding' => array(
                                    'top' => '.5rem',
                                    'right' => '3rem',
                                    'bottom' => '.5rem',
                                    'left' => '3rem',
                                
                                ),
                            ),
                            'border' => array(
                                'radius' => '0px',
                            ),
                            'typography' => array(
                                'fontStyle' => 'normal',
                                'fontWeight' => '600',
                            ),
                        ),
                        
                    ),
                    ),
                ),
            ),
        ),
    ),
);

?>

<div class="<?php echo esc_attr($class_name); ?>" >
    <?php if($layout == 'simple'): ?>
        <div class="clouds-bg bg-darkblue mb-n6" style="background:linear-gradient(<?php echo $gradient; ?>), url('<?php echo $bg; ?>') no-repeat center / cover;"></div>
    <?php endif; ?>
    <div class="hero-container<?php if($layout != 'simple') { echo ' bg-darkblue text-white text-shadow py-12 position-relative shape-divider'; } ?>" <?php if($layout != 'simple'): ?>style="background:linear-gradient(<?php echo $gradient; ?>), url('<?php echo $bg['url']; ?>') no-repeat center / cover fixed;"<?php endif; ?>>
        <div class="acf-block-padding">
            <InnerBlocks template="<?php echo esc_attr(wp_json_encode($intro_blocks)); ?>" />
        </div>
    </div>
</div>
