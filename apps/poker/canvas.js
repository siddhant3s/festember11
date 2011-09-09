/*!
 * oCanvas v1.0
 * http://ocanvas.org/
 *
 * Copyright 2011, Johannes Koggdal
 * Licensed under the MIT license
 * http://ocanvas.org/license
 */

(function(window, document, undefined){

	// Define the oCanvas object
	var oCanvas = {
		
		// Function for checking when the DOM is ready for interaction
		domReady: function (func) {
			if (/in/.test(document.readyState)) {
				setTimeout("oCanvas.domReady(" + func + ")", 10);
			} else {
				func();
			}
		},
		
		// Array containing all canvases created by oCanvas on the current page
		canvasList: [],
		
		// Object containing all the registered modules
		modules: {},
		
		// Object containing all the registered init methods
		inits: {},
		
		// Object containing all the registered plugins
		plugins: {},
		
		// Define the core class
		core: function (options) {
		
			// Add the canvas to the canvas list on the global object
			this.id = oCanvas.canvasList.push(this) - 1;
			

			// Add the registered modules to the new instance of core
			for (var m in oCanvas.modules) {
				if (typeof oCanvas.modules[m] === "function") {
					this[m] = Object.create(oCanvas.modules[m]());
				} else {
					this[m] = Object.create(oCanvas.modules[m]);
				}
			}
			
			// Set up default settings
			this.settings = {
				fps: 30,
				background: "transparent",
				clearEachFrame: true,
				drawEachFrame: true,
				disableScrolling: false,
				plugins: []
			};

			// Update the settings with the user specified settings
			oCanvas.extend(this.settings, options);
			
			// Set canvas to specified element
			if (this.settings.canvas.nodeName && this.settings.canvas.nodeName.toLowerCase() === "canvas") {
				this.canvasElement = this.settings.canvas;
			}
			
			// Set canvas to the element specified using a selector
			else if (typeof this.settings.canvas === "string") {
				this.canvasElement = document.querySelector(this.settings.canvas);
			}
			
			// Return false if no canvas was specified
			else {
				return false;
			}
			
			// Get the canvas context and dimensions
			this.canvas = c = this.canvasElement.getContext("2d");
			var width = this.canvasElement.width;
			var height = this.canvasElement.height;
			this.__defineSetter__("width", function (value) {
				width = !isNaN(parseFloat(value)) ? parseFloat(value) : width;
				this.canvasElement.width = width;
				this.redraw();
			});
			this.__defineGetter__("width", function () {
				return width;
			});
			this.__defineSetter__("height", function (value) {
				height = !isNaN(parseFloat(value)) ? parseFloat(value) : height;
				this.canvasElement.height = height;
				this.redraw();
			});
			this.__defineGetter__("height", function () {
				return height;
			});
			
			// Set the core instance in all modules to enable access of core properties inside of modules
			for (var m in oCanvas.modules) {
			
				// Add core access to modules in a wrapper module (like display objects that reside in the wrapper display)
				if (this[m].wrapper === true) {
					for (var wm in this[m]) {
						if (typeof this[m][wm] === "object" && typeof this[m][wm].setCore === "function") {
							this[m][wm] = this[m][wm].setCore(this);
						}
						else if (typeof this[m][wm].setCore === "function") {
							this[m][wm].setCore(this);
						}
						
						this[m].core = this;
					}
				}
				
				// Add core access to modules that reside directly in the core
				this[m].core = this;
			}
			
			// Initialize added modules that have registered init methods
			for (var name in oCanvas.inits) {
			
				// Modules directly on the oCanvas object
				if ((typeof oCanvas.inits[name] === "string") && (typeof this[name][oCanvas.inits[name]] === "function")) {
					this[name][oCanvas.inits[name]]();
				}
				
				// Modules that are parts of a wrapper module
				else if (oCanvas.inits[name] === "object") {
					for (var subname in oCanvas.inits[name]) {
						if (typeof this[name][oCanvas.inits[name][subname]] === "function") {
							this[name][oCanvas.inits[name][subname]]();
						}
					}
				}
			}
			
			// Run plugins if any have been specified
			var plugins = this.settings.plugins;
			if (plugins.length > 0) {
				for (var i = 0, l = plugins.length; i < l; i++) {
					if (typeof oCanvas.plugins[plugins[i]] === "function") {
						oCanvas.plugins[plugins[i]].call(this);
					}
				}
			}
		},
		
		// Method for registering a new module
		registerModule: function (name, module, init) {
			if (~name.indexOf(".")) {
				var parts = name.split(".");
				oCanvas.modules[parts[0]][parts[1]] = module;
				
				if (init !== undefined) {
					if (!oCanvas.inits[parts[0]]) {
						oCanvas.inits[parts[0]] = {};
					}
					oCanvas.inits[parts[0]][parts[1]] = init;
				}
			} else {
				oCanvas.modules[name] = module;
				if (init !== undefined) {
					oCanvas.inits[name] = init;
				}
			}
		},
		
		// Method for registering a new plugin
		// The plugin will not be run until a new core instance is being created,
		// and the instance requests the plugin, thus allowing a plugin to change
		// things in the library for just one instance
		registerPlugin: function (name, plugin) {
			oCanvas.plugins[name] = plugin;
		},
		
		// Function for creating a new instance of oCanvas
		create: function (settings) {
		
			// Create the new instance and return it
			return new oCanvas.core(settings);
		}
	};
	
	
	// Methods the core instances will have access to
	oCanvas.core.prototype = {
		
		// Method for adding an object to the canvas
		addChild: function (displayobj) {
			displayobj.add();
			
			return this;
		},
		
		// Method for removing an object from the canvas
		removeChild: function (displayobj) {
			displayobj.remove();
			
			return this;
		},
		
		// Shorthand method for clearing the canvas
		clear: function (keepBackground) {
			this.draw.clear(keepBackground);
			
			return this;
		},
		
		// Shorthand method for redrawing the canvas
		redraw: function () {
			this.draw.redraw();
			
			return this;
		},
		
		// Method for binding an event to the canvas
		bind: function (type, handler) {
			this.events.bind(this.canvasElement, type, handler);
			
			return this;
		},
		
		// Method for unbinding an event from the object
		unbind: function (type, handler) {
			this.events.unbind(this.canvasElement, type, handler);
			
			return this;
		},
			
		// Method for triggering all events added to the object
		trigger: function (types) {
			this.events.trigger(this.canvasElement, types);
			
			return this;
		}
	};

	// Attach the oCanvas object to the window object for access outside of this file
	window.oCanvas = oCanvas;
	



	// Define Object.create if not available
	if (typeof Object.create !== "function") {
		Object.create = function (o) {
			function F() {}
			F.prototype = o;
			return new F();
		};
	}

	// usage: log('inside coolFunc',this,arguments);
	// http://paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
	window.log = function () {
		log.history = log.history || [];	// store logs to an array for reference
		log.history.push(arguments);
		if (this.console) {
			var i, args = Array.prototype.slice.call(arguments), l = args.length;
			for (i = 0; i < l; i++) {
				console.log(args[i]);
			}
		}
	};

	// Extend an object with new properties and replace values for existing properties
	oCanvas.extend = function () {
	
		// Get first two args
		var args = Array.prototype.slice.call(arguments),
			last = args[args.length - 1],
			destination = args.splice(0, 1)[0],
			current = args.splice(0, 1)[0],
			x, getter, setter, exclude = [];
		
		// If the last object is an exclude object, get the properties
		if (last.exclude && (JSON.stringify(last) === JSON.stringify({exclude:last.exclude}))) {
			exclude = last.exclude;
		}
		
		// Do the loop unless this object is an exclude object
		if (current !== last || exclude.length === 0) {
			
			// Add members from second object to the first
			for (x in current) {
			
				// Exclude specified properties
				if (~exclude.indexOf(x)) {
					continue;
				}
				
				getter = current.__lookupGetter__(x);
				setter = current.__lookupSetter__(x);
				
				if (getter || setter) {
					if (getter) {
						destination.__defineGetter__(x, getter);
					}
					if (setter) {
						destination.__defineSetter__(x, setter);
					}
				} else {
					destination[x] = current[x];
				}
			}
		}
		
		// If there are more objects passed in, run once more, otherwise return the first object
		if (args.length > 0) {
			return oCanvas.extend.apply(this, [destination].concat(args));
		} else {
			return destination;
		}
	};




	// Define the timeline class
	var timeline = function () {
	
		// Return an object when instantiated
		return {
			
			init: function () {
				var _this = this;
				
				// Method for setting the function to be called for each frame
				this.core.setLoop = function (callback) {
					_this.userLoop = callback;
					
					// Return the timeline object to enable methods like start() to be called directly
					return _this;
				};
			},
			
			// Set default values when initalized
			currentFrame: 1,
			timeline: 0,
			running: false,
			
			set fps (value) {
				this.core.settings.fps = value;
				
				// Restart the timer if the timeline is running
				if (this.running) {
					this.start();
				}
			},
			get fps () {
				return this.core.settings.fps;
			},
			
			// Method that will be called for each frame
			loop: function () {
				
				// If mainLoop has been defined
				if (typeof this.userLoop === "function") {
				
					// Clear the canvas if specified
					if (this.core.settings.clearEachFrame === true) {
						this.core.draw.clear();
					}
					
					// Trigger the user defined function mainLoop and set this to the current core instance
					this.userLoop.call(this.core, this.core.canvas);
					
					// Redraw the canvas if specified
					if (this.core.settings.drawEachFrame === true) {
						this.core.draw.redraw();
					}
					
					// Increment the frame count
					this.currentFrame++;
				}
			},
		
			// Method that starts the timeline
			start: function () {
				var timeline = this;
				
				// Reset the timer
				clearInterval(timeline.timeline);
				timeline.timeline = setInterval(function () { timeline.loop(); }, 1000 / timeline.fps);
				timeline.running = true;
				
				return this;
			},
			
			// Method that stops the timeline
			stop: function () {
			
				// Remove the timer
				clearInterval(this.timeline);
				this.running = false;
				
				return this;
			}
		};
	};
	
	// Register the timeline module
	oCanvas.registerModule("timeline", timeline, "init");
	



	// Define the class
	var keyboard = function () {
		
		// Return an object when instantiated
		return {
			
			// List of all events that are added
			eventList: {
				keydown: [],
				keyup: [],
				keypress: [],
				running: []
			},
			
			// Define properties
			keysDown: {},
			keyPressTimer: 0,
			keyPressRunning: false,
			modifiedKeys: {},
			lastActiveKeyDown: false,
			last_event: {},
			
			// Method for initializing the keyboard object
			init: function () {
				var _this = this;
				this.running = false;
				
				// Register event types
				this.core.events.types.keyboard = ["keydown", "keyup", "keypress"];
				
				// Add event listeners to the document
				document.addEventListener("keydown", function (e) { _this.keydown.call(_this, e); }, false);
				document.addEventListener("keyup", function (e) { _this.keyup.call(_this, e); }, false);
				document.addEventListener("keypress", function (e) { _this.preventkeypress.call(_this, e); }, false);
			},
			
			// Method for adding an event to the event list
			addEvent: function (type, func) {
				return this.eventList[type].push(func) - 1;
			},
			
			// Method for removing an event from the event list
			removeEvent: function (type, id) {
				this.eventList[type].splice(id,1);
			},
			
			// Method for getting the key code from current event
			getKeyCode: function (e) {
				return e.keyCode === 0 ? e.which : e.keyCode;
			},
			
			// Method for getting how many keys are currently pressed down
			numKeysDown: function () {
				var active = 0,
					keysDown = this.keysDown;
				
				// Go through all the keys that are currently pressed down
				for (var x in keysDown) {
					if (keysDown[x] === true) {
						active++;
					}
				}
				
				return active;
			},
			
			// Method for checking if any keys are pressed down
			anyKeysDown: function () {
				if (this.numKeysDown() > 0) {
					return true;
				} else {
					return false;
				}
			},
			
			// Method for getting which keys are currently pressed down
			getKeysDown: function () {
				var keysDown = this.keysDown,
					down = [],
					x;
				
				// Go through all the keys that are currently pressed down
				for (x in keysDown) {
					if (keysDown[x] === true) {
						down.push(x);
					}
				}
				
				return down;
			},
			
			// Method for triggering all events of a specific type
			triggerEvents: function (type, e) {
				var key, i, event, eventObject;
				
				// If the mouse has set focus on the canvas
				if (this.core.mouse && this.core.mouse.canvasFocused === true) {
					key = this.eventList[type];
					eventObject = this.core.events.modifyEventObject(e, type);
					
					// Loop through all events and trigger them
					for (i = key.length; i--;) {
						event = key[i];
						if (typeof event === "function") {
							event(eventObject);
						}
					}
				}
			},
			
			// Method for triggering the events when a key is pressed down
			keydown: function (e) {
				this.last_event = e;
				var _this = this;
			
				// Cancel event if the key is already pressed down
				// (some browsers repeat even keydown when held down)
				if (this.keysDown[this.getKeyCode(e)] === true) {
					return;
				}
				
				// Set the key states
				this.lastActiveKeyDown = this.getKeyCode(e);
				this.keysDown[this.lastActiveKeyDown] = true;
				
				// Trigger event handlers
				this.triggerEvents("keydown", e);
				
				// Cancel the keypress timer
				clearInterval(this.keyPressTimer);
				this.keyPressRunning = false;
				
				// If there are keypress events attached and none are currently running
				if (!this.keyPressRunning && this.eventList.keypress.length > 0) {
				
					// Set the timer to trigger keypress events continuosly until released
					this.keyPressTimer = setInterval(function () { _this.keypress(e); }, 1000 / this.core.settings.fps);
					this.keyPressRunning = true;
				}
				
				// Prevent the default behavior of the assigned keys
				this.preventkeypress(e);
			},
			
			// Method for triggering the events when a key is released
			keyup: function (e) {
				this.last_event = e;
				
				// Set the key states
				var keyCode = this.getKeyCode(e);
				if (keyCode === this.lastActiveKeyDown) {
					this.lastActiveKeyDown = false;
				}
				delete this.keysDown[keyCode];
				
				// Trigger event handlers
				this.triggerEvents("keyup", e);
				
				// If there are no more keys pressed down, cancel the keypress timer
				if (!this.anyKeysDown()) {
					clearInterval(this.keyPressTimer);
					this.keyPressRunning = false;
				}
			},
			
			// Method for triggering the events when a key is pressed
			// The keydown method will trigger this method continuously until released
			keypress: function (e) {
				this.last_event = e;
				
				this.triggerEvents("keypress", e);
			},
			
			// Method for preventing the default behavior of the assigned keys
			preventkeypress: function (e) {
				var keyCode, modifiedKeys, code;
				
				if (this.core.mouse && this.core.mouse.canvasFocused === true) {
					keyCode = this.getKeyCode(e);
					modifiedKeys = this.modifiedKeys;
					
					for (code in modifiedKeys) {
						if (keyCode === code && modifiedKeys[code] !== false) {
							e.preventDefault();
						}
					}
				}
			},
			
			ARROW_UP:38, ARROW_DOWN:40, ARROW_LEFT:37, ARROW_RIGHT:39, SPACE:32, ENTER:13, ESC:27
		};
	};
	
	// Register the module
	oCanvas.registerModule("keyboard", keyboard, "init");




	// Define the class
	var mouse = function () {
		
		// Return an object when instantiated
		return {
			
			// List of all events that are added
			eventList: {
				mousemove: [],
				mouseenter: [],
				mouseleave: [],
				click: [],
				mousedown: [],
				mouseup: [],
				drag: []
			},
			
			last_event: {},
			cursorValue: "default",
			
			// Method for initializing the module
			init: function () {
				var _this = this,
					core = this.core,
					canvasElement = core.canvasElement,
					types;
				
				// Register pointer
				core.events.types.mouse = types = ["mousemove", "mouseenter", "mouseleave", "mousedown", "mouseup", "click"];
				core.events.pointers.mouse = function (type, doAdd) {
					if (~types.indexOf(type) && !("ontouchstart" in window || "createTouch" in document)) {
						doAdd("mouse", "click");
					}
				};
				core.pointer = this;
				
				// Define properties
				this.x = 0;
				this.y = 0;
				this.buttonState = 'up';
				this.canvasFocused = false;
				this.canvasHovered = false;
				this.cancel();
				
				// Add event listeners to the canvas element
				canvasElement.addEventListener('mousemove', function (e) { _this.mousemove.call(_this, e); }, false);
				canvasElement.addEventListener('mousedown', function (e) { _this.mousedown.call(_this, e); }, false);
				canvasElement.addEventListener('mouseup', function (e) { _this.mouseup.call(_this, e); }, false);
				
				// Add event listeners to the canvas element (used for setting states and trigger mouseup events)
				document.addEventListener('mouseup', function (e) { _this.docmouseup.call(_this, e); }, false);
				document.addEventListener('mouseover', function (e) { _this.docmouseover.call(_this, e); }, false);
				document.addEventListener('mousedown', function (e) { _this.docmousedown.call(_this, e); }, false);
				if (parent !== window) {
					// Add event listener for the parent document as well, if the canvas is within an iframe for example
					parent.document.addEventListener('mouseover', function (e) { _this.docmouseover.call(_this, e); }, false);
				}
			},
			
			// Method for adding an event to the event list
			addEvent: function (type, handler) {
				return this.eventList[type].push(handler) - 1;
			},
			
			// Method for removing an event from the event list
			removeEvent: function (type, index) {
				this.eventList[type].splice(index, 1);
			},
			
			// Method for getting the current mouse position relative to the canvas top left corner
			getPos: function (e) {
				var x, y,
					boundingRect = this.core.canvasElement.getBoundingClientRect();
					
				// Browsers supporting pageX/pageY
				if (e.pageX !== undefined && e.pageY !== undefined) {
					x = e.pageX - document.documentElement.scrollLeft - Math.round(boundingRect.left);
					y = e.pageY - document.documentElement.scrollTop - Math.round(boundingRect.top);
				}
				// Browsers not supporting pageX/pageY
				else if (e.clientX !== undefined && e.clientY !== undefined) {
					x = e.clientX + document.documentElement.scrollLeft - Math.round(boundingRect.left);
					y = e.clientY + document.documentElement.scrollTop - Math.round(boundingRect.top);
				}
				
				return { x: x, y: y };
			},
			
			// Method for updating the mouse position relative to the canvas top left corner
			updatePos: function (e) {
				var pos = this.getPos(e);
				this.x = pos.x;
				this.y = pos.y;
				
				return pos;
			},
			
			// Method for checking if the mouse pointer is inside the canvas
			onCanvas: function (e) {
				e = e || this.last_event;
				
				// Get pointer position
				var pos = e ? this.getPos(e) : {x:this.x, y:this.y};
				
				// Check boundaries => (left) && (right) && (top) && (bottom)
				if ( (pos.x >= 0) && (pos.x <= this.core.width) && (pos.y >= 0) && (pos.y <= this.core.height) ) {
					this.canvasHovered = true;
					this.updatePos(e);
					return true;
				} else {
					this.canvasHovered = false;
					return false;
				}
			},
			
			// Method for triggering all events of a specific type
			triggerEvents: function (type, e, forceLeave) {
				forceLeave = forceLeave || false;
				var events = this.eventList[type],
					i, event,
					eventObject = this.core.events.modifyEventObject(e, type);
						
				// Add new properties to the event object
				eventObject.x = this.x;
				eventObject.y = this.y;
				
				// Fix the which property
				// 0: No button pressed
				// 1: Primary button (usually left)
				// 2: Secondary button (usually right)
				// 3: Middle (usually the wheel)
				if (eventObject.button === 0 && ~"mousedown mouseup click".indexOf(type)) {
					eventObject.which = 1;
				} else if (eventObject.button === 2) {
					eventObject.which = 2;
				} else if (eventObject.button === 1) {
					eventObject.which = 3;
				} else {
					eventObject.which = 0;
				}
				
				// Trigger all events associated with the type
				for (i = events.length; i--;) {
					event = events[i];
					if (typeof event === "function") {
						event(eventObject, forceLeave);
					}
				}
			},
			
			// Method that triggers all mousemove events that are added
			// Also handles parts of drag and drop
			mousemove: function (e) {
				this.last_event = e;
				this.updatePos(e);
				this.canvasHovered = true;
				
				this.triggerEvents("mouseenter", e);
				this.triggerEvents("mousemove", e);
				this.triggerEvents("mouseleave", e);
				this.triggerEvents("drag", e);
			},
			
			// Method that triggers all mousedown events that are added
			mousedown: function (e) {
				this.canvasFocused = true;
				this.last_event = e;
				this.start_pos = this.getPos(e);
				this.buttonState = "down";
				
				this.triggerEvents("mousedown", e);
				
				return false;
			},
			
			// Method that triggers all mouseup events that are added
			mouseup: function (e) {
				this.last_event = e;
				this.buttonState = "up";
				
				this.triggerEvents("mouseup", e);
				this.triggerEvents("click", e);
				
				this.cancel();
			},
			
			// Method that triggers all mouseup events when pointer was pressed down on canvas and released outside
			docmouseup: function (e) {
				this.last_event = e;
				if (this.buttonState === "down" && !this.onCanvas(e)) {
					this.mouseup(e);
				}
			},
			
			// Method that triggers all mouseleave events when pointer is outside the canvas
			docmouseover: function (e) {
				this.last_event = e;
				if (!this.onCanvas(e)) {
					this.triggerEvents("mouseleave", e, true);
				}
			},
			
			// Method that sets the focus state when pointer is pressed down outside the canvas
			docmousedown: function (e) {
				this.last_event = e;
				if (!this.onCanvas(e)) {
					this.canvasFocused = false;
				}
			},
			
			// Method that cancels the click event
			// A click is triggered if both the start pos and end pos is within the object,
			// so resetting the start_pos cancels the click
			cancel: function () {
				this.start_pos = {x:-10,y:-10};
				
				return this;
			},
			
			// Method for hiding the cursor
			hide: function () {
				this.core.canvasElement.style.cursor = "none";
				
				return this;
			},
			
			// Method for showing the cursor
			show: function () {
				this.core.canvasElement.style.cursor = this.cursorValue;
				
				return this;
			},
			
			// Method for setting the mouse cursor icon
			cursor: function (value) {
				if (~value.indexOf("url(")) {
					var m = /url\((.*?)\)(\s(.*?)\s(.*?)|)($|,.*?$)/.exec(value),
						options = m[5] ? m[5] : "";
					value = "url(" + m[1] + ") " + (m[3] ? m[3] : 0) + " " + (m[4] ? m[4] : 0) + (options !== "" ? options :  ", default");
				}
				this.core.canvasElement.style.cursor = value;
				this.cursorValue = value;
				
				return this;
			}
		};
	};

	// Register the module
	oCanvas.registerModule("mouse", mouse, "init");



	
	// Define the class
	var touch = function () {
		
		// Return an object when instantiated
		return {
			
			// List of all events that are added
			eventList: {
				touchstart: [],
				touchend: [],
				touchmove: [],
				touchenter: [],
				touchleave: [],
				tap: []
			},
			
			last_event: {},
			
			// Method for initializing the module
			init: function () {
				var _this = this,
					core = this.core,
					canvasElement = core.canvasElement,
					types,
					isTouch = ("ontouchstart" in window || "createTouch" in document);
				
				// Register pointer
				core.events.types.touch = types = ["touchstart", "touchend", "touchmove", "touchenter", "touchleave", "tap"];
				core.events.pointers.touch = function (type, doAdd) {
					if (~types.indexOf(type) && isTouch) {
						doAdd("touch", "tap");
					}
				};
				if (isTouch) {
					core.pointer = this;
					
					// Set iOS specific settings to prevent selection of the canvas element
					canvasElement.style.WebkitUserSelect = "none";
					canvasElement.style.WebkitTouchCallout = "none";
					canvasElement.style.WebkitTapHighlightColor = "rgba(0,0,0,0)";
				}
				
				// Define properties
				this.x = -1;
				this.y = -1;
				this.touchState = 'up';
				this.canvasFocused = false;
				this.canvasHovered = false;
				this.cancel();
				
				// Add event listeners to the canvas element
				canvasElement.addEventListener('touchmove', function (e) { _this.touchmove.call(_this, e); }, false);
				canvasElement.addEventListener('touchstart', function (e) { _this.touchstart.call(_this, e); }, false);
				canvasElement.addEventListener('touchend', function (e) { _this.touchend.call(_this, e); }, false);
				
				if (core.settings.disableScrolling) {
					// Add event listener to prevent scrolling on touch devices
					canvasElement.addEventListener('touchmove', function (e) { _this.doctouchmove.call(_this, e); e.preventDefault(); }, false);
				}
				
				// Add event listeners to the canvas element (used for setting states and trigger touchend events)
				document.addEventListener('touchend', function (e) { _this.doctouchend.call(_this, e); }, false);
				document.addEventListener('touchmove', function (e) { _this.doctouchmove.call(_this, e); }, true);
				document.addEventListener('touchstart', function (e) { _this.doctouch.call(_this, e); }, true);
			},
			
			// Method for adding an event to the event list
			addEvent: function (type, handler) {
				return this.eventList[type].push(handler) - 1;
			},
			
			// Method for removing an event from the event list
			removeEvent: function (type, index) {
				this.eventList[type].splice(index, 1);
			},
			
			// Method for getting the current touch position relative to the canvas top left corner
			getPos: function (e) {
				var x, y;
				
				if (e.touches !== undefined) {
					var boundingRect = this.core.canvasElement.getBoundingClientRect(),
						l = e.touches.length;
	
					if (e.touches.length > 0) {
						e = e.touches[0];
							
						// Browsers supporting pageX/pageY
						if (e.pageX && e.pageY) {
							x = e.pageX - (Math.round(boundingRect.left) < 0 ? 0 : Math.round(boundingRect.left));
							y = e.pageY - (Math.round(boundingRect.top) < 0 ? 0 : Math.round(boundingRect.top));
						} else {
							x = this.x;
							y = this.y;
						}
					}
				} else {
					x = this.x;
					y = this.y;
				}
				
				return { x: x, y: y };
			},
			
			// Method for updating the touch position relative to the canvas top left corner
			updatePos: function (e) {
				var pos = this.getPos(e);
				this.x = pos.x;
				this.y = pos.y;
				
				return pos;
			},
			
			// Method for checking if the touch is inside the canvas
			onCanvas: function (e) {
				e = e || this.last_event;
				
				// Get pointer position
				var pos = e ? this.getPos(e) : {x:this.x, y:this.y};
				
				// Check boundaries => (left) && (right) && (top) && (bottom)
				if ( (pos.x >= 0) && (pos.x <= this.core.width) && (pos.y >= 0) && (pos.y <= this.core.height) ) {
					this.canvasHovered = true;
					this.updatePos(e);
					return true;
				} else {
					this.canvasHovered = false;
					return false;
				}
			},
			
			// Method for triggering all events of a specific type
			triggerEvents: function (type, e, forceLeave) {
				forceLeave = forceLeave || false;
				var events = this.eventList[type],
					i, event,
					eventObject = this.core.events.modifyEventObject(e, type);
						
				// Add new properties to the event object
				eventObject.x = this.x;
				eventObject.y = this.y;
				eventObject.which = 0;
				
				// Trigger all events associated with the type
				for (i = events.length; i--;) {
					event = events[i];
					if (typeof event === "function") {
						event(eventObject, forceLeave);
					}
				}
			},
			
			// Method that triggers all touchmove events that are added
			touchmove: function (e) {
				this.last_event = e;
				
				if (this.onCanvas(e)) {
					this.canvasHovered = true;
					
					this.triggerEvents("touchenter", e);
					this.triggerEvents("touchmove", e);
					this.triggerEvents("touchleave", e);
				}
			},
			
			// Method that triggers all touchstart events that are added
			touchstart: function (e) {
				this.canvasFocused = true;
				this.last_event = e;
				
				if (this.onCanvas(e)) {
					this.start_pos = this.updatePos(e);
					this.touchState = "down";
					
					this.triggerEvents("touchenter", e);
					this.triggerEvents("touchstart", e);
				}
				return false;
			},
			
			// Method that triggers all touchend events that are added
			touchend: function (e) {
				this.last_event = e;
				this.touchState = "up";
				
				this.triggerEvents("touchleave", e, true);
				this.triggerEvents("touchend", e);
				this.triggerEvents("tap", e);
				
				this.cancel();
			},
			
			// Method that triggers all touchend events when touch was pressed down on canvas and released outside
			doctouchend: function (e) {
				if (this.touchState === "down" && !this.onCanvas(e)) {
					this.touchend(e);
				}
			},
			
			// Method that triggers all touchleave events when touch is outside the canvas
			doctouchmove: function (e) {
				if (this.canvasHovered && !this.onCanvas(e)) {
					this.triggerEvents("touchleave", e, true);
				}
			},
			
			// Method that sets the focus state when touch is pressed down outside the canvas
			doctouch: function (e) {
				if (!this.onCanvas(e)) {
					this.canvasFocused = false;
				}
			},
			
			// Method that cancels the tap event
			// A tap is triggered if both the start pos and end pos is within the object,
			// so resetting the start_pos cancels the tap
			cancel: function () {
				this.start_pos = {x:-10,y:-10};
				
				return this;
			}
			
		};
	};

	// Register the module
	oCanvas.registerModule("touch", touch, "init");




	// Define the class
	var tools = function () {
		
		// Return an object when instantiated
		return {
			
			// Method for transforming the pointer position to the current object's transformation
			transformPointerPosition: function (obj, cX, cY, extraAngle, pointer) {
				extraAngle = extraAngle || 0;
				pointer = pointer || this.core.pointer;
				
				// All calls that come from isPointerInside() will pass the display object as its first argument
				// This method will then do multiple transforms for each object in the parent chain to get the correct result
				if (typeof obj === "object") {
					var parent = obj.parent,
						objectChain = [],
						last, object, pos = { x: 0, y: 0 }, origin;
					
					// Get all objects in the parent chain, including this one
					objectChain.push(obj);
					while (parent) {
						objectChain.push(parent);
						parent = parent.parent;
					}
					
					// Reverse the array so the top level parent comes first, and ends with the current object
					objectChain.reverse();
					
					// Loop through all objects in the parent chain
					last = pointer;
					for (n = 0, l = objectChain.length; n < l; n++) {
						object = objectChain[n];
						
						// If the object has a rotation, get the transformed mouse position for that rotation
						pos = this.transformPointerPosition(object.rotation, object.abs_x, object.abs_y, 0, last);
						
						// Save the current position so that the next iteration can use that as the pointer
						last = pos;
					}
					
					// Rotate an extra angle if specified
					if (extraAngle !== 0) {
						origin = obj.getOrigin();
						pos = this.transformPointerPosition(extraAngle * -1, cX, cY, 0, last);
					}
					
					// Return the correct position after all transforms
					return {
						x: pos.x,
						y: pos.y
					};
				}
				
				// If the first argument is not an object, it is the rotation passed in above
				else {
					var rotation = obj;
				}
				
				var topright = (pointer.x >= cX && pointer.y <= cY),
					bottomright = (pointer.x >= cX && pointer.y >= cY),
					bottomleft = (pointer.x <= cX && pointer.y >= cY),
					topleft = (pointer.x <= cX && pointer.y <= cY),
					D = Math.sqrt(Math.pow(pointer.x - cX, 2) + Math.pow(pointer.y - cY, 2)),
					rotation = ((rotation / 360) - Math.floor(rotation / 360)) * 360 - extraAngle,
					c, x, y,
					b = (D === 0) ? 0 : Math.abs(pointer.y - cY) / D;
				
				// When pointer is in top right or bottom left corner
				if ( topright || bottomleft ) {
					c = (180 - rotation - Math.asin(b) * 180 / Math.PI) * Math.PI / 180;
					
					x = cX + Math.cos(c) * D * (topright ? -1 : 1);
					y = cY + Math.sin(c) * D * (topright ? -1 : 1);
				}
				
				// When pointer is in top left or bottom right corner
				else if (topleft || bottomright) {
					c = (Math.asin(b) * 180 / Math.PI - rotation) * Math.PI / 180;
					
					x = cX + Math.cos(c) * D * (topleft ? -1 : 1);
					y = cY + Math.sin(c) * D * (topleft ? -1 : 1);
				}
				
				return {
					x: x,
					y: y
				};
			},
			
			// Method for checking if the pointer's current position is inside the specified object
			isPointerInside: function (obj, pointerObject) {
			
				var origin = obj.getOrigin();
			
				// Line
				if (obj.type === "line") {
				
					// Get angle difference relative to if it had been horizontal
					var dX = Math.abs(obj.end.x - obj.abs_x),
						dY = Math.abs(obj.end.y - obj.abs_y),
						D = Math.sqrt(dX * dX + dY * dY),
						angle = Math.asin(dY / D) * 180 / Math.PI,
						
						// Transform the pointer position with the angle correction
						pointer = this.transformPointerPosition(obj, obj.abs_x, obj.abs_y, angle * -1, pointerObject);
					
					// Check if pointer is inside the line
					// Pointer coordinates are transformed to be compared with a horizontal line
					return ((pointer.x > obj.abs_x - D - origin.x) && (pointer.x < obj.abs_x + D - origin.x) && (pointer.y > obj.abs_y - obj.strokeWidth / 2 - origin.y) && (pointer.y < obj.abs_y + obj.strokeWidth / 2 - origin.y));
				} else
				
				// Text
				if (obj.type === "text") {
					var pointer = this.transformPointerPosition(obj, obj.abs_x, obj.abs_y, 0, pointerObject),
						stroke = obj.strokeWidth / 2,
						left, right, top, bottom;
					
					// Find left and right positions based on the text alignment
					if (obj.align === "left") {
						left = obj.abs_x;
						right = obj.abs_x + obj.width;
					} else if (obj.align === "center") {
						left = obj.abs_x - obj.width / 2;
						right = obj.abs_x + obj.width / 2;
					} else if (obj.align === "right") {
						left = obj.abs_x - obj.width;
						right = obj.abs_x;
					} else if (obj.align === "start") {
						if (this.core.canvasElement.dir === "rtl") {
							left = obj.abs_x - obj.width;
							right = obj.abs_x;
						} else {
							left = obj.abs_x;
							right = obj.abs_x + obj.width;
						}
					} else if (obj.align === "end") {
						if (this.core.canvasElement.dir === "rtl") {
							left = obj.abs_x;
							right = obj.abs_x + obj.width;
						} else {
							left = obj.abs_x - obj.width;
							right = obj.abs_x;
						}
					}
					
					// Find the top and bottom positions based on the text baseline
					if (obj.baseline === "top") {
						top = obj.abs_y;
					} else if (obj.baseline === "hanging") {
						top = obj.abs_y - obj.height * 0.19;
					} else if (obj.baseline === "middle") {
						top = obj.abs_y - obj.height * 0.5;
					} else if (obj.baseline === "alphabetic") {
						top = obj.abs_y - obj.height * 0.79;
					} else if (obj.baseline === "ideographic") {
						top = obj.abs_y - obj.height * 0.84;
					} else if (obj.baseline === "bottom") {
						top = obj.abs_y - obj.height;
					}
					bottom = top + obj.height;
					
					return ((pointer.x > left - origin.x - stroke) && (pointer.x < right - origin.x + stroke) && (pointer.y > top - origin.y - stroke) && (pointer.y < bottom - origin.y + stroke));
				} else
				
				// Rectangle
				if (obj.shapeType === "rectangular") {
					var pointer = this.transformPointerPosition(obj, obj.abs_x, obj.abs_y, 0, pointerObject),
						stroke = (obj.strokePosition === "outside") ? obj.strokeWidth : ((obj.strokePosition === "center") ? obj.strokeWidth / 2 : 0);
					
					return ((pointer.x > obj.abs_x - origin.x - stroke) && (pointer.x < obj.abs_x + obj.width - origin.x + stroke) && (pointer.y > obj.abs_y - origin.y - stroke) && (pointer.y < obj.abs_y + obj.height - origin.y + stroke));
				} else
				
				// Circle
				if (obj.type === "ellipse" && obj.radius_x === obj.radius_y) {
					var pointer = this.transformPointerPosition(obj, obj.abs_x, obj.abs_y, 0, pointerObject),
						D = Math.sqrt(Math.pow(pointer.x - obj.abs_x + origin.x, 2) + Math.pow(pointer.y - obj.abs_y + origin.y, 2));
					return (D < obj.radius_x + obj.strokeWidth / 2);
				} else
				
				// Ellipse
				if (obj.type === "ellipse") {
					var pointer = this.transformPointerPosition(obj, obj.abs_x, obj.abs_y, 0, pointerObject),
						a = obj.radius_x + obj.strokeWidth / 2,
						b = obj.radius_y + obj.strokeWidth / 2;
					pointer.x -= obj.abs_x + origin.x;
					pointer.y -= obj.abs_y + origin.y;
					
					return ((pointer.x * pointer.x) / (a * a) + (pointer.y * pointer.y) / (b * b) < 1);
				} else
				
				// Polygon
				if (obj.type === "polygon") {
					var pointer = this.transformPointerPosition(obj, obj.abs_x, obj.abs_y, 0, pointerObject),
						radius = obj.radius + obj.strokeWidth / 2,
						length = obj.sides,
						j = length - 1,
						odd = false,
						i, thisPoint, prevPoint;
						
					for (i = 0; i < length; i++) {
					
						// Calulate positions for the points
						thisPoint = {
							x: (obj.abs_x - origin.x + (radius * Math.cos(i * 2 * Math.PI / length))),
							y: (obj.abs_y - origin.y + (radius * Math.sin(i * 2 * Math.PI / length)))
						};
						prevPoint = {
							x: (obj.abs_x - origin.x + (radius * Math.cos(j * 2 * Math.PI / length))),
							y: (obj.abs_y - origin.y + (radius * Math.sin(j * 2 * Math.PI / length)))
						};
						
						// Check how many edges we cross using odd parity
						if ( ((thisPoint.y < pointer.y) && (prevPoint.y >= pointer.y)) || ((prevPoint.y < pointer.y) && (thisPoint.y >= pointer.y)) ) {
							if (thisPoint.x + (pointer.y - thisPoint.y) / (prevPoint.y - thisPoint.y) * (prevPoint.x - thisPoint.x) < pointer.x) {
								odd = !odd;
							}
						}
						j = i;
					}
					
					return odd;
				} else
				
				// Arc
				// Filled arcs, stroked arcs, stroked arcs that look like pie chart pieces
				if (obj.type === "arc") {
					var angleRange = (obj.direction === "clockwise") ? obj.end - obj.start : Math.abs(obj.end - obj.start),
						extraAngle = (obj.direction === "clockwise" ? obj.start * -1 : obj.end * -1),
						pointer = this.transformPointerPosition(obj, obj.abs_x - origin.x, obj.abs_y - origin.y, extraAngle, pointerObject),
						D = Math.sqrt(Math.pow(pointer.x - obj.abs_x + origin.x, 2) + Math.pow(pointer.y - obj.abs_y + origin.y, 2)),
						radius = obj.radius,
						eP = {},
						p1 = {},
						a, y_, z, angle;
					
					// Cancel if the distance between pointer and origin is longer than the radius
					if ((obj.strokeWidth === 0 && D > radius) || (obj.strokeWidth > 0 && D > radius + obj.strokeWidth / 2)) {
						return false;
					}
					
					// If the arc is made like a pie chart piece
					// (desired radius is set as stroke width and actual radius is set to half that size)
					if (radius === obj.strokeWidth / 2) {
					
						if (angleRange > 180) {
						
							var pX, pY, pD, pA;
							
							// Calculate the distance between the pointer and origin, to find the angle
							pX = Math.abs(obj.abs_x - origin.x - pointer.x),
							pY = Math.abs(obj.abs_y - origin.y - pointer.y),
							pD = Math.sqrt(pX * pX + pY * pY),
							pA = Math.acos(pX / pD) * 180 / Math.PI;
							
							if (pointer.y >= obj.abs_y - origin.y && D <= obj.strokeWidth) {
								return true;
							} else if (pointer.y < obj.abs_y - origin.y && pointer.x < obj.abs_x - origin.x && pA <= (angleRange - 180)) {
								return true;
							} else {
								return false;
							}
						
						} else if (angleRange === 180) {
							
							// Inside if pointer is below the origin
							if (pointer.y >= obj.abs_y - origin.y && D <= obj.strokeWidth) {
								return true;
							} else {
								return false;
							}
							
						} else if (angleRange < 180) {
							
							// Rotate the pointer position so that the angle is aligned in the bottom like a U
							extraAngle = (90 - angleRange / 2 - (obj.direction === "clockwise" ? obj.start : obj.end));
							pointer = this.transformPointerPosition(obj, obj.abs_x - origin.x, obj.abs_y - origin.y, extraAngle, pointerObject);
							
							var d, pX, pY, pD, pA;
							
							// Fix the radius for this type of arc
							radius *= 2;
							
							// Calculate the distance from the origin to the y value of the end points
							d = Math.cos(angleRange / 2 * Math.PI / 180) * radius;
							
							// Calculate the distance between the pointer and origin, to find the angle
							pX = Math.abs(obj.abs_x - origin.x - pointer.x)
							pY = Math.abs(obj.abs_y - origin.y - pointer.y);
							pD = Math.sqrt(pX * pX + pY * pY);
							pA = Math.asin(pX / pD) * 180 / Math.PI;
							
							if (pointer.y >= obj.abs_y - origin.y + d) {
								return true;
							} else if (pointer.y >= obj.abs_y - origin.y && pA <= angleRange / 2) {
								return true;
							} else {
								return false;
							}
						}
					}
					
					// If it's a normal arc
					else {
						
						if (angleRange > 180) {
							a = (360 - angleRange) / 2;
							y_ = Math.cos(a * Math.PI / 180) * radius;
							
							eP.x = obj.abs_x - origin.x + Math.cos(a * Math.PI / 180) * y_;
							eP.y = obj.abs_y - origin.y - Math.sin(a * Math.PI / 180) * y_;
							
							
							z = 180 - 2 * a;
							
							p1.x = obj.abs_x - origin.x - Math.cos(z * Math.PI / 180) * radius;
							p1.y = obj.abs_y - origin.y - Math.sin(z * Math.PI / 180) * radius;
							
							var aRight = 90 - (90 - z) - (90 - a);
							
							if (pointer.y < eP.y && pointer.x < eP.x) {
								angle = a - Math.acos(Math.abs(pointer.y - eP.y) / Math.sqrt(Math.pow(pointer.x - eP.x, 2) + Math.pow(pointer.y - eP.y, 2))) * 180 / Math.PI;
							} else 
							if (pointer.y > eP.y && pointer.x >= eP.x) {
								angle = aRight - Math.acos(Math.abs(pointer.x - eP.x) / Math.sqrt(Math.pow(pointer.x - eP.x, 2) + Math.pow(pointer.y - eP.y, 2))) * 180 / Math.PI;
							} else
							if (pointer.y < obj.abs_y - origin.y && pointer.x >= eP.x) {
								return false;
							} else {
								angle = -1000000;
							}
							
							
							if (angle <= 0 && pointer.x >= p1.x && pointer.y > eP.y && pointer.y < obj.abs_y - origin.y) {
								return true;
							} else if (angle <= 0 && pointer.y <= obj.abs_y - origin.y && D <= radius) {
								return true;
							} else if (((obj.strokeWidth === 0 && D <= radius) || (obj.strokeWidth > 0 && D <= radius + obj.strokeWidth / 2)) && ((pointer.x <= p1.x && pointer.y <= obj.abs_y - origin.y) || (pointer.y >= obj.abs_y - origin.y)) ) {
								return true;
							} else {
								return false;
							}
						} else if (angleRange === 180) {
						
							// Inside if pointer is below the origin
							if (pointer.y >= obj.abs_y - origin.y && ((obj.strokeWidth === 0 && D <= radius) || (obj.strokeWidth > 0 && D <= radius + obj.strokeWidth / 2))) {
								return true;
							} else {
								return false;
							}
						} else if (angleRange < 180) {
						
							// Rotate the pointer position so that the angle is aligned in the bottom like a U
							extraAngle = (90 - angleRange / 2 - (obj.direction === "clockwise" ? obj.start : obj.end));
							pointer = this.transformPointerPosition(obj, obj.abs_x - origin.x, obj.abs_y - origin.y, extraAngle, pointerObject);
							
							var r, d;
							
							// Make it a bit more accurate when there is only a stroke
							r = (obj.fill === "") ? radius - obj.strokeWidth / 2 : radius;
							
							// Calculate the distance from the origin to the y value of the end points
							d = Math.cos(angleRange / 2 * Math.PI / 180) * r;
							
							// If there is only a stroke
							if (obj.fill === "" && obj.strokeWidth > 0) {
							
								// It has to be lower than the end points, and between the edges of the stroke
								if (pointer.y >= obj.abs_y - origin.y + d && D >= radius - obj.strokeWidth / 2 && D <= radius + obj.strokeWidth / 2) {
									return true;
								} else {
									return false;
								}
							}
							
							// If there is a fill and the y position of the pointer is below the end points
							else if (pointer.y >= obj.abs_y - origin.y + d) {
							
								// If there is also a stroke
								if (obj.strokeWidth > 0) {
									
									// If the distance from origin to pointer is less than to the outer edge of the stroke
									if (D <= radius + obj.strokeWidth / 2) {
										return true;
									} else {
										return false;
									}
								}
								
								// If no stroke, it is inside
								else {
									return true;
								}
							}
							
							// If the y position of the pointer is above the end points
							else {
								return false;
							}
						}
					}
				} else
				
				// Generic radial object
				if (obj.shapeType === "radial") {
					var radius = obj.radius ? obj.radius : 0;
					
					if (radius > 0) {
						var pointer = this.transformPointerPosition(obj, obj.abs_x, obj.abs_y, 0, pointerObject),
							origin = obj.getOrigin(),
							D = Math.sqrt(Math.pow(pointer.x - obj.abs_x + origin.x, 2) + Math.pow(pointer.y - obj.abs_y + origin.y, 2));
							
						return (D < radius);
					}
				}
			}
		};
	};

	// Register the module
	oCanvas.registerModule("tools", tools);




	// Define the class
	var events = function () {
		
		// Return an object when instantiated
		return {
			
			types: {},
			pointers: {},
			
			init: function () {
			
				// Add properties that the this module needs to be able to add events directly to the canvas
				this.core.canvasElement.events = {};
				this.core.canvasElement.drawn = true;
				this.core.canvasElement.isPointerInside = function () { return true; };
			},

			// Method for binding an event to a specific object
			bind: function (obj, types, handler) {
				var core = this.core,
					length, wrapper, index,
					types = types.split(" "),
					t, type,
					p;
				
				for (t = 0; t < types.length; t++) {
				
					type = types[t];
					
					// Handle keyboard events
					if (this.types.keyboard && ~this.types.keyboard.indexOf(type)) {
						
						// Add the event
						index = this.core.keyboard.addEvent(type, handler);
						
						// Initialize the events object for specific event type
						if (obj.events[type] === undefined) {
							obj.events[type] = {};
						}
						
						// Add the handler to the object
						obj.events[type][index] = handler;
					}
					
					// Handle pointer events
					else {
						
						for (p in this.pointers) {
							this.pointers[p](type, (function(type) {
								return function (pointer, clickName) {
									
									// Initialize the events object for specific event type
									if (obj.events[type] === undefined) {
										obj.events[type] = {};
									}
									
									// Create event wrapper
									wrapper = function (e, forceLeave) {
									
										// Cancel event if object is not drawn to canvas
										if (!obj.drawn) {
											return;
										}
									
										// If pointer is inside the object and we are not forced to trigger mouseleave
										if (obj.isPointerInside() && !forceLeave) {
										
											// Only trigger mouse events that are supposed to be triggered inside the object
											if (type !== pointer + "leave") {
											
												// Only trigger mouseenter the first time event is triggered after pointer enters the object
												if (type === pointer + "enter" && obj.events[pointer + "ontarget"]) {
													return;
												}
												
												// Don't trigger click events if the pointer was pressed down outside the object
												if (type === clickName && (core.pointer.start_pos.x < 0 || core.pointer.start_pos.y < 0 || !obj.isPointerInside(core.pointer.start_pos))) {
													return;
												}
												
												// Set status and trigger callback
												if (type !== "touchend") {
													obj.events[pointer + "ontarget"] = true;
												}
												handler.call((obj.nodeName !== undefined ? core : obj), e);
											}
										}
										
										// If pointer is not inside the object right now, but just was
										else if (type === pointer + "leave" && obj.events[pointer + "ontarget"]) {
										
											// Reset status and trigger callback for mouseleave
											obj.events[pointer + "ontarget"] = false;
											handler.call(obj, e);
										}
									};
									
									// Add the handler to the event list in the mouse module
									index = core[pointer].addEvent(type, wrapper);
									obj.events[type][index] = handler;
								};
							})(type));
						}
					}
				}
			},
			
			// Method for removing an event handler from an object
			unbind: function (obj, types, handler) {
				var t, type, x, pointer, i, index;
				
				types = types.split(" ");
				
				for (t = 0; t < types.length; t++) {
				
					type = types[t];
					
					// Ignore event type if the object doesn't have any events of that type
					if (obj.events[type] === undefined) {
						continue;
					}
					
					// Find pointer type
					for (x in this.types) {
						if (~this.types[x].indexOf(type)) {
							pointer = x;
							break;
						}
					}
					
					// Find the index for the specified handler
					for (i in obj.events[type]) {
						if (obj.events[type][i] === handler) {
							index = i;
						}
					}
					
					// If index was found, remove the handler
					if (index !== undefined) {
						delete obj.events[type][index];
						this.core[pointer].removeEvent(type, index);
					}
				}
			},
			
			
			// Method for triggering events that has been added to an object
			trigger: function (obj, types) {
				var t, type, event, events;
				
				types = types.split(" ");
				
				// Loop through the specified event types
				for (t = 0; t < types.length; t++) {
					type = types[t];
					events = obj.events[type];
					
					// If the event type exists on the object
					if (events !== undefined) {
						
						// Trigger all events of this type on this object
						for (event in events) {
							if (~this.types.keyboard.indexOf(type)) {
								events[event].call(obj, this.core.keyboard.last_event);
							} else {
								events[event].call(obj, this.core.pointer.last_event);
							}
						}
					}
					
					// If the event type is a cancel event
					else if (~type.indexOf("cancel")) {
						this.core[type.replace("cancel","")].cancel();
					}
				}
			},
			
			// Method for modifying the event object and fixing a few issues
			modifyEventObject: function (event, type) {
				var properties = "altKey ctrlKey metaKey shiftKey button charCode keyCode clientX clientY layerX layerY pageX pageY screenX screenY detail eventPhase isChar touches targetTouches changedTouches scale rotation".split(" "),
					numProps = properties.length,
					eventObject, i, property;
				
				// Fix specific properties and methods
				eventObject = {
					originalEvent: event,
					type: type,
					timeStamp: (new Date()).getTime(),
					which: event.which === 0 ? event.keyCode : event.which,
					
					preventDefault: function () {
						event.preventDefault();
					},
					
					stopPropagation: function () {
						event.stopPropagation();
					}
				};
				
				// Set selected original properties
				for (i = 0; i < numProps; i++) {
					property = properties[i];
					if (event[property] !== undefined) {
						eventObject[property] = event[property];
					}
				}
				
				// Fix original methods
				eventObject.preventDefault
				
				return eventObject;
			}
		};
	};

	// Register the module
	oCanvas.registerModule("events", events, "init");




	// Define the class
	var draw = function () {
		
		// Return an object when instantiated
		return {

			// Set properties
			objects: {},
			drawn: {},
			lastObjectID: 0,
			translation: { x: 0, y: 0 },
			
			// Method for adding a new object to the object list that will be drawn
			add: function (obj) {
				var id = ++this.lastObjectID;
				this.objects[id] = obj;
				this.drawn[id] = false;
				
				return id;
			},
			
			// Method for removing an object from the object list
			remove: function (id) {
				if (this.objects[id] === undefined) {
					return;
				}
				this.objects[id].drawn = false;
				delete this.objects[id];
				delete this.drawn[id];
				this.redraw();
			},
			
			// Method for clearing the canvas from everything that has been drawn (bg can be kept)
			clear: function (keepBackground) {
				var objects = this.objects, i;
				
				if (keepBackground === undefined || keepBackground === true) {
					// The background is just redrawn over the entire canvas to remove all image data
					this.core.background.redraw();
				} else {
					// Clear all the image data on the canvas
					this.core.canvas.clearRect(0, 0, this.core.width, this.core.height);
				}
				
				// Set the drawn status of all objects
				for (i in objects) {
					objects[i].drawn = false;
				}
				
				return this;
			},
			
			// Method for drawing all objects in the object list
			redraw: function (forceClear) {
				forceClear = forceClear || false;
				var canvas = this.core.canvas,
					objects = this.objects,
					i, obj, object, x, y, objectChain, lastX, lastY, n, l, parent, shadow;
				
				// Clear the canvas (keep the background)
				if (this.core.settings.clearEachFrame || forceClear) {
					this.clear();
				}
				
				// Loop through all objects
				for (i in objects) {
					obj = objects[i];
					if (obj !== undefined) {
						if (typeof obj.draw === "function") {
						
							// Update the object's properties if an update method is available
							if (typeof obj.update === "function") {
								obj.update();
							}
							
							// Temporarily move the canvas origin and take children's positions into account, so they will rotate around the parent
							canvas.save();
							
							// Create an array of all the parents to this object
							objectChain = [];
							objectChain.push(obj);
							parent = obj.parent;
							while (parent) {
								objectChain.push(parent);
								parent = parent.parent;
							}
							// Reverse the array so the top level parent comes first, and ends with the current object
							objectChain.reverse();
							
							// Loop through all objects in the parent chain
							lastX = 0; lastY = 0;
							for (n = 0, l = objectChain.length; n < l; n++) {
								object = objectChain[n];
							
								// Translate the canvas matrix to the position of the object
								canvas.translate(object.abs_x - lastX, object.abs_y - lastY);
								
								// If the object has a rotation, rotate the canvas matrix
								if (object.rotation !== 0) {
									canvas.rotate(object.rotation * Math.PI / 180);
								}
								
								// Save the current translation so that the next iteration can subtract that
								lastX = object.abs_x;
								lastY = object.abs_y;
							}
							
							// Save the translation so that display objects can access this if they need
							this.translation = { x: lastX, y: lastY };
							
							// Automatically adjust the abs_x/abs_y for the object
							// (objects not using these variables in the drawing process use the object created above)
							x = obj.abs_x;
							y = obj.abs_y;
							obj._.abs_x = 0;
							obj._.abs_y = 0;
							
							// Temporarily scale the canvas for this object
							if (obj.scalingX !== 1 || obj.scalingY !== 1) {
								canvas.scale(obj.scalingX, obj.scalingY);
							}
							
							// Set the alpha to match the object's opacity
							canvas.globalAlpha = !isNaN(parseFloat(obj.opacity)) ? parseFloat(obj.opacity) : 1;
							
							// Set the composition mode
							canvas.globalCompositeOperation = obj.composition;
							
							// Set shadow properties if object has shadow
							shadow = obj.shadow;
							if (shadow.blur > 0) {
								canvas.shadowOffsetX = shadow.offsetX;
								canvas.shadowOffsetY = shadow.offsetY;
								canvas.shadowBlur = shadow.blur;
								canvas.shadowColor = shadow.color;
							}
							
							// Set stroke properties
							canvas.lineCap = obj.cap;
							canvas.lineJoin = obj.join;
							canvas.miterLimit = obj.miterLimit;
							
							// Draw the object
							obj.draw();
							this.drawn[i] = true;
							obj.drawn = true;
							
							// Reset the abs_x/abs_y values
							obj._.abs_x = x;
							obj._.abs_y = y;
							
							// Reset stroke properties
							canvas.lineCap = "butt";
							canvas.lineJoin = "miter";
							canvas.miterLimit = 10;
							
							// Restore the old transformation
							canvas.restore();
							this.translation = { x: 0, y: 0 };
						}
					}
				}
				
				return this;
			}
		};
	};

	// Register the module
	oCanvas.registerModule("draw", draw);




	// Define the class
	var background = function () {
		
		// Return an object when instantiated
		return {

			// Set properties
			bg: "",
			value: "",
			type: "transparent",
			loaded: false,
			
			init: function () {
				this.set(this.core.settings.background);
			},
			
			// Method for setting the background
			set: function (value) {
				var _this = this;
				if (typeof value !== "string") {
					value = "";
				}
				
				this.value = value;
				
				// Get background type (gradient, image, color or transparent)
				if (~value.indexOf("gradient")) {
					this.type = "gradient";
				} else if (~value.indexOf("image")) {
					this.type = "image";
				} else if (this.core.style && this.core.style.isColor(value)) {
					this.type = "color";
				} else {
					this.type = "transparent";
				}
				
				// Handle the different background types
				if (this.type === "color") {
				
					// Set color as background
					this.bg = value;
					if (this.core.timeline && !this.core.timeline.running) {
						this.core.draw.redraw(true);
					}
					this.loaded = true;
				}
				else if (this.type === "gradient") {
				
					// Get gradient object and set it as background
					this.bg = this.core.style ? this.core.style.getGradient(value, 0, 0, this.core.width, this.core.height) : "";
					if (this.core.timeline && !this.core.timeline.running) {
						this.core.draw.redraw(true);
					}
					this.loaded = true;
				}
				else if (this.type === "image") {
				
					// Parse image string
					var matches = /image\((.*?)(,(\s|)(repeat|repeat-x|repeat-y|no-repeat)|)\)/.exec(value),
						path = matches[1],
						repeat = matches[4] || "repeat",
						image = new Image();
				
					// Set image as background
					image.src = path;
					image.onload = function () {
						_this.bg = _this.core.canvas.createPattern(this, repeat);
						_this.loaded = true;
						if (_this.core.timeline && !_this.core.timeline.running) {
							_this.core.redraw(true);
						}
					};
				}
				
				else {
					// Background type is transparent, redraw the background (clears the canvas)
					this.redraw(true);
					this.loaded = true;
				}
				
				return this;
			},
			
			// Method for redrawing the background (replaces everything thas has been drawn)
			redraw: function (trigger) {
				var core = this.core;
				
				// Fill canvas with the background color if it's not transparent
				if (this.type !== "transparent") {
					core.canvas.fillStyle = this.bg;
					core.canvas.fillRect(0, 0, core.width, core.height);
				}
				
				// Only clear the canvas if no background is specified
				else {
					core.canvas.clearRect(0, 0, core.width, core.height);
				}
			}
		};
	};

	// Register the module
	oCanvas.registerModule("background", background, "init");




	// Define the class
	var scenes = function () {
		
		// Return an object when instantiated
		return {
			
			// Set properties
			current: "none",
			scenes: {},

			// Method for creating a new scene
			create: function (name, init) {
				this.scenes[name] = Object.create(this.scenesBase());
				this.scenes[name].name = name;
				
				init.call(this.scenes[name]);
				
				return this.scenes[name];
			},
			
			// Object base that will be instantiated for each new scene
			scenesBase: function () {
			
				return {
					name: "",
				
					// Container for all objects that are added to the scene
					objects: [],
					
					loaded: false,
					
					// Method for adding objects to the scene
					add: function (obj) {
						this.objects.push(obj);
						
						// Add the object to canvas if the scene is loaded
						if (this.loaded) {
							obj.add();
						}
						
						return this;
					},
					
					// Method for removing an object from the scene
					remove: function (obj) {
						var index = this.objects.indexOf(obj);
						if (~index) {
							this.objects.splice(index, 1);
								
							// Remove the object from canvas if the scene is loaded
							if (this.loaded) {
								obj.remove();
							}
						}
						
						return this;
					},
					
					// Method for loading the scene's objects
					load: function () {
						if (this.loaded) {
							return;
						}
						
						var objects = this.objects,
							i, l = objects.length;
							
						// Loop through all added objects
						for (i = 0; i < l; i++) {
							if (objects[i] !== undefined) {
								objects[i].add();
							}
						}
						
						this.loaded = true;
						
						return this;
					},
					
					// Method for unloading the scene (removes all added objects from the canvas)
					unload: function () {
						var objects = this.objects,
							i, l = objects.length;
							
						// Loop through all added objects
						for (i = 0; i < l; i++) {
							if (objects[i] !== undefined) {
								// Remove the object from canvas
								objects[i].remove();
							}
						}
						
						this.loaded = false;
						
						return this;
					}
				};
			},
			
			// Method for loading a specific scene
			load: function (name, unload) {
				// Unload last scene if not done already
				if (unload === true && this.current !== "none") {
					this.unload(this.current);
				}
				this.current = name;
				this.scenes[name].load();
				
				return this;
			},
			
			// Method for unloading a specific scene
			unload: function (name) {
				this.current = "none";
				this.scenes[name].unload();
				
				return this;
			}
		};
	};

	// Register the module
	oCanvas.registerModule("scenes", scenes);




	// Define the class
	var style = function () {
		
		// Return an object when instantiated
		return {

			// Method for converting a stroke to either an object or a string
			// Fixes errors if found
			getStroke: function (value, return_type) {
				return_type = (return_type === "string") ? "string" : "object";
			
				// Convert object to string with default values if unspecified
				if (typeof value === "object" && return_type === "string") {
					var val = value;
					value = (typeof val.pos === "string") ? val.pos : "center";
					value += " " + (typeof val.width === "number" ? val.width+"px" : "1px");
					value += " " + (typeof val.color === "string" ? val.color : "#000000");
				}
			
				// Get stroke settings
				var stroke = value.split(" "),
					strokePositions = ["outside", "center", "inside"],
					fixed_color = '', i, num_splits = stroke.length,
					strokePos, width, color, only_color;
				
				// If there are more than 2 splits
				if (num_splits >= 3) {
					
					// If first split is not a valid stroke position
					if (!~strokePositions.indexOf(stroke[0])) {
					
						// Boolean that says if only a color is specified
						only_color = isNaN(parseInt(stroke[0]));
						
						// Loop through all the splits and concatenate the split color values
						for (i = (only_color ? 0 : 1); i < num_splits; i++) {
							fixed_color += stroke[i];
						}
						
						// Set the fixed stroke array
						if (only_color) {
							stroke = [1, fixed_color];
						} else {
							stroke = [stroke[0], fixed_color];
						}
						
						// Set number of splits so the if case further down is entered
						num_splits = 2;
						
					} else {
					
						// Fix color value
						if (num_splits > 3) {
							for (i = 2; i < num_splits; i++) {
								fixed_color += stroke[i];
							}
							stroke = [stroke[0], stroke[1], fixed_color];
						}
						
						// Set the stroke object with correct values
						stroke = {
							pos: stroke[0],
							width: parseInt(stroke[1]),
							color: stroke[2]
						};
					}
				}
				
				// If there are only two splits ( [width, color] )
				if (num_splits === 2) {
					
					// Set the stroke object
					stroke = {
						pos: "center",
						width: parseInt(stroke[0]),
						color: stroke[1]
					};
				}
				
				// If stroke is still an array (empty stroke value was passed in)
				if (stroke.length) {
					stroke = {
						width: 0
					};
				}
				
				if (return_type === "string") {
					return stroke.pos + " " + stroke.width + "px " + stroke.color;
				}
				else if (return_type === "object") {
					return stroke;
				}
			},
			
			// Method for converting a gradient string to a gradient object
			getGradient: function (value, x, y, width, height) {

				if (~value.indexOf("linear")) {
					return this.getLinearGradient(value, x, y, width, height);
					
				} else if (~value.indexOf("radial")) {
					return this.getRadialGradient(value, x, y, width, height);
					
				} else {
					return "transparent";
				}
			},
			
			// Method for converting a CSS style linear gradient to a CanvasGradient object
			getLinearGradient: function (value, x, y, width, height) {
				var gradient,
					args, pos_parts, pos = [], i, start, sX, sY, eX, eY,
					positions = ["top", "bottom", "left", "right"],
					matchedColor, colorIndex, parenColors = [], colorStops, s;
			
				// Get arguments of the linear-gradient function, while preserving color values like hsla() and such
				args = /\((.*)\)/.exec(value)[1];
				while (matchedColor = /((hsl|hsla|rgb|rgba)\(.*?\))/.exec(args)) {
					colorIndex = parenColors.push(matchedColor[1]) - 1;
					args = args.substring(0, matchedColor.index) + "###" + colorIndex + "###" + args.substring(matchedColor.index + matchedColor[1].length, args.length);
				}
				args = args.split(",");
				
				// Get position keywords
				pos_parts = args[0].split(" ");
				
				// If the first keyword is a position, add it
				if (~positions.indexOf(pos_parts[0]) || ~pos_parts[0].indexOf("deg")) {
					pos.push(pos_parts[0]);
				}
				// If the second keyword is a position, add it
				if (pos_parts.length > 1 && ~positions.indexOf(pos_parts[1])) {
					pos.push(pos_parts[1]);
				}
				// Add default value if none is specified
				if (pos.length === 0) {
					pos.push("top");
				} else {
					start = 1;
				}
				
				// Get coordinates for start and ending points, based on the above position
				// Get horizontal, vertical or degree specified coordinates
				if (pos.length === 1) {
					if (pos[0] === "top") {
						sX = x + width / 2;
						sY = y;
						eX = x + width / 2;
						eY = y + height;
					} else if (pos[0] === "right") {
						sX = x + width;
						sY = y + height / 2;
						eX = x;
						eY = y + height / 2;
					} else if (pos[0] === "bottom") {
						sX = x + width / 2;
						sY = y + height;
						eX = x + width / 2;
						eY = y;
					} else if (pos[0] === "left") {
						sX = x;
						sY = y + height / 2;
						eX = x + width;
						eY = y + height / 2;
					} else if (~pos[0].indexOf("deg")) {
						var alpha, a, beta, cornerDistance, endDistance, cornerX, cornerY, cY,
							pi = Math.PI,
							centerX = x + width / 2,
							centerY = y + height / 2;
						
						// Convert the angle to the range 0 - 359 degrees and then convert it to radians
						alpha = (parseFloat(pos) % 360) * pi / 180;
						a = alpha;
						
						// Upper right corner
						if (alpha >= 0 && alpha < pi / 2) {
							cornerX = x + width;
							cornerY = y;
						}
						
						// Upper left corner
						else if (alpha >= pi / 2 && alpha < pi) {
							cY = centerY;
							centerY = centerX;
							cornerY = x;
							cornerX = cY;
							centerX = y;
						}
						
						// Bottom left corner
						else if (alpha >= pi && alpha < pi * 1.5) {
							cY = centerY;
							cornerX = centerX;
							centerX = x;
							centerY = y + height;
							cornerY = cY;
						}
						
						// Bottom right corner
						else if (alpha >= pi * 1.5 && alpha < pi * 2) {
							cY = centerY;
							centerY = x + width;
							cornerY = centerX;
							cornerX = y + height;
							centerX = cY;
						}
						
						
						// Convert the angle to the range 0 - 89
						alpha = alpha % (pi / 2);
						
						// Get angle between baseline and the line between the corner and the center
						beta = Math.atan(Math.abs(centerY - cornerY) / Math.abs(cornerX - centerX));
						
						// Get the distance between the corner and the center
						cornerDistance = Math.sqrt(Math.pow(centerY - cornerY, 2) + Math.pow(centerX - cornerX, 2));
						
						// Get the distance between the end point and the center
						endDistance = cornerDistance * Math.cos(beta - (alpha));
						
						// Get end point and start point
						// Upper right corner
						if (a >= 0 && a < pi / 2) {
							eX = centerX + endDistance * Math.cos(alpha);
							eY = centerY - endDistance * Math.sin(alpha);
							sX = centerX * 2 - eX;
							sY = centerY * 2 - eY;
						}
						
						// Upper left corner
						else if (a >= pi / 2 && a < pi) {
							eX = centerY - endDistance * Math.cos(pi / 2 - alpha);
							eY = cornerX - endDistance * Math.sin(pi / 2 - alpha);
							sX = centerY * 2 - eX;
							sY = cornerX * 2 - eY;
						}
						
						// Bottom left corner
						else if (a >= pi && a < pi * 1.5) {
							eX = cornerX + endDistance * Math.cos(pi - alpha);
							eY = cornerY + endDistance * Math.sin(pi - alpha);
							sX = cornerX * 2 - eX;
							sY = cornerY * 2 - eY;
						}
						
						// Bottom right corner
						else if (a >= pi * 1.5 && a < pi * 2) {
							eX = cornerY - endDistance * Math.cos(pi * 1.5 - alpha);
							eY = centerX - endDistance * Math.sin(pi * 1.5 - alpha);
							sX = cornerY * 2 - eX;
							sY = centerX * 2 - eY;
						}
					}
					
				// Get diagonal coordinates
				} else {
					if (~pos.indexOf("top") && ~pos.indexOf("left")) {
						sX = x;
						sY = y;
						eX = x + width;
						eY = y + height;
					} else if (~pos.indexOf("top") && ~pos.indexOf("right")) {
						sX = x + width;
						sY = y;
						eX = x;
						eY = y + height;
					} else if (~pos.indexOf("bottom") && ~pos.indexOf("left")) {
						sX = x;
						sY = y + height;
						eX = x + width;
						eY = y;
					} else if (~pos.indexOf("bottom") && ~pos.indexOf("right")) {
						sX = x + width;
						sY = y + height;
						eX = x;
						eY = y;
					}
				}
				
				// Create the gradient object
				gradient = this.core.canvas.createLinearGradient(sX, sY, eX, eY);
				
				// Get the color stops
				colorStops = this.getColorStops(gradient, args.slice(start), parenColors);
				
				// Add the color stops to the gradient object
				for (s = 0; s < colorStops.length; s++) {
					gradient.addColorStop(colorStops[s].pos / 100, colorStops[s].color);
				}
				
				// Return the gradient object
				return gradient;
			},
			
			// Method for converting a CSS style radial gradient to a CanvasGradient object
			getRadialGradient: function (value, x, y, width, height) {
				var gradient,
					bg_position_keywords_x = ["left", "center", "right"],
					bg_position_keywords_y = ["top", "center", "bottom"],
					bg_position_sizes_x = { "left": x, "center": (x + width / 2), "right": (x + width) },
					bg_position_sizes_y = { "top": y, "center": (y + height / 2), "bottom": (y + height) },
					sizes = ["closest-side", "closest-corner", "farthest-side", "farthest-corner", "contain", "cover"],
					args, i, l, matchedColor, colorIndex, parenColors = [], colorStops, s,
					pos_arg, num_pos_args = 0, circles = [{x:undefined,y:undefined,r:0}, {x:undefined,y:undefined,r:undefined}], p, p_key,
					size_arg, size, size_set = false;
				
				// Get arguments of the radial-gradient function, while preserving color values like hsla() and such
				args = /\((.*)\)/.exec(value)[1];
				while (matchedColor = /((hsl|hsla|rgb|rgba)\(.*?\))/.exec(args)) {
					colorIndex = parenColors.push(matchedColor[1]) - 1;
					args = args.substring(0, matchedColor.index) + "###" + colorIndex + "###" + args.substring(matchedColor.index + matchedColor[1].length, args.length);
				}
				args = args.split(/\s*,\s*/);
				l = args.length;
				
				// Get position for start and end circles
				for (i = 0; i < 2; i++) {
					
					// If the argument has two values
					if (~args[i].indexOf(" ")) {
						pos_arg = args[i].split(" ");
						
						// Get the different keywords
						// Center
						if (pos_arg[0] === "center") {
							circles[i].x = pos_arg[0];
							circles[i].y = pos_arg[1];
							num_pos_args = i + 1;
						}
						
						// Interpret X position for first value of the argument
						else if (~bg_position_keywords_x.indexOf(pos_arg[0])) {
							circles[i].x = pos_arg[0];
							num_pos_args = i + 1;
							
							// Interpret Y position for second value of the argument
							if (~bg_position_keywords_y.indexOf(pos_arg[1])) {
								circles[i].y = pos_arg[1];
							}
						}
						
						// Interpret Y position for first value of the argument
						else if (~bg_position_keywords_y.indexOf(pos_arg[0])) {
							circles[i].y = pos_arg[0];
							num_pos_args = i + 1;
							
							// Interpret Y position for second value of the argument
							if (~bg_position_keywords_x.indexOf(pos_arg[1])) {
								circles[i].x = pos_arg[1];
							}
						}
						
						// Interpret X position for first value of the argument and the value is numeric
						else if (!isNaN(parseFloat(pos_arg[0]))) {
							circles[i].x = pos_arg[0];
							num_pos_args = i + 1;
							
							// Interpret Y position for second value of the argument (could be either keyword or numeric)
							if (~bg_position_keywords_y.indexOf(pos_arg[1]) || !isNaN(parseFloat(pos_arg[1]))) {
								circles[i].y = pos_arg[1];
							}
						}
						
						// Add the missing position values
						if (!circles[i].x) {
							circles[i].x = "center";
						}
						if (!circles[i].y) {
							circles[i].y = "center";
						}
					}
					
					// If only one value was passed in as the argument
					else {
						
						// Add position if it's a keyword for either an X or Y position
						if (~bg_position_keywords_x.indexOf(args[i])) {
							circles[i].x = args[i];
							num_pos_args = i + 1;
						} else if (~bg_position_keywords_y.indexOf(args[i])) {
							circles[i].y = args[i];
							num_pos_args = i + 1;
						}
						
						// If the position is not a valid keyword and this is the end circle,
						// add the same position as the first circle has
						else if (i === 1) {
							circles[i].x = circles[0].x;
						}
						
						// Add default position for the first value if nothing valid was passed in
						else {
							circles[i].x = "center";
						}
						
						
						// Since only one value was passed in, the second must be added here
						// If this is the second position (end circle), use the first circle's position
						if (i === 1) {
							circles[i].y = circles[0].y;
						}
						
						// Add default value if nothing value was passed in
						else {
							circles[i].y = "center";
						}
					}
				}
			
			
				// Get the size
				
				// Check for keywords
				if (~sizes.indexOf(args[num_pos_args])) {
					size = args[num_pos_args];
					size_set = true;
				}
				
				// Check for pixel or percentage value
				if (~args[num_pos_args].indexOf("px") || ~args[num_pos_args].indexOf("%")) {
					size = parseFloat(args[num_pos_args]);
					size_set = true;
					if (isNaN(size)) {
						size = 0;
					}
				}
				
				// Defaults if no correct values were passed in
				if (size === undefined) {
					size = "cover";
				}
				
				
				
				// Convert all positions to actual pixel sizes relative to the top left corner of the canvas
				for (i = 0; i < 2; i++) {
				
					// Get pixel sizes for keywords
					circles[i].abs_x = bg_position_sizes_x[circles[i].x];
					circles[i].abs_y = bg_position_sizes_y[circles[i].y];
					
					// Loop through both x and y
					for (p = 0; p < 2; p++) {
					
						p_key = "abs_" + (p === 0 ? "x" : "y");
					
						// If the value was not found, it is not a keyword â€“ it is probably a number
						if (circles[i][p_key] === undefined) {
						
							// Get the number
							circles[i][p_key] = parseFloat(circles[i][(p_key === "abs_x" ? "x" : "y")]);
							
							// If it was not a number, get the center value
							if (isNaN(circles[i][p_key])) {
								circles[i][p_key] = (p_key === "abs_x") ? bg_position_sizes_x.center - x : bg_position_sizes_y.center - y;
							}
							
							// If it was a percentage, convert it to an actual pixel size
							if (~circles[i][(p_key === "abs_x" ? "x" : "y")].indexOf("%")) {
								circles[i][p_key] = (circles[i][p_key] / 100) * (p_key === "abs_x" ? width : height);
							}
							
							// Add the x offset to make the position relative to the left corner of the canvas
							circles[i][p_key] += (p_key === "abs_x") ? x : y;
						}
					}
				}
				
				
				// Convert the size to actual pixels
				
				// Check for keywords
				if (~sizes.indexOf(size)) {
					if (size === "closest-side" || size === "contain") {
						size = Math.min(
							Math.abs(circles[1].abs_y - y),
							Math.abs(y + height - circles[1].abs_y),
							Math.abs(circles[1].abs_x - x),
							Math.abs(x + width - circles[1].abs_y)
						);
					} else if (size === "closest-corner") {
						size = Math.min(
							Math.sqrt(Math.pow((circles[1].abs_x - x), 2) + Math.pow((circles[1].abs_y - y), 2)),
							Math.sqrt(Math.pow((x + width - circles[1].abs_x), 2) + Math.pow((circles[1].abs_y - y), 2)),
							Math.sqrt(Math.pow((x + width - circles[1].abs_x), 2) + Math.pow((y + height - circles[1].abs_y), 2)),
							Math.sqrt(Math.pow((circles[1].abs_x - x), 2) + Math.pow((y + height - circles[1].abs_y), 2))
						);
					} else if (size === "farthest-corner" || size === "cover") {
						size = Math.max(
							Math.sqrt(Math.pow((circles[1].abs_x - x), 2) + Math.pow((circles[1].abs_y - y), 2)),
							Math.sqrt(Math.pow((x + width - circles[1].abs_x), 2) + Math.pow((circles[1].abs_y - y), 2)),
							Math.sqrt(Math.pow((x + width - circles[1].abs_x), 2) + Math.pow((y + height - circles[1].abs_y), 2)),
							Math.sqrt(Math.pow((circles[1].abs_x - x), 2) + Math.pow((y + height - circles[1].abs_y), 2))
						);
					} else if (size === "farthest-side") {
						size = Math.max(
							Math.abs(circles[1].abs_y - y),
							Math.abs(y + height - circles[1].abs_y),
							Math.abs(circles[1].abs_x - x),
							Math.abs(x + width - circles[1].abs_y)
						);
					} else {
						size = 0;
					}
				}
				
				// Check for a percentage
				if (~args[num_pos_args].indexOf("%")) {
					
					// Convert it to pixels relative to the specified dimension. Defaults to width
					if (~args[num_pos_args].indexOf(" ")) {
						size_arg = args[num_pos_args].split(" ")[1] === "height" ? height : width;
					} else {
						size_arg = width;
					}
					size = (size / 100) * size_arg;
				}
				
				// Set the radius for the end circle
				circles[1].r = size;
				
				// Create the gradient object
				gradient = this.core.canvas.createRadialGradient(circles[0].abs_x, circles[0].abs_y, circles[0].r, circles[1].abs_x, circles[1].abs_y, circles[1].r);
				
				// Get the color stops
				colorStops = this.getColorStops(gradient, args.slice(num_pos_args + (size_set ? 1 : 0)), parenColors);
				
				// Add the color stops to the gradient object
				for (s = 0; s < colorStops.length; s++) {
					gradient.addColorStop(colorStops[s].pos / 100, colorStops[s].color);
				}
				
				return gradient;
			},
			
			// Method for getting color stops
			getColorStops: function (gradient, stops, parenColors) {
			
				var i, l = stops.length,
					colorStop, stop_parts, color, color_pos, colorStops = [];
			
				// Loop through all color stops
				for (i = 0; i < l; i++) {
					colorStop = stops[i].trim();
					
					// If the last position was more than or equal to 100 %,
					// the following would not be visible anyway, so setting it is unnecessary
					if (color_pos >= 100) {
						break;
					}
					
					// Split the color stop value to separate the color from the position
					// Using space is OK, since hsla() values and such are stripped away up at the top
					// Positions outside the range 0 - 100 % are not supported at the moment
					if (~colorStop.indexOf(" ")) {
						stop_parts = colorStop.split(" ");
						color = stop_parts[0];
						color_pos = stop_parts[1];
						
						// Convert a pixel value to a percentage
						if (~color_pos.indexOf("px")) {
							color_pos = parseFloat(color_pos) / Math.sqrt(Math.pow(eX - sX, 2) + Math.pow(eY - sY, 2)) * 100;
						} else {
							color_pos = parseFloat(color_pos);
						}
					}
					
					// No position was specified, so one will be generated
					else {
						color = colorStop;
						
						// Set first position to 0 if not set before
						if (color_pos === undefined) {
							color_pos = 0;
						}
						
						// Set the next position if it's not the first one
						else {
							color_pos = color_pos + ((100 - color_pos) / (l - i));
						}
					}
					
					// Get the saved color value if the color contained parentheses when passed in to this method
					if (~color.indexOf("###")) {
						color = parenColors[/###(\d+)###/.exec(color)[1]];
					}
					
					// Add color data to an array with all color stops
					colorStops.push({
						pos: color_pos,
						color: color
					});
				}
				
				return colorStops;
			},
			
			// Method for converting a font to either a string or an object
			getFont: function (value, return_type) {
				return_type = (return_type === "string") ? "string" : "object";
				
				// Convert object to string with default values if unspecified
				if (typeof value === "object" && return_type === "string") {
					var val = value;
					value = (typeof val.style === "string" ? val.style : "normal");
					value += " " + (typeof val.variant === "string" ? val.variant : "normal");
					value += " " + (typeof val.weight === "string" ? val.weight : "normal");
					value += " " + (typeof val.size === "number" ? (~~(val.size * 10 + 0.5) / 10)+"px" : "16px");
					value += "/" + (typeof val.lineHeight === "number" ? (~~(val.lineHeight * 10 + 0.5) / 10) : 1.5);
					value += " " + (typeof val.family === "string" ? val.family : "sans-serif");
				}
				
				if (value.length > 0) {
				
					// Get font settings
					var font = value.split(" "),
						l = font.length,
						i, value, splits, n, family = "",
						styles = ["normal", "italic", "oblique"],
						variants = ["normal", "small-caps"],
						weights = ["normal", "bold", "bolder", "lighter", "100", "200", "300", "400", "500", "600", "700", "800", "900"],
						font_object = {};
					
					for (i = 0; i < l; i++) {
						value = font[i];
						
						// Font style
						if (~styles.indexOf(value) && !font_object.style) {
							font_object.style = value;
						} else
						// Font variant
						if (~variants.indexOf(value) && !font_object.variant) {
							font_object.variant = value;
						} else
						// Font weight
						if (~weights.indexOf(value) && !font_object.weight) {
							font_object.weight = value;
						} else
	
						if (~value.indexOf("/") && !font_object.size && !font_object.lineHeight) {
							splits = value.split("/");
							// Font size
							if (!isNaN(parseInt(splits[0]))) {
								font_object.size = parseInt(splits[0]);
							}
							// Line height
							if (!isNaN(parseFloat(splits[1]))) {
								font_object.lineHeight = parseFloat(splits[1]);
							}
						} else
						
						if (!font_object.size && /\d+[a-z]{2}(?!\/)/.test(value)) {
							// Font size
							if (!isNaN(parseInt(value))) {
								font_object.size = parseInt(value);
							}
						} else
						
						// Font family
						if (isNaN(parseInt(value)) && !font_object.family) {
							family = "";
							for (n = i; n < l; n++) {
								family += font[n] + (n === l-1 ? "" : " ")
							}
							font_object.family = family;
						}
					}
				}
				
				// Set default values if unspecified
				font = font_object || {};
				font.style = font.style ? font.style : "normal";
				font.variant = font.variant ? font.variant : "normal";
				font.weight = font.weight ? font.weight : "normal";
				font.size = font.size ? font.size : 16;
				font.lineHeight = font.lineHeight ? font.lineHeight : 1;
				font.family = font.family ? font.family : "sans-serif";
				
				if (return_type === "string") {
					return font.style + " " + font.variant + " " + font.weight + " " + font.size + "px/" + font.lineHeight + " " + font.family;
				}
				else if (return_type === "object") {
					return font;
				}
			},
			
			// Method for converting a shadow to either an object or a string
			getShadow: function (value, return_type) {
				var shadow = {}, values;
				
				// Correct errors if any when an object is passed in
				if (typeof value === "object") {
					shadow.offsetX = !isNaN(parseFloat(value.offsetX)) ? parseFloat(value.offsetX) : 0;
					shadow.offsetY = !isNaN(parseFloat(value.offsetY)) ? parseFloat(value.offsetY) : 0;
					shadow.blur = !isNaN(parseFloat(value.blur)) ? parseFloat(value.blur) : 0;
					shadow.color = this.isColor(value.color) ? value.color : "#000";
				}
				
				// Parse the values if a string was passed in
				else if (typeof value === "string") {
					
					var values = /^(.*?)\s(.*?)\s(.*?)\s(.*?)$/.exec(value);
					shadow.offsetX = !isNaN(parseFloat(values[1])) ? parseFloat(values[1]) : 0;
					shadow.offsetY = !isNaN(parseFloat(values[2])) ? parseFloat(values[2]) : 0;
					shadow.blur = !isNaN(parseFloat(values[3])) ? parseFloat(values[3]) : 0;
					shadow.color = this.isColor(values[4]) ? values[4] : "#000";
				}
				
				if (return_type === "string") {
					return shadow.offsetX + "px " + shadow.offsetY + "px " + shadow.blur + "px " + shadow.color;
				} else {
					return shadow;
				}
			},
			
			// Method for checking if a value is a color or not
			isColor: function (value) {
				if (typeof value === "string" && (value[0] === "#" || value.substr(0, 4) === "rgb(" || value.substr(0, 5) === "rgba(" || value.substr(0, 4) === "hsl(" || value.substr(0, 5) === "hsla(")) {
					return true;
				} else {
					return false;
				}
			}
		};
	};

	// Register the module
	oCanvas.registerModule("style", style);




	// Define the class
	var animation = function () {
		
		// Return an object when instantiated
		return {
			
			durations: {
				short: 200,
				normal:200,
				long: 200
			},

			defaults: {
				duration: "normal",
				easing: "ease-in-out"
			},
			
			queue: {
				activeAnimations: {},
				lastID: 0
			},
			
			easing: {
				
				"ease-in": function (time) {
					return this.cubicBezier(0.42, 0, 1, 1, time);
				},
				
				"ease-out": function (time) {
					return this.cubicBezier(0, 0, 0.58, 1, time);
				},
				
				"ease-in-out": function (time) {
					return this.cubicBezier(0.42, 0, 0.58, 1, time);
				},
				
				"linear": function (time) {
					return time;
				},
				
				cubicBezier: function (x1, y1, x2, y2, time) {
				
					// Inspired by Don Lancaster's two articles
					// http://www.tinaja.com/glib/cubemath.pdf
					// http://www.tinaja.com/text/bezmath.html
					
					
						// Set start and end point
					var x0 = 0,
						y0 = 0,
						x3 = 1,
						y3 = 1,
						
						// Convert the coordinates to equation space
						A = x3 - 3*x2 + 3*x1 - x0,
						B = 3*x2 - 6*x1 + 3*x0,
						C = 3*x1 - 3*x0,
						D = x0,
						E = y3 - 3*y2 + 3*y1 - y0,
						F = 3*y2 - 6*y1 + 3*y0,
						G = 3*y1 - 3*y0,
						H = y0,
						
						// Variables for the loop below
						t = time,
						iterations = 5,
						i, slope, x, y;
					
					// Loop through a few times to get a more accurate time value, according to the Newton-Raphson method
					// http://en.wikipedia.org/wiki/Newton's_method
					for (i = 0; i < iterations; i++) {
					
						// The curve's x equation for the current time value
						x = A* t*t*t + B*t*t + C*t + D;
						
						// The slope we want is the inverse of the derivate of x
						slope = 1 / (3*A*t*t + 2*B*t + C);
						
						// Get the next estimated time value, which will be more accurate than the one before
						t -= (x - time) * slope;
						t = t > 1 ? 1 : (t < 0 ? 0 : t);
					}
					
					// Find the y value through the curve's y equation, with the now more accurate time value
					y = Math.abs(E*t*t*t + F*t*t + G*t * H);
					
					return y;
				}
			},
			
			animate: function (obj, args, runFromQueue, id) {
				args = Array.prototype.slice.call(args);
				runFromQueue = runFromQueue || false;
				id = id || false;
				
				// Abort if the first argument is not an object
				if (args[0].constructor !== Object) {
					return false;
				}
				
				// Add new item to the queue if it doesn't exist for this object
				if (!this.queue[obj.id]) {
					this.queue[obj.id] = [];
				}
				
				var _this = this,
					properties = args[0],
					duration = this.defaults.duration,
					easing = this.easing[this.defaults.easing],
					callback = function () {},
					queue = this.queue,
					objQueue = queue[obj.id],
					property, runMore,
					startValues = {},
					currentTime = 0;
				
				// Add the animation to the queue if this call comes from a display object
				// If this block is run, execution will be aborted at the end of the block
				// and run animate() again with the first inactive animation in the queue
				if (runFromQueue !== true) {
					objQueue.push({
						id: ++queue.lastID,
						start: function () {
							_this.animate(obj, args, true, this.id);
						}
					});
					
					// Start the first animation in the queue if no animations are active on the object
					// If there is an active the next animation in the queue will be fired
					// when that animation is completed
					if (!queue.activeAnimations[obj.id]) {
						queue.activeAnimations[obj.id] = objQueue[0].id;
						objQueue[0].start();
						objQueue.splice(0, 1);
						return;
					}
					return;
				}
				
				
				
				// Helper functions to be used further down
				function parseDuration (arg) {
					if (this.durations[arg]) {
						return this.durations[arg];
					} else {
						return !isNaN(parseInt(arg)) ? parseInt(arg) : this.durations[duration];
					}
				}
				function parseEasing (arg, argNum) {
				
					// Allow the user to specify a custom easing function,
					// only if it's not the last argument (will interfere with the callback)
					if (typeof arg === "function" && argNum === args.length - 2) {
						return arg;
					}
					
					// Predefined easing method
					else if (this.easing[arg]) {
						return this.easing[arg];
					}
					
					// Custom cubic bezier curve
					else if (typeof arg === "string" && ~arg.indexOf("cubic-bezier")) {
						var x1, y1, x2, y2, match;
						
						// Get the values from the form:
						//   cubic-bezier(x1, y1, x2, y2)
						match = arg.match(/cubic-bezier\(\s*(.*?),\s*(.*?),\s*(.*?),\s*(.*?)\)/);
						x1 = !isNaN(parseFloat(match[1])) ? parseFloat(match[1]) : 0,
						y1 = !isNaN(parseFloat(match[2])) ? parseFloat(match[2]) : 0,
						x2 = !isNaN(parseFloat(match[3])) ? parseFloat(match[3]) : 1,
						y2 = !isNaN(parseFloat(match[4])) ? parseFloat(match[4]) : 1;
						
						return function (time) {
							return this.cubicBezier(x1, y1, x2, y2, time);
						};
					}
					
					// Return the default easing if nothing else matches
					else {
						return easing;
					}
				}
				function parseCallback (arg) {
					return (typeof arg === "function") ? arg : callback;
				}
				
				
				// Get arguments and correct different syntax alternatives
				duration = parseDuration.call(this, args[1]);
				easing = parseEasing.call(this, args[1], 1);
				easing = parseEasing.call(this, args[2], 2);
				callback = parseCallback.call(this, args[1]);
				callback = parseCallback.call(this, args[2]);
				callback = parseCallback.call(this, args[3]);
				
				// Get start values from the object
				for (property in properties) {
					startValues[property] = obj[property];
				}
				
				// Set the timer that will run the actual animation frames
				(function timer () {
					var property, endValue, startValue, change, newValue;
					
					// Set the new time value
					currentTime += 1000 / _this.core.settings.fps;
					
					// Loop through all properties and set them to the new calculated value
					for (property in properties) {
					
						// Get values needed to calculate the next step
						endValue = properties[property];
						startValue = startValues[property];
						
						// Calculate the next value using the set easing function
						// The easing function gets one argument, time, which is a percentage (0-1) of how long the animation has run
						// Back from the easing function comes a coefficient of how far to the end value the next value should be
						newValue = easing.call(_this.easing, currentTime / duration) * (endValue - startValue) + startValue;
						
						// Only animate if the property hasn't reached its end value
						if ((startValue < endValue && newValue <= endValue) || (startValue > endValue && newValue >= endValue)) {
						
							// Set the new value
							obj[property] = newValue;
						}
					}
					
					// Draw the frame if there is time left
					if (currentTime < duration && queue.activeAnimations[obj.id] === id) {
						_this.core.draw.redraw(true);
						
						setTimeout(timer, 1000 / _this.core.settings.fps);
					}
					
					// Abort the animation if the end time has been reached 
					else if (queue.activeAnimations[obj.id] === id) {
						
						// Set the values to the end values
						for (property in properties) {
							obj[property] = properties[property];
						}
						
						// Redraw the canvas
						_this.core.draw.redraw(true);
						
						// Set animation status
						queue.activeAnimations[obj.id] = false;
						
						// Trigger the callback
						callback.call(obj);
						
						// Trigger the next animation in the queue if there is any
						if (objQueue[0] !== undefined) {
							queue.activeAnimations[obj.id] = objQueue[0].id;
							objQueue[0].start();
							objQueue.splice(0, 1);
							return;
						}
					}
				})();
			},
			
			// Method that stops all running animations on an object
			stop: function(objectID) {
				
				// Only stop the queue if it exists
				if (this.queue[objectID] !== undefined) {
				
					// Stop the animation and remove the queue
					this.queue.activeAnimations[objectID] = false;
					delete this.queue[objectID];
					
					// Redraw the canvas with the latest updates
					this.core.draw.redraw(true);
				}
			}
			
		};
	};

	// Register the module
	oCanvas.registerModule("animation", animation);




	// Define the class
	var displayObject = function () {
	
		// Method for setting a stroke property. Updates both obj.stroke and obj.property
		var setStrokeProperty = function (_this, property, value, objectProperty, thecore) {
			var stroke = thecore.style.getStroke(_this.stroke);
			stroke[property] = value;
			_this.stroke = thecore.style.getStroke(stroke, "string");
		};
		
		// Return an object when instantiated
		return {

			// Properties
			id: 0,
			shapeType: "rectangular",
			type: "",
			origin: {
				x: 0,
				y: 0
			},
			drawn: false,
			events: {},
			children: [],
			opacity: 1,
			rotation: 0,
			composition: "source-over",
			scalingX: 1,
			scalingY: 1,
			
			_: {
				x: 0,
				y: 0,
				abs_x: 0,
				abs_y: 0,
				rotation: 0,
				width: 0,
				height: 0,
				stroke: "",
				strokeColor: "",
				strokeWidth: 0,
				strokePosition: "center",
				cap: "butt",
				join: "miter",
				miterLimit: 10,
				fill: "",
				shadow: {
					offsetX: 0,
					offsetY: 0,
					blur: 0,
					color: "transparent"
				}
			},
			
			set strokeColor (color) {
				setStrokeProperty(this, "color", color, "strokeColor", this.core);
			},
			set strokeWidth (width) {
				setStrokeProperty(this, "width", width, "strokeWidth", this.core);
			},
			set strokePosition (pos) {
				setStrokeProperty(this, "pos", pos, "strokePosition", this.core);
			},
			set stroke (value) {
			
				// Convert the value to a correct string if it is not a string
				if (typeof value !== "string") {
					value = this.core.style.getStroke(value, "string");
				}
				
				// Get stroke object and set styles
				var stroke = this.core.style.getStroke(value);
				
				// Handle patterns
				if (~stroke.color.indexOf("image(")) {
					var matches = /image\((.*?)(,(\s|)(repeat|repeat-x|repeat-y|no-repeat)|)\)/.exec(stroke.color),
						path = matches[1],
						repeat = matches[4] || "repeat",
						image = new Image(),
						_this = this;
						
					image.src = path;
					this._.strokepattern_loading = true;
					this._.strokepattern_redraw = false;
					
					image.onload = function () {
						_this._.strokeColor = _this.core.canvas.createPattern(this, repeat);
						_this._.strokepattern_loading = false;
						
						if (_this._.strokepattern_redraw) {
							_this._.strokepattern_redraw = false;
							_this.redraw();
						}
					};
				} else {
					this._.strokeColor = stroke.color;
				}
				
				// Set other stroke properties
				this._.strokeWidth = stroke.width;
				this._.strokePosition = stroke.pos;
				this._.stroke = value;
			},
			set cap (value) {
				var possible_values = ["butt", "round", "square"];
				this._.cap = ~possible_values.indexOf(value) ? value : "butt";
			},
			set join (value) {
				var possible_values = ["round", "bevel", "miter"];
				this._.join = ~possible_values.indexOf(value) ? value : "miter";
			},
			set miterLimit (value) {
				this._.miterLimit = !isNaN(parseFloat(value)) ? parseFloat(value) : 10;
			},
			get stroke () {
				return this._.stroke;
			},
			get strokeColor () {
				if (this._.strokepattern_loading) {
					this._.strokepattern_redraw = true;
					return "";
				} else if (~this._.strokeColor.toString().indexOf("CanvasPattern")) {
					return this._.strokeColor;
				} else if (~this._.strokeColor.indexOf("gradient")) {
					var origin = this.getOrigin();
					if (this.shapeType === "rectangular") {
						var stroke = (this.strokePosition === "outside") ? this.strokeWidth : (this.strokePosition === "center" ? this.strokeWidth / 2 : 0);
						return this.core.style.getGradient(this._.strokeColor, this.abs_x - origin.x - stroke, this.abs_y - origin.y - stroke, this.width + stroke * 2, this.height + stroke * 2);
					} else if (this.shapeType === "radial") {
						var radius = this.radius + this.strokeWidth / 2;
						return this.core.style.getGradient(this._.strokeColor, this.abs_x - origin.x - this.radius, this.abs_y - origin.y - this.radius, radius * 2, radius * 2);
					}
				} else {
					return this._.strokeColor;
				}
			},
			get strokeWidth () {
				return this._.strokeWidth;
			},
			get strokePosition () {
				return this._.strokePosition;
			},
			get cap () {
				return this._.cap;
			},
			get join () {
				return this._.join;
			},
			get miterLimit () {
				return this._.miterLimit;
			},
			
			set fill (value) {
				if (~value.indexOf("image(")) {
					var matches = /image\((.*?)(,(\s|)(repeat|repeat-x|repeat-y|no-repeat)|)\)/.exec(value),
						path = matches[1],
						repeat = matches[4] || "repeat",
						image = new Image(),
						_this = this;
						
					image.src = path;
					this._.pattern_loading = true;
					this._.pattern_redraw = false;
					
					image.onload = function () {
						_this._.fill = _this.core.canvas.createPattern(this, repeat);
						_this._.pattern_loading = false;
						
						if (_this._.pattern_redraw) {
							_this._.pattern_redraw = false;
							_this.redraw();
						}
					};
				} else {
					this._.fill = value;
				}
			},
			get fill () {
				if (this._.pattern_loading) {
					this._.pattern_redraw = true;
					return "";
				} else if (~this._.fill.toString().indexOf("CanvasPattern")) {
					return this._.fill;
				} else if (~this._.fill.indexOf("gradient")) {
					var origin = this.getOrigin();
					if (this.shapeType === "rectangular") {
						return this.core.style.getGradient(this._.fill, this.abs_x - origin.x, this.abs_y - origin.y, this.width, this.height);
					} else if (this.shapeType === "radial") {
						return this.core.style.getGradient(this._.fill, this.abs_x - origin.x - this.radius, this.abs_y - origin.y - this.radius, this.radius * 2, this.radius * 2);
					}
				} else {
					return this._.fill;
				}
			},
			set shadow (value) {
			
				// Convert the value to a correct string if it is not a string
				if (typeof value !== "string") {
					value = this.core.style.getShadow(value, "string");
				}
				
				// Get shadow object and set styles
				var shadow = this.core.style.getShadow(value);
				this._.shadow = shadow;
			},
			set shadowOffsetX (value) {
				if (!isNaN(parseFloat(value))) {
					this._.shadow.offsetX = parseFloat(value);
				}
			},
			set shadowOffsetY (value) {
				if (!isNaN(parseFloat(value))) {
					this._.shadow.offsetY = parseFloat(value);
				}
			},
			set shadowBlur (value) {
				if (!isNaN(parseFloat(value))) {
					this._.shadow.blur = parseFloat(value);
				}
			},
			set shadowColor (value) {
				if (this.core.style.isColor(value)) {
					this._.shadow.color = value;
				}
			},
			get shadow () {
				return this._.shadow;
			},
			get shadowOffsetX () {
				return this._.shadow.offsetX;
			},
			get shadowOffsetY () {
				return this._.shadow.offsetY;
			},
			get shadowBlur () {
				return this._.shadow.blur;
			},
			get shadowColor () {
				return this._.shadow.color;
			},
			
			set x (value) {
				this._.x = value;
				this._.abs_x = value + ((this.parent !== undefined) ? this.parent.abs_x : 0);
				
				// Update children
				var objects = this.children,
					l = objects.length, i;
				for (i = 0; i < l; i++) {
					objects[i]._.abs_x = this.abs_x + objects[i].x;
					objects[i].x += 0;
				}
			},
			set y (value) {
				this._.y = value;
				this._.abs_y = value + ((this.parent !== undefined) ? this.parent.abs_y : 0);
				
				// Update children
				var objects = this.children,
					l = objects.length, i;
				for (i = 0; i < l; i++) {
					objects[i]._.abs_y = this.abs_y - objects[i].y;
					objects[i].y += 0;
				}
			},
			get x () {
				return this._.x;
			},
			get y () {
				return this._.y;
			},
			set abs_x (value) {
				return;
			},
			set abs_y (value) {
				return;
			},
			get abs_x () {
				return this._.abs_x;
			},
			get abs_y () {
				return this._.abs_y;
			},
			set width (value) {
				var old = this._.width;
				this._.width = value;
				
				// Update children
				var objects = this.children,
					l = objects.length, i;
				for (i = 0; i < l; i++) {
					objects[i].width = objects[i].width - old + value;
				}
			},
			get width () {
				return this._.width;
			},
			set height (value) {
				var old = this._.height;
				this._.height = value;
				
				// Update children
				var objects = this.children,
					l = objects.length, i;
				for (i = 0; i < l; i++) {
					objects[i].height = objects[i].height - old + value;
				}
			},
			get height () {
				return this._.height;
			},
			
			// Method for binding an event to the object
			bind: function (type, handler) {
				this.core.events.bind(this, type, handler);
				
				return this;
			},
			
			// Method for unbinding an event from the object
			unbind: function (type, handler) {
				this.core.events.unbind(this, type, handler);
				
				return this;
			},
			
			// Method for triggering all events added to the object
			trigger: function (types) {
				this.core.events.trigger(this, types);
				
				return this;
			},
			
			// Method for adding the object to the canvas
			add: function () {
				if (this.drawn === false) {
				
					// Add this object
					this.id = this.core.draw.add(this);
					
					// Redraw the canvas with the new object
					this.core.redraw();
					this.drawn = true;
					
					// Add children that have been added to this object
					var objects = this.children,
						l = objects.length, i;
					for (i = 0; i < l; i++) {
						objects[i].add();
					}
				}
				
				return this;
			},
			
			// Method for removing the object from the canvas
			remove: function () {
				this.core.draw.remove(this.id);
				this.drawn = false;
				
				// Add children that have been added to this object
				var objects = this.children,
					l = objects.length, i;
				for (i = 0; i < l; i++) {
					objects[i].remove();
				}
				
				return this;
			},
			
			// Method for drawing the shape
			draw: function () {
				
			},
			
			// Method for redrawing the canvas
			redraw: function () {
				this.core.draw.redraw();
				
				return this;
			},
			
			// Method for rotating the object
			rotate: function (angle) {
				this.rotation += angle;
				
				return this;
			},
			
			// Method for rotating to a specific angle
			rotateTo: function (angle) {
				this.rotation = angle;
				
				return this;
			},
			
			// Method for getting x/y arguments, with the ability to choose only one
			// Used by other methods
			//   Examples:
			//     obj.move(50, 100); // moves object 50px to the right and 100px down
			//     obj.move(50, "x"); // moves object 50px to the right
			//     obj.move(50); // moves object 50px to the right and down
			getArgs: function (x, y, default_x, default_y) {
				default_x = default_x || 0;
				default_y = default_y || 0;
				
				// Second argument is string 
				if (typeof y === "string") {
					var type = y,
						val = x;
					x = (type === "x") ? val : default_x;
					y = (type === "y") ? val : default_y;
				}
				else if (y === undefined) {
					y = x;
				}
				
				return {
					x: x,
					y: y
				};
			},
			
			// Method for moving the object
			move: function (x, y) {
				var change = this.getArgs(x, y);
				this.x += change.x;
				this.y += change.y;
				
				return this;
			},
			
			// Method for moving to a specific position
			moveTo: function (x, y) {
				var pos = this.getArgs(x, y, this.x, this.y);
				this.x = pos.x;
				this.y = pos.y;
				
				return this;
			},
			
			// Method for scaling the object
			scale: function (x, y) {
				var scaling = this.getArgs(x, y, 1, 1);
				this.scalingX = scaling.x;
				this.scalingY = scaling.y;
				
				return this;
			},
			
			// Method for scaling to a specific size
			scaleTo: function (width, height) {
				var currentWidth = (this.shapeType === "rectangular" ? this.width : this.radius),
					currentHeight = (this.shapeType === "rectangular" ? this.height : this.radius),
					size = this.getArgs(width, height, currentWidth, currentHeight);
					
				// Don't let the size be 0, because the native scale method doesn't support zero values
				size.x = size.x <= 0 ? 1 : size.x;
				size.y = size.y <= 0 ? 1 : size.y;
				
				// Set the scaling
				this.scalingX = size.x / currentWidth;
				this.scalingX = size.y / currentHeight;
				
				return this;
			},
			
			// Method for animating any numeric property
			animate: function () {
				this.core.animation.animate(this, arguments);
				
				return this;
			},
			
			// Method for clearing the object's animation queue and stop the animations
			stop: function () {
				this.core.animation.stop(this.id);
				
				return this;
			},
			
			// Method for changing the opacity property to 1 as an animation
			fadeIn: function () {
				var args = Array.prototype.slice.call(arguments);
				this.core.animation.animate(this, [{ opacity: 1 }].concat(args));
				
				return this;
			},
			
			// Method for changing the opacity property to 0 as an animation
			fadeOut: function () {
				var args = Array.prototype.slice.call(arguments);
				this.core.animation.animate(this, [{ opacity: 0 }].concat(args));
				
				return this;
			},
			
			// Method for changing the opacity property to a custom value as an animation
			fadeTo: function () {
				var args = Array.prototype.slice.call(arguments);
				this.core.animation.animate(this, [{ opacity: args.splice(0, 1)[0] }].concat(args));
				
				return this;
			},
			
			// Method for making drag and drop easier
			dragAndDrop: function (callbacks) {
			
				callbacks = (callbacks === undefined) ? {} : callbacks;
			
				// If false is passed as argument, remove all event handlers
				if (callbacks === false && this.draggable === true) {
					this.draggable = false;
					
					this.unbind("mousedown touchstart", this._.drag_start)
					this.core.unbind("mouseup touchend", this._.drag_end);
					this.core.unbind("mousemove touchmove", this._.drag_move);
				}
				
				// Otherwise add event handlers, unless they have been added before
				else if (!this.draggable) {
				
					this.draggable = true;
					this.dragging = false;
				
					var _this = this,
						offset = { x: 0, y: 0 };
					
					this._.drag_start = function (e) {
						this.dragging = true;
						
						// Get the difference between pointer position and object position
						offset.x = e.x - this.x;
						offset.y = e.y - this.y;
						
						// Run user callback
						if (typeof callbacks.start === "function") {
							callbacks.start.call(this);
						}
						
						// Redraw the canvas if the timeline is not running
						if (!this.core.timeline.running) {
							this.core.draw.redraw();
						}
					};
					
					this._.drag_end = function () {
						_this.dragging = false;
						
						// Run user callback
						if (typeof callbacks.end === "function") {
							callbacks.end.call(_this);
						}
						
						// Redraw the canvas if the timeline is not running
						if (!_this.core.timeline.running) {
							_this.core.draw.redraw();
						}
					};
					
					this._.drag_move = function (e) {
						if (_this.dragging) {
						
							// Set new position for the object, using the offset
							_this.x = e.x - offset.x;
							_this.y = e.y - offset.y;
							
							// Run user callback
							if (typeof callbacks.move === "function") {
								callbacks.move.call(_this);
							}
							
							// Redraw the canvas if the timeline is not running
							if (!_this.core.timeline.running) {
								_this.core.draw.redraw();
							}
						}
					};
					
					// Bind event handlers
					this.bind("mousedown touchstart", this._.drag_start)
					this.core.bind("mouseup touchend", this._.drag_end);
					this.core.bind("mousemove touchmove", this._.drag_move);
				}
				
				return this;
			},
			
			// Method for setting the origin coordinates
			// Accepts pixel values or the following keywords:
			//     x: left | center | right
			//     y: top | center | bottom
			setOrigin: function (x, y) {
				this.origin.x = x;
				this.origin.y = y;
				
				return this;
			},
			
			// Method for getting the current origin coordinates in pixels
			getOrigin: function () {
				var x, y,
					origin = this.origin,
					shapeType = this.shapeType;
				
				// Get X coordinate in pixels
				if (origin.x === "center") {
					x = (shapeType === "rectangular") ? this.width / 2 : 0;
				} else if (origin.x === "right") {
					x = (shapeType === "rectangular") ? this.width : this.radius;
				} else if (origin.x === "left") {
					x = (shapeType === "rectangular") ? 0 : -this.radius;
				} else {
					x = !isNaN(parseFloat(origin.x)) ? parseFloat(origin.x) : 0;
				}
				
				// Get Y coordinate in pixels
				if (origin.y === "center") {
					y = (shapeType === "rectangular") ? this.height / 2 : 0;
				} else if (origin.y === "bottom") {
					y = (shapeType === "rectangular") ? this.height : this.radius;
				} else if (origin.y === "top") {
					y = (shapeType === "rectangular") ? 0 : -this.radius;
				} else {
					y = !isNaN(parseFloat(origin.y)) ? parseFloat(origin.y) : 0;
				}
				
				// Return pixel coordinates
				return {
					x: x,
					y: y
				};
			},
			
			// Method for adding a child to the display object
			// Children will transform accordingly when this display object transforms
			addChild: function (childObj, returnIndex) {
			
				// Check if the child object doesn't already have a parent
				if (childObj.parent === undefined) {
				
					// Add the object as a child
					var index = this.children.push(childObj) - 1;
					
					// Update child
					childObj.parent = this;
					childObj.x += 0;
					childObj.y += 0;
					
					// Add it to canvas if this object is drawn
					if (this.drawn) {
						childObj.add();
					}
					
					if (returnIndex) {
						return index;
					}
				} else if (returnIndex) {
					return false;
				}
				
				// Return the object itself if user chose to not get the index in return
				return this;
			},
			
			// Method for removing a child
			removeChild: function (childObj) {
				var index = this.children.indexOf(childObj);
				if (~index) {
					this.removeChildAt(index);
				}
				
				return this;
			},
			
			// Method for removing a child at a specific index
			removeChildAt: function (index) {
				if (this.children[index] !== undefined) {
					this.children[index].remove();
					this.children[index].parent = undefined;
					this.children.splice(index, 1);
				}
				
				return this;
			},
			
			// Method for creating a clone of this object
			clone: function (settings) {
				settings = settings || {};
				settings.drawn = false;
				var newObj = this.core.display[this.type](settings),
					this_filtered = {},
					reject = ["core", "events", "children", "parent", "img", "fill", "strokeColor"],
					loopObject, x, stroke;
				
				// Filter out the setter and getter methods, and also properties listed above
				loopObject = function (obj, destination) {
					for (x in obj) {
						if (~reject.indexOf(x)) {
							continue;
						}
						if (typeof obj[x] === "object") {
							destination[x] = (obj[x].constructor === Array) ? [] : {};
							loopObject(obj[x], destination[x]);
							continue;
						}
						if (obj.__lookupGetter__(x) === undefined) {
							destination[x] = obj[x];
						}
					}
				}
				loopObject(this, this_filtered);
				
				// Fix gradients and patterns
				this_filtered.fill = this._.fill;
				stroke = this.core.style.getStroke(this.stroke);
				this_filtered.strokeColor = stroke.color;
				
				// Extend the new object with this object's properties and then apply the custom settings
				newObj = oCanvas.extend(newObj, this_filtered, settings);
				
				if (typeof newObj.init === "function") {
					newObj.init();
				}
				
				return newObj;
			},
			
			// Method for checking if the pointer is inside the object
			isPointerInside: function (pointer) {
				return this.core.tools.isPointerInside(this, pointer);
			}
		};
	},
	
	// Method for registering a custom display object at run time
	// It is only attached to the current core instance
	register = function (name, properties, draw, init) {
		var display = this,
			core = this.core,
			
			// The object that will be instantiated
			obj = function (settings, thecore) {
			
				// Return an object containing base properties, core access and a draw wrapper
				// The object is extended with properties set on register, and settings set on instantiation
				return oCanvas.extend({
					core: thecore,
					type: name,
					shapeType: "rectangular",
					
					// Wrapper for the draw method. This enables the callback to work internally and gives the user
					// access to the canvas context and the core
					draw: function () {
						draw.call(this, core.canvas, core);

						return this;
					}
				}, properties, settings);
			};
		
		// Add the constructor function to core.display.name
		this[name] = function (settings) {
		
			// Instantiate a new custom object with specified settings
			var retObj = oCanvas.extend(Object.create(displayObject()), new obj(settings, core));
			
			// Run initialization method if provided
			if (init !== undefined && typeof display[name][init] === "function") {
				display[name][init]();
			}
			
			// Return the new object
			return retObj;
		};
		
		return display;
	};
	
	// Register the module
	oCanvas.registerModule("displayObject", displayObject);
	
	// Second namespace where objects gets placed
	oCanvas.registerModule("display", { wrapper: true, register: register });
	
	
	
	// Add method to oCanvas to enable display objects to be added
	oCanvas.registerDisplayObject = function (name, obj, init) {
	
		// Register the object as a submodule to display
		oCanvas.registerModule("display."+name, {
		
			// Method for getting the core instance
			setCore: function (thecore) {
			
				// Method that core.display.rectangle() will call
				return function (settings) {
				
					// Create a new rectangle object that inherits from displayObject
					var retObj = oCanvas.extend(Object.create(displayObject()), new obj(settings, thecore));
					retObj.type = name;
					
					// Trigger an init method if specified
					if (init !== undefined) {
						retObj[init]();
					}
					
					// Return the new object
					return retObj;
				};
			}
		});
	};




	// Define the class
	var rectangle = function (settings, thecore) {
		
		// Return an object when instantiated
		return oCanvas.extend({
			core: thecore,
			
			shapeType: "rectangular",
			
			draw: function () {
				var canvas = this.core.canvas,
					origin = this.getOrigin(),
					x = this.abs_x - origin.x,
					y = this.abs_y - origin.y;
				
				canvas.beginPath();
				
				// Do fill if a color is specified
				if (this.fill !== "") {
					canvas.fillStyle = this.fill;
					canvas.fillRect(x, y, this.width, this.height);
				}
				
				// Do color if stroke width is specified
				if (this.strokeWidth > 0) {
				
					// Set styles
					canvas.lineWidth = this.strokeWidth;
					canvas.strokeStyle = this.strokeColor;
					
					// Set stroke outside the box
					if (this.strokePosition === "outside") {
						canvas.strokeRect(x - this.strokeWidth / 2, y - this.strokeWidth / 2, this.width + this.strokeWidth, this.height + this.strokeWidth);
					}
					
					// Set stroke on the edge of the box (half of the stroke outside, half inside)
					else if (this.strokePosition === "center") {
						canvas.strokeRect(x, y, this.width, this.height);
					}
					
					// Set stroke on the inside of the box
					else if (this.strokePosition === "inside") {
						canvas.strokeRect(x + this.strokeWidth / 2, y + this.strokeWidth / 2, this.width - this.strokeWidth, this.height - this.strokeWidth);
					}
				}
				
				canvas.closePath();
				
				return this;
			}
			
		}, settings);
	};
	
	// Register the display object
	oCanvas.registerDisplayObject("rectangle", rectangle);
	



	// Define the class
	var image = function (settings, thecore) {
		
		// Return an object when instantiated
		return oCanvas.extend({
			core: thecore,
			
			shapeType: "rectangular",
			loaded: false,
			firstDrawn: false,
			tile: false,
			tile_width: 0,
			tile_height: 0,
			tile_spacing_x: 0,
			tile_spacing_y: 0,
			
			// Init method for loading the image resource
			init: function () {
				var _this = this,
				
					// Get source (settings.image can be either an HTML img element or a string with path to the image)
					source = (this.image.nodeName && this.image.nodeName.toLowerCase() === "img") ? "htmlImg" : "newImg";
				
				// Get image object (either create a copy of the current element, or a new image)
				this.img = (source === "htmlImg") ? this.image.cloneNode(false) : new Image();
				
				// Temporarily append it to the canvas to be able to get dimensions
				this.core.canvasElement.appendChild(this.img);
				
				// Get dimensions when the image is loaded. Also, remove the temp img from DOM
				this.img.onload = function () {
					_this.loaded = true;
					
					// Set dimensions proportionally (if only one is specified, calculate the other)
					if (_this.width !== 0) {
						if (_this.height === 0) {
							_this.height = _this.width / (this.width / this.height);
						}
					} else {
						_this.width = this.width;
					}
					if (_this.height !== 0) {
						if (_this.width === 0) {
							_this.width = _this.height / (this.height / this.width);
						}
					} else {
						_this.height = this.height;
					}
					_this.tile_width = (_this.tile_width === 0) ? _this.width : _this.tile_width;
					_this.tile_height = (_this.tile_height === 0) ? _this.height : _this.tile_height;
					_this.core.canvasElement.removeChild(this);
					_this.core.redraw();
				};
				
				// Set the path to the image if a string was passed in
				if (source === "newImg") {
					this.img.src = this.image;
				}
			},
			
			// Method that draws the image to the canvas once it's loaded
			draw: function () {
				var canvas = this.core.canvas,
					_this = this,
					origin = this.getOrigin(),
					x = this.abs_x - origin.x,
					y = this.abs_y - origin.y,
					width, height;
				
				// If the image has finished loading, go on and draw
				if (this.loaded && this.core.draw.objects[this.id] !== undefined && this.img.width > 0 && this.img.height > 0) {
					
				
					width = (this.width === 0) ? this.img.width : this.width;
					height = (this.height === 0) ? this.img.height : this.height;
				
					if (this.tile) {
					
						var num_x = Math.ceil(width / this.tile_width),
							num_y = Math.ceil(height / this.tile_height),
							tile_x, tile_y;
						
						canvas.save();
						canvas.beginPath();
						
						// Create clipping path for the rectangle that the tiled images will be drawn inside
						canvas.moveTo(x, y);
						canvas.lineTo(x + width, y);
						canvas.lineTo(x + width, y + height);
						canvas.lineTo(x, y + height);
						canvas.lineTo(x, y);
						canvas.clip();
						
						// Draw all the tiled images
						for (tile_y = 0; tile_y < num_y; tile_y++) {
							for (tile_x = 0; tile_x < num_x; tile_x++) {
								canvas.drawImage(this.img, x + tile_x * (this.tile_width + this.tile_spacing_x), y + tile_y * (this.tile_height + this.tile_spacing_y), this.tile_width, this.tile_height);
							}
						}

						canvas.closePath();
						canvas.restore();

						
					} else {
				
						// Draw the image to the canvas
						canvas.drawImage(this.img, x, y, width, height);
						
					}
					
					// Do color if stroke width is specified
					if (this.strokeWidth > 0) {
						canvas.lineWidth = this.strokeWidth;
						canvas.strokeStyle = this.strokeColor;
						canvas.strokeRect(x, y, width, height);
					}
					
					// Clear the timer if this is the first time it is drawn
					if (this.firstDrawn === false) {
						this.firstDrawn = true;
						clearTimeout(this.loadtimer);
					}
				}
				
				// If the image hasn't finished loading, set a timer and try again
				else {
					clearTimeout(this.loadtimer);
					this.loadtimer = setTimeout(function () {
						_this.draw();
					}, 100);
				}
				
				return this;
			}
			
		}, settings);
	};
	
	// Register the display object
	oCanvas.registerDisplayObject("image", image, "init");
	



	// Define the class
	var text = function (settings, thecore) {
	
		// Method for setting a font property. Updates both obj.font and obj.property
		var setFontProperty = function (_this, property, value, objectProperty, thecore) {
			var font = thecore.style.getFont(_this.font);
			font[property] = value;
			_this._.font = thecore.style.getFont(font, "string");
			_this._[objectProperty] = value;
		};
		
		// Return an object when instantiated
		return oCanvas.extend({
			core: thecore,
			
			shapeType: "rectangular",
			
			// Default properties
			align: "start",
			baseline: "top",
			_: oCanvas.extend({}, thecore.displayObject._, {
				font: "normal normal normal 16px/1 sans-serif",
				style: "normal",
				variant: "normal",
				weight: "normal",
				size: 16,
				lineHeight: 1,
				family: "sans-serif",
				text: "",
				width: 0,
				height: 0
			}),
			
			// Setters for font properties
			set font (value) {
			
				// Convert the value to a correct string if it is not a string
				if (typeof value !== "string") {
					value = this.core.style.getFont(value, "string");
				}
				
				// Get font object and set styles
				var font = this.core.style.getFont(value);
				value = this.core.style.getFont(font, "string");
				this._.style = font.style;
				this._.variant = font.variant;
				this._.weight = font.weight;
				this._.size = font.size;
				this._.lineHeight = font.lineHeight;
				this._.family = font.family;
				this._.font = value;
				
				this.setDimensions();
			},
			set style (style) {
				setFontProperty(this, "style", style, "style", this.core);
				this.setDimensions();
			},
			set variant (variant) {
				setFontProperty(this, "variant", variant, "variant", this.core);
				this.setDimensions();
			},
			set weight (weight) {
				setFontProperty(this, "weight", weight, "weight", this.core);
				this.setDimensions();
			},
			set size (size) {
				setFontProperty(this, "size", size, "size", this.core);
				this.setDimensions();
			},
			set lineHeight (lineHeight) {
				setFontProperty(this, "lineHeight", lineHeight, "lineHeight", this.core);
				this.setDimensions();
			},
			set family (family) {
				setFontProperty(this, "family", family, "family", this.core);
				this.setDimensions();
			},
			set text (text) {
				this._.text = text;
				this.setDimensions();
			},
			set width (value) {
				return;
			},
			set height (value) {
				return;
			},
			
			// Getters for font properties
			get font () {
				return this._.font;
			},
			get style () {
				return this._.style;
			},
			get variant () {
				return this._.variant;
			},
			get weight () {
				return this._.weight;
			},
			get size () {
				return this._.size;
			},
			get lineHeight () {
				return this._.lineHeight;
			},
			get family () {
				return this._.family;
			},
			get text () {
				return this._.text;
			},
			get width () {
				return this._.width;
			},
			get height () {
				return this._.height;
			},
			
			// Method for initializing the text and get dimensions
			init: function () {
				this._.initialized = true;
				this.setDimensions();
			},
			
			// Method for setting width/height when something has changed
			setDimensions: function () {
				if (this._.initialized) {
					var canvas = this.core.canvas,
						metrics;
					
					// Measure the text
					canvas.fillStyle = this.fill;
					canvas.font = this.font;
					metrics = canvas.measureText(this.text);
					
					// Set new dimensions
					this._.width = metrics.width;
					this._.height = this.size;
				}
			},
			
			// Method for drawing the object to the canvas
			draw: function () {
				var canvas = this.core.canvas,
					origin = this.getOrigin(),
					x = this.abs_x - origin.x,
					y = this.abs_y - origin.y,
					lines, i;
				
				canvas.beginPath();
				
				canvas.font = this.font;
				canvas.textAlign = this.align;
				canvas.textBaseline = this.baseline;
				
				// Draw the text as a stroke if a stroke is specified
				if (this.strokeWidth > 0) {
					canvas.lineWidth = this.strokeWidth;
					canvas.strokeStyle = this.strokeColor;
					canvas.strokeText(this.text, x, y);
					canvas.stroke();
				}
				
				// Draw the text normally if a fill color is specified
				if (this.fill !== "") {
					canvas.fillStyle = this.fill;
					
					// Draw the text with support for multiple lines
					lines = this.text.toString().split("\n");
					for (i = 0; i < lines.length; i++) {
						canvas.fillText(lines[i], x, y + (i * this.lineHeight * this.height));
					}
					canvas.fill();
				}
				
				canvas.closePath();
				
				return this;
			}
			
		}, settings);
	};
	
	// Register the display object
	oCanvas.registerDisplayObject("text", text, "init");
	



	// Define the class
	var arc = function (settings, thecore) {
		
		// Return an object when instantiated
		return oCanvas.extend({
			core: thecore,
			
			shapeType: "radial",
			radius: 0,
			start: 0,
			end: 0,
			direction: "clockwise",
			
			draw: function () {
				var canvas = this.core.canvas,
					origin = this.getOrigin(),
					x = this.abs_x - origin.x,
					y = this.abs_y - origin.y;
				
				// Don't draw if the radius is 0 or less (won't be visible anyway)
				if (this.radius > 0) {
				
					// Draw the arc
					canvas.beginPath();
					canvas.arc(x, y, this.radius, this.start * Math.PI / 180, this.end * Math.PI / 180, (this.direction === "anticlockwise"));
					
					// Do fill
					if (this.fill !== "") {
						canvas.fillStyle = this.fill;
						canvas.fill();
					}
					
					// Do stroke
					if (this.strokeWidth > 0) {
						canvas.lineWidth = this.strokeWidth;
						canvas.strokeStyle = this.strokeColor;
						canvas.stroke();
					}
					
					canvas.closePath();
					
				}
				
				return this;
			}
			
		}, settings);
	};
	
	// Register the display object
	oCanvas.registerDisplayObject("arc", arc);
	



	// Define the class
	var ellipse = function (settings, thecore) {
		
		// Return an object when instantiated
		return oCanvas.extend({
			core: thecore,
			
			shapeType: "radial",
			
			_: oCanvas.extend({}, thecore.displayObject._, {
				radius_x: 0,
				radius_y: 0
			}),
			
			set radius (value) {
				this._.radius_x = value;
				this._.radius_y = value;
			},
			
			set radius_x (value) {
				this._.radius_x = value;
			},
			
			set radius_y (value) {
				this._.radius_y = value;
			},
			
			get radius () {
				return this._.radius_x;
			},
			
			get radius_x () {
				return this._.radius_x;
			},
			
			get radius_y () {
				return this._.radius_y;
			},
			
			draw: function () {
				var canvas = this.core.canvas,
					origin = this.getOrigin(),
					x = this.abs_x - origin.x,
					y = this.abs_y - origin.y;
				
				canvas.beginPath();
				
				// Draw a perfect circle with the arc method if both radii are the same
				if (this.radius_x === this.radius_y) {
					canvas.arc(x, y, this.radius_x, 0, Math.PI * 2, false);
				}
				
				// Draw an ellipse if the radii are not the same
				else {
					
					// Calculate values for the ellipse
					var EllipseToBezierConstant = 0.276142374915397,
						o = {x: this.radius_x * 2 * EllipseToBezierConstant, y: this.radius_y * 2 * EllipseToBezierConstant};
					
					// Draw the curves that will form the ellipse
					canvas.moveTo(x - this.radius_x, y);
					canvas.bezierCurveTo(x - this.radius_x, y - o.y, x - o.x, y - this.radius_y, x, y - this.radius_y);
					canvas.bezierCurveTo(x + o.x, y - this.radius_y, x + this.radius_x, y - o.y, x + this.radius_x, y);
					canvas.bezierCurveTo(x + this.radius_x, y + o.y, x + o.x, y + this.radius_y, x, y + this.radius_y);
					canvas.bezierCurveTo(x - o.x, y + this.radius_y, x - this.radius_x, y + o.y, x - this.radius_x, y);
				}
				
				// Do fill
				if (this.fill !== "") {
					canvas.fillStyle = this.fill;
					canvas.fill();
				}
				
				// Do stroke
				if (this.strokeWidth > 0) {
					canvas.lineWidth = this.strokeWidth;
					canvas.strokeStyle = this.strokeColor;
					canvas.stroke();
				}
				
				canvas.closePath();
				
				return this;
			}
			
		}, settings);
	};
	
	// Register the display object
	oCanvas.registerDisplayObject("ellipse", ellipse);
	



	// Define the class
	var polygon = function (settings, thecore) {
		
		// Return an object when instantiated
		return oCanvas.extend({
			core: thecore,
			
			shapeType: "radial",
			
			sides: 3,
			
			_: oCanvas.extend({}, thecore.displayObject._, {
				radius: 0,
				side: 0
			}),
			
			set radius (value) {
				this._.radius = value;
				this._.side = 2 * this._.radius * Math.sin(Math.PI / this.sides);
			},
			
			set side (value) {
				this._.side = value;
				this._.radius = (this._.side / 2) / Math.sin(Math.PI / this.sides);
			},
			
			get radius () {
				return this._.radius;
			},
			
			get side () {
				return this._.side;
			},
			
			draw: function () {
				var canvas = this.core.canvas,
					origin = this.getOrigin(),
					x = this.abs_x - origin.x,
					y = this.abs_y - origin.y,
					firstPoint = { x: 0, y: 0 },
					sides = this.sides,
					radius = this.radius,
					xPos, yPos, i;
				
				canvas.beginPath();
				
				for (i = 0; i <= sides; i++) {
					xPos = x + radius * Math.cos(i * 2 * Math.PI / sides);
					yPos = y + radius * Math.sin(i * 2 * Math.PI / sides);
					
					if (i === 0) {
						canvas.moveTo(xPos, yPos);
						firstPoint = { x: xPos, y: yPos };
					} else
					if (i == sides) {
						canvas.lineTo(firstPoint.x, firstPoint.y);
					} else {
						canvas.lineTo(xPos, yPos);
					}
				}
				
				canvas.closePath();
				
				if (this.fill !== "") {
					canvas.fillStyle = this.fill;
					canvas.fill();
				}
				
				
				if (this.strokeWidth > 0) {
					canvas.lineWidth = this.strokeWidth;
					canvas.strokeStyle = this.strokeColor;
					canvas.stroke();
				}
				
				return this;
			}
			
		}, settings);
	};
	
	// Register the display object
	oCanvas.registerDisplayObject("polygon", polygon);
	



	// Define the class
	var line = function (settings, thecore) {
		
		// Return an object when instantiated
		return oCanvas.extend({
			core: thecore,
			
			shapeType: "radial",
			
			// Properties
			_: oCanvas.extend({}, thecore.displayObject._, {
				start_x: 0,
				start_y: 0,
				end_x: 0,
				end_y: 0,
				x: 200,
				y: 0,
				abs_x: 0,
				abs_y: 0
			}),
			children: [],
			
			// Getters and setters
			set start (values) {
				this._.start_x = values.x;
				this._.start_y = values.y;
				this.setPosition();
			},
			set end (values) {
				this._.end_x = values.x;
				this._.end_y = values.y;
				this.setPosition();
			},
			get start () {
				return { x: this._.start_x, y: this._.start_y };
			},
			get end () {
				return { x: this._.end_x, y: this._.end_y };
			},
			
			// Overwrite the setters that displayObject provides, to enable start/end coordinates to affect the position
			set x (value) {
				// Get delta length
				var diff = this._.end_x - this._.start_x;
				
				// Assign new x positions for the object
				this._.x = value;
				this._.abs_x = value + ((this.parent !== undefined) ? this.parent.abs_x : 0);
				
				// Assign new x positions for start and end points
				this._.start_x = value - (diff / 2) + (this._.abs_x - this._.x);
				this._.end_x = value + (diff / 2) + (this._.abs_x - this._.x);
				
				// Update children
				var objects = this.children,
					l = objects.length, i;
				for (i = 0; i < l; i++) {
					objects[i]._.abs_x = this.abs_x + objects[i].x;
					objects[i].x += 0;
				}
			},
			set y (value) {
				// Get delta length
				var diff = this._.end_y - this._.start_y;
				
				// Assign new y positions for the object
				this._.y = value;
				this._.abs_y = value + ((this.parent !== undefined) ? this.parent.abs_y : 0);
				
				// Assign new y positions for start and end points
				this._.start_y = value - (diff / 2) + (this._.abs_y - this._.y);
				this._.end_y = value + (diff / 2) + (this._.abs_y - this._.y);
				
				// Update children
				var objects = this.children,
					l = objects.length, i;
				for (i = 0; i < l; i++) {
					objects[i]._.abs_y = this.abs_y - objects[i].y;
					objects[i].y += 0;
				}
			},
			get x () {
				return this._.x;
			},
			get y () {
				return this._.y;
			},
			
			set length (value) {
				var dX, dY, length, angle;
				
				// Find current length and angle
				dX = Math.abs(this._.end_x - this._.start_x);
				dY = Math.abs(this._.end_y - this._.start_y);
				length = Math.sqrt(dX * dX + dY * dY);
				angle = Math.asin(dX / length);
				
				// Calculate new values
				dX = Math.sin(angle) * value;
				dY = Math.cos(angle) * value;
				this._.end_x = this._.start_x + dX;
				this._.end_y = this._.start_y + dY;
				this.x += 0;
				this.y += 0;
			},
			get length () {
				var dX, dY, length;
				
				dX = Math.abs(this._.end_x - this._.start_x);
				dY = Math.abs(this._.end_y - this._.start_y);
				length = Math.sqrt(dX * dX + dY * dY);
				
				return length;
			},
			
			set radius (value) {
				this.length = value * 2;
			},
			get radius () {
				return this.length / 2;
			},
			
			// Method for setting x/y coordinates (which will set abs_x/abs_y as specified by displayObject)
			setPosition: function () {
				if (this.initialized) {
					this.x = this._.start_x + (this._.end_x - this._.start_x) / 2;
					this.y = this._.start_y + (this._.end_y - this._.start_y) / 2;
				}
			},
			
			// Method for initializing the dimensions
			init: function () {
				this.initialized = true;
				this.setPosition();
			},
			
			draw: function () {
				var canvas = this.core.canvas,
					origin = this.getOrigin(),
					translation = this.core.draw.translation;
				
				
				canvas.lineWidth = this.strokeWidth;
				canvas.strokeStyle = this.strokeColor;
				canvas.beginPath();
				canvas.moveTo(this.start.x - translation.x - origin.x, this.start.y - translation.y - origin.y);
				canvas.lineTo(this.end.x - translation.x - origin.x, this.end.y - translation.y - origin.y);
				canvas.stroke();
				canvas.closePath();
				
				return this;
			}
			
		}, settings);
	};
	
	// Register the display object
	oCanvas.registerDisplayObject("line", line, "init");
	



	// Define the class
	var sprite = function (settings, thecore) {
		
		// Return an object when instantiated
		return oCanvas.extend({
			core: thecore,
			
			// Set properties
			shapeType: "rectangular",
			loaded: false,
			firstDrawn: false,
			frames: [],
			duration: 0,
			frame: 1,
			generate: false,
			offset_x: 0,
			offset_y: 0,
			direction: "x",
			running: false,
			active: false,
			loop: true,
			
			_: oCanvas.extend({}, thecore.displayObject._, {
				autostart: false
			}),
			
			set autostart (value) {
				this.active = value;
				this._.autostart = value;
			},
			
			get autostart () {
				return this._.autostart;
			},
			
			// Init method for loading the image resource
			init: function () {
				if (this.image === undefined) {
					return;
				}
				var _this = this,
				
					// Get source (settings.image can be either an HTML img element or a string with path to the image)
					source = (this.image.nodeName && this.image.nodeName.toLowerCase() === "img") ? "htmlImg" : "newImg";
				
				// Get image object (either create a copy of the current element, or a new image)
				this.img = (source === "htmlImg") ? this.image.cloneNode(false) : new Image();
				
				// Temporarily append it to the canvas to be able to get dimensions
				this.core.canvasElement.appendChild(this.img);
				
				// Get dimensions when the image is loaded. Also, remove the temp img from DOM
				this.img.onload = function () {
				
					// Set the full source image dimensions
					_this.full_width = this.width;
					_this.full_height = this.height;
					
					// If automatic generation is specified
					if (_this.generate) {
					
						// Get frame data
						var dir = _this.direction,
							length_full = (dir === "y") ? _this.full_height : _this.full_width,
							length_cropped = (dir === "y") ? _this.height : _this.width,
							num_frames = length_full / length_cropped,
							i;
						
						// Create frames based on the specified width, height, direction, offset and duration
						_this.frames = [];
						for (i = 0; i < num_frames; i++) {
							_this.frames.push({
								x: _this.offset_x + (i * (dir === "x" ? _this.width : 0)),
								y: _this.offset_y + (i * (dir === "y" ? _this.height : 0)),
								d: _this.duration
							});
						}
					}
					_this.core.canvasElement.removeChild(this);
					_this.loaded = true;
				};
				
				// Set the path to the image if a string was passed in
				if (source === "newImg") {
					this.img.src = this.image;
				}
			},
			
			draw: function () {
				var _this = this,
					canvas = this.core.canvas,
					origin = this.getOrigin(),
					x = this.abs_x - origin.x,
					y = this.abs_y - origin.y,
					frame;
				
				// If the image has finished loading, go on and draw
				if (this.loaded) {
				
					// Draw current frame
					if (this.frames.length > 0) {
					
						// Get current frame
						frame = this.frames[this.frame - 1];
						frame_width = (frame.w !== undefined) ? frame.w : this.width;
						frame_height = (frame.h !== undefined) ? frame.h : this.height;
						
						// Draw the current sprite part
						canvas.drawImage(this.img, frame.x, frame.y, frame_width, frame_height, x, y, frame_width, frame_height);
						
						// Do stroke if stroke width is specified
						if (this.strokeWidth > 0) {
							canvas.lineWidth = this.strokeWidth;
							canvas.strokeStyle = this.strokeColor;
							canvas.strokeRect(x, y, frame_width, frame_height);
						}
						
						// Set a redraw timer at the current frame duration if a timer is not already running
						if (this.running === false && this.active) {
						
							setTimeout(function () {
							
								// Increment the frame number only after the frame duration has passed
								if (_this.loop) {
									_this.frame = (_this.frame === _this.frames.length) ? 1 : _this.frame + 1;
								} else {
									_this.frame = (_this.frame === _this.frames.length) ? _this.frame : _this.frame + 1;
								}
								
								// Set timer status
								_this.running = false;
								
								// Redraw canvas if the timeline is not running
								if (!_this.core.timeline.running) {
									_this.core.draw.redraw();
								}
								
							}, frame.d);
							
							// Set timer status
							this.running = true;
						}
					}
					
					// Clear the timer if this is the first time it is drawn
					if (this.firstDrawn === false) {
						this.firstDrawn = true;
						clearTimeout(this.loadtimer);
					}
				}
				
				// If the image hasn't finished loading, set a timer and try again
				else {
					clearTimeout(this.loadtimer);
					this.loadtimer = setTimeout(function () {
						_this.draw();
					}, 100);
				}
				
				return this;
			},
			
			start: function () {
				this.active = true;
				this.core.redraw();
				
				return this;
			},
			
			stop: function () {
				this.active = false;
				
				return this;
			},
			
		}, settings);
	};
	
	// Register the display object
	oCanvas.registerDisplayObject("sprite", sprite, "init");
	

})(window, document);
