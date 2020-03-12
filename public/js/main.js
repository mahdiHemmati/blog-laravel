/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $(".slide").mouseenter(function () {
    $(this).animate({
      width: '+=10px'
    });
    $(this).toggleClass("shadow"); //add shadow class to this
  });
  $(".slide").mouseleave(function () {
    $(this).animate({
      width: '-=10px'
    });
    $(this).toggleClass("shadow"); //remove shadow class from this
  });
  $(".slide").css({
    left: 20
  }) // Set the left to its calculated position
  .animate({
    "left": "0px"
  }, "slow"); // $("#index-search-form").

  $("#index-search-form").on('submit', function (e) {
    e.preventDefault();
    console.log($("#index-search-input").val()); // var search = $("#index-search-input").text();
    // $('#index-search-form').attr('action', "/posts/s/"+search );
  });
  $(".like").on('click', function (e) {
    // console.log(e)
    e.preventDefault();
    var isLike = e.target.parentElement.previousElementSibling == null;
    console.log(isLike);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); // var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
    // console.log(route);

    var postId = $("#post_id").text(); // console.log(postId);

    $.ajax({
      method: 'POST',
      url: route,
      data: {
        isLike: isLike,
        id: postId,
        _token: token
      },
      success: function success(data, textStatus, xhr) {
        console.log(data);
      },
      error: function error(xhr, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    }); // .done(function( data ) {
    //     if ( console && console.log ) {
    //         console.log( "Sample of data:", data );
    //     }
    // });
  }); //set height image equal to width
  //
  // $(window).on('resize', function(){
  //     var cw = $('.slide img').width();
  //     $('.slide').css({'height':cw+'px'});
  //     // $('.slide img').css({'height':cw+'px'});
  // });
  // let navbar = $(".navbar");
  // $(window).scroll(function (){
  //     if ($(window).scrollTop() > 300){
  //         navbar.addClass("sticky-top");
  //     }
  //     else {
  //         navbar.removeClass("sticky-top");
  //     }
  // });
});

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/main.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! G:\Xammp\htdocs\my-web-sites\lsapp\resources\js\main.js */"./resources/js/main.js");


/***/ })

/******/ });