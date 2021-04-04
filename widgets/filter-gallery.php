<?php
/**
 * VISER Filter Gallery 
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Scheme_Typography;
class Filter_Gallery extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve team member widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Filter Gallery';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve team member widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Filter Gallery', 'viser-addons-for-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve team member widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-photo-video';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'viser-addons' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		
		// start layout section 
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Items', 'viser-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'fg_list_title', [
				'label' => __( 'Title', 'viser-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'viser-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'fg_list_content', [
				'label' => __( 'Content', 'viser-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'viser-addons-for-elementor' ),
				'show_label' => false,
			]
		);

        $repeater->add_control(
			'fg_list_control', [
				'label' => __( 'Control Name', 'viser-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '' , 'viser-addons-for-elementor' ),
				'placeholder' => __( 'design, branding' , 'viser-addons-for-elementor' ),
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'fg_image',
			[
				'label' => __( 'Choose Image', 'viser-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $repeater->add_control(
			'fg_website_link',
			[
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'viser-addons-for-elementor' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);



		$this->add_control(
			'fg_list',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'fg_list_title' => __( 'Gallery item title', 'viser-addons-for-elementor' ),
						'fg_list_content' => __( 'Lorem ipsum dolor sit amet.', 'viser-addons-for-elementor' ),
					],
					[
						'fg_list_title' => __( 'Gallery item title', 'viser-addons-for-elementor' ),
						'fg_list_content' => __( 'Lorem ipsum dolor sit amet.', 'viser-addons-for-elementor' ),
					],
				],
				'title_field' => '{{{ fg_list_title }}}',
			]
		);

		$this->end_controls_section();
		// end layout section   

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

        ?>
        <div class="container text-center">
            <div class="row">
                <div class="col-12@sm filters-group-wrap">
                    <div class="filters-group m-auto">
                        <div class="btn-group filter-options">
                        <?php
                            $fg_gallerycontrols             = array_column( $settings['fg_list'], 'fg_list_control' );
                            $fg_controls_comma_separated = implode( ', ', $fg_gallerycontrols );
                            $fg_controls_array           = explode( ",",$fg_controls_comma_separated );
                            $fg_controls_lowercase       = array_map( 'strtolower', $fg_controls_array );
                            $fg_controls_remove_space    = array_filter( array_map( 'trim', $fg_controls_lowercase ) );
                            $fg_controls_items           = array_unique( $fg_controls_remove_space );

                            foreach( $fg_controls_items as $control ) :
                                $control_attribute = preg_replace( '#[ -]+#', '-', $control );
                                echo '<button class="btn btn--primary" data-filter=".'.esc_attr( $control_attribute ).'">'.esc_html( $control ).'</button>';
                            endforeach;
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div id="grid" class="row my-shuffle-container">
            <?php
            if ( $settings['fg_list'] ) {
                foreach (  $settings['fg_list'] as $item ) {
                    ?>
                    <figure class="col-3@xs col-4@sm col-3@md picture-item" data-groups='["design"]' data-date-created="2017-04-30" data-title="Lake Walchen">
                        <div class="picture-item__inner">
                            <div class="aspect aspect--16x9">
                                <div class="aspect__inner">
                                    <?php echo '<img src="' . $item['fg_image']['url'] . '">'; ?>
                                </div>
                            </div>
                            <div class="picture-item__details">
                                <figcaption class="picture-item__title"><a href="https://unsplash.com/photos/zshyCr6HGw0" target="_blank" rel="noopener">Lake Walchen</a></figcaption>
                                <p class="picture-item__tags hidden@xs">nature</p>
                            </div>
                        </div>
                    </figure>
                    <?php
                }
            }
            ?>
            
                <div class="col-1@sm col-1@xs my-sizer-element"></div>
            </div>
        </div>
        <script src='https://unpkg.com/shufflejs@5'></script>
        <?php

	}

}
