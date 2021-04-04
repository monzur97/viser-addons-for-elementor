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
				'label' => __( 'Layout', 'viser-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                            <button class="btn btn--primary" data-group="space">Space</button>
                            <button class="btn btn--primary" data-group="nature">Nature</button>
                            <button class="btn btn--primary" data-group="animal">Animal</button>
                            <button class="btn btn--primary" data-group="city">City</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div id="grid" class="row my-shuffle-container">
                <figure class="col-3@xs col-4@sm col-3@md picture-item" data-groups='["nature"]' data-date-created="2017-04-30" data-title="Lake Walchen">
                    <div class="picture-item__inner">
                        <div class="aspect aspect--16x9">
                            <div class="aspect__inner">
                                <img src="https://images.unsplash.com/photo-1493585552824-131927c85da2?ixlib=rb-0.3.5&auto=format&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=284&h=160&fit=crop&s=6ef0f8984525fc4500d43ffa53fe8190" srcset="https://images.unsplash.com/photo-1493585552824-131927c85da2?ixlib=rb-0.3.5&auto=format&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=284&h=160&fit=crop&s=6ef0f8984525fc4500d43ffa53fe8190 1x, https://images.unsplash.com/photo-1493585552824-131927c85da2?ixlib=rb-0.3.5&auto=format&q=55&fm=jpg&dpr=2&crop=entropy&cs=tinysrgb&w=284&h=160&fit=crop&s=6ef0f8984525fc4500d43ffa53fe8190 2x" alt="A deep blue lake sits in the middle of vast hills covered with evergreen trees" />
                            </div>
                        </div>
                        <div class="picture-item__details">
                            <figcaption class="picture-item__title"><a href="https://unsplash.com/photos/zshyCr6HGw0" target="_blank" rel="noopener">Lake Walchen</a></figcaption>
                            <p class="picture-item__tags hidden@xs">nature</p>
                        </div>
                    </div>
                </figure>
            
                <div class="col-1@sm col-1@xs my-sizer-element"></div>
            </div>
        </div>
        <script src='https://unpkg.com/shufflejs@5'></script>
        <?php

	}

}
