<?php

// https://www.advancedcustomfields.com/resources/register-fields-via-php/

return array(
  'key' => 'group_'.$blockName,
  'name' => $blockName,
  'label' => str_replace('-', ' ', ucfirst($blockName)),
  'display' => 'row',
  'sub_fields' => array(
    array(
      'key' => 'field_'.$blockName.'_tab1',
      'label' => 'Scheme',
      'name' => '',
      'type' => 'tab',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'placement' => 'top',
      'endpoint' => 0,
    ),
    array(
      'key' => 'field_'.$blockName.'_scheme',
      'label' => 'Scheme',
      'name' => 'scheme',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array(
        'default' => 'Default',
        'grey' => 'Grey',
        'yellow' => 'Yellow',
        'pink' => 'Pink',
        'blue' => 'Blue',
        'blue-darker' => 'Darker Blue',
        'black' => 'Black',
        'green' => 'Green',
        'red' => 'Red'
      ),
      'default_value' => array(
        0 => 'default',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'return_format' => 'value',
      'placeholder' => '',
    ),
    array(
      'key' => 'field_'.$blockName.'_tab2',
      'label' => 'Assets',
      'name' => '',
      'type' => 'tab',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'placement' => 'top',
      'endpoint' => 0,
    ),
    array(
      'key' => 'field_'.$blockName.'_overflow_visibility',
      'label' => 'Overflow Visibility',
      'name' => 'overflow_visibility',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array(
        'visible' => 'Visible (Assets overlap section)',
        'hidden' => 'Hidden (Assets are cut off on side of the section)',
      ),
      'default_value' => array(
        0 => 'visible',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'return_format' => 'value',
      'placeholder' => '',
    ),
    array(
      'key' => 'field_'.$blockName.'_assets',
      'label' => 'Assets',
      'name' => 'assets',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => 0,
      'max' => 0,
      'layout' => 'block',
      'button_label' => 'Add Asset',
      'sub_fields' => array(
        array(
          'key' => 'field_'.$blockName.'_tab_image',
          'label' => 'Image',
          'name' => '',
          'type' => 'tab',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'placement' => 'top',
          'endpoint' => 0,
        ),
        array(
          'key' => 'field_'.$blockName.'_image',
          'label' => 'Image',
          'name' => 'image',
          'type' => 'image',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'return_format' => 'array',
          'preview_size' => 'thumbnail',
          'library' => 'all',
          'min_width' => '',
          'min_height' => '',
          'min_size' => '',
          'max_width' => '',
          'max_height' => '',
          'max_size' => '',
          'mime_types' => '',
        ),
        array(
          'key' => 'field_'.$blockName.'_placement',
          'label' => 'Placement',
          'name' => 'placement',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'background' => 'Background',
            'left' => 'Left',
            'right' => 'Right',
            'fifty-left' => 'Left (50% width of section)',
            'fifty-right' => 'Right (50% width of section)',
            'custom' => 'Custom',
          ),
          'default_value' => array(
            0 => 'background',
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'return_format' => 'value',
          'placeholder' => '',
        ),
        array(
          'key' => 'field_'.$blockName.'_custom_css',
          'label' => 'Custom CSS',
          'name' => 'custom_css',
          'type' => 'textarea',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => array(
            array(
              array(
                'field' => 'field_'.$blockName.'_placement',
                'operator' => '==',
                'value' => 'custom',
              ),
            ),
          ),
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => 'top: 0; left: 50%; height: 100%;',
          'maxlength' => '',
          'rows' => 3,
          'new_lines' => '',
        ),
        array(
          'key' => 'field_'.$blockName.'_tab_positioning',
          'label' => 'Position & Size',
          'name' => '',
          'type' => 'tab',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'placement' => 'top',
          'endpoint' => 0,
        ),
        array(
          'key' => 'field_'.$blockName.'_position',
          'label' => 'Image Alignment',
          'name' => 'position',
          'type' => 'checkbox',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'top' => 'Top',
            'left' => 'Left',
            'right' => 'Right',
            'bottom' => 'Bottom',
            'center' => 'Center',
          ),
          'allow_custom' => 0,
          'save_custom' => 0,
          'default_value' => array(
            0 => 'center',
          ),
          'layout' => 'vertical',
          'toggle' => 0,
          'return_format' => 'value',
        ),
        array(
          'key' => 'field_'.$blockName.'_zindex',
          'label' => 'Position (Z)',
          'name' => 'z-index',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'back' => 'Behind Content',
            'front' => 'In front of Content',
          ),
          'default_value' => array(
            0 => 'back',
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'return_format' => 'value',
          'placeholder' => '',
        ),
        array(
          'key' => 'field_'.$blockName.'_size',
          'label' => 'Size',
          'name' => 'size',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'normal' => 'Original (no size adjustment)',
            'pattern' => 'Pattern (repeat)',
            'cover' => 'Fill (cover)',
            'contain' => 'Fit (contain)',
            'contain-height' => 'Fit (height)',
            'contain-width' => 'Fit (width)',
          ),
          'default_value' => array(
            0 => 'cover',
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'return_format' => 'value',
          'placeholder' => '',
        ),
        array(
          'key' => 'field_'.$blockName.'_visibility',
          'label' => 'Visibility',
          'name' => 'visibility',
          'type' => 'checkbox',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'mobile' => 'Mobile (xs,sm)',
            'laptop' => 'Laptop (md,lg)',
            'desktop' => 'Desktop (xl)',
          ),
          'allow_custom' => 0,
          'save_custom' => 0,
          'default_value' => array(
            0 => 'mobile',
            1 => 'laptop',
            2 => 'desktop',
          ),
          'layout' => 'vertical',
          'toggle' => 0,
          'return_format' => 'value',
        ),
        array(
          'key' => 'field_'.$blockName.'_tab3',
          'label' => 'Animations',
          'name' => '',
          'type' => 'tab',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'placement' => 'top',
          'endpoint' => 0,
        ),
        array(
          'key' => 'field_'.$blockName.'_animation_style',
          'label' => 'Animation Style',
          'name' => 'animation_style',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'none' => 'none',
            'fadeIn' => 'fadeIn',
            'fadeInUp' => 'fadeInUp',
            'fadeInDown' => 'fadeInDown',
            'fadeInLeft' => 'fadeInLeft',
            'fadeInRight' => 'fadeInRight',
            'zoomIn' => 'zoomIn',
          ),
          'default_value' => array(
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'return_format' => 'value',
          'placeholder' => '',
        ),
        array(
          'key' => 'field_'.$blockName.'_animation_speed',
          'label' => 'Animation Speed',
          'name' => 'animation_speed',
          'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'fast' => 'Quick',
            'normal' => 'Normal (default)',
            'slow' => 'Slow',
            'veryslow' => 'Very Slow',
          ),
          'default_value' => array(
            0 => 'normal',
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'ajax' => 0,
          'return_format' => 'value',
          'placeholder' => '',
        ),
        array(
          'key' => 'field_'.$blockName.'_animation_delay',
          'label' => 'Animation Delay',
          'name' => 'animation_delay',
          'type' => 'number',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '25',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '0.5',
          'prepend' => 'seconds',
          'append' => '',
          'min' => '',
          'max' => '',
          'step' => '',
        ),
      ),
    ),
    array(
      'key' => 'field_'.$blockName.'_tab4',
      'label' => 'Layout Settings',
      'name' => '',
      'type' => 'tab',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'placement' => 'top',
      'endpoint' => 0,
    ),
    array(
      'key' => 'field_'.$blockName.'_section_template',
      'label' => 'Section Template',
      'name' => 'section_template',
      'type' => 'select',
      'instructions' => 'Choose your section template. Sections might have different rules.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array(
        'normal' => 'Normal',
        'full-height' => 'Full Height',
      ),
      'default_value' => array(
        0 => 'normal',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'return_format' => 'value',
      'placeholder' => '',
    ),
    array(
      'key' => 'field_'.$blockName.'_vertical_alignment',
      'label' => 'Block Vertical Alignment',
      'name' => 'vertical_alignment',
      'type' => 'select',
      'instructions' => 'If full-height is enabled: How does the blocks position.',
      'required' => 0,
      'conditional_logic' => array(
        array(
          array(
            'field' => 'field_'.$blockName.'_section_template',
            'operator' => '==',
            'value' => 'full-height',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array(
        'align-top' => 'Top',
        'align-center' => 'Center',
        'align-bottom' => 'Bottom',
        'align-stretch' => 'Stretch Full-height',
      ),
      'default_value' => array(
        0 => 'align-center',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'return_format' => 'value',
      'placeholder' => '',
    ),
    array(
      'key' => 'field_'.$blockName.'_pin_blocks',
      'label' => 'Pin blocks',
      'name' => 'pin_blocks',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => array(
        array(
          array(
            'field' => 'field_'.$blockName.'_section_template',
            'operator' => '==',
            'value' => 'full-height',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array(
        'disable' => 'Disabled (block doesn\'t scroll down)',
        'enabled' => 'Enabled (block scroll to the end of the section)',
      ),
      'default_value' => array(
        0 => 'disabled',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'return_format' => 'value',
      'placeholder' => '',
    ),
    array(
      'key' => 'field_'.$blockName.'_minimum_height',
      'label' => 'Minimum height (laptop/desktop)',
      'name' => 'minimum_height',
      'type' => 'number',
      'instructions' => 'When using Pin blocks sometimes we want the section to be a lot higher than the window height or the height the block is. This height will be disabled for mobile.',
      'required' => 0,
      'conditional_logic' => array(
        array(
          array(
            'field' => 'field_'.$blockName.'_section_template',
            'operator' => '==',
            'value' => 'full-height',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => 'px',
      'append' => '',
      'min' => '',
      'max' => '',
      'step' => '',
    ),
  ),
  'min' => '',
  'max' => '',
);