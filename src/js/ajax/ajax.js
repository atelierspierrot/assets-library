/*
# ***** BEGIN LICENSE BLOCK *****
# Assets Library - The open source PHP/JavaScript/CSS library of Les Ateliers Pierrot
# Copyleft (c) 2013-2014 Pierre Cassat and contributors
# <www.ateliers-pierrot.fr> - <contact@ateliers-pierrot.fr>
# License GPL-3.0 <http://www.opensource.org/licenses/gpl-3.0.html>
# Sources <http://github.com/atelierspierrot/assets-library>
#
# Ce programme est un logiciel libre distribué sous licence GNU/GPL.
#
# ***** END LICENSE BLOCK ***** */


/**
 * Ajax full manager
 */
(function(window, undefined) {

	//---------------------------
	// Constants
	//---------------------------

	var ClassVersion = "1.0",
		format_defaults = ['TEXT', 'XML', 'JSON'],
		MS_XmlHttpObj = [
			"Msxml2.XMLHTTP.6.0", 
			"Msxml2.XMLHTTP.4.0", 
			"Msxml2.XMLHTTP.3.0", 
			"Msxml2.XMLHTTP", 
			"Microsoft.XMLHTTP"
		];

	//---------------------------
	// Internal Variables
	//---------------------------

	var _previous_content = null,     // store the DOM ID content if so
		_response_headers = null,     // getAllResponseHeaders
		_token_ = null,               // Single and unique object ID
		_response = null,             // The request response if so
		_request = null,              // The request itself
		_req_statut = null;           // Status of the response (String)

	//---------------------------
	// Variables
	//---------------------------
	// They are all setted in _EmptyObject()
	// They are all overridden by the arguments in Caller

	var dom = window,             // The window object concerned (window by default)
		_if_modified = null,      // Load request just if response is modified
		_url = null,              // The URL to load (needed - object stops if empty)
		_method = null,           // GET, POST (GET by default)
		_args = null,             // The args to send (formated string or array)
		_dom_id = null,           // A DOM ID where the result will be sent
		_callback = null,         // Some callbacks : array( error: ..., success: ... )
		_format = null,           // TEXT, XML, JSON
		_asynch = null,           // Boolean asynchronous or not
		_loader = null,           // URL (can be relative) of the loader image
		_loader_style = null,     // CSS styles of loader image
		_timeout = null,          // 0 by default
		_content_type = null;     // 'application/x-www-form-urlencoded' by default

	//---------------------------
	// Callers / Objects
	//---------------------------

	var Ajax = function() {
		_EmptyObject();
		var dbg_info = "";
		if (arguments.length) {
			for (var arg in arguments[0]) {
				if( arg.toLowerCase() === "url" ) {
					_url = arguments[0][arg];
				}
				else if( arg.toLowerCase() === "method" ) {
					if( arguments[0][arg].toUpperCase() === "POST" )
						_method = "POST";
				}
				else if( arg.toLowerCase() === "data" ) {
					_args = arguments[0][arg];
					dbg_info += "\n    Send data : "+dump(_args, true);
				}
				else if( arg.toLowerCase() === "success" ) {
					_callback.success = arguments[0][arg];
				}
				else if( arg.toLowerCase() === "error" ) {
					_callback.error = arguments[0][arg];
				}
				else if( arg.toLowerCase() === "format" ) {
					if( format_defaults.in_array(arguments[0][arg].toUpperCase()) )
						_format = arguments[0][arg];
				}
				else if( arg.toLowerCase() === "load_in" ) {
					_dom_id = arguments[0][arg];
					dbg_info += "\n    DOM ID concerned : "+dump(_dom_id);
				}
				else if( arg.toLowerCase() === "dom_id" ) {
					_dom_id = arguments[0][arg];
					dbg_info += "\n    DOM ID concerned : "+dump(_dom_id);
				}
				else if( arg.toLowerCase() === "dom_disabled" ) {
					_dom_disabled = arguments[0][arg];
					dbg_info += "\n    DOM ID will be disabled during the request";
				}
				else if( arg.toLowerCase() === "disabled_opacity" ) {
					_disabled_opacity = arguments[0][arg];
					dbg_info += "\n    Disabled opacity is setted to "+dump(_disabled_opacity);
				}
				else if( arg.toLowerCase() === "loader" ) {
					_loader = arguments[0][arg];
					dbg_info += "\n    Loader setted to : "+dump(_loader);
				}
				else if( arg.toLowerCase() === "timeout" ) {
					_timeout = arguments[0][arg];
					dbg_info += "\n    Timeout setted to : "+_timeout;
				}
				else if( arg.toLowerCase() === "contenttype" ) {
					_content_type = arguments[0][arg];
					dbg_info += "\n    Content Type : "+dump(_content_type);
				}
				else if( arg.toLowerCase() === "if_modified" ) {
					_if_modified = arguments[0][arg];
					dbg_info += "\n    If modified : "+dump(_if_modified);
				}
				else if( arg.toLowerCase() === "asynch" && arguments[0][arg] === false ) {
					_asynch = false;
					dbg_info += "\n    Asynchronous : "+dump(_asynch);
				}
			}
		}
		dbg_info = "Initializing Ajax request object with :"
				+"\n    URL : "+_url
				+"\n    Method : "+_method
				+"\n    Response format : "+_format
				+"\n    Callback(s) :\n"+dump(_callback, true, 1)
				+"\nUser params :"
				+dbg_info;
	
		// If no URL, return empty
		if (is_null(_url)) {
			_first_dbg("[ ERROR ] Argument 'URL' is missing in 'Ajax' call !");
			return _url;
		}
	
		// Else let's do it !
		_first_dbg( dbg_info );
		return Ajax_init();
    },

	// Arguments : DOM ID, URL, data, callback
    ajaxLoad = function() {
        _EmptyObject();
        var largs = arguments.length;
        if( largs<2 ) {
        	_first_dbg("[ ERROR ] Too few arguments in 'ajaxLoad' call ! ("+largs+" received - must be at least 2)");
        	return;
        }
        switch ( largs ) {
        	case 2:
        		return new Ajax({ dom_id: arguments[0], url: arguments[1] });
        	    break;
        	case 2:
        		return new Ajax({ dom_id: arguments[0], url: arguments[1], args: arguments[2] });
        	    break;
        	case 3:
        		return new Ajax({ dom_id: arguments[0], url: arguments[1], args: arguments[2], success: arguments[3] });
        	    break;
        }
        return;
    },

	// Submit a form using AJAX : the "form" entry is required
	Ajax_Submit = function() {
		var _args = arguments[0];
        if( is_null(_args.form) || _args.form.nodeName.toLowerCase()!=='form' ) {
        	_first_dbg("[ ERROR ] Required argument 'form' in 'Ajax_Submit' call is not set or is not a form!");
        	return;
        }
        _args.data = _args.form.serialize();
        _args.url = _args.url || _args.form.action || document.location.href;
        _args.method = _args.method || _args.form.method || 'GET';
        if (is_null(_args.error)) {
	        _args.error = function() { return true; };
	    }
        $ajax = new Ajax(_args);
		return false;
	},

    _EmptyObject = function() {
		dom = window;
//      _request = null;
		_token_ = uniqid();
		_response = null;
		_req_statut = null;
		_loader = "../../img/indicator.gif";
	    _loader_alt_text = "Loading AJAX request ...";
	    _loader_style = "margin:1em";
	    _content_type = "application/x-www-form-urlencoded; charset=UTF-8";
	    _if_modified = false;
		_timeout = 0;
		_asynch = true;
		_url = null;
		_method = "GET";
		_args = null;
		_dom_id = null;
		_dom_disabled = false;
		_disabled_opacity = "0.4";
		_callback = {
			success:false, error:false
		};
		_format = "TEXT";
		_eval_js = true;
    },

	//---------------------------
	// Methods
	//---------------------------

	/**
	 * Initialize the request
	 * If the request is NOT asynchronous (asynch=false in the caller) the class
	 * skips the function 'onreadystatechange'
	 */
	 Ajax_init = function() {
    	if ( _dom_id ) {
    	    ShowLoader();
    	}
        InitializeRequest();
        if( _asynch !== true ) {
        	Commit();
        	if( _request ) {
	        	setTimeout(function() { 
    	    		_OnSuccess();
	    	   	}, 200);
	    	}
        }
        else {
        	setTimeout(function() { 
        		Commit(); 
	       	}, _timeout);
	    }
    },
	
    InitializeRequest = function() {
        _dbg("Entering 'InitializeRequest' : creation of request and attach listeners");
    	if (_request === null ) {
	        _request = _GetRequest();
	    }
	    _request.onreadystatechange = _StateHandler;
        // If get method, we add arguments at the URL
        if( _method === 'GET' && _args ) {
        	_url += "?"+_ParseArguments( _args );
        	_args = null;
        }
        _request.open( _method, _url, _asynch );
        _SetRequestHeader("X-Requested-With", "XMLHttpRequest");
        // If 'if modified'
        if( _if_modified ) {
			var curdate=new Date();
            _SetRequestHeader("If-Modified-Since", curdate.toGMTString());
        }
        // If post method, we mention a content-type by default
        if( _method=='POST' ) {              
            _SetRequestHeader("Content-Type", _content_type);
        }
    },

   Commit = function() {
        _dbg("Entering 'Commit' with data : "+dump(_args));
        if (_request) {
           return _request.send(_args);
        }
   },

   Close = function() {
        _dbg("Entering 'Close' : request abortion");
        if (_request) {
            _request.abort();
        }
   },

    ReturnResponse = function() { 
        _dbg("Entering 'ReturnResponse' : apply callback(s)");
        if( !is_null( _response ) ) {
		    if( _req_statut === 'error' && _callback.error ) {
		    	fn = (typeof _callback.error == "function") ? _callback.error : window[_callback.error];
                fn.apply( this, [_response, _request.status] );
                return;
            }
		    else if( _req_statut === 'success') {
		    	if( _callback.success ) {
			    	fn = (typeof _callback.success === "function") ? _callback.success : window[_callback.success];
    	            fn.apply( this, [_response, _request.status] );
        	        return;
    	        }
    	        else if ( _dom_id ) {
    	            LoadInDOM();
    	        }
            }
		    else if( _req_statut == 'unchanged' && _dom_id ) {
		    	LoadInDOM( true );
            }
            else {
                return _response;
            }
        }
    },

	LoadInDOM = function( _NoResponse ) {
		var content = '';
		if ( !_NoResponse && _format === 'TEXT' ) {
			content = _response;
			_dbg("[ DOM ] Trying to load request response to DOM object with ID '"+_dom_id+"'");
	    }
	    else if( _previous_content ) {
			content = _previous_content;
			_dbg("[ DOM ] Trying to reload previous content to DOM object with ID '"+_dom_id+"'");
	    }

		try {
			_dom_object = document.getElementById(_dom_id);
			_dom_object.innerHTML = content;
			if (_dom_disabled) {
		    	_dbg("Enabling content of DOM : "+_dom_id);
    	       	_dom_object.disabled = false;
    	       	_dom_object.className = _dom_object.className.replace(_disabled_class, '');
    	    }
		} catch(e) {
			_dbg("[ DOM Error ] DOM object with ID '"+_dom_id+"' not found !");
		}
	},
    
	ShowLoader = function() {
	    try {
			var _dom_object = document.getElementById(_dom_id);
			var _previous_content = _dom_object.innerHTML;
	    	var _loader_img = document.createElement("img");
		    var _pos = _dom_object.get_position();
console.debug(_pos);
console.debug(_dom_object);
var _pos_test = _dom_object.getOffset();
console.debug(_pos_test);
	    	_loader_img.src = _loader;
	    	_loader_img.style = _loader_style;
	    	_loader_img.alt = _loader_alt_text;
		    _loader_img.style.top = _pos[1]+"px";
			_loader_img.style.left = _pos[0]+"px";
			if (_dom_disabled) {
		    	var _loader_content = document.createElement("div");
		    	_loader_content.innerHTML = _previous_content;
			    _loader_content.style.top = _pos[1]+"px";
				_loader_content.style.left = _pos[0]+"px";
		    	_loader_content.style.position = "absolute";
		    	_loader_content.style.opacity = _disabled_opacity;
		    	_loader_content.style.filter = "alpha(opacity="+(_disabled_opacity*100)+")";
		    	_dbg("Disabling content of DOM : "+_dom_id);
    	       	_dom_object.disabled = true;
		    	_dbg("Adding loader in DOM : "+_loader_img);
		    	_loader_img.style.position = "absolute";
		    	_loader_img.style.opacity = "1";
		    	_loader_img.style.filter = "alpha(opacity=100)";
    	       	_dom_object.innerHTML = "";
    	       	_dom_object.appendChild( _loader_img );
    	       	_dom_object.appendChild( _loader_content );
			} else {
		    	_dbg("Showing loader in DOM : "+_loader_img);
    	       	_dom_object.innerHTML = "";
    	       	_dom_object.appendChild( _loader_img );
    	    }
	    } catch(e) { }
	},
    
   //---------------------------
   // Processing Request Declarations
   //---------------------------

    _GetRequest = function() {
    	var xhr_object;

        if(dom.XMLHttpRequest) {
            xhr_object = new XMLHttpRequest();
	        _dbg("Creation of a XMLHttpRequest object");
			if ( _format==='XML' && xhr_object.overrideMimeType ) {
				xhr_object.overrideMimeType('text/xml');
                _dbg("Overriding XMLHttpRequest object MimeType to 'text/xml'");
			}
        } 
        else if(dom.ActiveXObject) {
            for (var x=0; x<MS_XmlHttpObj.length; ++x) { // try each MS ActiveX object in turn
			    try {
				    xhr_object = new ActiveXObject( MS_XmlHttpObj[x] );
			        _dbg("Creation of an ActiveXObject object");
    				break;
	    		} catch (e) {
                    xhr_object = false;
                    _dbg("[ ERROR ] Instanciation error : "+e);
		    	}
    		}
        }
        else {
            xhr_object = false;
            _dbg("[ ERROR ] The current browser does not appear to support asynchronous requests ! ('XMLHttpRequest' or 'ActiveXObject' have not functioned) !");
        }

        return xhr_object;
    },

    _StateHandler = function() { 
      switch ( _request.readyState ) {
         case 0:
            window.setTimeout("void(0)", 100);
            _OnUninitialize();
            break;
         case 1:
            window.setTimeout("void(0)", 100);
            _OnLoading();
            break;
         case 2:
            window.setTimeout("void(0)", 100);
            _OnLoaded();
            break;
         case 3:
            window.setTimeout("void(0)", 100);
            _OnInteractive();
            break;
         case 4:
         	_response_headers = _request.getAllResponseHeaders();
         	_dbg("[ Response ] Getting a response with status '"+_request.status+" "+_request.statusText+"'\n Complete response headers : \n"+dump(_response_headers, true, 1));
            if (_request.status == 200) {
               _OnSuccess();
            }
            else if (_request.status == 304) {
               _OnSuccess(true);
            }
            else {
               _OnFailure();
            }
            return;
            break;
      }
    },

   _SetRequestHeader = function(field, value) {
        if ( !field || !value ) { return; }
        _dbg("Setting 'RequestHeader' for field '"+field+"' : value '"+value+"'");
        if ( _request ) {
            _request.setRequestHeader(field, value);
        }
   },
                  
   _GetResponseXML = function() {
      return (_request) ? _request.responseXML : null;
   },
       
   _GetResponseText = function() {
      return (_request) ? _request.responseText : null;
   },
   
   _GetResponseJson = function() {
      return (_request) ? _request.responseText : null;
   },
       
   _GetRequestObject = function() {
      return _request;
   },

    _ParseArguments = function(args) {
    	if( typeof(args) == 'string' ) { return args; }
		if(typeof(args) != 'object') { return; }
		var args_string = '';
		for(var item in args) {
			var value = args[item];
 			if(typeof(value) !== 'object') {
				args_string += item+'='+escape(value)+'&';
			}
		} 
		if( args_string.charAt(args_string.length-1)==='&' ) {
			args_string = args_string.substr(0, (args_string.length-1));
		}
		return args_string;
    },

	_evalJavascript = function() {
//		var _js_mask = "<script[^>]*>([^<"+"/script]*)<"+"/script>",
//		var _js_mask = "(<script[^>]*>)([^<"+"/script]*)(<"+"/script>)",
		var _js_mask = "<script[^>]*>([^<]*)<"+"/script>",
			_patrn = new RegExp(_js_mask.replace('/', '\/'), 'gim'),
			matches = _response.match(_patrn),
			js_code;
		if (matches) {
			for (i=0; i<matches.length; i++) {
				js_code = matches[i].replace(_patrn, "$1");
				if (js_code && js_code!=="") {
		    	     _dbg("Evaluating javascript globally from response : "+js_code);
		        	 // http://blog.client9.com/2008/11/javascript-eval-in-global-scope.html
					eval.call(null, js_code);
				}
			}
		}
	},

   //---------------------------
   // Event Declarations
   //---------------------------
   _OnUninitialize = function() { 
	    _req_statut = 'uninitialize';
   },

   _OnLoading = function() { 
	    _req_statut = 'loading';
   },

   _OnLoaded = function() { 
	    _req_statut = 'loaded';
   },

   _OnInteractive = function() { 
	    _req_statut = 'interactive';
   },

   _OnSuccess = function(_unchanged) {  
   		if( _unchanged ) {
		    _req_statut = 'unchanged';
		}
	    else {
	        _req_statut = 'success';
	    }
        switch (_format) {
         case 'TEXT' :
            _response = _GetResponseText();
	        _dbg("Response received : "+dump(_response));
	        if (_eval_js) { _evalJavascript(); }
            break;
         case 'XML' :
            _response = _GetResponseXML();
            _dbg("Response received : "+_response);
        	break;
         case 'JSON' :
            _response = _GetResponseJson();
            break;
        }
        return ReturnResponse();
   },

   _OnFailure = function() {  
	    _req_statut = 'error';
	    _response = " the request returned a "+_request.status+" status";
         _dbg("[ ERROR ] Response error | response status : "+_request.status);
        return ReturnResponse();
   },

   //---------------------------
   // Utilities
   //---------------------------
    is_null = function(input) {
        return input==null;
    },
    
    _dump = function(arr, nocut, level) {
        var dumped_text="";
        var level_padding="";
        if(!level) level=0;
        for(var j=0;j<level+1;j++) { level_padding+="    "; }
        if( is_null(arr) ) {
			dumped_text = "null";
        }
		else if(typeof(arr)=='object') {
			for(var item in arr) {
				var value=arr[item];
				if(typeof(value)=='object') {
					dumped_text += level_padding+"'"+item+"' ...\n";
					dumped_text += dump(value,nocut,level+1);
				} 
				else{
					if(typeof(value)!='function') 
						dumped_text += level_padding+"'"+item+"' => '"+value+"'\n";
				}
			}
		} 
		else {
			var tar = typeof(arr);
			if(tar == 'string' ) {
				if( nocut ) {
					var str = arr; 
				} else {
				    var str = ( arr.length > 120 ) ? arr.substr(0, 120)+" [...]" : arr;
				}
			    if( arr.length==0 )
			    	dumped_text = "(empty string)";
				else 
					dumped_text = "'"+str+"' ("+tar+") (length "+arr.length+")";
			}
			else dump_text = "'"+arr+"' ("+tar+")";
		}
		return dumped_text;
    },
    
    _first_dbg = function(str) {
        if (window.settings!==undefined && window.settings['debug']!==undefined && window.settings['debug']==false) {
            return;
        }
        if(window.console && window.console.log) {
            window.console.info("[ Ajax ] [ Version "+ClassVersion+" ] [ this.Token = '"+_token_+"' ]\n"+str);
        }
        else if(_alert === true) { alert(str); }
        else { return false; }
    }; 

    Element.prototype.get_position = function() {
		var left=0, top=0, e=this;
		while (e.offsetParent !== undefined && e.offsetParent !== null)
		{
			left += e.offsetLeft + (e.clientLeft !== null ? e.clientLeft : 0);
			top += e.offsetTop + (e.clientTop !== null ? e.clientTop : 0);
			e = e.offsetParent;
		}
		return [left,top];
    };

    return(
    	window.Ajax         = Ajax,
    	window.ajaxLoad     = ajaxLoad,
    	window.Ajax_Submit  = Ajax_Submit
    );
})(window);

// Endfile