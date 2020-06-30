<?php

#-----------------------------------------------------------------
# Elements 
#-----------------------------------------------------------------

$thb_shortcodes['header_2'] = array( 
	'type'=>'heading', 
	'title'=>esc_html__('Elements', 'thevoux')
);
$thb_shortcodes['small_title'] = array( 
	'type'=>'regular', 
	'title'=>esc_html__('Small Title', 'thevoux'), 
	'attr'=>array( 
		'title'=>array(
			'type'=>'text', 
			'title'=>'Title'
		)
	)
);
$thb_shortcodes['large_title'] = array( 
	'type'=>'regular', 
	'title'=>esc_html__('Large Title', 'thevoux'), 
	'attr'=>array( 
		'title'=>array(
			'type'=>'text', 
			'title'=>'Title'
		)
	)
);
$thb_shortcodes['thb_button'] = array( 
	'type'=>'regular', 
	'title'=>esc_html__('Button', 'thevoux' ), 
	'attr'=>array(
		'size'=>array(
			'type'=>'radio', 
			'title'=>esc_html__('Size', 'thevoux'),
			'opt'=>array(
				'mini' =>'Mini',
				'small'=>'Small',
				'medium'=>'Medium',
				'large'=>'Large'
			)
		),
		'animation'=>array(
			'type'=>'radio', 
			'title'=>esc_html__('Animation', 'thevoux'),
			'opt'=>array(
				"" => "None",
				"animation right-to-left" => "Left",
				"animation left-to-right" => "Right",
				"animation bottom-to-top" => "Top",
				"animation top-to-bottom" => "Bottom",
				"animation scale" => "Scale",
				"animation fade-in" => "Fade"
			)
		),
		'icon'=>array(
			'type'=>'select', 
			'title'=>esc_html__('Icon', 'thevoux'),
			'values'=> thb_getIconArray()
		),
		'title'=>array(
			'type'=>'text', 
			'title'=>esc_html__('Buton Text', 'thevoux')
		),
		'link'=>array(
			'type'=>'text', 
			'title'=>esc_html__('Buton Link', 'thevoux')
		),
		'target_blank'=> array(
			'type'=>'checkbox', 
			'title'=>esc_html__('Open in New Window?', 'thevoux' ),
			'desc'=>'Opens the button link in new window'
		)
	)
);
$thb_shortcodes['quote'] = array( 
	'type'=>'regular', 
	'title'=>esc_html__('Quotes', 'thevoux'), 
	'attr'=>array( 
		'align'=>array(
			'type'=>'radio', 
			'title'=>esc_html__('Alignment', 'thevoux'), 
			'opt'=>array(
				'normal'=>'Normal',
				'pullleft'=>'Pull Left',
				'pullright'=>'Pull Right'
			)
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>esc_html__('Content', 'thevoux')
		),
		'author'=>array(
			'type'=>'text', 
			'title'=>'Quote Author'
		)
		
	)
);
$thb_shortcodes['dropcap'] = array( 
	'type'=>'regular', 
	'title'=>esc_html__('Dropcap', 'thevoux' ),
	'attr'=>array( 
		'title'=>array(
			'type'=>'text', 
			'title'=>'Letter'
		)
	)
);
$thb_shortcodes['single_icon'] = array( 
	'type'=>'regular', 
	'title'=>esc_html__('Single Icon', 'thevoux'), 
	'attr'=>array( 
		'icon'=>array(
			'type'=>'select', 
			'title'=>esc_html__('Icon', 'thevoux'),
			'values'=> thb_getIconArray()
		),
		'size'=>array(
			'type'=>'radio', 
			'title'=>esc_html__('Icon Size', 'thevoux'),
			'opt'=>array(
				'icon-1x'=>'1x',
				'icon-2x'=>'2x',
				'icon-3x'=>'3x',
				'icon-4x'=>'4x'
			)
		),
		'boxed'=> array(
			'type'=>'checkbox', 
			'title'=>esc_html__('Boxed?', 'thevoux'),
			'desc'=>'Boxed contains the icon inside a box'
		),
		'icon_link'=>array(
			'type'=>'text', 
			'title'=>esc_html__('Icon Link', 'thevoux'),
			'desc'=>'If you would like to link the icon to an url, enter it here. (Boxed option should be checked)'
		)
	)
);