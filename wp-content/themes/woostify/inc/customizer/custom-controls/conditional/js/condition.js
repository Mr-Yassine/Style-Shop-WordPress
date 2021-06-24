/**
 * Woostify condition control
 *
 * @package woostify
 */

'use strict';

(
	function( api ) {
		api.bind(
			'ready',
			function() {

				var hideTabLayout          = function( control_id, tab_id, hide_all = true ) {
					api.control(
						control_id,
						function( control ) {
							var val = control.settings['default'].get()
							api.control(
								tab_id,
								function( tab_control ) {
									if ( ! val ) {
										if ( ! hide_all ) {
											tab_control.container.find( 'li.woostify-tab-button[data-tab="design"]' ).addClass( 'disabled-btn' )
										} else {
											tab_control.container.addClass( 'woostify-hide' )
										}
									} else {
										if ( ! hide_all ) {
											tab_control.container.find( 'li.woostify-tab-button[data-tab="design"]' ).removeClass( 'disabled-btn' )
										} else {
											tab_control.container.removeClass( 'woostify-hide' )
										}
									}
								},
							)
						},
					)

					wp.customize(
						control_id,
						function( value ) {
							value.bind(
								function( newval ) {
									api.control(
										tab_id,
										function( control ) {
											if ( ! newval ) {
												if ( ! hide_all ) {
													control.container.find( 'li.woostify-tab-button[data-tab="design"]' ).addClass( 'disabled-btn' )
												} else {
													control.container.addClass( 'woostify-hide' )
												}
											} else {
												if ( ! hide_all ) {
													control.container.find( 'li.woostify-tab-button[data-tab="design"]' ).removeClass( 'disabled-btn' )
												} else {
													control.container.removeClass( 'woostify-hide' )
												}
											}
										},
									)
								},
							)
						},
					)
				}

				/**
				 * Update control tab data
				 *
				 * @param ids
				 */
				var updateControlAttribute = function( ids ) {
					// Call dependency on the setting controls when they exist.
					for ( var i = 0, j = ids.length; i < j; i ++ ) {
						api.control(
							ids[i],
							function( control ) {
								var tab = control.params.tab

								if ( '' !== tab ) {
									control.container.attr( 'data-tab', tab )
								}
							},
						)
					}
				}

				/**
				 * Condition controls.
				 *
				 * @param string  id            Setting id.
				 * @param array   dependencies  Setting id dependencies.
				 * @param string  value         Setting value.
				 * @param array   parentvalue   Parent setting id and value.
				 * @param boolean operator      Operator.
				 */
				var condition = function( id, dependencies, value, operator ) {
					var value    = undefined !== arguments[2] ? arguments[2] : false,
						operator = undefined !== arguments[3] ? arguments[3] : false

					api(
						id,
						function( setting ) {

							/**
							 * Update a control's active setting value.
							 *
							 * @param {api.Control} control
							 */
							var dependency = function( control ) {
								var visibility = function() {
									// wp.customize.control( parentValue[0] ).setting.get();.
									var compare = false

									// Support array || string || boolean.
									if ( Array.isArray( value ) ) {
										compare = value.includes( setting.get() )
									} else {
										compare = value === setting.get()
									}

									// Is NOT of value.
									if ( operator ) {
										if ( compare ) {
											control.container.removeClass( 'hide' )
										} else {
											control.container.addClass( 'hide' )
										}
									} else {
										if ( compare ) {
											control.container.addClass( 'hide' )
										} else {
											control.container.removeClass( 'hide' )
										}
									}
								}

								// Set initial active state.
								visibility()

								// Update activate state whenever the setting is changed.
								setting.bind( visibility )
							}

							// Call dependency on the setting controls when they exist.
							for ( var i = 0, j = dependencies.length; i < j; i ++ ) {
								api.control( dependencies[i], dependency )
							}
						},
					)
				}

				/**
				 * Condition controls.
				 *
				 * @param string  id            Setting id.
				 * @param array   dependencies  Setting id dependencies.
				 * @param string  value         Setting value.
				 * @param array   parentvalue   Parent setting id and value.
				 * @param boolean operator      Operator.
				 * @param array   arr           The parent setting value.
				 */
				var subCondition = function( id, dependencies, value, operator, arr ) {
					var value    = undefined !== arguments[2] ? arguments[2] : false,
						operator = undefined !== arguments[3] ? arguments[3] : false,
						arr      = undefined !== arguments[4] ? arguments[4] : false

					api(
						id,
						function( setting ) {

							/**
							 * Update a control's active setting value.
							 *
							 * @param {api.Control} control
							 */
							var dependency = function( control ) {
								var visibility = function() {
									// arr[0] = control setting id.
									// arr[1] = control setting value.
									if ( ! arr || arr[1] !== wp.customize.control( arr[0] ).setting.get() ) {
										return
									}

									if ( operator ) {
										if ( value === setting.get() ) {
											control.container.removeClass( 'hide' )
										} else {
											control.container.addClass( 'hide' )
										}
									} else {
										if ( value === setting.get() ) {
											control.container.addClass( 'hide' )
										} else {
											control.container.removeClass( 'hide' )
										}
									}
								}

								// Set initial active state.
								visibility()

								// Update activate state whenever the setting is changed.
								setting.bind( visibility )
							}

							// Call dependency on the setting controls when they exist.
							for ( var i = 0, j = dependencies.length; i < j; i ++ ) {
								api.control( dependencies[i], dependency )
							}
						},
					)
				}

				/**
				 * Condition controls.
				 *
				 * @param string  id            Setting id.
				 * @param array   dependencies  Setting id dependencies.
				 * @param string  value         Setting value.
				 * @param array   parentvalue   Parent setting id and value.
				 */
				var arrayCondition = function( id, dependencies, value ) {
					var value    = undefined !== arguments[2] ? arguments[2] : false,
						operator = undefined !== arguments[3] ? arguments[3] : false

					api(
						id,
						function( setting ) {

							/**
							 * Update a control's active setting value.
							 *
							 * @param {api.Control} control
							 */
							var dependency = function( control ) {
								var visibility = function() {
									if ( setting.get().includes( value ) ) {
										control.container.removeClass( 'hide' )
									} else {
										control.container.addClass( 'hide' )
									}
								}

								// Set initial active state.
								visibility()

								// Update activate state whenever the setting is changed.
								setting.bind( visibility )
							}

							// Call dependency on the setting controls when they exist.
							for ( var i = 0, j = dependencies.length; i < j; i ++ ) {
								api.control( dependencies[i], dependency )
							}
						},
					)
				}

				// POST.
				// Post structure.
				arrayCondition(
					'woostify_setting[blog_list_structure]',
					['woostify_setting[blog_list_post_meta]'],
					'post-meta',
				)

				// Post single structure.
				arrayCondition(
					'woostify_setting[blog_single_structure]',
					['woostify_setting[blog_single_post_meta]'],
					'post-meta',
				)

				// Topbar.
				condition(
					'woostify_setting[topbar_display]',
					[
						'woostify_setting[topbar_text_color]',
						'woostify_setting[topbar_background_color]',
						'woostify_setting[topbar_space]',
						'topbar_content_divider',
						'woostify_setting[topbar_left]',
						'woostify_setting[topbar_center]',
						'woostify_setting[topbar_right]',
					],
					false,
				)

				// Shopping cart icon.
				condition(
					'woostify_setting[header_shop_cart_icon]',
					[
						'woostify_setting[header_shop_cart_price]',
					],
					false,
				)

				// HEADER TRANSPARENT SECTION.
				// Enable transparent header.
				condition(
					'woostify_setting[header_transparent]',
					[
						'woostify_setting[header_transparent_disable_archive]',
						'woostify_setting[header_transparent_disable_index]',
						'woostify_setting[header_transparent_disable_page]',
						'woostify_setting[header_transparent_disable_post]',
						'woostify_setting[header_transparent_disable_shop]',
						'woostify_setting[header_transparent_disable_product]',
						'woostify_setting[header_transparent_enable_on]',
						'header_transparent_border_divider',
						'woostify_setting[header_transparent_border_width]',
						'woostify_setting[header_transparent_border_color]',
						'woostify_setting[header_transparent_logo]',
						'woostify_setting[header_transparent_menu_color]',
						'woostify_setting[header_transparent_icon_color]',
						'woostify_setting[header_transparent_count_background]',
					],
				)

				// PAGE HEADER
				// Enable page header.
				condition(
					'woostify_setting[page_header_display]',
					[
						'woostify_setting[page_header_title]',
						'woostify_setting[page_header_breadcrumb]',
						'woostify_setting[page_header_text_align]',
						'woostify_setting[page_header_title_color]',
						'woostify_setting[page_header_background_color]',
						'woostify_setting[page_header_background_image]',
						'woostify_setting[page_header_background_image_size]',
						'woostify_setting[page_header_background_image_position]',
						'woostify_setting[page_header_background_image_repeat]',
						'woostify_setting[page_header_background_image_attachment]',
						'page_header_breadcrumb_divider',
						'page_header_title_color_divider',
						'page_header_spacing_divider',
						'woostify_setting[page_header_breadcrumb_text_color]',
						'woostify_setting[page_header_padding_top]',
						'woostify_setting[page_header_padding_bottom]',
						'woostify_setting[page_header_margin_bottom]',
					],
				)

				// Background image.
				subCondition(
					'woostify_setting[page_header_background_image]',
					[
						'woostify_setting[page_header_background_image_size]',
						'woostify_setting[page_header_background_image_position]',
						'woostify_setting[page_header_background_image_repeat]',
						'woostify_setting[page_header_background_image_attachment]',
					],
					'',
					false,
					[
						'woostify_setting[page_header_display]',
						true,
					],
				)
				// And trigger if parent control update.
				wp.customize(
					'woostify_setting[page_header_display]',
					function( value ) {
						value.bind(
							function( newval ) {
								if ( newval ) {
									subCondition(
										'woostify_setting[page_header_background_image]',
										[
											'woostify_setting[page_header_background_image_size]',
											'woostify_setting[page_header_background_image_position]',
											'woostify_setting[page_header_background_image_repeat]',
											'woostify_setting[page_header_background_image_attachment]',
										],
										'',
										false,
										[
											'woostify_setting[page_header_display]',
											true,
										],
									)
								}
							},
						)
					},
				)

				// SHOP.
				// Position Add to cart.
				condition(
					'woostify_setting[shop_page_add_to_cart_button_position]',
					[
						'woostify_setting[shop_product_add_to_cart_icon]',
					],
					[
						'icon',
						'none',
					],
					false,
				)

				// Equal product content.
				condition(
					'woostify_setting[shop_page_product_content_equal]',
					[
						'woostify_setting[shop_page_product_content_min_height]',
					],
					false,
				)

				// Equal image height.
				condition(
					'woostify_setting[shop_page_product_image_equal_height]',
					[
						'woostify_setting[shop_page_product_image_height]',
					],
					false,
				)

				// Sale square.
				condition(
					'woostify_setting[shop_page_sale_square]',
					[
						'woostify_setting[shop_page_sale_size]',
					],
					false,
				)

				// Out of stock square.
				condition(
					'woostify_setting[shop_page_out_of_stock_square]',
					[
						'woostify_setting[shop_page_out_of_stock_size]',
					],
					false,
				)

				// Product card border.
				condition(
					'woostify_setting[shop_page_product_card_border_style]',
					[
						'woostify_setting[shop_page_product_card_border_width]',
						'woostify_setting[shop_page_product_card_border_color]',
					],
					'none',
				)

				// Product image border.
				condition(
					'woostify_setting[shop_page_product_image_border_style]',
					[
						'woostify_setting[shop_page_product_image_border_width]',
						'woostify_setting[shop_page_product_image_border_color]',
					],
					'none',
				)

				// SHOP SINGLE.
				// Product related.
				condition(
					'woostify_setting[shop_single_related_product]',
					[
						'woostify_setting[shop_single_product_related_total]',
						'woostify_setting[shop_single_product_related_columns]',
					],
					false,
				)

				// Gallery layout.
				condition(
					'woostify_setting[shop_single_gallery_layout]',
					[
						'woostify_setting[shop_single_product_sticky_top_space]',
						'woostify_setting[shop_single_product_sticky_bottom_space]',
					],
					'column',
					true,
				)

				// Product Single Button Add To Cart.
				condition(
					'woostify_setting[shop_single_product_button_cart]',
					[
						'woostify_setting[shop_single_button_cart_background]',
						'woostify_setting[shop_single_button_cart_color]',
						'woostify_setting[shop_single_button_background_hover]',
						'woostify_setting[shop_single_button_color_hover]',
					],
					false,
				)

				// Product recently viewed.
				condition(
					'woostify_setting[shop_single_product_recently_viewed]',
					[
						'woostify_setting[shop_single_recently_viewed_title]',
						'woostify_setting[shop_single_recently_viewed_count]',
					],
					false,
				)

				// FOOTER SECTION.
				condition(
					'woostify_setting[scroll_to_top]',
					[
						'woostify_setting[scroll_to_top_background]',
						'woostify_setting[scroll_to_top_color]',
						'woostify_setting[scroll_to_top_position]',
						'woostify_setting[scroll_to_top_border_radius]',
						'woostify_setting[scroll_to_top_offset_bottom]',
						'woostify_setting[scroll_to_top_on]',
						'woostify_setting[scroll_to_top_icon_size]',
					],
					false,
				)

				// Sticky Footer  Bar section.
				condition(
					'woostify_setting[sticky_footer_bar_enable]',
					[
						'woostify_setting[sticky_footer_bar_enable_on]',
						'woostify_setting[sticky_footer_bar_items]',
						'woostify_setting[sticky_footer_bar_hide_when_scroll]',
						'woostify_setting[sticky_footer_bar_hide_on_product_single]',
						'woostify_setting[sticky_footer_bar_hide_on_cart_page]',
						'woostify_setting[sticky_footer_bar_hide_on_checkout_page]',
					]
				)

				// Disable footer.
				condition(
					'woostify_setting[footer_display]',
					[
						'woostify_setting[footer_space]',
						'woostify_setting[footer_column]',
						'woostify_setting[footer_background_color]',
						'woostify_setting[footer_heading_color]',
						'woostify_setting[footer_link_color]',
						'woostify_setting[footer_text_color]',
						'woostify_setting[footer_custom_text]',
						'footer_text_divider',
						'footer_background_color_divider',
					],
				)

				// And trigger if parent control update.
				hideTabLayout( 'woostify_setting[sticky_footer_bar_enable]', 'woostify_setting[sticky_footer_bar_context_tabs]' )
				hideTabLayout( 'woostify_setting[topbar_display]', 'woostify_setting[topbar_context_tabs]' )
				hideTabLayout( 'woostify_setting[scroll_to_top]', 'woostify_setting[scroll_to_top_context_tabs]' )
				hideTabLayout( 'woostify_setting[page_header_display]', 'woostify_setting[page_header_context_tabs]' )
				hideTabLayout( 'woostify_setting[footer_display]', 'woostify_setting[footer_context_tabs]' )
				hideTabLayout( 'woostify_setting[header_transparent]', 'woostify_setting[header_transparent_context_tabs]' )
			},
		)

	}( wp.customize )
)
