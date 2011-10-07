/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview The floating dialog plugin.
 */

/**
 * No resize for this dialog.
 * @constant
 */
CKEDITOR.DIALOG_RESIZE_NONE = 0;

/**
 * Only allow horizontal resizing for this dialog, disable vertical resizing.
 * @constant
 */
CKEDITOR.DIALOG_RESIZE_WIDTH = 1;

/**
 * Only allow vertical resizing for this dialog, disable horizontal resizing.
 * @constant
 */
CKEDITOR.DIALOG_RESIZE_HEIGHT = 2;

/*
 * Allow the dialog to be resized in both directions.
 * @constant
 */
CKEDITOR.DIALOG_RESIZE_BOTH = 3;

(function()
{
	var cssLength = CKEDITOR.tools.cssLength;
	function isTabVisible( tabId )
	{
		return !!this._.tabs[ tabId ][ 0 ].$.offsetHeight;
	}

	function getPreviousVisibleTab()
	{
		var tabId = this._.currentTabId,
			length = this._.tabIdList.length,
			tabIndex = CKEDITOR.tools.indexOf( this._.tabIdList, tabId ) + length;

		for ( var i = tabIndex - 1 ; i > tabIndex - length ; i-- )
		{
			if ( isTabVisible.call( this, this._.tabIdList[ i % length ] ) )
				return this._.tabIdList[ i % length ];
		}

		return null;
	}

	function getNextVisibleTab()
	{
		var tabId = this._.currentTabId,
			length = this._.tabIdList.length,
			tabIndex = CKEDITOR.tools.indexOf( this._.tabIdList, tabId );

		for ( var i = tabIndex + 1 ; i < tabIndex + length ; i++ )
		{
			if ( isTabVisible.call( this, this._.tabIdList[ i % length ] ) )
				return this._.tabIdList[ i % length ];
		}

		return null;
	}


	function clearOrRecoverTextInputValue( container, isRecover )
	{
		var inputs = container.$.getElementsByTagName( 'input' );
		for ( var i = 0, length = inputs.length; i < length ; i++ )
		{
			var item = new CKEDITOR.dom.element( inputs[ i ] );

			if ( item.getAttribute( 'type' ).toLowerCase() == 'text' )
			{
				if ( isRecover )
				{
					item.setAttribute( 'value', item.getCustomData( 'fake_value' ) || '' );
					item.removeCustomData( 'fake_value' );
				}
				else
				{
					item.setCustomData( 'fake_value', item.getAttribute( 'value' ) );
					item.setAttribute( 'value', '' );
				}
			}
		}
	}

	/**
	 * This is the base class for runtime dialog objects. An instance of this
	 * class represents a single named dialog for a single editor instance.
	 * @param {Object} editor The editor which created the dialog.
	 * @param {String} dialogName The dialog's registered name.
	 * @constructor
	 * @example
	 * var dialogObj = new CKEDITOR.dialog( editor, 'smiley' );
	 */
	CKEDITOR.dialog = function( editor, dialogName )
	{
		// Load the dialog definition.
		var definition = CKEDITOR.dialog._.dialogDefinitions[ dialogName ],
			defaultDefinition = CKEDITOR.tools.clone( defaultDialogDefinition ),
			buttonsOrder = editor.config.dialog_buttonsOrder || 'OS',
			dir = editor.lang.dir;

			if ( ( buttonsOrder == 'OS' && CKEDITOR.env.mac ) ||    // The buttons in MacOS Apps are in reverse order (#4750)
				( buttonsOrder == 'rtl' && dir == 'ltr' ) ||
				( buttonsOrder == 'ltr' && dir == 'rtl' ) )
					defaultDefinition.buttons.reverse();


		// Completes the definition with the default values.
		definition = CKEDITOR.tools.extend( definition( editor ), defaultDefinition );

		// Clone a functionally independent copy for this dialog.
		definition = CKEDITOR.tools.clone( definition );

		// Create a complex definition object, extending it with the API
		// functions.
		definition = new definitionObject( this, definition );

		var doc = CKEDITOR.document;

		var themeBuilt = editor.theme.buildDialog( editor );

		// Initialize some basic parameters.
		this._ =
		{
			editor : editor,
			element : themeBuilt.element,
			name : dialogName,
			contentSize : { width : 0, height : 0 },
			size : { width : 0, height : 0 },
			contents : {},
			buttons : {},
			accessKeyMap : {},

			// Initialize the tab and page map.
			tabs : {},
			tabIdList : [],
			currentTabId : null,
			currentTabIndex : null,
			pageCount : 0,
			lastTab : null,
			tabBarMode : false,

			// Initialize the tab order array for input widgets.
			focusList : [],
			currentFocusIndex : 0,
			hasFocus : false
		};

		this.parts = themeBuilt.parts;

		CKEDITOR.tools.setTimeout( function()
			{
				editor.fire( 'ariaWidget', this.parts.contents );
			},
			0, this );

		// Set the startup styles for the dialog, avoiding it enlarging the
		// page size on the dialog creation.
		this.parts.dialog.setStyles(
			{
				position : CKEDITOR.env.ie6Compat ? 'absolute' : 'fixed',
				top : 0,
				left: 0,
				visibility : 'hidden'
			});

		// Call the CKEDITOR.event constructor to initialize this instance.
		CKEDITOR.event.call( this );

		// Fire the "dialogDefinition" event, making it possible to customize
		// the dialog definition.
		this.definition = definition = CKEDITOR.fire( 'dialogDefinition',
			{
				name : dialogName,
				definition : definition
			}
			, editor ).definition;

		var tabsToRemove = {};
		// Cache tabs that should be removed.
		if ( !( 'removeDialogTabs' in editor._ ) && editor.config.removeDialogTabs )
		{
			var removeContents = editor.config.removeDialogTabs.split( ';' );

			for ( i = 0; i < removeContents.length; i++ )
			{
				var parts = removeContents[ i ].split( ':' );
				if ( parts.length == 2 )
				{
					var removeDialogName = parts[ 0 ];
					if ( !tabsToRemove[ removeDialogName ] )
						tabsToRemove[ removeDialogName ] = [];
					tabsToRemove[ removeDialogName ].push( parts[ 1 ] );
				}
			}
			editor._.removeDialogTabs = tabsToRemove;
		}

		// Remove tabs of this dialog.
		if ( editor._.removeDialogTabs && ( tabsToRemove = editor._.removeDialogTabs[ dialogName ] ) )
		{
			for ( i = 0; i < tabsToRemove.length; i++ )
				definition.removeContents( tabsToRemove[ i ] );
		}

		// Initialize load, show, hide, ok and cancel events.
		if ( definition.onLoad )
			this.on( 'load', definition.onLoad );

		if ( definition.onShow )
			this.on( 'show', definition.onShow );

		if ( definition.onHide )
			this.on( 'hide', definition.onHide );

		if ( definition.onOk )
		{
			this.on( 'ok', function( evt )
				{
					// Dialog confirm might probably introduce content changes (#5415).
					editor.fire( 'saveSnapshot' );
					setTimeout( function () { editor.fire( 'saveSnapshot' ); }, 0 );
					if ( definition.onOk.call( this, evt ) === false )
						evt.data.hide = false;
				});
		}

		if ( definition.onCancel )
		{
			this.on( 'cancel', function( evt )
				{
					if ( definition.onCancel.call( this, evt ) === false )
						evt.data.hide = false;
				});
		}

		var me = this;

		// Iterates over all items inside all content in the dialog, calling a
		// function for each of them.
		var iterContents = function( func )
		{
			var contents = me._.contents,
				stop = false;

			for ( var i in contents )
			{
				for ( var j in contents[i] )
				{
					stop = func.call( this, contents[i][j] );
					if ( stop )
						return;
				}
			}
		};

		this.on( 'ok', function( evt )
			{
				iterContents( function( item )
					{
						if ( item.validate )
						{
							var isValid = item.validate( this );

							if ( typeof isValid == 'string' )
							{
								alert( isValid );
								isValid = false;
							}

							if ( isValid === false )
							{
								if ( item.select )
									item.select();
								else
									item.focus();

								evt.data.hide = false;
								evt.stop();
								return true;
							}
						}
					});
			}, this, null, 0 );

		this.on( 'cancel', function( evt )
			{
				iterContents( function( item )
					{
						if ( item.isChanged() )
						{
							if ( !confirm( editor.lang.common.confirmCancel ) )
								evt.data.hide = false;
							return true;
						}
					});
			}, this, null, 0 );

		this.parts.close.on( 'click', function( evt )
				{
					if ( this.fire( 'cancel', { hide : true } ).hide !== false )
						this.hide();
					evt.data.preventDefault();
				}, this );

		// Sort focus list according to tab order definitions.
		function setupFocus()
		{
			var focusList = me._.focusList;
			focusList.sort( function( a, b )
				{
					// Mimics browser tab order logics;
					if ( a.tabIndex != b.tabIndex )
						return b.tabIndex - a.tabIndex;
					//  Sort is not stable in some browsers,
					// fall-back the comparator to 'focusIndex';
					else
						return a.focusIndex - b.focusIndex;
				});

			var size = focusList.length;
			for ( var i = 0; i < size; i++ )
				focusList[ i ].focusIndex = i;
		}

		function changeFocus( forward )
		{
			var focusList = me._.focusList,
				offset = forward ? 1 : -1;
			if ( focusList.length < 1 )
				return;

			var current = me._.currentFocusIndex;

			// Trigger the 'blur' event of  any input element before anything,
			// since certain UI updates may depend on it.
			try
			{
				focusList[ current ].getInputElement().$.blur();
			}
			catch( e ){}

			var startIndex = ( current + offset + focusList.length ) % focusList.length,
				currentIndex = startIndex;
			while ( !focusList[ currentIndex ].isFocusable() )
			{
				currentIndex = ( currentIndex + offset + focusList.length ) % focusList.length;
				if ( currentIndex == startIndex )
					break;
			}
			focusList[ currentIndex ].focus();

			// Select whole field content.
			if ( focusList[ currentIndex ].type == 'text' )
				focusList[ currentIndex ].select();
		}

		this.changeFocus = changeFocus;

		var processed;

		function focusKeydownHandler( evt )
		{
			// If I'm not the top dialog, ignore.
			if ( me != CKEDITOR.dialog._.currentTop )
				return;

			var keystroke = evt.data.getKeystroke(),
				rtl = editor.lang.dir == 'rtl';

			processed = 0;
			if ( keystroke == 9 || keystroke == CKEDITOR.SHIFT + 9 )
			{
				var shiftPressed = ( keystroke == CKEDITOR.SHIFT + 9 );

				// Handling Tab and Shift-Tab.
				if ( me._.tabBarMode )
				{
					// Change tabs.
					var nextId = shiftPressed ? getPreviousVisibleTab.call( me ) : getNextVisibleTab.call( me );
					me.selectPage( nextId );
					me._.tabs[ nextId ][ 0 ].focus();
				}
				else
				{
					// Change the focus of inputs.
					changeFocus( !shiftPressed );
				}

				processed = 1;
			}
			else if ( keystroke == CKEDITOR.ALT + 121 && !me._.tabBarMode && me.getPageCount() > 1 )
			{
				// Alt-F10 puts focus into the current tab item in the tab bar.
				me._.tabBarMode = true;
				me._.tabs[ me._.currentTabId ][ 0 ].focus();
				processed = 1;
			}
			else if ( ( keystroke == 37 || keystroke == 39 ) && me._.tabBarMode )
			{
				// Arrow keys - used for changing tabs.
				nextId = ( keystroke == ( rtl ? 39 : 37 ) ? getPreviousVisibleTab.call( me ) : getNextVisibleTab.call( me ) );
				me.selectPage( nextId );
				me._.tabs[ nextId ][ 0 ].focus();
				processed = 1;
			}
			else if ( ( keystroke == 13 || keystroke == 32 ) && me._.tabBarMode )
			{
				this.selectPage( this._.currentTabId );
				this._.tabBarMode = false;
				this._.currentFocusIndex = -1;
				changeFocus( true );
				processed = 1;
			}

			if ( processed )
			{
				evt.stop();
				evt.data.preventDefault();
			}
		}

		function focusKeyPressHandler( evt )
		{
			processed && evt.data.preventDefault();
		}

		var dialogElement = this._.element;
		// Add the dialog keyboard handlers.
		this.on( 'show', function()
			{
				dialogElement.on( 'keydown', focusKeydownHandler, this, null, 0 );
				// Some browsers instead, don't cancel key events in the keydown, but in the
				// keypress. So we must do a longer trip in those cases. (#4531)
				if ( CKEDITOR.env.opera || ( CKEDITOR.env.gecko && CKEDITOR.env.mac ) )
					dialogElement.on( 'keypress', focusKeyPressHandler, this );

			} );
		this.on( 'hide', function()
			{
				dialogElement.removeListener( 'keydown', focusKeydownHandler );
				if ( CKEDITOR.env.opera || ( CKEDITOR.env.gecko && CKEDITOR.env.mac ) )
					dialogElement.removeListener( 'keypress', focusKeyPressHandler );
			} );
		this.on( 'iframeAdded', function( evt )
			{
				var doc = new CKEDITOR.dom.document( evt.data.iframe.$.contentWindow.document );
				doc.on( 'keydown', focusKeydownHandler, this, null, 0 );
			} );

		// Auto-focus logic in dialog.
		this.on( 'show', function()
			{
				// Setup tabIndex on showing the dialog instead of on loading
				// to allow dynamic tab order happen in dialog definition.
				setupFocus();

				if ( editor.config.dialog_startupFocusTab
					&& me._.pageCount > 1 )
				{
					me._.tabBarMode = true;
					me._.tabs[ me._.currentTabId ][ 0 ].focus();
				}
				else if ( !this._.hasFocus )
				{
					this._.currentFocusIndex = -1;

					// Decide where to put the initial focus.
					if ( definition.onFocus )
					{
						var initialFocus = definition.onFocus.call( this );
						// Focus the field that the user specified.
						initialFocus && initialFocus.focus();
					}
					// Focus the first field in layout order.
					else
						changeFocus( true );

					/*
					 * IE BUG: If the initial focus went into a non-text element (e.g. button),
					 * then IE would still leave the caret inside the editing area.
					 */
					if ( this._.editor.mode == 'wysiwyg' && CKEDITOR.env.ie )
					{
						var $selection = editor.document.$.selection,
							$range = $selection.createRange();

						if ( $range )
						{
							if ( $range.parentElement && $range.parentElement().ownerDocument == editor.document.$
							  || $range.item && $range.item( 0 ).ownerDocument == editor.document.$ )
							{
								var $myRange = document.body.createTextRange();
								$myRange.moveToElementText( this.getElement().getFirst().$ );
								$myRange.collapse( true );
								$myRange.select();
							}
						}
					}
				}
			}, this, null, 0xffffffff );

		// IE6 BUG: Text fields and text areas are only half-rendered the first time the dialog appears in IE6 (#2661).
		// This is still needed after [2708] and [2709] because text fields in hidden TR tags are still broken.
		if ( CKEDITOR.env.ie6Compat )
		{
			this.on( 'load', function( evt )
					{
						var outer = this.getElement(),
							inner = outer.getFirst();
						inner.remove();
						inner.appendTo( outer );
					}, this );
		}

		initDragAndDrop( this );
		initResizeHandles( this );

		// Insert the title.
		( new CKEDITOR.dom.text( definition.title, CKEDITOR.document ) ).appendTo( this.parts.title );

		// Insert the tabs and contents.
		for ( var i = 0 ; i < definition.contents.length ; i++ )
		{
			var page = definition.contents[i];
			page && this.addPage( page );
		}

		this.parts[ 'tabs' ].on( 'click', function( evt )
				{
					var target = evt.data.getTarget();
					// If we aren't inside a tab, bail out.
					if ( target.hasClass( 'cke_dialog_tab' ) )
					{
						// Get the ID of the tab, without the 'cke_' prefix and the unique number suffix.
						var id = target.$.id;
						this.selectPage( id.substring( 4, id.lastIndexOf( '_' ) ) );

						if ( this._.tabBarMode )
						{
							this._.tabBarMode = false;
							this._.currentFocusIndex = -1;
							changeFocus( true );
						}
						evt.data.preventDefault();
					}
				}, this );

		// Insert buttons.
		var buttonsHtml = [],
			buttons = CKEDITOR.dialog._.uiElementBuilders.hbox.build( this,
				{
					type : 'hbox',
					className : 'cke_dialog_footer_buttons',
					widths : [],
					children : definition.buttons
				}, buttonsHtml ).getChild();
		this.parts.footer.setHtml( buttonsHtml.join( '' ) );

		for ( i = 0 ; i < buttons.length ; i++ )
			this._.buttons[ buttons[i].id ] = buttons[i];
	};

	// Focusable interface. Use it via dialog.addFocusable.
	function Focusable( dialog, element, index )
	{
		this.element = element;
		this.focusIndex = index;
		// TODO: support tabIndex for focusables.
		this.tabIndex = 0;
		this.isFocusable = function()
		{
			return !element.getAttribute( 'disabled' ) && element.isVisible();
		};
		this.focus = function()
		{
			dialog._.currentFocusIndex = this.focusIndex;
			this.element.focus();
		};
		// Bind events
		element.on( 'keydown', function( e )
			{
				if ( e.data.getKeystroke() in { 32:1, 13:1 }  )
					this.fire( 'click' );
			} );
		element.on( 'focus', function()
			{
				this.fire( 'mouseover' );
			} );
		element.on( 'blur', function()
			{
				this.fire( 'mouseout' );
			} );
	}

	CKEDITOR.dialog.prototype =
	{
		destroy : function()
		{
			this.hide();
			this._.element.remove();
		},

		/**
		 * Resizes the dialog.
		 * @param {Number} width The width of the dialog in pixels.
		 * @param {Number} height The height of the dialog in pixels.
		 * @function
		 * @example
		 * dialogObj.resize( 800, 640 );
		 */
		resize : (function()
		{
			return function( width, height )
			{
				if ( this._.contentSize && this._.contentSize.width == width && this._.contentSize.height == height )
					return;

				CKEDITOR.dialog.fire( 'resize',
					{
						dialog : this,
						skin : this._.editor.skinName,
						width : width,
						height : height
					}, this._.editor );

				this._.contentSize = { width : width, height : height };
			};
		})(),

		/**
		 * Gets the current size of the dialog in pixels.
		 * @returns {Object} An object with "width" and "height" properties.
		 * @example
		 * var width = dialogObj.getSize().width;
		 */
		getSize : function()
		{
			var element = this._.element.getFirst();
			return { width : element.$.offsetWidth || 0, height : element.$.offsetHeight || 0};
		},

		/**
		 * Moves the dialog to an (x, y) coordinate relative to the window.
		 * @function
		 * @param {Number} x The target x-coordinate.
		 * @param {Number} y The target y-coordinate.
		 * @param {Boolean} save Flag indicate whether the dialog position should be remembered on next open up.
		 * @example
		 * dialogObj.move( 10, 40 );
		 */
		move : (function()
		{
			var isFixed;
			return function( x, y, save )
			{
				// The dialog may be fixed positioned or absolute positioned. Ask the
				// browser what is the current situation first.
				var element = this._.element.getFirst();
				if ( isFixed === undefined )
					isFixed = element.getComputedStyle( 'position' ) == 'fixed';

				if ( isFixed && this._.position && this._.position.x == x && this._.position.y == y )
					return;

				// Save the current position.
				this._.position = { x : x, y : y };

				// If not fixed positioned, add scroll position to the coordinates.
				if ( !isFixed )
				{
					var scrollPosition = CKEDITOR.document.getWindow().getScrollPosition();
					x += scrollPosition.x;
					y += scrollPosition.y;
				}

				element.setStyles(
						{
							'left'	: ( x > 0 ? x : 0 ) + 'px',
							'top'	: ( y > 0 ? y : 0 ) + 'px'
						});

				save && ( this._.moved = 1 );
			};
		})(),

		/**
		 * Gets the dialog's position in the window.
		 * @returns {Object} An object with "x" and "y" properties.
		 * @example
		 * var dialogX = dialogObj.getPosition().x;
		 */
		getPosition : function(){ return CKEDITOR.tools.extend( {}, this._.position ); },

		/**
		 * Shows the dialog box.
		 * @example
		 * dialogObj.show();
		 */
		show : function()
		{
			// Insert the dialog's element to the root document.
			var element = this._.element;
			var definition = this.definition;
			if ( !( element.getParent() && element.getParent().equals( CKEDITOR.document.getBody() ) ) )
				element.appendTo( CKEDITOR.document.getBody() );
			else
				element.setStyle( 'display', 'block' );

			// FIREFOX BUG: Fix vanishing caret for Firefox 2 or Gecko 1.8.
			if ( CKEDITOR.env.gecko && CKEDITOR.env.version < 10900 )
			{
				var dialogElement = this.parts.dialog;
				dialogElement.setStyle( 'position', 'absolute' );
				setTimeout( function()
					{
						dialogElement.setStyle( 'position', 'fixed' );
					}, 0 );
			}


			// First, set the dialog to an appropriate size.
			this.resize( this._.contentSize && this._.contentSize.width || definition.minWidth,
					this._.contentSize && this._.contentSize.height || definition.minHeight );

			// Reset all inputs back to their default value.
			this.reset();

			// Select the first tab by default.
			this.selectPage( this.definition.contents[0].id );

			// Set z-index.
			if ( CKEDITOR.dialog._.currentZIndex === null )
				CKEDITOR.dialog._.currentZIndex = this._.editor.config.baseFloatZIndex;
			this._.element.getFirst().setStyle( 'z-index', CKEDITOR.dialog._.currentZIndex += 10 );

			// Maintain the dialog ordering and dialog cover.
			// Also register key handlers if first dialog.
			if ( CKEDITOR.dialog._.currentTop === null )
			{
				CKEDITOR.dialog._.currentTop = this;
				this._.parentDialog = null;
				showCover( this._.editor );

				element.on( 'keydown', accessKeyDownHandler );
				element.on( CKEDITOR.env.opera ? 'keypress' : 'keyup', accessKeyUpHandler );

				// Prevent some keys from bubbling up. (#4269)
				for ( var event in { keyup :1, keydown :1, keypress :1 } )
					element.on( event, preventKeyBubbling );
			}
			else
			{
				this._.parentDialog = CKEDITOR.dialog._.currentTop;
				var parentElement = this._.parentDialog.getElement().getFirst();
				parentElement.$.style.zIndex  -= Math.floor( this._.editor.config.baseFloatZIndex / 2 );
				CKEDITOR.dialog._.currentTop = this;
			}

			// Register the Esc hotkeys.
			registerAccessKey( this, this, '\x1b', null, function()
					{
						this.getButton( 'cancel' ) && this.getButton( 'cancel' ).click();
					} );

			// Reset the hasFocus state.
			this._.hasFocus = false;

			CKEDITOR.tools.setTimeout( function()
				{
					this.layout();
					this.parts.dialog.setStyle( 'visibility', '' );

					// Execute onLoad for the first show.
					this.fireOnce( 'load', {} );
					CKEDITOR.ui.fire( 'ready', this );

					this.fire( 'show', {} );
					this._.editor.fire( 'dialogShow', this );

					// Save the initial values of the dialog.
					this.foreach( function( contentObj ) { contentObj.setInitValue && contentObj.setInitValue(); } );

				},
				100, this );
		},

		/**
		 * Rearrange the dialog to its previous position or the middle of the window.
		 * @since 3.5
		 */
		layout : function()
		{
			var viewSize = CKEDITOR.document.getWindow().getViewPaneSize(),
					dialogSize = this.getSize();

			this.move( this._.moved ? this._.position.x : ( viewSize.width - dialogSize.width ) / 2,
					this._.moved ? this._.position.y : ( viewSize.height - dialogSize.height ) / 2 );
		},

		/**
		 * Executes a function for each UI element.
		 * @param {Function} fn Function to execute for each UI element.
		 * @returns {CKEDITOR.dialog} The current dialog object.
		 */
		foreach : function( fn )
		{
			for ( var i in this._.contents )
			{
				for ( var j in this._.contents[i] )
					fn( this._.contents[i][j] );
			}
			return this;
		},

		/**
		 * Resets all input values in the dialog.
		 * @example
		 * dialogObj.reset();
		 * @returns {CKEDITOR.dialog} The current dialog object.
		 */
		reset : (function()
		{
			var fn = function( widget ){ if ( widget.reset ) widget.reset( 1 ); };
			return function(){ this.foreach( fn ); return this; };
		})(),

		setupContent : function()
		{
			var args = arguments;
			this.foreach( function( widget )
				{
					if ( widget.setup )
						widget.setup.apply( widget, args );
				});
		},

		commitContent : function()
		{
			var args = arguments;
			this.foreach( function( widget )
				{
					if ( widget.commit )
						widget.commit.apply( widget, args );
				});
		},

		/**
		 * Hides the dialog box.
		 * @example
		 * dialogObj.hide();
		 */
		hide : function()
		{
			if ( !this.parts.dialog.isVisible() )
				return;

			this.fire( 'hide', {} );
			this._.editor.fire( 'dialogHide', this );
			var element = this._.element;
			element.setStyle( 'display', 'none' );
			this.parts.dialog.setStyle( 'visibility', 'hidden' );
			// Unregister all access keys associated with this dialog.
			unregisterAccessKey( this );

			// Close any child(top) dialogs first.
			while( CKEDITOR.dialog._.currentTop != this )
				CKEDITOR.dialog._.currentTop.hide();

			// Maintain dialog ordering and remove cover if needed.
			if ( !this._.parentDialog )
				hideCover();
			else
			{
				var parentElement = this._.parentDialog.getElement().getFirst();
				parentElement.setStyle( 'z-index', parseInt( parentElement.$.style.zIndex, 10 ) + Math.floor( this._.editor.config.baseFloatZIndex / 2 ) );
			}
			CKEDITOR.dialog._.currentTop = this._.parentDialog;

			// Deduct or clear the z-index.
			if ( !this._.parentDialog )
			{
				CKEDITOR.dialog._.currentZIndex = null;

				// Remove access key handlers.
				element.removeListener( 'keydown', accessKeyDownHandler );
				element.removeListener( CKEDITOR.env.opera ? 'keypress' : 'keyup', accessKeyUpHandler );

				// Remove bubbling-prevention handler. (#4269)
				for ( var event in { keyup :1, keydown :1, keypress :1 } )
					element.removeListener( event, preventKeyBubbling );

				var editor = this._.editor;
				editor.focus();

				if ( editor.mode == 'wysiwyg' && CKEDITOR.env.ie )
				{
					var selection = editor.getSelection();
					selection && selection.unlock( true );
				}
			}
			else
				CKEDITOR.dialog._.currentZIndex -= 10;

			delete this._.parentDialog;
			// Reset the initial values of the dialog.
			this.foreach( function( contentObj ) { contentObj.resetInitValue && contentObj.resetInitValue(); } );
		},

		/**
		 * Adds a tabbed page into the dialog.
		 * @param {Object} contents Content definition.
		 * @example
		 */
		addPage : function( contents )
		{
			var pageHtml = [],
				titleHtml = contents.label ? ' title="' + CKEDITOR.tools.htmlEncode( contents.label ) + '"' : '',
				elements = contents.elements,
				vbox = CKEDITOR.dialog._.uiElementBuilders.vbox.build( this,
						{
							type : 'vbox',
							className : 'cke_dialog_page_contents',
							children : contents.elements,
							expand : !!contents.expand,
							padding : contents.padding,
							style : contents.style || 'width: 100%;'
						}, pageHtml );

			// Create the HTML for the tab and the content block.
			var page = CKEDITOR.dom.element.createFromHtml( pageHtml.join( '' ) );
			page.setAttribute( 'role', 'tabpanel' );

			var env = CKEDITOR.env;
			var tabId = 'cke_' + contents.id + '_' + CKEDITOR.tools.getNextNumber(),
				 tab = CKEDITOR.dom.element.createFromHtml( [
					'<a class="cke_dialog_tab"',
						( this._.pageCount > 0 ? ' cke_last' : 'cke_first' ),
						titleHtml,
						( !!contents.hidden ? ' style="display:none"' : '' ),
						' id="', tabId, '"',
						env.gecko && env.version >= 10900 && !env.hc ? '' : ' href="javascript:void(0)"',
						' tabIndex="-1"',
						' hidefocus="true"',
						' role="tab">',
							contents.label,
					'</a>'
				].join( '' ) );

			page.setAttribute( 'aria-labelledby', tabId );

			// Take records for the tabs and elements created.
			this._.tabs[ contents.id ] = [ tab, page ];
			this._.tabIdList.push( contents.id );
			!contents.hidden && this._.pageCount++;
			this._.lastTab = tab;
			this.updateStyle();

			var contentMap = this._.contents[ contents.id ] = {},
				cursor,
				children = vbox.getChild();

			while ( ( cursor = children.shift() ) )
			{
				contentMap[ cursor.id ] = cursor;
				if ( typeof( cursor.getChild ) == 'function' )
					children.push.apply( children, cursor.getChild() );
			}

			// Attach the DOM nodes.

			page.setAttribute( 'name', contents.id );
			page.appendTo( this.parts.contents );

			tab.unselectable();
			this.parts.tabs.append( tab );

			// Add access key handlers if access key is defined.
			if ( contents.accessKey )
			{
				registerAccessKey( this, this, 'CTRL+' + contents.accessKey,
					tabAccessKeyDown, tabAccessKeyUp );
				this._.accessKeyMap[ 'CTRL+' + contents.accessKey ] = contents.id;
			}
		},

		/**
		 * Activates a tab page in the dialog by its id.
		 * @param {String} id The id of the dialog tab to be activated.
		 * @example
		 * dialogObj.selectPage( 'tab_1' );
		 */
		selectPage : function( id )
		{
			if ( this._.currentTabId == id )
				return;

			// Returning true means that the event has been canceled
			if ( this.fire( 'selectPage', { page : id, currentPage : this._.currentTabId } ) === true )
				return;

			// Hide the non-selected tabs and pages.
			for ( var i in this._.tabs )
			{
				var tab = this._.tabs[i][0],
					page = this._.tabs[i][1];
				if ( i != id )
				{
					tab.removeClass( 'cke_dialog_tab_selected' );
					page.hide();
				}
				page.setAttribute( 'aria-hidden', i != id );
			}

			var selected = this._.tabs[ id ];
			selected[ 0 ].addClass( 'cke_dialog_tab_selected' );

			// [IE] an invisible input[type='text'] will enlarge it's width
			// if it's value is long when it shows, so we clear it's value
			// before it shows and then recover it (#5649)
			if ( CKEDITOR.env.ie6Compat || CKEDITOR.env.ie7Compat )
			{
				clearOrRecoverTextInputValue( selected[ 1 ] );
				selected[ 1 ].show();
				setTimeout( function()
				{
					clearOrRecoverTextInputValue( selected[ 1 ], 1 );
				}, 0 );
			}
			else
				selected[ 1 ].show();

			this._.currentTabId = id;
			this._.currentTabIndex = CKEDITOR.tools.indexOf( this._.tabIdList, id );
		},

		// Dialog state-specific style updates.
		updateStyle : function()
		{
			// If only a single page shown, a different style is used in the central pane.
			this.parts.dialog[ ( this._.pageCount === 1 ? 'add' : 'remove' ) + 'Class' ]( 'cke_single_page' );
		},

		/**
		 * Hides a page's tab away from the dialog.
		 * @param {String} id The page's Id.
		 * @example
		 * dialog.hidePage( 'tab_3' );
		 */
		hidePage : function( id )
		{
			var tab = this._.tabs[id] && this._.tabs[id][0];
			if ( !tab || this._.pageCount == 1 || !tab.isVisible() )
				return;
			// Switch to other tab first when we're hiding the active tab.
			else if ( id == this._.currentTabId )
				this.selectPage( getPreviousVisibleTab.call( this ) );

			tab.hide();
			this._.pageCount--;
			this.updateStyle();
		},

		/**
		 * Unhides a page's tab.
		 * @param {String} id The page's Id.
		 * @example
		 * dialog.showPage( 'tab_2' );
		 */
		showPage : function( id )
		{
			var tab = this._.tabs[id] && this._.tabs[id][0];
			if ( !tab )
				return;
			tab.show();
			this._.pageCount++;
			this.updateStyle();
		},

		/**
		 * Gets the root DOM element of the dialog.
		 * @returns {CKEDITOR.dom.element} The &lt;span&gt; element containing this dialog.
		 * @example
		 * var dialogElement = dialogObj.getElement().getFirst();
		 * dialogElement.setStyle( 'padding', '5px' );
		 */
		getElement : function()
		{
			return this._.element;
		},

		/**
		 * Gets the name of the dialog.
		 * @returns {String} The name of this dialog.
		 * @example
		 * var dialogName = dialogObj.getName();
		 */
		getName : function()
		{
			return this._.name;
		},

		/**
		 * Gets a dialog UI element object from a dialog page.
		 * @param {String} pageId id of dialog page.
		 * @param {String} elementId id of UI element.
		 * @example
		 * @returns {CKEDITOR.ui.dialog.uiElement} The dialog UI element.
		 */
		getContentElement : function( pageId, elementId )
		{
			var page = this._.contents[ pageId ];
			return page && page[ elementId ];
		},

		/**
		 * Gets the value of a dialog UI element.
		 * @param {String} pageId id of dialog page.
		 * @param {String} elementId id of UI element.
		 * @example
		 * @returns {Object} The value of the UI element.
		 */
		getValueOf : function( pageId, elementId )
		{
			return this.getContentElement( pageId, elementId ).getValue();
		},

		/**
		 * Sets the value of a dialog UI element.
		 * @param {String} pageId id of the dialog page.
		 * @param {String} elementId id of the UI element.
		 * @param {Object} value The new value of the UI element.
		 * @example
		 */
		setValueOf : function( pageId, elementId, value )
		{
			return this.getContentElement( pageId, elementId ).setValue( value );
		},

		/**
		 * Gets the UI element of a button in the dialog's button row.
		 * @param {String} id The id of the button.
		 * @example
		 * @returns {CKEDITOR.ui.dialog.button} The button object.
		 */
		getButton : function( id )
		{
			return this._.buttons[ id ];
		},

		/**
		 * Simulates a click to a dialog button in the dialog's button row.
		 * @param {String} id The id of the button.
		 * @example
		 * @returns The return value of the dialog's "click" event.
		 */
		click : function( id )
		{
			return this._.buttons[ id ].click();
		},

		/**
		 * Disables a dialog button.
		 * @param {String} id The id of the button.
		 * @example
		 */
		disableButton : function( id )
		{
			return this._.buttons[ id ].disable();
		},

		/**
		 * Enables a dialog button.
		 * @param {String} id The id of the button.
		 * @example
		 */
		enableButton : function( id )
		{
			return this._.buttons[ id ].enable();
		},

		/**
		 * Gets the number of pages in the dialog.
		 * @returns {Number} Page count.
		 */
		getPageCount : function()
		{
			return this._.pageCount;
		},

		/**
		 * Gets the editor instance which opened this dialog.
		 * @returns {CKEDITOR.editor} Parent editor instances.
		 */
		getParentEditor : function()
		{
			return this._.editor;
		},

		/**
		 * Gets the element that was selected when opening the dialog, if any.
		 * @returns {CKEDITOR.dom.element} The element that was selected, or null.
		 */
		getSelectedElement : function()
		{
			return this.getParentEditor().getSelection().getSelectedElement();
		},

		/**
		 * Adds element to dialog's focusable list.
		 *
		 * @param {CKEDITOR.dom.element} element
		 * @param {Number} [index]
		 */
		addFocusable: function( element, index ) {
			if ( typeof index == 'undefined' )
			{
				index = this._.focusList.length;
				this._.focusList.push( new Focusable( this, element, index ) );
			}
			else
			{
				this._.focusList.splice( index, 0, new Focusable( this, element, index ) );
				for ( var i = index + 1 ; i < this._.focusList.length ; i++ )
					this._.focusList[ i ].focusIndex++;
			}
		}
	};

	CKEDITOR.tools.extend( CKEDITOR.dialog,
		/**
		 * @lends CKEDITOR.dialog
		 */
		{
			/**
			 * Registers a dialog.
			 * @param {String} name The dialog's name.
			 * @param {Function|String} dialogDefinition
			 * A function returning the dialog's definition, or the URL to the .js file holding the function.
			 * The function should accept an argument "editor" which is the current editor instance, and
			 * return an object conforming to {@link CKEDITOR.dialog.dialogDefinition}.
			 * @example
			 * @see CKEDITOR.dialog.dialogDefinition
			 */
			add : function( name, dialogDefinition )
			{
				// Avoid path registration from multiple instances override definition.
				if ( !this._.dialogDefinitions[name]
					|| typeof  dialogDefinition == 'function' )
					this._.dialogDefinitions[name] = dialogDefinition;
			},

			exists : function( name )
			{
				return !!this._.dialogDefinitions[ name ];
			},

			getCurrent : function()
			{
				return CKEDITOR.dialog._.currentTop;
			},

			/**
			 * The default OK button for dialogs. Fires the "ok" event and closes the dialog if the event succeeds.
			 * @static
			 * @field
			 * @example
			 * @type Function
			 */
			okButton : (function()
			{
				var retval = function( editor, override )
				{
					override = override || {};
					return CKEDITOR.tools.extend( {
						id : 'ok',
						type : 'button',
						label : editor.lang.common.ok,
						'class' : 'cke_dialog_ui_button_ok',
						onClick : function( evt )
						{
							var dialog = evt.data.dialog;
							if ( dialog.fire( 'ok', { hide : true } ).hide !== false )
								dialog.hide();
						}
					}, override, true );
				};
				retval.type = 'button';
				retval.override = function( override )
				{
					return CKEDITOR.tools.extend( function( editor ){ return retval( editor, override ); },
							{ type : 'button' }, true );
				};
				return retval;
			})(),

			/**
			 * The default cancel button for dialogs. Fires the "cancel" event and closes the dialog if no UI element value changed.
			 * @static
			 * @field
			 * @example
			 * @type Function
			 */
			cancelButton : (function()
			{
				var retval = function( editor, override )
				{
					override = override || {};
					return CKEDITOR.tools.extend( {
						id : 'cancel',
						type : 'button',
						label : editor.lang.common.cancel,
						'class' : 'cke_dialog_ui_button_cancel',
						onClick : function( evt )
						{
							var dialog = evt.data.dialog;
							if ( dialog.fire( 'cancel', { hide : true } ).hide !== false )
								dialog.hide();
						}
					}, override, true );
				};
				retval.type = 'button';
				retval.override = function( override )
				{
					return CKEDITOR.tools.extend( function( editor ){ return retval( editor, override ); },
							{ type : 'button' }, true );
				};
				return retval;
			})(),

			/**
			 * Registers a dialog UI element.
			 * @param {String} typeName The name of the UI element.
			 * @param {Function} builder The function to build the UI element.
			 * @example
			 */
			addUIElement : function( typeName, builder )
			{
				this._.uiElementBuilders[ typeName ] = builder;
			}
		});

	CKEDITOR.dialog._ =
	{
		uiElementBuilders : {},

		dialogDefinitions : {},

		currentTop : null,

		currentZIndex : null
	};

	// "Inherit" (copy actually) from CKEDITOR.event.
	CKEDITOR.event.implementOn( CKEDITOR.dialog );
	CKEDITOR.event.implementOn( CKEDITOR.dialog.prototype, true );

	var defaultDialogDefinition =
	{
		resizable : CKEDITOR.DIALOG_RESIZE_BOTH,
		minWidth : 600,
		minHeight : 400,
		buttons : [ CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton ]
	};

	// Tool function used to return an item from an array based on its id
	// property.
	var getById = function( array, id, recurse )
	{
		for ( var i = 0, item ; ( item = array[ i ] ) ; i++ )
		{
			if ( item.id == id )
				return item;
			if ( recurse && item[ recurse ] )
			{
				var retval = getById( item[ recurse ], id, recurse ) ;
				if ( retval )
					return retval;
			}
		}
		return null;
	};

	// Tool function used to add an item into an array.
	var addById = function( array, newItem, nextSiblingId, recurse, nullIfNotFound )
	{
		if ( nextSiblingId )
		{
			for ( var i = 0, item ; ( item = array[ i ] ) ; i++ )
			{
				if ( item.id == nextSiblingId )
				{
					array.splice( i, 0, newItem );
					return newItem;
				}

				if ( recurse && item[ recurse ] )
				{
					var retval = addById( item[ recurse ], newItem, nextSiblingId, recurse, true );
					if ( retval )
						return retval;
				}
			}

			if ( nullIfNotFound )
				return null;
		}

		array.push( newItem );
		return newItem;
	};

	// Tool function used to remove an item from an array based on its id.
	var removeById = function( array, id, recurse )
	{
		for ( var i = 0, item ; ( item = array[ i ] ) ; i++ )
		{
			if ( item.id == id )
				return array.splice( i, 1 );
			if ( recurse && item[ recurse ] )
			{
				var retval = removeById( item[ recurse ], id, recurse );
				if ( retval )
					return retval;
			}
		}
		return null;
	};

	/**
	 * This class is not really part of the API. It is the "definition" property value
	 * passed to "dialogDefinition" event handlers.
	 * @constructor
	 * @name CKEDITOR.dialog.dialogDefinitionObject
	 * @extends CKEDITOR.dialog.dialogDefinition
	 * @example
	 * CKEDITOR.on( 'dialogDefinition', function( evt )
	 * 	{
	 * 		var definition = evt.data.definition;
	 * 		var content = definition.getContents( 'page1' );
	 * 		...
	 * 	} );
	 */
	var definitionObject = function( dialog, dialogDefinition )
	{
		// TODO : Check if needed.
		this.dialog = dialog;

		// Transform the contents entries in contentObjects.
		var contents = dialogDefinition.contents;
		for ( var i = 0, content ; ( content = contents[i] ) ; i++ )
			contents[ i ] = content && new contentObject( dialog, content );

		CKEDITOR.tools.extend( this, dialogDefinition );
	};

	definitionObject.prototype =
	/** @lends CKEDITOR.dialog.dialogDefinitionObject.prototype */
	{
		/**
		 * Gets a content definition.
		 * @param {String} id The id of the content definition.
		 * @returns {CKEDITOR.dialog.contentDefinition} The content definition
		 *		matching id.
		 */
		getContents : function( id )
		{
			return getById( this.contents, id );
		},

		/**
		 * Gets a button definition.
		 * @param {String} id The id of the button definition.
		 * @returns {CKEDITOR.dialog.buttonDefinition} The button definition
		 *		matching id.
		 */
		getButton : function( id )
		{
			return getById( this.buttons, id );
		},

		/**
		 * Adds a content definition object under this dialog definition.
		 * @param {CKEDITOR.dialog.contentDefinition} contentDefinition The
		 *		content definition.
		 * @param {String} [nextSiblingId] The id of an existing content
		 *		definition which the new content definition will be inserted
		 *		before. Omit if the new content definition is to be inserted as
		 *		the last item.
		 * @returns {CKEDITOR.dialog.contentDefinition} The inserted content
		 *		definition.
		 */
		addContents : function( contentDefinition, nextSiblingId )
		{
			return addById( this.contents, contentDefinition, nextSiblingId );
		},

		/**
		 * Adds a button definition object under this dialog definition.
		 * @param {CKEDITOR.dialog.buttonDefinition} buttonDefinition The
		 *		button definition.
		 * @param {String} [nextSiblingId] The id of an existing button
		 *		definition which the new button definition will be inserted
		 *		before. Omit if the new button definition is to be inserted as
		 *		the last item.
		 * @returns {CKEDITOR.dialog.buttonDefinition} The inserted button
		 *		definition.
		 */
		addButton : function( buttonDefinition, nextSiblingId )
		{
			return addById( this.buttons, buttonDefinition, nextSiblingId );
		},

		/**
		 * Removes a content definition from this dialog definition.
		 * @param {String} id The id of the content definition to be removed.
		 * @returns {CKEDITOR.dialog.contentDefinition} The removed content
		 *		definition.
		 */
		removeContents : function( id )
		{
			removeById( this.contents, id );
		},

		/**
		 * Removes a button definition from the dialog definition.
		 * @param {String} id The id of the button definition to be removed.
		 * @returns {CKEDITOR.dialog.buttonDefinition} The removed button
		 *		definition.
		 */
		removeButton : function( id )
		{
			removeById( this.buttons, id );
		}
	};

	/**
	 * This class is not really part of the API. It is the template of the
	 * objects representing content pages inside the
	 * CKEDITOR.dialog.dialogDefinitionObject.
	 * @constructor
	 * @name CKEDITOR.dialog.contentDefinitionObject
	 * @example
	 * CKEDITOR.on( 'dialogDefinition', function( evt )
	 * 	{
	 * 		var definition = evt.data.definition;
	 * 		var content = definition.getContents( 'page1' );
	 *		content.remove( 'textInput1' );
	 * 		...
	 * 	} );
	 */
	function contentObject( dialog, contentDefinition )
	{
		this._ =
		{
			dialog : dialog
		};

		CKEDITOR.tools.extend( this, contentDefinition );
	}

	contentObject.prototype =
	/** @lends CKEDITOR.dialog.contentDefinitionObject.prototype */
	{
		/**
		 * Gets a UI element definition under the content definition.
		 * @param {String} id The id of the UI element definition.
		 * @returns {CKEDITOR.dialog.uiElementDefinition}
		 */
		get : function( id )
		{
			return getById( this.elements, id, 'children' );
		},

		/**
		 * Adds a UI element definition to the content definition.
		 * @param {CKEDITOR.dialog.uiElementDefinition} elementDefinition The
		 *		UI elemnet definition to be added.
		 * @param {String} nextSiblingId The id of an existing UI element
		 *		definition which the new UI element definition will be inserted
		 *		before. Omit if the new button definition is to be inserted as
		 *		the last item.
		 * @returns {CKEDITOR.dialog.uiElementDefinition} The element
		 *		definition inserted.
		 */
		add : function( elementDefinition, nextSiblingId )
		{
			return addById( this.elements, elementDefinition, nextSiblingId, 'children' );
		},

		/**
		 * Removes a UI element definition from the content definition.
		 * @param {String} id The id of the UI element definition to be
		 *		removed.
		 * @returns {CKEDITOR.dialog.uiElementDefinition} The element
		 *		definition removed.
		 * @example
		 */
		remove : function( id )
		{
			removeById( this.elements, id, 'children' );
		}
	};

	function initDragAndDrop( dialog )
	{
		var lastCoords = null,
			abstractDialogCoords = null,
			element = dialog.getElement().getFirst(),
			editor = dialog.getParentEditor(),
			magnetDistance = editor.config.dialog_magnetDistance,
			margins = editor.skin.margins || [ 0, 0, 0, 0 ];

		if ( typeof magnetDistance == 'undefined' )
			magnetDistance = 20;

		function mouseMoveHandler( evt )
		{
			var dialogSize = dialog.getSize(),
				viewPaneSize = CKEDITOR.document.getWindow().getViewPaneSize(),
				x = evt.data.$.screenX,
				y = evt.data.$.screenY,
				dx = x - lastCoords.x,
				dy = y - lastCoords.y,
				realX, realY;

			lastCoords = { x : x, y : y };
			abstractDialogCoords.x += dx;
			abstractDialogCoords.y += dy;

			if ( abstractDialogCoords.x + margins[3] < magnetDistance )
				realX = - margins[3];
			else if ( abstractDialogCoords.x - margins[1] > viewPaneSize.width - dialogSize.width - magnetDistance )
				realX = viewPaneSize.width - dialogSize.width + ( editor.lang.dir == 'rtl' ? 0 : margins[1] );
			else
				realX = abstractDialogCoords.x;

			if ( abstractDialogCoords.y + margins[0] < magnetDistance )
				realY = - margins[0];
			else if ( abstractDialogCoords.y - margins[2] > viewPaneSize.height - dialogSize.height - magnetDistance )
				realY = viewPaneSize.height - dialogSize.height + margins[2];
			else
				realY = abstractDialogCoords.y;

			dialog.move( realX, realY, 1 );

			evt.data.preventDefault();
		}

		function mouseUpHandler( evt )
		{
			CKEDITOR.document.removeListener( 'mousemove', mouseMoveHandler );
			CKEDITOR.document.removeListener( 'mouseup', mouseUpHandler );

			if ( CKEDITOR.env.ie6Compat )
			{
				var coverDoc = currentCover.getChild( 0 ).getFrameDocument();
				coverDoc.removeListener( 'mousemove', mouseMoveHandler );
				coverDoc.removeListener( 'mouseup', mouseUpHandler );
			}
		}

		dialog.parts.title.on( 'mousedown', function( evt )
			{
				lastCoords = { x : evt.data.$.screenX, y : evt.data.$.screenY };

				CKEDITOR.document.on( 'mousemove', mouseMoveHandler );
				CKEDITOR.document.on( 'mouseup', mouseUpHandler );
				abstractDialogCoords = dialog.getPosition();

				if ( CKEDITOR.env.ie6Compat )
				{
					var coverDoc = currentCover.getChild( 0 ).getFrameDocument();
					coverDoc.on( 'mousemove', mouseMoveHandler );
					coverDoc.on( 'mouseup', mouseUpHandler );
				}

				evt.data.preventDefault();
			}, dialog );
	}

	function initResizeHandles( dialog )
	{
		var def = dialog.definition,
			resizable = def.resizable;

		if ( resizable == CKEDITOR.DIALOG_RESIZE_NONE )
			return;

		var editor = dialog.getParentEditor();
		var wrapperWidth, wrapperHeight,
				viewSize, origin, startSize,
				dialogCover;

		function positionDialog( right )
		{
			// Maintain righthand sizing in RTL.
			if ( dialog._.moved && editor.lang.dir == 'rtl' )
			{
				var element = dialog._.element.getFirst();
				element.setStyle( 'right', right + "px" );
				element.removeStyle( 'left' );
			}
			else if ( !dialog._.moved )
				dialog.layout();
		}

		var mouseDownFn = CKEDITOR.tools.addFunction( function( $event )
		{
			startSize = dialog.getSize();

			var content = dialog.parts.contents,
				iframeDialog = content.$.getElementsByTagName( 'iframe' ).length;

			// Shim to help capturing "mousemove" over iframe.
			if ( iframeDialog )
			{
				dialogCover = CKEDITOR.dom.element.createFromHtml( '<div class="cke_dialog_resize_cover" style="height: 100%; position: absolute; width: 100%;"></div>' );
				content.append( dialogCover );
			}

			// Calculate the offset between content and chrome size.
			wrapperHeight = startSize.height - dialog.parts.contents.getSize( 'height',  ! ( CKEDITOR.env.gecko || CKEDITOR.env.opera || CKEDITOR.env.ie && CKEDITOR.env.quirks ) );
			wrapperWidth = startSize.width - dialog.parts.contents.getSize( 'width', 1 );

			origin = { x : $event.screenX, y : $event.screenY };

			viewSize = CKEDITOR.document.getWindow().getViewPaneSize();

			CKEDITOR.document.on( 'mousemove', mouseMoveHandler );
			CKEDITOR.document.on( 'mouseup', mouseUpHandler );

			if ( CKEDITOR.env.ie6Compat )
			{
				var coverDoc = currentCover.getChild( 0 ).getFrameDocument();
				coverDoc.on( 'mousemove', mouseMoveHandler );
				coverDoc.on( 'mouseup', mouseUpHandler );
			}

			$event.preventDefault && $event.preventDefault();
		});

		// Prepend the grip to the dialog.
		dialog.on( 'load', function()
		{
			var direction = '';
			if ( resizable == CKEDITOR.DIALOG_RESIZE_WIDTH )
				direction = ' cke_resizer_horizontal';
			else if ( resizable == CKEDITOR.DIALOG_RESIZE_HEIGHT )
				direction = ' cke_resizer_vertical';
			var resizer = CKEDITOR.dom.element.createFromHtml( '<div class="cke_resizer' + direction + '"' +
					' title="' + CKEDITOR.tools.htmlEncode( editor.lang.resize ) + '"' +
					' onmousedown="CKEDITOR.tools.callFunction(' + mouseDownFn + ', event )"></div>' );
			dialog.parts.footer.append( resizer, 1 );
		});
		editor.on( 'destroy', function() { CKEDITOR.tools.removeFunction( mouseDownFn ); } );

		function mouseMoveHandler( evt )
		{
			var rtl = editor.lang.dir == 'rtl',
				dx = ( evt.data.$.screenX - origin.x ) * ( rtl ? -1 : 1 ),
				dy = evt.data.$.screenY - origin.y,
				width = startSize.width,
				height = startSize.height,
				internalWidth = width + dx * ( dialog._.moved ? 1 : 2 ),
				internalHeight = height + dy * ( dialog._.moved ? 1 : 2 ),
				element = dialog._.element.getFirst(),
				right = rtl && element.getComputedStyle( 'right' ),
				position = dialog.getPosition();

			// IE might return "auto", we need exact position.
			if ( right )
				right = right == 'auto' ? viewSize.width - ( position.x || 0 ) - element.getSize( 'width' ) : parseInt( right, 10 );

			if ( position.y + internalHeight > viewSize.height )
				internalHeight = viewSize.height - position.y;

			if ( ( rtl ? right : position.x ) + internalWidth > viewSize.width )
				internalWidth = viewSize.width - ( rtl ? right : position.x );

			// Make sure the dialog will not be resized to the wrong side when it's in the leftmost position for RTL.
			if ( ( resizable == CKEDITOR.DIALOG_RESIZE_WIDTH || resizable == CKEDITOR.DIALOG_RESIZE_BOTH ) && !( rtl && dx > 0 && !position.x ) )
				width = Math.max( def.minWidth || 0, internalWidth - wrapperWidth );

			if ( resizable == CKEDITOR.DIALOG_RESIZE_HEIGHT || resizable == CKEDITOR.DIALOG_RESIZE_BOTH )
				height = Math.max( def.minHeight || 0, internalHeight - wrapperHeight );

			dialog.resize( width, height );
			// The right property might get broken during resizing, so computing it before the resizing.
			positionDialog( right );

			evt.data.preventDefault();
		}

		function mouseUpHandler()
		{
			CKEDITOR.document.removeListener( 'mouseup', mouseUpHandler );
			CKEDITOR.document.removeListener( 'mousemove', mouseMoveHandler );

			if ( dialogCover )
			{
				dialogCover.remove();
				dialogCover = null;
			}

			if ( CKEDITOR.env.ie6Compat )
			{
				var coverDoc = currentCover.getChild( 0 ).getFrameDocument();
				coverDoc.removeListener( 'mouseup', mouseUpHandler );
				coverDoc.removeListener( 'mousemove', mouseMoveHandler );
			}

			// Switch back to use the left property, if RTL is used.
			if ( editor.lang.dir == 'rtl' )
			{
				var element = dialog._.element.getFirst(),
					left = element.getComputedStyle( 'left' );

				// IE might return "auto", we need exact position.
				if ( left == 'auto' )
					left = viewSize.width - parseInt( element.getStyle( 'right' ), 10 ) - dialog.getSize().width;
				else
					left = parseInt( left, 10 );

				element.removeStyle( 'right' );
				// Make sure the left property gets applied, even if it is the same as previously.
				dialog._.position.x += 1;
				dialog.move( left, dialog._.position.y );
			}
		}
	}

	var resizeCover;
	// Caching resuable covers and allowing only one cover
	// on screen.
	var covers = {},
		currentCover;

	function showCover( editor )
	{
		var win = CKEDITOR.document.getWindow();
		var config = editor.config,
			backgroundColorStyle = config.dialog_backgroundCoverColor || 'white',
			backgroundCoverOpacity = config.dialog_backgroundCoverOpacity,
			baseFloatZIndex = config.baseFloatZIndex,
			coverKey = CKEDITOR.tools.genKey(
					backgroundColorStyle,
					backgroundCoverOpacity,
					baseFloatZIndex ),
			coverElement = covers[ coverKey ];

		if ( !coverElement )
		{
			var html = [
					'<div tabIndex="-1" style="position: ', ( CKEDITOR.env.ie6Compat ? 'absolute' : 'fixed' ),
					'; z-index: ', baseFloatZIndex,
					'; top: 0px; left: 0px; ',
					( !CKEDITOR.env.ie6Compat ? 'background-color: ' + backgroundColorStyle : '' ),
					'" class="cke_dialog_background_cover">'
				];

			if ( CKEDITOR.env.ie6Compat )
			{
				// Support for custom document.domain in IE.
				var isCustomDomain = CKEDITOR.env.isCustomDomain(),
					iframeHtml = '<html><body style=\\\'background-color:' + backgroundColorStyle + ';\\\'></body></html>';

				html.push(
					'<iframe' +
						' hidefocus="true"' +
						' frameborder="0"' +
						' id="cke_dialog_background_iframe"' +
						' src="javascript:' );

				html.push( 'void((function(){' +
								'document.open();' +
								( isCustomDomain ? 'document.domain=\'' + document.domain + '\';' : '' ) +
								'document.write( \'' + iframeHtml + '\' );' +
								'document.close();' +
							'})())' );

				html.push(
						'"' +
						' style="' +
							'position:absolute;' +
							'left:0;' +
							'top:0;' +
							'width:100%;' +
							'height: 100%;' +
							'progid:DXImageTransform.Microsoft.Alpha(opacity=0)">' +
					'</iframe>' );
			}

			html.push( '</div>' );

			coverElement = CKEDITOR.dom.element.createFromHtml( html.join( '' ) );
			coverElement.setOpacity( backgroundCoverOpacity != undefined ? backgroundCoverOpacity : 0.5 );

			coverElement.appendTo( CKEDITOR.document.getBody() );
			covers[ coverKey ] = coverElement;
		}
		else
			coverElement.	show();

		currentCover = coverElement;
		var resizeFunc = function()
		{
			var size = win.getViewPaneSize();
			coverElement.setStyles(
				{
					width : size.width + 'px',
					height : size.height + 'px'
				} );
		};

		var scrollFunc = function()
		{
			var pos = win.getScrollPosition(),
				cursor = CKEDITOR.dialog._.currentTop;
			coverElement.setStyles(
					{
						left : pos.x + 'px',
						top : pos.y + 'px'
					});

			if ( cursor )
			{
				do
				{
					var dialogPos = cursor.getPosition();
					cursor.move( dialogPos.x, dialogPos.y );
				} while ( ( cursor = cursor._.parentDialog ) );
			}
		};

		resizeCover = resizeFunc;
		win.on( 'resize', resizeFunc );
		resizeFunc();
		// Using Safari/Mac, focus must be kept where it is (#7027)
		if ( !( CKEDITOR.env.mac && CKEDITOR.env.webkit ) )
			coverElement.focus();

		if ( CKEDITOR.env.ie6Compat )
		{
			// IE BUG: win.$.onscroll assignment doesn't work.. it must be window.onscroll.
			// So we need to invent a really funny way to make it work.
			var myScrollHandler = function()
				{
					scrollFunc();
					arguments.callee.prevScrollHandler.apply( this, arguments );
				};
			win.$.setTimeout( function()
				{
					myScrollHandler.prevScrollHandler = window.onscroll || function(){};
					window.onscroll = myScrollHandler;
				}, 0 );
			scrollFunc();
		}
	}

	function hideCover()
	{
		if ( !currentCover )
			return;

		var win = CKEDITOR.document.getWindow();
		currentCover.hide();
		win.removeListener( 'resize', resizeCover );

		if ( CKEDITOR.env.ie6Compat )
		{
			win.$.setTimeout( function()
				{
					var prevScrollHandler = window.onscroll && window.onscroll.prevScrollHandler;
					window.onscroll = prevScrollHandler || null;
				}, 0 );
		}
		resizeCover = null;
	}

	function removeCovers()
	{
		for ( var coverId in covers )
			covers[ coverId ].remove();
		covers = {};
	}

	var accessKeyProcessors = {};

	var accessKeyDownHandler = function( evt )
	{
		var ctrl = evt.data.$.ctrlKey || evt.data.$.metaKey,
			alt = evt.data.$.altKey,
			shift = evt.data.$.shiftKey,
			key = String.fromCharCode( evt.data.$.keyCode ),
			keyProcessor = accessKeyProcessors[( ctrl ? 'CTRL+' : '' ) + ( alt ? 'ALT+' : '') + ( shift ? 'SHIFT+' : '' ) + key];

		if ( !keyProcessor || !keyProcessor.length )
			return;

		keyProcessor = keyProcessor[keyProcessor.length - 1];
		keyProcessor.keydown && keyProcessor.keydown.call( keyProcessor.uiElement, keyProcessor.dialog, keyProcessor.key );
		evt.data.preventDefault();
	};

	var accessKeyUpHandler = function( evt )
	{
		var ctrl = evt.data.$.ctrlKey || evt.data.$.metaKey,
			alt = evt.data.$.altKey,
			shift = evt.data.$.shiftKey,
			key = String.fromCharCode( evt.data.$.keyCode ),
			keyProcessor = accessKeyProcessors[( ctrl ? 'CTRL+' : '' ) + ( alt ? 'ALT+' : '') + ( shift ? 'SHIFT+' : '' ) + key];

		if ( !keyProcessor || !keyProcessor.length )
			return;

		keyProcessor = keyProcessor[keyProcessor.length - 1];
		if ( keyProcessor.keyup )
		{
			keyProcessor.keyup.call( keyProcessor.uiElement, keyProcessor.dialog, keyProcessor.key );
			evt.data.preventDefault();
		}
	};

	var registerAccessKey = function( uiElement, dialog, key, downFunc, upFunc )
	{
		var procList = accessKeyProcessors[key] || ( accessKeyProcessors[key] = [] );
		procList.push( {
				uiElement : uiElement,
				dialog : dialog,
				key : key,
				keyup : upFunc || uiElement.accessKeyUp,
				keydown : downFunc || uiElement.accessKeyDown
			} );
	};

	var unregisterAccessKey = function( obj )
	{
		for ( var i in accessKeyProcessors )
		{
			var list = accessKeyProcessors[i];
			for ( var j = list.length - 1 ; j >= 0 ; j-- )
			{
				if ( list[j].dialog == obj || list[j].uiElement == obj )
					list.splice( j, 1 );
			}
			if ( list.length === 0 )
				delete accessKeyProcessors[i];
		}
	};

	var tabAccessKeyUp = function( dialog, key )
	{
		if ( dialog._.accessKeyMap[key] )
			dialog.selectPage( dialog._.accessKeyMap[key] );
	};

	var tabAccessKeyDown = function( dialog, key )
	{
	};

	// ESC, ENTER
	var preventKeyBubblingKeys = { 27 :1, 13 :1 };
	var preventKeyBubbling = function( e )
	{
		if ( e.data.getKeystroke() in preventKeyBubblingKeys )
			e.data.stopPropagation();
	};

	(function()
	{
		CKEDITOR.ui.dialog =
		{
			/**
			 * The base class of all dialog UI elements.
			 * @constructor
			 * @param {CKEDITOR.dialog} dialog Parent dialog object.
			 * @param {CKEDITOR.dialog.uiElementDefinition} elementDefinition Element
			 * definition. Accepted fields:
			 * <ul>
			 * 	<li><strong>id</strong> (Required) The id of the UI element. See {@link
			 * 	CKEDITOR.dialog#getContentElement}</li>
			 * 	<li><strong>type</strong> (Required) The type of the UI element. The
			 * 	value to this field specifies which UI element class will be used to
			 * 	generate the final widget.</li>
			 * 	<li><strong>title</strong> (Optional) The popup tooltip for the UI
			 * 	element.</li>
			 * 	<li><strong>hidden</strong> (Optional) A flag that tells if the element
			 * 	should be initially visible.</li>
			 * 	<li><strong>className</strong> (Optional) Additional CSS class names
			 * 	to add to the UI element. Separated by space.</li>
			 * 	<li><strong>style</strong> (Optional) Additional CSS inline styles
			 * 	to add to the UI element. A semicolon (;) is required after the last
			 * 	style declaration.</li>
			 * 	<li><strong>accessKey</strong> (Optional) The alphanumeric access key
			 * 	for this element. Access keys are automatically prefixed by CTRL.</li>
			 * 	<li><strong>on*</strong> (Optional) Any UI element definition field that
			 * 	starts with <em>on</em> followed immediately by a capital letter and
			 * 	probably more letters is an event handler. Event handlers may be further
			 * 	divided into registered event handlers and DOM event handlers. Please
			 * 	refer to {@link CKEDITOR.ui.dialog.uiElement#registerEvents} and
			 * 	{@link CKEDITOR.ui.dialog.uiElement#eventProcessors} for more
			 * 	information.</li>
			 * </ul>
			 * @param {Array} htmlList
			 * List of HTML code to be added to the dialog's content area.
			 * @param {Function|String} nodeNameArg
			 * A function returning a string, or a simple string for the node name for
			 * the root DOM node. Default is 'div'.
			 * @param {Function|Object} stylesArg
			 * A function returning an object, or a simple object for CSS styles applied
			 * to the DOM node. Default is empty object.
			 * @param {Function|Object} attributesArg
			 * A fucntion returning an object, or a simple object for attributes applied
			 * to the DOM node. Default is empty object.
			 * @param {Function|String} contentsArg
			 * A function returning a string, or a simple string for the HTML code inside
			 * the root DOM node. Default is empty string.
			 * @example
			 */
			uiElement : function( dialog, elementDefinition, htmlList, nodeNameArg, stylesArg, attributesArg, contentsArg )
			{
				if ( arguments.length < 4 )