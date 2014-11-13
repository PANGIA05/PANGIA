// Generated by CoffeeScript 1.4.0

/*
jQuery css-watch event Coffeescript v1.2 - 11/20/2012
http://github.com/leifcr/jquery-csswatch/
(c) 2012 Leif Ringstad

@author Leif Ringstad
@version 1.0

Licensed under the freeBSD license
*/


(function() {
  var ExecuteMethod,
    __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

  (function($, window, document) {
    /*
        Plugin constructor
    */

    var CssWatch;
    CssWatch = function(elem, options) {
      this.elem = elem;
      this.$elem = $(elem);
      this.options = options;
      this.cb_timer_id = null;
      this.cached_function_name = "";
      this.stop_requested = false;
    };
    /*
        Plugin prototype
    */

    CssWatch.prototype = {
      defaults: {
        event_name: "css-change",
        data_attr_name: "css-watch-data",
        use_event: true,
        callback: null,
        props: "",
        props_functions: {}
      },
      /*
            Initializer
      */

      init: function() {
        this.config = $.extend({}, this.defaults, this.options, this.metadata);
        this.config.props = this.splitAndTrimProps(this.config.props);
        if (this.config.props.length > 0) {
          this.setInitialData();
          this.start();
        }
        return this;
      },
      /*
            split and trim properties
      */

      splitAndTrimProps: function(props) {
        var arr, i, ret;
        arr = props.split(",");
        ret = [];
        i = 0;
        while (i < arr.length) {
          ret.push(arr[i].trim());
          i++;
        }
        return ret;
      },
      /*
            set initial data
      */

      setInitialData: function() {
        var i;
        i = 0;
        while (i < this.config.props.length) {
          this.setData(this.config.props[i], this.getPropertyValue(this.config.props[i]));
          i++;
        }
      },
      /*
            set a data element for a css property on the current element
      */

      setData: function(property, value) {
        return this.$elem.data("" + this.config.data_attr_name + "-" + property, value);
      },
      /*
            update data attributes from changes
      */

      updateDataFromChanges: function(changes) {
        var property, value, _i, _len, _ref;
        _ref = Object.keys(changes);
        for (value = _i = 0, _len = _ref.length; _i < _len; value = ++_i) {
          property = _ref[value];
          this.setData(property, changes[property]);
        }
      },
      /*
            get the datavalue stored for a property
      */

      getDataValue: function(property) {
        return this.$elem.data("" + this.config.data_attr_name + "-" + property);
      },
      /*
            get css property value (from jquery css or from custom function if needed)
      */

      getPropertyValue: function(property) {
        var keys;
        if ((this.cached_function_name === null) || (Object.keys(this.config.props_functions).length === 0)) {
          return this.$elem.css(property);
        }
        if (this.cached_function_name === "") {
          keys = Object.keys(this.config.props_functions);
          if (__indexOf.call(keys, property) >= 0) {
            this.cached_function_name = this.config.props_functions[property];
          } else {
            this.cached_function_name === null;
          }
        }
        if ((this.cached_function_name !== "") && (this.cached_function_name !== null)) {
          if (window.ExecuteMethod) {
            return ExecuteMethod.executeMethodByFunctionName(this.cached_function_name, this.$elem);
          } else {
            return console.log("You are missing the ExecuteMethod library.");
          }
        } else {
          return this.$elem.css(property);
        }
      },
      /*
            get object of changes
      */

      changedProperties: function() {
        var i, ret;
        i = 0;
        ret = {};
        while (i < this.config.props.length) {
          if (this.getPropertyValue(this.config.props[i]) !== this.getDataValue(this.config.props[i])) {
            ret[this.config.props[i]] = this.getPropertyValue(this.config.props[i]);
          }
          i++;
        }
        return ret;
      },
      /*
            stop csswatch / checking of css attributes
      */

      stop: function() {
        var stop_requested;
        if (typeof this.config === "undefined" || this.config === null) {
          return;
        }
        stop_requested = true;
        return window.cssWatchCancelAnimationFrame(this.cb_timer_id);
      },
      /*
            start csswatch / checking of css attributes
      */

      start: function() {
        var _this = this;
        if (typeof this.config === "undefined" || this.config === null) {
          return;
        }
        this.stop_requested = false;
        this.cb_timer_id = window.cssWatchRequestAnimationFrame(function() {
          _this.check();
        });
      },
      /*
            the actual checking of changes
      */

      check: function() {
        var changes,
          _this = this;
        if (typeof this.config === "undefined" || this.config === null) {
          return false;
        }
        if (this.stop_requested === true) {
          return false;
        }
        changes = this.changedProperties();
        if (Object.keys(changes).length > 0) {
          if (this.config.use_event) {
            this.$elem.trigger(this.config.event_name, changes);
          }
          if (this.config.callback !== null) {
            this.config.callback.apply(null, [changes]);
          }
          this.updateDataFromChanges(changes);
        }
        this.cb_timer_id = window.cssWatchRequestAnimationFrame(function() {
          _this.check();
        });
        return false;
      },
      /*
           destroy plugin (stop/remove data)
      */

      destroy: function() {
        this.stop();
        this.$elem.removeData("css-watch-object");
        this.$elem.removeData(this.config.data_attr_name);
        return null;
      }
    };
    /*
       Set defaults
    */

    CssWatch.defaults = CssWatch.prototype.defaults;
    /*
       Jquery extension for plugin
       Plugin funcitonality is in the class above
    */

    $.fn.csswatch = function(options) {
      return this.each(function() {
        var data, obj;
        if (typeof options === "object" || !options) {
          data = $(this).data("css-watch-object");
          if (!data) {
            obj = new CssWatch(this, options);
            $(this).data("css-watch-object", obj);
            obj.init();
          }
        } else if (typeof options === "string") {
          obj = $(this).data("css-watch-object");
          if (obj && obj[options]) {
            return obj[options].apply(this);
          }
        }
      });
    };
  })(jQuery, window, document);

  /*
  #
  # Cross browser Object.keys implementation
  #
  # This is suggested implementation from Mozilla for supporting browser that do not implement Object.keys
  # if object doesn't have .keys function
  # if(!Object.keys) Object.keys = function(o){
  #    if (o !== Object(o))
  #       throw new TypeError('Object.keys called on non-object');
  #    var ret=[],p;
  #    for(p in o) if(Object.prototype.hasOwnProperty.call(o,p)) ret.push(p);
  #    return ret;
  # }
  */


  if (!Object.keys) {
    Object.keys = function(o) {
      var p, ret;
      if (o !== Object(o)) {
        throw new TypeError("Object.keys called on non-object");
      }
      ret = [];
      p = void 0;
      for (p in o) {
        if (Object.prototype.hasOwnProperty.call(o, p)) {
          ret.push(p);
        }
      }
      return ret;
    };
  }

  /*
    Cross browser requestAnimationFrame
    Not including settimeout as it will have a static value for timeout
  */


  if (!window.cssWatchRequestAnimationFrame) {
    window.cssWatchRequestAnimationFrame = (function() {
      return window.webkitAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || window.requestAnimationFrame || function(callback, element) {
        return window.setTimeout(callback, 1000 / 60);
      };
    })();
  }

  /*
    Cross browser cancelAnimationFrame
  */


  if (!window.cssWatchCancelAnimationFrame) {
    window.cssWatchCancelAnimationFrame = (function() {
      return window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.webkitCancelRequestAnimationFrame || window.mozCancelAnimationFrame || window.mozCancelRequestAnimationFrame || window.oCancelRequestAnimationFrame || window.msCancelRequestAnimationFrame || function(timeout_id) {
        return window.clearTimeout(timeout_id);
      };
    })();
  }

  /*
  # Execute Method
  # (c) 2012 Leif Ringstad
  # Licensed under the freeBSD license (see LICENSE.txt for details)
  #
  # Source: http://github.com/leifcr/execute_method
  # v 1.0.0
  */


  ExecuteMethod = {
    getFunctionsAndProperties: function(str) {
      var arr, i, ret;
      arr = str.split(".");
      i = 0;
      ret = [];
      while (i < arr.length) {
        ret.push(ExecuteMethod.getFunctionAndParameters(arr[i]));
        i++;
      }
      return ret;
    },
    getFunctionAndParameters: function(str) {
      var func, isfunc, params;
      if (ExecuteMethod.isFunction(str)) {
        params = str.substring(str.indexOf("(") + 1, str.indexOf(")"));
        if (params.length > 0) {
          params = ExecuteMethod.splitAndTypeCastParameters(params);
        } else {
          params = [];
        }
        func = str.substring(0, str.indexOf("\("));
        isfunc = true;
      } else {
        func = str;
        params = null;
        isfunc = false;
      }
      return {
        func: func,
        params: params,
        isfunc: isfunc
      };
    },
    splitAndTypeCastParameters: function(params) {
      var arr, i, ret;
      arr = params.split(",");
      ret = [];
      i = 0;
      ret = [];
      while (i < arr.length) {
        ret.push(ExecuteMethod.typecastParameter(arr[i]));
        i++;
      }
      return ret;
    },
    isFunction: function(str) {
      if (ExecuteMethod.regexIndexOf(str, /(\([\d|\D]+\))|(\(\))/, 0) !== -1) {
        return true;
      }
      return false;
    },
    regexIndexOf: function(string, regex, startpos) {
      var indexOf;
      indexOf = string.substring(startpos || 0).search(regex);
      if (indexOf >= 0) {
        return indexOf + (startpos || 0);
      } else {
        return indexOf;
      }
    },
    typecastParameter: function(param) {
      param = param.trim();
      param = param.replace(/^"/, "");
      param = param.replace(/"$/m, "");
      if (param.search(/^\d+$/) === 0) {
        return parseInt(param);
      } else if (param.search(/^\d+\.\d+$/) === 0) {
        return parseFloat(param);
      } else if (param === "false") {
        return false;
      } else if (param === "true") {
        return true;
      }
      return param;
    },
    executeSingleFunction: function(func, params, context, _that) {
      return context[func].apply(_that, params);
    },
    getSingleProperty: function(property, context) {
      return context[property];
    },
    /*
      # @param {String} Provide a string on what to execute (e.g. this.is.something(true).to_run() or myFunction().property or myFunction())
      # @param {Object} Provide a object to run the string provided on
      # @param {Object} Provide an object that points to the "this" pointer which
    */

    executeMethodByFunctionName: function(str, context) {
      var current_context, current_val, func_data, i;
      func_data = ExecuteMethod.getFunctionsAndProperties(str);
      i = 0;
      current_context = context;
      current_val = null;
      while (i < func_data.length) {
        if (func_data[i]["isfunc"] === true) {
          current_context = ExecuteMethod.executeSingleFunction(func_data[i]["func"], func_data[i]["params"], current_context, context);
        } else {
          current_context = ExecuteMethod.getSingleProperty(func_data[i]["func"], current_context);
        }
        i++;
      }
      return current_context;
    }
  };

  if (!String.prototype.trim) {
    String.prototype.trim = function() {
      return this.replace(/^\s+|\s+$/g, '');
    };
  }

  if (window.ExecuteMethod === "undefined" || window.ExecuteMethod === null || window.ExecuteMethod === void 0) {
    window.ExecuteMethod = ExecuteMethod;
  }

}).call(this);
