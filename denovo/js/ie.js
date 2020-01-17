"use strict";

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _instanceof(left, right) { if (right != null && typeof Symbol !== "undefined" && right[Symbol.hasInstance]) { return !!right[Symbol.hasInstance](left); } else { return left instanceof right; } }

function _classCallCheck(instance, Constructor) { if (!_instanceof(instance, Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

let obj = {};
let arr = [];
obj.__proto__.forEach = arr.__proto__.forEach;
console.log(obj.__proto__)
console.log(arr.__proto__)

window.onload = function () {
  new classMultiplyWrapper(Slider, {
    selector: '.sertificat_box',
    infinity: true,
    navigationDotters: true,
    sizeWork: {
      desktop: false,
      touch: false,
      mobile: true
    }
  });
  new classMultiplyWrapper(SliderTalk, {
    selector: '.talk_slider',
    infinity: true,
    navigationArrows: true,
    slideClickRewind: true,
    multiDisplay: {
      mobile: 5,
      touch: 5,
      desktop: 5 //multiShift: true,

    }
  });
  new classMultiplyWrapper(SliderBanner, {
    selector: '.banner_slider',
    infinity: true,
    navigationDotters: true //autoShift: true,

  });
  document.addEventListener('click', clickItemHandler);
  document.addEventListener('mouseover', menuListHandler);
  new classMultiplyWrapper(FormValidate, {
    selector: '.form_validate'
  }); //emulateSelector('.select_emulator');

  new inputFileEmulator('.input_emulator-file');
  changeModelInfo();
  installVideoHeight();
  aboutTimerCountdown();
  hiddenScrollAside('.aside_body');
  window.addEventListener('resize', function () {
    return hiddenScrollAside('.aside_body');
  });
};

function classMultiplyWrapper(Cls, parametrs) {
  document.querySelectorAll(parametrs.selector).forEach(function (item) {
    parametrs.item = item;
    new Cls(parametrs);
  });
}

;

var Slider =
/*#__PURE__*/
function () {
  function Slider(params) {
    _classCallCheck(this, Slider);

    this.params = params;
    this.container = params.item;
    this.params.moveTime ? this.moveTime = this.params.moveTime : this.moveTime = 0.4;

    if (this.params.sizeWork) {
      this.sizeFlag = 0;
      this.checkSize(this.params.sizeWork);
      window.addEventListener('resize', this.checkSize.bind(this, this.params.sizeWork));
    }

    if (!this.sizeFlag) this.create();
    this.container.addEventListener('mousedown', this.mouseFlip.bind(this));
    this.container.addEventListener("touchstart", this.touchFlip.bind(this));
    window.addEventListener('resize', this.prepare.bind(this));
  }

  _createClass(Slider, [{
    key: "checkSize",
    value: function checkSize(p) {
      var trigger = false;
      var w = document.body.offsetWidth;
      if (p.desktop && w > 1100) trigger = true;
      if (p.touch && w > 768 && w <= 1100) trigger = true;
      if (p.mobile && w <= 768) trigger = true;

      if (trigger) {
        if (this.sizeFlag != 1) {
          this.sizeFlag = 1;
          this.create();
        }
      } else {
        var deleteElem = function deleteElem(elem) {
          if (elem) elem.remove();
        };

        this.sizeFlag = 2;
        if (!this.container.querySelector('.slider_box')) return;
        var box = this.container.querySelector('.slider_box');

        while (box.children[0]) {
          box.children[0].style.width = '100%';
          box.children[0].style.minWidth = '100%';
          this.container.append(box.children[0]);
        }

        box.remove();
        deleteElem(this.container.querySelector('.slider_block'));
        deleteElem(this.slider_nav);
        deleteElem(this.slider_arrow_right);
        deleteElem(this.slider_arrow_left);
        deleteElem(this.slider_counter);
      }
    }
  }, {
    key: "create",
    value: function create() {
      this.createSliderBox();
      if (this.params.navigationDotters && !this.params.multiDisplay) this.createSliderNavigationDotters();
      this.prepare();
      if (this.params.navigationArrows) this.createSliderNavigationArrows();
      if (this.params.navigationCounter && !this.params.multiDisplay) this.createSliderNavigationCounter();
      if (this.params.slideClickRewind) this.prepareSlidesOnclick();
      if (this.params.autoShift) this.changeSlidesAutomaticaly();
    }
  }, {
    key: "prepare",
    value: function prepare() {
      if (this.sizeFlag == 2) return;
      this.activeSlider = 0;
      this.slideOnScreen = 1;

      if (this.params.multiDisplay) {
        var w = document.body.offsetWidth;

        if (w > 0 && w <= 768) {
          this.slideOnScreen = this.params.multiDisplay.mobile;
        } else if (w > 768 && w <= 1100) {
          this.slideOnScreen = this.params.multiDisplay.touch;
        } else {
          this.slideOnScreen = this.params.multiDisplay.desktop;
        }
      }

      this.extendSlides();
      this.slideAll();
    }
  }, {
    key: "createSliderBox",
    value: function createSliderBox() {
      var _this = this;

      this.block = document.createElement('div');
      this.block.classList.add('slider_block');
      this.box = document.createElement('div');
      this.box.classList.add('slider_box');
      this.sliders = [].slice.call(this.container.children);
      this.sliders.forEach(function (item, i, arr) {
        item.classList.add('slider_slide');

        _this.box.append(item);
      });
      this.block.append(this.box);
      this.container.append(this.block);
      this.block.style.width = '100%';
      this.block.style.maxWidth = '100vw';
      this.block.style.overflow = 'hidden';
      this.box.style.display = 'flex';
      this.box.style.transition = "transform ".concat(this.moveTime, "s ease-in-out");
      this.box.style.webkitTransition = "-webkit-transform ".concat(this.moveTime, "s ease-in-out");
      this.box.style.transform = "translateX(0)";
      this.box.style.webkitTransform = "translateX(0)";
    }
  }, {
    key: "createSliderNavigationArrows",
    value: function createSliderNavigationArrows() {
      var _this2 = this;

      this.slider_arrow_right = document.createElement('div');
      this.slider_arrow_right.classList.add('slider_arrow','slider_arrow-right');
      this.slider_arrow_right.innerHTML = "<img src=\"img/slider_arrow_right.svg\" alt=\"\" />";

      this.slider_arrow_right.onclick = function () {
        return _this2.slideMove({
          direction: 'right'
        });
      }; //slider_arrow_right.ontouchstart = ()=> this.slideMove({direction: 'right'});


      this.container.append(this.slider_arrow_right);
      this.slider_arrow_left = document.createElement('div');
      this.slider_arrow_left.classList.add('slider_arrow','slider_arrow-left');
      this.slider_arrow_left.innerHTML = "<img src=\"img/slider_arrow_left.svg\" alt=\"\" />";

      this.slider_arrow_left.onclick = function () {
        return _this2.slideMove({
          direction: 'left'
        });
      }; //slider_arrow_left.ontouchstart = ()=> this.slideMove({direction: 'left'});


      this.container.append(this.slider_arrow_left);
    }
  }, {
    key: "createSliderNavigationCounter",
    value: function createSliderNavigationCounter() {
      this.slider_counter = document.createElement('div');
      this.slider_counter.classList.add('slider_counter');
      var numberStart = "01";
      var numberEnd = Math.ceil(this.sliders.length / this.slideOnScreen);
      numberEnd = numberEnd < 10 ? "0".concat(numberEnd) : numberEnd;
      this.slider_counter.innerHTML = "<span class=\"slider_counter_number slider_counter_number-start\">".concat(numberStart, "</span><span class=\"slider_counter_line\"></span><span class=\"slider_counter_number slider_counter_number-end\">").concat(numberEnd, "</span>");
      this.container.append(this.slider_counter);
    }
  }, {
    key: "changeSliderNavigationCounter",
    value: function changeSliderNavigationCounter() {
      var numberStart = Math.ceil(this.activeSlider / this.slideOnScreen) + 1;
      if (numberStart < 1) numberStart = 1;
      numberStart = numberStart < 10 ? "0".concat(numberStart) : numberStart;
      this.container.querySelectorAll('.slider_counter_number-start')[0].textContent = numberStart;
    }
  }, {
    key: "createSliderNavigationDotters",
    value: function createSliderNavigationDotters() {
      this.slider_nav = document.createElement('ul');
      this.slider_nav.classList.add('slider_nav');
      this.butts = [];

      for (var i = 0; i < this.sliders.length; i++) {
        var slider_nav_butt = document.createElement('li');
        slider_nav_butt.classList.add('slider_nav_butt');
        slider_nav_butt.style.transition = "all ".concat(this.moveTime, " ease-in-out");
        slider_nav_butt.dataset.number = i;
        this.butts.push(slider_nav_butt);
        this.slider_nav.append(slider_nav_butt);
      }

      this.container.addEventListener('click', func.bind(this)); //this.container.addEventListener('touchstart',func.bind(this));

      function func(event) {
        if (!event.target.closest('.slider_nav_butt')) return;
        var butt = event.target.closest('.slider_nav_butt');
        clearInterval(this.autoShift);
        return this.slideMove({
          counter: butt.dataset.number
        });
      }

      this.container.append(this.slider_nav);
    }
  }, {
    key: "changeSlidesAutomaticaly",
    value: function changeSlidesAutomaticaly() {
      var _this3 = this;

      this.autoShift = setInterval(function () {
        _this3.slideMove({
          direction: 'right'
        });
      }, this.moveTime * 20000);
    }
  }, {
    key: "extendSlides",
    value: function extendSlides() {
      var _this4 = this;

      this.boxWidth = this.box.offsetWidth / this.slideOnScreen;
      var d = this.boxWidth;
      var marginRight = 0;

      if (this.params.multiDisplay) {
        if (this.params.multiDisplay.marginRight) {
          var w = document.body.offsetWidth;

          if (w > 0 && w <= 700) {
            marginRight = this.params.multiDisplay.marginRight.mobile;
          } else if (w > 700 && w <= 1100) {
            marginRight = this.params.multiDisplay.marginRight.touch;
          } else {
            marginRight = this.params.multiDisplay.marginRight.desktop;
          }
        }

        d = this.boxWidth - marginRight * (this.slideOnScreen - 1) / this.slideOnScreen;
      }

      this.sliders.forEach(function (slide, i, arr) {
        slide.style.width = "".concat(d, "px");
        slide.style.minWidth = "".concat(d, "px");
        slide.dataset.number = i;
        if ((i + 1) % _this4.slideOnScreen) slide.style.marginRight = "".concat(marginRight, "px");
      });
    }
  }, {
    key: "slideAll",
    value: function slideAll(callback) {
      var _this5 = this;

      if (this.flagBlock) return;
      this.flagBlock = true;
      var n = 0;
      this.sliders.forEach(function (slide, i, arr) {
        if (slide.classList.contains('active')) {
          _this5.boxShift = -(i * _this5.boxWidth);
          _this5.box.style.transform = "translateX(".concat(_this5.boxShift, "px)");
          _this5.box.style.webkiteTransform = "translateX(".concat(_this5.boxShift, "px)");
          n = slide.dataset.number;
        }
      });
      if (n == 0) this.sliders[0].classList.add('active');
      if (n >= this.sliders.length) n = this.sliders.length - 1;

      if (this.params.navigationDotters) {
        this.butts.forEach(function (butt, i, arr) {
          butt.classList.remove('active');
          if (i == n) butt.classList.add('active');
        });
      }

      ;

      if (this.params.emulateDotters) {
        this.emulSlides = [].slice.call(document.querySelector(this.params.emulateDotters).children);
        this.emulSlides.forEach(function (item, i) {
          item.classList.remove('active');
        });
        this.emulSlides[n].classList.add('active');
      }

      setTimeout(function () {
        _this5.flagBlock = false;
        if (callback) callback();
        _this5.flagBlockSlide = false;
      }, this.moveTime * 1000);
    }
  }, {
    key: "slideMove",
    value: function slideMove(params) {
      if (this.flagBlockSlide) return;
      this.flagBlockSlide = true;
      this.installActiveSlider();

      if (this.params.multiDisplay && this.params.multiDisplay.multiShift) {
        var m = this.sliders.length - this.sliders.length % this.slideOnScreen;
        if (m == this.sliders.length) m = this.sliders.length - this.slideOnScreen;
        if (params.direction == 'right') this.activeSlider += this.slideOnScreen;
        if (params.direction == 'left') this.activeSlider -= this.slideOnScreen;
        if (params.counter != undefined) this.activeSlider = params.counter;

        if (this.params.infinity) {
          this.infinitySlideWork.call(this);
        } else {
          if (this.activeSlider >= m) this.activeSlider = m;
          if (this.activeSlider < 0) this.activeSlider = 0;
        }

        this.installActiveSlider(this.activeSlider);
        this.slideAll();
      } else {
        if (params.direction == 'right') this.activeSlider++;
        if (params.direction == 'left') this.activeSlider--;
        if (params.counter != undefined) this.activeSlider = params.counter;

        if (this.params.infinity) {
          this.infinitySlideWork.call(this);
        } else {
          if (this.activeSlider > this.sliders.length - 1) this.activeSlider = this.sliders.length - 1;
          if (this.activeSlider < 0) this.activeSlider = 0;
          this.sliders[this.activeSlider].classList.add('active');
          this.slideAll();
        }
      }

      if (this.params.navigationCounter) this.changeSliderNavigationCounter();
    }
  }, {
    key: "installActiveSlider",
    value: function installActiveSlider(n) {
      var _this6 = this;

      this.sliders = [].slice.call(this.box.children);

      if (n || n === 0) {
        this.sliders.forEach(function (slide, i, arr) {
          slide.classList.remove('active');
        });
        this.activeSlider = n;
        this.sliders[n].classList.add('active');
      } else {
        this.sliders.forEach(function (slide, i, arr) {
          if (slide.classList.contains('active')) _this6.activeSlider = i;
          slide.classList.remove('active');
        });
      }
    }
  }, {
    key: "infinitySlideWork",
    value: function infinitySlideWork() {
      var _this7 = this;

      if (this.flagBlockInfinity) return;
      this.flagBlockInfinity = true;

      if (this.activeSlider > this.sliders.length - this.slideOnScreen) {
        var func0 = function func0() {
          this.box.style.transition = "";

          for (var _i = 0; _i < sr; _i++) {
            this.sliders[0].remove();
            this.sliders.shift();
          }

          this.installActiveSlider(this.activeSlider - sr);
          this.slideAll(func2.bind(this));

          function func2() {
            this.box.style.transition = "transform ".concat(this.moveTime, "s ease-in-out");
            this.box.style.webkiteTransition = "-webkite-transform ".concat(this.moveTime, "s ease-in-out");
            this.flagBlockInfinity = false;
          }
        };

        var sr = this.slideOnScreen - this.sliders.length + this.activeSlider;

        for (var i = 0; i < sr; i++) {
          var s = this.sliders[i].cloneNode(true);
          this.box.append(s);
        }

        this.sliders = [].slice.call(this.box.children);
        this.installActiveSlider(this.activeSlider);
        this.slideAll(func0.bind(this));
      } else if (this.activeSlider < 0) {
        var _func = function _func() {
          this.box.style.transition = "transform ".concat(this.moveTime, "s ease-in-out");
          this.box.style.webkiteTransition = "-webkite-transform ".concat(this.moveTime, "s ease-in-out");
          this.installActiveSlider(0);
          this.slideAll(func2.bind(this));

          function func2() {
            for (var _i3 = 0; _i3 < _sr; _i3++) {
              var _s2 = this.sliders[this.sliders.length - 1].remove();

              this.sliders.pop();
            }

            this.installActiveSlider(0);
            this.flagBlockInfinity = false;
          }
        };

        var _sr = this.slideOnScreen;
        if (!this.params.multiShift) _sr = 1;
        this.box.style.transition = "";

        for (var _i2 = 0; _i2 < _sr; _i2++) {
          var _s = this.sliders[this.sliders.length - _i2 - 1].cloneNode(true);

          this.box.prepend(_s);
        }

        this.sliders = [].slice.call(this.box.children);
        this.installActiveSlider(_sr);
        this.slideAll(_func.bind(this));
      } else {
        this.installActiveSlider(this.activeSlider);
        this.slideAll(function () {
          return _this7.flagBlockInfinity = false;
        });
      }
    }
  }, {
    key: "prepareSlidesOnclick",
    value: function prepareSlidesOnclick() {
      this.container.addEventListener('click', func.bind(this));

      function func(event) {
        var _this8 = this;

        if (!event.target.closest('.slider_slide')) return;
        var slide = event.target.closest('.slider_slide');
        var number = +slide.dataset.number;
        this.sliders.forEach(function (slide) {
          return slide.classList.remove('active');
        });

        if (this.params.infinity) {
          this.sliders.forEach(function (item, i) {
            item.classList.remove('active');

            if (item == slide) {
              item.classList.add('active');

              _this8.installActiveSlider(i);
            }
          });
          this.infinitySlideWork();
        } else {
          this.installActiveSlider(slide.dataset.number);
          this.slideAll();
        }
      }
    }
  }, {
    key: "mouseFlip",
    value: function mouseFlip(event) {
      event.preventDefault();
      var mousePointStart = event.clientX;
      var mousePointCurrent = 0;
      var mouseMoveBinded = mouseMove.bind(this);

      function mouseMove(event) {
        event.preventDefault();
        clearInterval(this.autoShift);
        mousePointCurrent = event.clientX;
        var m = mousePointCurrent - mousePointStart;

        if (m < -document.body.offsetWidth / 4) {
          this.slideMove({
            direction: 'right'
          });
          mousePointStart = mousePointCurrent;
          mouseUp.call(this, event);
        } else if (m > document.body.offsetWidth / 4) {
          this.slideMove({
            direction: 'left'
          });
          mousePointStart = mousePointCurrent;
          mouseUp.call(this, event);
        }
      }

      function mouseUp(event) {
        event.preventDefault();
        this.container.removeEventListener('mousemove', mouseMoveBinded);
        mousePointStart = 0;
        mousePointCurrent = 0;
      }

      this.container.addEventListener('mousemove', mouseMoveBinded);
      this.container.addEventListener('mouseup', mouseUp.bind(this));
    }
  }, {
    key: "touchFlip",
    value: function touchFlip(event) {
      var touchPointStart = event.changedTouches['0'].screenX;
      var touchPointCurrent = 0;
      var touchMoveBinded = touchMove.bind(this);
      var touchEndBinded = touchEnd.bind(this);
      this.touchTimeStart = +new Date();

      function touchMove(event) {
        touchPointCurrent = event.changedTouches['0'].screenX;
        var m = touchPointCurrent - touchPointStart;

        if (m >= document.body.offsetWidth / 4) {
          event.preventDefault();
          clearInterval(this.autoShift);
          this.slideMove({
            direction: 'left'
          });
          touchPointStart = touchPointCurrent;
          touchEndBinded(event);
        } else if (m <= -document.body.offsetWidth / 4) {
          event.preventDefault();
          clearInterval(this.autoShift);
          this.slideMove({
            direction: 'right'
          });
          touchPointStart = touchPointCurrent;
          touchEndBinded(event);
        }
      }

      function touchEnd(event) {
        event.preventDefault();
        this.container.removeEventListener('touchmove', touchMoveBinded);
        this.container.removeEventListener('touchend', touchEndBinded);
        touchPointStart = 0;
        touchPointCurrent = 0;
        this.touchTimeEnd = +new Date();

        if (this.touchTimeEnd - this.touchTimeStart > 10) {
          event.target.click();
        }
      }

      this.container.addEventListener('touchmove', touchMoveBinded);
      this.container.addEventListener('touchend', touchEndBinded);
      this.container.addEventListener('touchcancel', touchEndBinded);
    }
  }]);

  return Slider;
}();

;

var SliderTalk =
/*#__PURE__*/
function (_Slider) {
  _inherits(SliderTalk, _Slider);

  function SliderTalk(params) {
    _classCallCheck(this, SliderTalk);

    return _possibleConstructorReturn(this, _getPrototypeOf(SliderTalk).call(this, params));
  }

  _createClass(SliderTalk, [{
    key: "prepare",
    value: function prepare() {
      this.activeSlider = 0;
      this.rightPart = this.container.closest('.talk_box').querySelector('.talk_right');
      this.mainImage = this.container.closest('.talk_box').querySelector('.talk_image-main img');
      this.slideOnScreen = 1;

      if (this.params.multiDisplay) {
        var w = document.body.offsetWidth;

        if (w > 0 && w <= 768) {
          this.slideOnScreen = this.params.multiDisplay.mobile;
        } else if (w > 768 && w <= 1100) {
          this.slideOnScreen = this.params.multiDisplay.touch;
        } else {
          this.slideOnScreen = this.params.multiDisplay.desktop;
        }
      }

      this.extendSlides();
      this.slideAll();
    }
  }, {
    key: "slideAll",
    value: function slideAll(callback) {
      var _this9 = this;

      if (this.flagBlock) return;
      this.flagBlock = true;
      var n = 0;
      this.sliders.forEach(function (slide, i, arr) {
        if (slide.classList.contains('active')) {
          _this9.boxShift = -(i * _this9.boxWidth);
          _this9.box.style.transform = "translateX(".concat(_this9.boxShift, "px)");
          _this9.box.style.webkiteTransform = "translateX(".concat(_this9.boxShift, "px)");
          n = slide.dataset.number;
        }
      });
      if (n == 0) this.sliders[0].classList.add('active');
      if (n >= this.sliders.length) n = this.sliders.length - 1;

      if (this.params.navigationDotters) {
        this.butts.forEach(function (butt, i, arr) {
          butt.classList.remove('active');
          if (i == n) butt.classList.add('active');
        });
      }

      ;

      if (this.params.emulateDotters) {
        this.emulSlides = [].slice.call(document.querySelector(this.params.emulateDotters).children);
        this.emulSlides.forEach(function (item, i) {
          item.classList.remove('active');
        });
        this.emulSlides[n].classList.add('active');
      }

      setTimeout(function () {
        _this9.flagBlock = false;
        if (callback) callback();

        _this9.changeSlideContent();

        _this9.flagBlockSlide = false;
      }, this.moveTime * 1000);
    }
  }, {
    key: "changeSlideContent",
    value: function changeSlideContent() {
      this.rightPart.innerHTML = this.sliders[this.activeSlider].querySelector('.talk_text').innerHTML;
      this.mainImage.src = this.sliders[this.activeSlider].querySelector('img').src;
    }
  }]);

  return SliderTalk;
}(Slider);

;

var SliderBanner =
/*#__PURE__*/
function (_Slider2) {
  _inherits(SliderBanner, _Slider2);

  function SliderBanner(params) {
    _classCallCheck(this, SliderBanner);

    return _possibleConstructorReturn(this, _getPrototypeOf(SliderBanner).call(this, params));
  }

  _createClass(SliderBanner, [{
    key: "prepare",
    value: function prepare() {
      this.activeSlider = 0;
      this.slideOnScreen = 1;

      if (this.params.multiDisplay) {
        var w = document.body.offsetWidth;

        if (w > 0 && w <= 768) {
          this.slideOnScreen = this.params.multiDisplay.mobile;
        } else if (w > 768 && w <= 1100) {
          this.slideOnScreen = this.params.multiDisplay.touch;
        } else {
          this.slideOnScreen = this.params.multiDisplay.desktop;
        }
      }

      this.extendSlides();
      this.extendNavs();
      this.slideAll();
    }
  }, {
    key: "createSliderBox",
    value: function createSliderBox() {
      var _this10 = this;

      this.block = document.createElement('div');
      this.block.classList.add('slider_block');
      this.box = document.createElement('div');
      this.box.classList.add('slider_box');
      this.sliders = [].slice.call(this.container.children);
      this.sliders.forEach(function (item, i, arr) {
        item.classList.add('slider_slide');

        _this10.box.append(item);
      });
      this.block.append(this.box);
      this.container.append(this.block);
      this.block.style.width = '100%';
      this.block.style.maxWidth = '100vw';
      this.block.style.overflow = 'hidden';
      this.box.style.display = 'flex';
      this.box.style.transition = "transform ".concat(this.moveTime, "s ease-in-out");
      this.box.style.webkitTransition = "-webkit-transform ".concat(this.moveTime, "s ease-in-out");
      this.box.style.transform = "translateX(0)";
      this.box.style.webkitTransform = "translateX(0)";
      this.parent = this.container.closest('.main-block');
      this.nav = this.parent.querySelector('.banner_nav');
      this.navList = [].slice.call(this.nav.children);
      this.navList.forEach(function (item) {
        item.onclick = function (event) {
          _this10.sliders.forEach(function (slide, i) {
            if (slide.dataset.number == item.dataset.number) _this10.installActiveSlider(i);
          });

          _this10.slideAll();
        };
      });
    }
  }, {
    key: "extendNavs",
    value: function extendNavs() {
      var d = this.box.offsetWidth / this.navList.length;
      this.navList.forEach(function (nav) {
        nav.style.width = "".concat(d, "px");
        nav.style.minWidth = "".concat(d, "px");
      });
    }
  }, {
    key: "slideAll",
    value: function slideAll(callback) {
      var _this11 = this;

      if (this.flagBlock) return;
      this.flagBlock = true;
      var n = 0;
      this.sliders.forEach(function (slide, i, arr) {
        if (slide.classList.contains('active')) {
          _this11.boxShift = -(i * _this11.boxWidth);
          _this11.box.style.transform = "translateX(".concat(_this11.boxShift, "px)");
          _this11.box.style.webkiteTransform = "translateX(".concat(_this11.boxShift, "px)");
          n = slide.dataset.number;
        }
      });
      if (n == 0) this.sliders[0].classList.add('active');
      if (n >= this.sliders.length) n = this.sliders.length - 1;

      if (this.params.navigationDotters) {
        this.butts.forEach(function (butt, i, arr) {
          butt.classList.remove('active');
          if (i == n) butt.classList.add('active');
        });
      }

      ;

      if (this.params.emulateDotters) {
        this.emulSlides = [].slice.call(document.querySelector(this.params.emulateDotters).children);
        this.emulSlides.forEach(function (item, i) {
          item.classList.remove('active');
        });
        this.emulSlides[n].classList.add('active');
      }

      this.navList.forEach(function (item) {
        item.classList.remove('active');
        if (item.dataset.number == _this11.sliders[_this11.activeSlider].dataset.number) item.classList.add('active');
      });
      setTimeout(function () {
        _this11.flagBlock = false;
        if (callback) callback();
        _this11.flagBlockSlide = false;
      }, this.moveTime * 1000);
    }
  }]);

  return SliderBanner;
}(Slider);

;

function clickItemHandler(event) {
  if (!event.target.closest('.click-item')) return;
  var item = event.target.closest('.click-item');
  var obj = {
    'toggle': function toggle(target) {
      target.closest('.click-obj').classList.toggle('active');
    },
    'toggle-menu': function toggleMenu(target) {
      var obj = target.closest('.click-obj');
      obj.classList.toggle('active');

      if (obj.classList.contains('active')) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.overflow = 'auto';
      }
    },
    'remove': function remove(target) {
      target.closest('.click-obj').remove();
    },
    'popup-open': function popupOpen(target) {
      document.querySelector(target.dataset.label).classList.add('active');
    },
    'popup-close': function popupClose(target) {
      if (target.dataset.label) {
        document.querySelector(target.dataset.label).classList.remove('active');
      } else {
        target.closest('.popup-container').classList.remove('active');
      }
    },
    'open-lightbox': function openLightbox(target) {
      if (document.body.clientWidth < 769) return;
      target.classList.add('lightbox_target');
      var container = document.createElement('div');
      container.classList.add('lightbox_container','click-obj');
      container.innerHTML = "<div class=\"lightbox_background\"></div>\n\t\t\t\t\t\t\t\t<div class=\"lightbox\">\n\t\t\t\t\t\t\t\t\t<div class=\"lightbox_close click-item\" data-action=\"remove\">\t\t\n\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-times\"></i>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"lightbox_arrow lightbox_arrow-left click-item\" data-action=\"switch_lightbox\" data-direction=\"-1\">\n\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-arrow-left\"></i>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"lightbox_arrow lightbox_arrow-right click-item\" data-action=\"switch_lightbox\" data-direction=\"1\">\n\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-arrow-right\"></i>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<img class=\"active\" src=\"".concat(target.src, "\" alt=\"\" />\n\t\t\t\t\t\t\t\t</div>");
      document.body.append(container);
    },
    'switch_lightbox': function switch_lightbox(target) {
      var lightbox = target.closest('.lightbox');
      var img = lightbox.querySelector('img');
      var arr = document.querySelector('.lightbox_target').closest('.lightbox_box').querySelectorAll('.lightbox_item img');
      var direction = target.dataset.direction;

      for (var i = 0; i < arr.length; i++) {
        if (arr[i].classList.contains('lightbox_target')) {
          arr[i].classList.remove('lightbox_target');
          var n = i + +direction;
          if (n >= arr.length) n = 0;
          if (n < 0) n = arr.length - 1;
          arr[n].classList.add('lightbox_target');
          img.src = arr[n].src;
          img.classList.remove('active');
          setTimeout(function () {
            return img.classList.add('active');
          }, 0);
          break;
        }
      }
    },
    'video-start': function videoStart(target) {
      var obj = target.closest('.click-obj');
      obj.classList.add('active');
      var video = obj.querySelector('video');
      video.play();
    },
    'video-stop': function videoStop(target) {
      var obj = target.closest('.click-obj');
      obj.classList.remove('active');
      target.pause();
    }
  };

  if (item.dataset.action) {
    var actions = item.dataset.action.split(' ');
    actions.forEach(function (action) {
      return obj[action](item);
    });
  } else {
    obj['toggle'](item);
  }
}

;

function changeModelInfo() {
  document.querySelectorAll('.model').forEach(function (container) {
    var box = container.querySelectorAll('.model_list');
    var list = container.querySelectorAll('.model_item');
    var high = container.querySelector('.model_highlight');
    var text = container.querySelector('.model_description_content');
    list[0].classList.add('active');
    list.forEach(function (item) {
      item.onclick = function (event) {
        var target = event.target.closest('.model_item');
        if (target.classList.contains('active')) return;
        list.forEach(function (item) {
          return item.classList.remove('active');
        });
        target.classList.add('active');
        func1();
      };
    });

    function func1() {
      var target = container.querySelector('.model_item.active');
      text.innerHTML = target.querySelector('.model_text').innerHTML;
      text.classList.remove('active');
      setTimeout(function () {
        return text.classList.add('active');
      });
      var boxPosition = container.getBoundingClientRect();
      high.style.top = "".concat(target.getBoundingClientRect().top - boxPosition.top, "px");
      high.style.height = "".concat(getComputedStyle(target).height);
    }

    ;
    func1();
  });
}

;

function installVideoHeight() {
  document.querySelectorAll('.video_box').forEach(function (item) {
    var video;

    if (item.querySelector('video')) {
      video = item.querySelector('video');
    } else if (item.querySelector('iframe')) {
      video = item.querySelector('iframe');
    }

    ;
    var p = 56.25;

    if (video) {
      p = video.height / video.width * 100;
    }

    item.style.paddingBottom = "".concat(p, "%");
  });
}

;

function aboutTimerCountdown() {
  var timer = document.getElementById('about_timer');
  timer.style.hidden = false;
  var days = timer.querySelector('#about_days .about_timer_number');
  var hours = timer.querySelector('#about_hours .about_timer_number');
  var minutes = timer.querySelector('#about_minutes .about_timer_number');
  var seconds = timer.querySelector('#about_seconds .about_timer_number');
  var begin = new Date();
  begin.setFullYear(2011, 1, 1);
  begin.setHours(2, 0, 0);

  function calc() {
    var n = new Date();
    days.textContent = parseInt((n - begin) / 24 / 3600000);
    hours.textContent = n.getHours() - begin.getHours();
    minutes.textContent = n.getMinutes() - begin.getMinutes();
    seconds.textContent = n.getSeconds() - begin.getSeconds();
  }

  calc();
  setInterval(calc, 1000);
}

;

var FormValidate =
/*#__PURE__*/
function () {
  function FormValidate(params) {
    _classCallCheck(this, FormValidate);

    this.form = params.item;
    this.status = false;
    this.items = this.form.querySelectorAll('.form_validate_item');
    this.submit = this.form.querySelector('.form_validate_submit');
    this.submit.disabled = true;
    this.form.addEventListener('input', this.checkInputsPattern.bind(this));
    this.form.addEventListener('change', this.checkInputsPattern.bind(this));
    this.form.addEventListener('input', this.validatePhone.bind(this));
  }

  _createClass(FormValidate, [{
    key: "checkInputsPattern",
    value: function checkInputsPattern(event) {
      if (event.target.tagName.toLowerCase() != 'input') return;
      var eType = event.target.type.toLowerCase();
      if (!(event.target.required && event.target.dataset.pattern) && !(eType == 'checkbox' || eType == 'radio') && !(eType == 'file')) return;
      var target = event.target;
      var regexp = new RegExp(target.dataset.pattern);

      if (event.type == 'input') {
        if (this.testValue(target)) this.changeClassList(target, true);
      } else if (event.type == 'change') {
        this.testValue(target) ? this.changeClassList(target, true) : this.changeClassList(target, false);

        if (eType == 'checkbox' || eType == 'radio') {
          if (event.target.name) {
            var flag = false;
            var counter = 0;
            this.form.querySelectorAll("input[name=".concat(target.name, "]")).forEach(function (item) {
              if (item.checked) {
                flag = true;
                counter++;
              }
            });

            if (flag) {
              this.changeClassList(target, true);
            } else {
              this.changeClassList(target, false);
            }

            if (!target.closest('.order_select')) return;
            if (!target.closest('.order_select').querySelector('.order_select_num')) return;
            target.closest('.order_select').querySelector('.order_select_num').textContent = counter;
          } else {
            if (target.checked) {
              this.changeClassList(target, true);
            } else {
              this.changeClassList(target, false);
            }
          }
        }

        this.checkItems();
      }
    }
  }, {
    key: "testValue",
    value: function testValue(target) {
      var regexp = new RegExp(target.dataset.pattern);
      var result = true;
      if (!regexp.test("".concat(target.value))) result = false;
      if (target.dataset.min && target.value.length < +target.dataset.min) result = false;
      if (target.dataset.max && target.value.length > +target.dataset.max) result = false;
      return result;
    }
  }, {
    key: "changeClassList",
    value: function changeClassList(target) {
      var direction = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

      if (direction) {
        target.closest('.form_validate_item').classList.remove('invalid');
        target.classList.remove('invalid');
      } else {
        target.closest('.form_validate_item').classList.add('invalid');
        target.classList.add('invalid');
      }
    }
  }, {
    key: "checkItems",
    value: function checkItems() {
      var _this12 = this;

      this.status = true;
      this.items.forEach(function (item) {
        if (item.classList.contains('invalid') || !item.querySelector('input').value) _this12.status = false;
      });

      if (this.status) {
        this.submit.disabled = false;
      } else {
        this.submit.disabled = true;
      }
    }
  }, {
    key: "validatePhone",
    value: function validatePhone() {
      if (!(event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel')) return;
      event.target.value = event.target.value.replace(/\D/g, "");

      if (event.target.value.slice(0, 3) != '380') {
        event.target.value = "380".concat(event.target.value.slice(3));
      }
    }
  }]);

  return FormValidate;
}();

;

var inputFileEmulator = function inputFileEmulator(selector) {
  _classCallCheck(this, inputFileEmulator);

  document.querySelectorAll(selector).forEach(function (box) {
    var input = box.querySelector('input');
    var label = box.querySelector('label');
    var acceptArr;
    if (input.getAttribute('accept')) acceptArr = input.getAttribute('accept').split('/');
    input.addEventListener('change', function (e) {
      var fileName = '';

      if (this.files && this.files.length > 1) {
        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
      } else {
        fileName = e.target.value.split('\\').pop();
      }

      if (fileName) label.innerHTML = "<span>".concat(fileName, "</span>");

      if (acceptArr) {
        var n = fileName.slice(fileName.lastIndexOf('.') + 1);
        var result = acceptArr.findIndex(function (item) {
          return item == n;
        });

        if (result == -1) {
          input.value = '';
          label.innerHTML = "<span>\u041D\u0435\u0432\u0435\u0440\u043D\u044B\u0439 \u0444\u043E\u0440\u043C\u0430\u0442 \u0444\u0430\u0439\u043B\u0430</span>";
        }
      }
    });
  });
};

;

function hiddenScrollAside(selector) {
  document.querySelectorAll(selector).forEach(function (box) {
    if (document.body.clientWidth > 1100) {
      box.classList.add('scroll-emul_block');

      var _cont = box.querySelector('.scroll-emul_container');

      if (!box.children[0].classList.contains('scroll-emul_container')) {
        var scrollContent = function scrollContent(e) {
          line_item.style.top = "".concat(e.target.scrollTop / contentFullHeight * 100, "%");
        };

        _cont = document.createElement('div');
        _cont.classList.add('scroll-emul_container');
        var content = document.createElement('div');
        content.classList.add('scroll-emul_content');

        while (box.children.length) {
          content.append(box.children[0]);
        }

        var line = document.createElement('div');
        line.classList.add('scroll-emul_line');
        var line_item = document.createElement('div');
        line_item.classList.add('scroll-emul_line_item');

        _cont.append(content);

        line.append(line_item);

        _cont.append(line);

        box.append(_cont);
        content.style.width = "calc(100% + ".concat(content.offsetWidth - content.clientWidth - content.clientLeft, "px)");
        var contentFullHeight = 0;

        for (var i = 0; i < content.children.length; i++) {
          contentFullHeight += parseFloat(content.children[i].offsetHeight);
        }

        ;
        var line_itemHeight = parseFloat(content.offsetHeight) / contentFullHeight * 100;
        line.hidden = line_itemHeight >= 100;
        line_item.style.height = "".concat(line_itemHeight, "%");
        content.addEventListener('scroll', scrollContent);
      } else {}
    } else {
      if (!box.children[0].classList.contains('scroll-emul_container')) return;
      box.classList.remove('scroll-emul_block');

      var _content = box.querySelector('.scroll-emul_content');

      while (_content.children.length) {
        box.append(cont.children[0]);
      }

      box.querySelector('.scroll-emul_container').remove();
    }
  });
}

;

function menuListHandler(event) {
  if (!event.target.closest('.aside_item.click-obj')) return;
  var item = event.target.closest('.aside_item');
  var p = item.querySelector('.aside_item_list');
  p.style.top = "".concat(item.getBoundingClientRect().top, "px");
}

;