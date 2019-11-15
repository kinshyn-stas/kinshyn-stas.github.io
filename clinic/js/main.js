"use strict";

function _instanceof(left, right) { if (right != null && typeof Symbol !== "undefined" && right[Symbol.hasInstance]) { return !!right[Symbol.hasInstance](left); } else { return left instanceof right; } }

function _classCallCheck(instance, Constructor) { if (!_instanceof(instance, Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

window.onload = function () {
  new classMultiplyWrapper(Slider, {
    selector: '.offers_slider',
    infinity: true,
    navigationDotters: true
  });
  new classMultiplyWrapper(Slider, {
    selector: '.specialists_slider',
    infinity: true,
    multiDisplay: {
      mobile: 1,
      touch: 3,
      desktop: 5,
      multiShift: true
    },
    moveTime: 0.5
  });
  new classMultiplyWrapper(Calendar, {
    selector: '.calendar_container'
  });
  new classMultiplyWrapper(Calendar, {
    selector: '.rozklad_container',
    type: 'big'
  });
  document.addEventListener('click', clickItemHandler);
  document.addEventListener('change', togglePartForm);
  document.addEventListener('keydown', function (event) {
    if (event.target.tagName.toLowerCase() == 'input' && event.target.type == 'tel') {
      var keycode = event.keyCode;

      if (44 < keycode && keycode < 58 || keycode == 187 || keycode == 8 || keycode == 37 || keycode == 39) {} else {
        event.preventDefault();
      }

      ;
    }

    ;
  });
  emulateSelector('.select_emulator');
  new inputFileEmulator('.input_emulator-file');
  countTextareaSybmols('.textarea-count');
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

    this.container = params.item;
    this.params = params;
    params.moveTime ? this.moveTime = params.moveTime : this.moveTime = 0.4;
    this.createSliderBox();
    if (this.params.navigationDotters) this.createSliderNavigationDotters();
    this.prepare();
    if (this.params.navigationArrows) this.createSliderNavigationArrows();
    if (this.params.navigationCounter) this.createSliderNavigationCounter();
    if (this.params.slideClickRewind) this.prepareSlidesOnclick();
    this.box.addEventListener('mousedown', this.mouseFlip.bind(this));
    this.box.addEventListener("touchstart", this.touchFlip.bind(this));
    window.addEventListener('resize', this.prepare.bind(this));
  }

  _createClass(Slider, [{
    key: "prepare",
    value: function prepare() {
      this.activeSlider = 0;
      this.slideOnScreen = 1;

      if (this.params.multiDisplay) {
        var w = document.body.offsetWidth;

        if (w > 0 && w <= 700) {
          this.slideOnScreen = this.params.multiDisplay.mobile;
        } else if (w > 700 && w <= 1100) {
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
      this.block.classList = 'slider_block';
      this.box = document.createElement('div');
      this.box.classList = 'slider_box';
      this.sliders = [].slice.call(this.container.children);
      this.sliders.forEach(function (item, i, arr) {
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

      var slider_arrow_right = document.createElement('div');
      slider_arrow_right.classList = 'slider_arrow slider_arrow-right';
      slider_arrow_right.innerHTML = "<svg width=\"37\" height=\"36\" viewBox=\"0 0 37 36\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n\t\t<rect x=\"18.6445\" y=\"35.2929\" width=\"24.4558\" height=\"24.4558\" rx=\"3.5\" transform=\"rotate(-135 18.6445 35.2929)\"/>\n\t\t<path d=\"M17.2983 21.7448L21.3713 17.6718L17.2983 13.5989\" stroke-width=\"1.5\"/>\n\t\t</svg>";

      slider_arrow_right.onclick = function () {
        return _this2.slideMove({
          direction: 'right'
        });
      };

      this.container.append(slider_arrow_right);
      var slider_arrow_left = document.createElement('div');
      slider_arrow_left.classList = 'slider_arrow slider_arrow-left';
      slider_arrow_left.innerHTML = "<svg width=\"36\" height=\"36\" viewBox=\"0 0 36 36\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n\t\t<rect x=\"18\" y=\"0.707107\" width=\"24.4558\" height=\"24.4558\" rx=\"3.5\" transform=\"rotate(45 18 0.707107)\"/>\n\t\t<path d=\"M19.3462 14.2554L15.2733 18.3283L19.3462 22.4012\" stroke-width=\"1.5\"/>\n\t\t</svg>";

      slider_arrow_left.onclick = function () {
        return _this2.slideMove({
          direction: 'left'
        });
      };

      this.container.append(slider_arrow_left);
    }
  }, {
    key: "createSliderNavigationCounter",
    value: function createSliderNavigationCounter() {
      var slider_counter = document.createElement('div');
      slider_counter.classList = 'slider_counter';
      var numberStart = "01";
      var numberEnd = Math.ceil(this.sliders.length / this.slideOnScreen);
      numberEnd = numberEnd < 10 ? "0".concat(numberEnd) : numberEnd;
      slider_counter.innerHTML = "<span class=\"slider_counter_number slider_counter_number-start\">".concat(numberStart, "</span><span class=\"slider_counter_line\"></span><span class=\"slider_counter_number slider_counter_number-end\">").concat(numberEnd, "</span>");
      this.container.append(slider_counter);
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
      var _this3 = this;

      var slider_nav = document.createElement('ul');
      slider_nav.classList = 'slider_nav';
      this.butts = [];

      for (var i = 0; i < this.sliders.length; i++) {
        var slider_nav_butt = document.createElement('li');
        slider_nav_butt.classList = 'slider_nav_butt';
        slider_nav_butt.style.transition = "all ".concat(this.moveTime, " ease-in-out");
        slider_nav_butt.dataset.number = i;
        this.butts.push(slider_nav_butt);
      }

      this.butts.forEach(function (butt, i, arr) {
        butt.addEventListener('click', func.bind(_this3));
        slider_nav.append(butt);

        function func() {
          return this.slideMove({
            counter: butt.dataset.number
          });
        }
      });
      this.container.append(slider_nav);
    }
  }, {
    key: "extendSlides",
    value: function extendSlides() {
      var _this4 = this;

      this.boxWidth = this.box.offsetWidth / this.slideOnScreen;

      if (this.params.multiDisplay && this.params.multiDisplay.marginRight) {
        var marginRight;
        var w = document.body.offsetWidth;

        if (w > 0 && w <= 700) {
          marginRight = this.params.multiDisplay.marginRight.mobile;
        } else if (w > 700 && w <= 1100) {
          marginRight = this.params.multiDisplay.marginRight.touch;
        } else {
          marginRight = this.params.multiDisplay.marginRight.desktop;
        }

        this.sliders.forEach(function (slide, i, arr) {
          var d = _this4.boxWidth - marginRight * (_this4.slideOnScreen - 1) / _this4.slideOnScreen;
          slide.style.width = "".concat(d, "px");
          slide.style.minWidth = "".concat(d, "px");
          if ((i + 1) % _this4.slideOnScreen) slide.style.marginRight = "".concat(marginRight, "px");
        });
      } else {
        this.sliders.forEach(function (slide, i, arr) {
          slide.style.width = "".concat(_this4.boxWidth, "px");
          slide.style.minWidth = "".concat(_this4.boxWidth, "px");
        });
      }

      this.sliders.forEach(function (slide, i, arr) {
        slide.dataset.number = i;
      });
    }
  }, {
    key: "slideAll",
    value: function slideAll(callback) {
      var _this5 = this;

      var n = 0;
      this.sliders.forEach(function (slide, i, arr) {
        if (slide.classList.contains('active')) {
          _this5.boxShift = -(i * _this5.boxWidth);
          _this5.box.style.transform = "translateX(".concat(_this5.boxShift, "px)");
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

      if (callback) setTimeout(callback, this.moveTime * 1000);
    }
  }, {
    key: "slideMove",
    value: function slideMove(params) {
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
      var l = this.slideOnScreen;

      if (this.activeSlider > this.sliders.length - l) {
        var func = function func() {
          this.box.style.transition = "";
          this.installActiveSlider(0);
          this.slideAll(func2.bind(this));

          function func2() {
            for (var _i = 0; _i < l; _i++) {
              this.sliders[this.sliders.length - 1].remove();
              this.sliders.pop();
            }

            this.box.style.transition = "transform ".concat(this.moveTime, "s ease-in-out");
          }

          ;
        };

        for (var i = 0; i < l; i++) {
          this.box.append(this.sliders[i].cloneNode(true));
        }

        this.sliders = [].slice.call(this.box.children);
        this.installActiveSlider(this.activeSlider);
        this.slideAll(func.bind(this));
      } else if (this.activeSlider < 0) {
        var _func = function _func() {
          this.box.style.transition = "transform ".concat(this.moveTime, "s ease-in-out");
          this.installActiveSlider(0);
          this.slideAll(func2.bind(this));

          function func2() {
            this.box.style.transition = "";
            this.installActiveSlider(this.sliders.length - l);

            for (var _i3 = 0; _i3 < l; _i3++) {
              this.sliders[0].remove();
              this.sliders.shift();
            }

            this.slideAll(func3.bind(this));

            function func3() {
              this.box.style.transition = "transform ".concat(this.moveTime, "s ease-in-out");
            }
          }

          ;
        };

        this.box.style.transition = "";

        for (var _i2 = 0; _i2 < l; _i2++) {
          this.box.prepend(this.sliders[this.sliders.length - _i2 - 1].cloneNode(true));
        }

        this.sliders = [].slice.call(this.box.children);
        this.installActiveSlider(l);
        this.slideAll(_func.bind(this));
      } else {
        this.installActiveSlider(this.activeSlider);
        this.slideAll();
      }
    }
  }, {
    key: "prepareSlidesOnclick",
    value: function prepareSlidesOnclick() {
      var _this7 = this;

      this.sliders.forEach(function (slide) {
        slide.addEventListener('click', func.bind(_this7));

        function func() {
          this.sliders.forEach(function (slide) {
            return slide.classList.remove('active');
          });
          slide.classList.add('active');
          this.slideAll();
        }
      });
    }
  }, {
    key: "mouseFlip",
    value: function mouseFlip(event) {
      event.preventDefault();
      var x = this.box;
      var mousePointStart = event.clientX;
      var mousePointCurrent = 0;
      var mouseMoveBinded = mouseMove.bind(this);

      function mouseMove(event) {
        event.preventDefault();
        mousePointCurrent = event.clientX;
        var m = mousePointCurrent - mousePointStart;
        x.style.transform = "translateX(".concat(this.boxShift + m, "px)");

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
        this.box.removeEventListener('mousemove', mouseMoveBinded);
        mousePointStart = 0;
        mousePointCurrent = 0;
        x.style.transform = "translateX(".concat(this.boxShift, "px)");
      }

      this.box.addEventListener('mousemove', mouseMoveBinded);
      this.box.addEventListener('mouseup', mouseUp.bind(this));
    }
  }, {
    key: "touchFlip",
    value: function touchFlip(event) {
      event.preventDefault();
      var x = this.box;
      var touchPointStart = event.changedTouches['0'].screenX;
      var touchPointCurrent = 0;
      var touchPointStartY = event.changedTouches['0'].screenY;
      var touchPointCurrentY = 0; //this.touchBlockFlag = false;

      var touchMoveBinded = touchMove.bind(this);

      function touchMove(event) {
        touchPointCurrent = event.changedTouches['0'].screenX;
        var m = touchPointCurrent - touchPointStart;

        if (m >= document.body.offsetWidth / 4) {
          this.slideMove({
            direction: 'left'
          });
          touchPointStart = touchPointCurrent; //this.touchBlockFlag = true;

          touchEnd.call(this, event);
        } else if (m <= -document.body.offsetWidth / 4) {
          this.slideMove({
            direction: 'right'
          });
          touchPointStart = touchPointCurrent; //this.touchBlockFlag = true;

          touchEnd.call(this, event);
        }

        touchPointCurrentY = event.changedTouches['0'].screenY;
        var n = touchPointCurrentY - touchPointStartY;
        console.log(n, document.documentElement.clientHeight / 2);

        if (n >= document.documentElement.clientHeight / 2) {
          console.log('t1');
          window.scrollBy(0, -200);
          touchPointStartY = touchPointCurrentY;
        } else if (n <= -document.documentElement.clientHeight / 2) {
          console.log('t2');
          window.scrollBy(0, 200);
          touchPointStartY = touchPointCurrentY;
        }
      }

      function touchEnd(event) {
        //if(!this.touchBlockFlag) return;
        event.preventDefault();
        this.box.removeEventListener('touchmove', touchMoveBinded);
        touchPointStart = 0;
        touchPointCurrent = 0;
        x.style.transform = "translateX(".concat(this.boxShift, "px)");
      }

      this.box.addEventListener('touchmove', touchMoveBinded);
      this.box.addEventListener('touchend', touchEnd.bind(this));
      this.box.addEventListener('touchcancel', touchEnd.bind(this));
    }
  }]);

  return Slider;
}();

;

function clickItemHandler(event) {
  if (!event.target.closest('.click-item')) return;
  var item = event.target.closest('.click-item');
  var obj = {
    'toggle': function toggle(target) {
      target.closest('.click-obj').classList.toggle('active');
    },
    'toggle-focus': function toggleFocus(target) {
      target.closest('.click-obj').classList.toggle('active');
      target.closest('.click-obj').setAttribute('tabindex', '1');

      target.closest('.click-obj').onblur = function () {
        this.classList.remove('active');
      };
    },
    'remove': function remove(target) {
      target.closest('.click-obj').remove();
    },
    'think-form': function thinkForm(target) {
      event.preventDefault();
      var form = target.closest('.click-obj');
      form.querySelectorAll('.think_variant input').forEach(function (input) {
        if (input.checked) {
          form.classList.add('closed');
          func();
        }
      });

      function func() {
        form.querySelectorAll('.think_variant').forEach(function (variant) {
          variant.classList.add('closed');
          variant.querySelector('input').disabled = true;
          var p = +variant.dataset.percent;
          var stat = variant.querySelector('.think_statistic');
          stat.style.width = "calc(".concat(p, "% + (66px * ").concat(p, " / 100))");
          stat.innerHTML = "<span class=\"think_statistic_number\">".concat(p, "%</span>");
        });
        var inputS = form.querySelector('input[type=submit]');
        inputS.value = "Дякуєм за відповідь!";
        inputS.disabled = true;
        inputS.classList.add('disabled');
      }
    },
    'change-language': function changeLanguage(target) {
      var box = target.closest('.click-obj');

      if (box.classList.contains('active')) {
        box.querySelectorAll('.lang_item').forEach(function (item) {
          return item.classList.remove('active');
        });
        target.classList.add('active');
        box.classList.remove('active');
      } else {
        box.classList.add('active');
      }
    },
    'change-language-mobile': function changeLanguageMobile(target) {
      target.closest('.click-obj').querySelectorAll('.click-item').forEach(function (item) {
        return item.classList.remove('active');
      });
      target.classList.add('active');
    },
    'article-toggle': function articleToggle(target) {
      target.closest('.article_tabs').querySelectorAll('.article_tab').forEach(function (tab) {
        return tab.classList.remove('active');
      });
      target.classList.add('active');
      target.closest('.article_container').querySelectorAll('.article_item').forEach(function (item) {
        return item.classList.add('hidden');
      });
      target.closest('.article_container').querySelectorAll(".".concat(target.dataset.class)).forEach(function (item) {
        return item.classList.remove('hidden');
      });
    },
    'scroll-top': function scrollTop(target) {
      var int = setInterval(func, 1);

      function func() {
        if (window.pageYOffset > 0) {
          window.scrollTo(0, window.pageYOffset - 30);
        } else {
          clearInterval(int);
        }
      }
    },
    'change-punkt': function changePunkt(target) {
      var box = target.closest('.documents_list');
      var item = target.closest('.documents_list_item');
      box.querySelectorAll('.documents_list_item').forEach(function (t) {
        return t.classList.remove('active');
      });
      item.classList.add('active');
    },
    'change-tab': function changeTab(target) {
      document.querySelectorAll(target.dataset.label).forEach(function (tabContent) {
        tabContent.closest('.tabs_content').querySelectorAll('.tab_content').forEach(function (item) {
          return item.classList.remove('active');
        });
        tabContent.classList.add('active');
      });
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

function emulateSelector(select) {
  var selects = document.querySelectorAll(select);
  selects.forEach(function (select) {
    select.hidden = true;
    var emul = document.createElement('div');
    emul.classList = "select";

    emul.onclick = function () {
      return emul.classList.toggle('active');
    };

    emul.setAttribute('tabindex', '1');

    emul.onblur = function () {
      this.classList.remove('active');
    };

    var emulList = document.createElement('div');
    emulList.classList = "select_list";
    emul.append(emulList);
    select.querySelectorAll('option').forEach(function (item) {
      var option = document.createElement('div');
      option.classList = "select_option";
      option.innerHTML = item.innerHTML;
      option.dataset.value = item.value;

      option.onclick = function () {
        select.value = option.dataset.value;
        option.parentNode.querySelectorAll('.select_option').forEach(function (option) {
          option.classList.remove('selected');
        });
        option.classList.add('selected');
      };

      if (item.selected) option.classList.add('selected');
      if (item.dataset.default == 'true') option.classList.add('default');
      if (item.disabled) option.classList.add('disabled');
      emulList.append(option);
    });
    select.parentNode.append(emul);
    var heightStart = emul.querySelector('.select_option').offsetHeight;
    var heightEnd = 0;
    emul.querySelectorAll('.select_option').forEach(function (option) {
      heightEnd += option.offsetHeight;
    }); //emul.style.height = heightStart + 'px';
    //emul.querySelector('.select_list').style.maxHeight = heightStart + 'px';		
  });
  var z = 1;

  for (var i = selects.length - 1; i >= 0; i--) {
    selects[i].parentNode.querySelector('.select').style.zIndex = "".concat(z, "0");
    z++;
  }
}

; // calendar start

var Calendar =
/*#__PURE__*/
function () {
  function Calendar(parametrs) {
    _classCallCheck(this, Calendar);

    this.parametrs = parametrs;
    this.box = this.parametrs.item;
    this.direction = true;
    this.type = parametrs.type;
    this.dayName = [{
      name: 'НД',
      output: true
    }, {
      name: 'ПН',
      output: false
    }, {
      name: 'ВТ',
      output: false
    }, {
      name: 'СР',
      output: false
    }, {
      name: 'ЧТ',
      output: false
    }, {
      name: 'ПТ',
      output: false
    }, {
      name: 'СБ',
      output: true
    }];
    this.date = new Date();
    this.createCalendar();
    window.addEventListener('resize', this.createCalendar.bind(this));
  }

  _createClass(Calendar, [{
    key: "createCalendar",
    value: function createCalendar(params) {
      this.takeJSON();
      this.countColumns();
      this.cleanBox();
      this.createHead();
      this.createHeader();
      this.createPanel();
      this.createTable();
    }
  }, {
    key: "takeJSON",
    value: function takeJSON() {
      this.data = JSON.parse(rozklad);
      console.log(this.data);
    }
  }, {
    key: "countColumns",
    value: function countColumns() {
      this.box.classList.remove('collapse');
      var m = Math.floor((this.box.offsetWidth - 180) / 128);
      if (m > 8) m = 8;

      if (m < 4) {
        m = 4;
        this.box.classList.add('collapse');
      }

      this.columns = m;
      if (this.parametrs.type != 'big') this.columns = 8;
      console.log(this.columns);
    }
  }, {
    key: "cleanBox",
    value: function cleanBox() {
      this.box.innerHTML = '';
    }
  }, {
    key: "createTable",
    value: function createTable() {
      var _this8 = this;

      this.data.forEach(function (item, i) {
        if (item.branch && item.branch == _this8.box.dataset.branch) {
          _this8.createRow(item);
        }
      });
    }
  }, {
    key: "createHead",
    value: function createHead() {
      this.head = document.createElement('div');
      this.head.classList = "calendar_head";
      this.box.append(this.head);
    }
  }, {
    key: "createHeader",
    value: function createHeader() {
      this.headBox = document.createElement('div');
      this.headBox.classList = "calendar_head_box";
      this.calculateDate({
        callback: func.bind(this)
      });

      function func(n) {
        var columnHead = document.createElement('div');
        columnHead.classList = 'calendar_head_item';
        columnHead.dataset.date = +this.date;

        columnHead.onclick = function (e) {
          if (!this.box.classList.contains('collapse')) return;

          if (+this.box.querySelectorAll('.calendar_head_item')[2].dataset.date < +event.target.closest('.calendar_head_item').dataset.date) {
            this.date = new Date(+this.collapseLeft);
            this.direction = true;
          } else {
            this.date = new Date(+this.collapseRight);
            this.direction = false;
          }

          this.collapse = true;
          this.createCalendar();
          this.collapse = false;
        }.bind(this);

        columnHead.innerHTML = "<div class=\"calendar_head_content\">\n\t\t\t\t\t\t\t\t\t\t\t<span class=\"calendar_head_name\">".concat(this.dayName[n].name, "</span>\n\t\t\t\t\t\t\t\t\t\t\t<span class=\"calendar_head_date\">").concat(this.date.getDate() >= 10 ? this.date.getDate() : '0' + this.date.getDate(), ".").concat(this.date.getMonth() + 1 >= 10 ? this.date.getMonth() + 1 : '0' + (this.date.getMonth() + 1), "</span>\n\t\t\t\t\t\t\t\t\t\t</div>");
        this.direction ? this.headBox.append(columnHead) : this.headBox.prepend(columnHead);
      }

      this.head.append(this.headBox);
    }
  }, {
    key: "createPanel",
    value: function createPanel() {
      var _this9 = this;

      var panel = document.createElement('div');
      panel.classList = 'calendar_panel';
      var arrowLeft = document.createElement('a');
      arrowLeft.classList = 'calendar_arrow calendar_arrow-left';
      arrowLeft.innerHTML = "<svg width=\"8\" height=\"16\" viewBox=\"0 0 8 16\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n\t\t\t\t\t\t\t\t\t<path opacity=\"var(--svg-opacity-3)\" fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M0.287829 7.20792L6.3223 0.328386C6.70617 -0.109461 7.32854 -0.109461 7.71222 0.328386C8.09593 0.765844 8.09593 1.47536 7.71222 1.91278L2.37264 8.00012L7.71206 14.0872C8.09577 14.5249 8.09577 15.2343 7.71206 15.6718C7.32835 16.1094 6.70601 16.1094 6.32215 15.6718L0.287674 8.79214C0.095819 8.5733 0 8.2868 0 8.00015C0 7.71336 0.096005 7.42665 0.287829 7.20792Z\" fill=\"var(--svg-color-3)\"/>\n\t\t\t\t\t\t\t\t\t</svg>";

      arrowLeft.onclick = function () {
        _this9.date = new Date(+_this9.leftDate - 86400000);
        _this9.direction = false;

        _this9.createCalendar();
      };

      var arrowRight = document.createElement('a');
      arrowRight.classList = 'calendar_arrow calendar_arrow-right';
      arrowRight.innerHTML = "<svg width=\"8\" height=\"16\" viewBox=\"0 0 8 16\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n\t\t\t\t\t\t\t\t\t<path opacity=\"var(--svg-opacity-3)\" fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M7.71217 8.79208L1.6777 15.6716C1.29383 16.1095 0.671461 16.1095 0.287783 15.6716C-0.0959275 15.2342 -0.0959275 14.5246 0.287783 14.0872L5.62736 7.99988L0.287938 1.91276C-0.0957722 1.47513 -0.0957722 0.765684 0.287938 0.328226C0.671648 -0.109409 1.29399 -0.109409 1.67785 0.328226L7.71233 7.20786C7.90418 7.4267 8 7.7132 8 7.99985C8 8.28664 7.904 8.57335 7.71217 8.79208Z\" fill=\"var(--svg-color-3)\"/>\n\t\t\t\t\t\t\t\t\t</svg>";

      arrowRight.onclick = function () {
        _this9.date = new Date(+_this9.rightDate + 86400000);
        _this9.direction = true;

        _this9.createCalendar();
      };

      panel.append(arrowLeft);
      panel.append(arrowRight);

      if (this.type == 'big') {
        this.headBox.append(panel);
      } else {
        this.head.append(panel);
      }
    }
  }, {
    key: "createPerson",
    value: function createPerson(params) {
      var personBox = document.createElement('div');
      personBox.classList = "calendar_person";
      personBox.innerHTML = "<div class=\"calendar_person_left\">\n\t\t\t\t\t\t\t\t\t\t<span class=\"calendar_person_name\">".concat(params.name, "</span>\n\t\t\t\t\t\t\t\t\t\t<span class=\"calendar_person_position\">").concat(params.position, "</span>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"calendar_person_right\">\n\t\t\t\t\t\t\t\t\t\t<span class=\"calendar_cabinet\">").concat(params.cabinet, "</span>\n\t\t\t\t\t\t\t\t\t</div>");
      return personBox;
    }
  }, {
    key: "createRow",
    value: function createRow(params) {
      var row = document.createElement('div');
      row.classList = "calendar_row";
      if (this.parametrs.type == 'big') row.append(this.createPerson(params));
      var calendarCells = document.createElement('div');
      calendarCells.classList = "calendar_cells";
      this.calculateDate({
        callback: func.bind(this)
      });
      console.log(params.timetable);

      function func(n) {
        var _this10 = this;

        var columnCell = document.createElement('div');
        columnCell.classList = 'calendar_cell';
        var x;
        params.events.forEach(function (e) {
          if (_this10.date.getFullYear() == e.year && _this10.date.getMonth() == e.month && _this10.date.getDate() == e.date) x = e;
        });
        var columnCellTopInner;
        columnCellTopInner = "<span class=\"calendar_cell_time\">".concat(params.timetable[this.date.getDay() - 1].worktime, "</span>");
        if (x) columnCellTopInner += "<span class=\"calendar_cell_event\">".concat(x.name, "</span>");
        var columnCellBottomInner = "";
        if (!x && this.type != 'big') columnCellBottomInner = "<div class=\"button_container\">\n\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"button_little\">\u0437\u0430\u043F\u0438\u0441\u0430\u0442\u0438\u0441\u044C</a>\n\t\t\t\t\t\t\t\t\t\t\t\t</div>";
        columnCell.innerHTML = "<div class=\"calendar_cell_content\">\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"calendar_cell_top\">\n\t\t\t\t\t\t\t\t\t\t\t\t".concat(columnCellTopInner, "\n\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"calendar_cell_bottom\">\n\t\t\t\t\t\t\t\t\t\t\t\t").concat(columnCellBottomInner, "\n\t\t\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t\t</div>");
        this.direction ? calendarCells.append(columnCell) : calendarCells.prepend(columnCell);
      }

      row.append(calendarCells);
      this.box.append(row);
    }
  }, {
    key: "limitM",
    value: function limitM(m) {
      if (m > 32 - new Date(this.date.getFullYear(), this.date.getMonth(), 32).getDate()) {
        m = 1;
        this.date.setMonth(this.date.getMonth() + 1);
      } else if (m < 1) {
        this.date.setMonth(this.date.getMonth() - 1);
        m = 32 - new Date(this.date.getFullYear(), this.date.getMonth(), 32).getDate();
      }

      return m;
    }
  }, {
    key: "calculateDate",
    value: function calculateDate(params) {
      if (this.direction) {
        this.leftDate = new Date(+this.date);
      } else {
        this.rightDate = new Date(+this.date);
      }

      var m = this.date.getDate();

      for (var i = 0; i < this.columns;) {
        m = this.limitM(m);
        this.date.setDate(m);

        if (this.direction) {
          if (i == 1) {
            this.collapseLeft = new Date(this.date);
          }

          if (i == 2) {
            this.collapseRight = new Date(this.date);
          }
        } else {
          if (i == 1) {
            this.collapseRight = new Date(this.date);
          }

          if (i == 2) {
            this.collapseLeft = new Date(this.date);
          }
        }

        var n = this.date.getDay();
        if (n >= this.dayName.length - 1) n = 0;

        if (!this.dayName[n].output) {
          params.callback(n);
          i++;
        }

        this.direction ? m += 1 : m -= 1;
      }

      if (this.direction) {
        this.rightDate = new Date(+this.date);
        this.date = new Date(+this.leftDate);
      } else {
        this.leftDate = new Date(+this.date);
        this.date = new Date(+this.rightDate);
      }
    }
  }]);

  return Calendar;
}(); // calendar end


var inputFileEmulator = function inputFileEmulator(selector) {
  _classCallCheck(this, inputFileEmulator);

  document.querySelectorAll(selector).forEach(function (box) {
    var input = box.querySelector('input');
    var label = box.querySelector('label');
    input.addEventListener('change', function (e) {
      var fileName = '';

      if (this.files && this.files.length > 1) {
        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
      } else {
        fileName = e.target.value.split('\\').pop();
      }

      if (fileName) label.querySelector('span').innerHTML = "<span>".concat(fileName, "</span>");
    });
  });
};

function countTextareaSybmols(selector) {
  document.querySelectorAll(selector).forEach(function (textarea) {
    var counter = document.createElement('span');
    counter.classList = 'textarea-counter';
    textarea.parentNode.append(counter);
    textarea.addEventListener('change', func);
    textarea.addEventListener('keydown', func);

    function func(e) {
      var textarea = e.target.closest('textarea');
      var text = textarea.value;

      if (text.length > 249) {
        event.preventDefault();
        var t = text.split('');
        t.length = 249;
        textarea.value = t.join('');
        return false;
      }

      counter.innerHTML = "".concat(text.length + 1, "/250");
    }
  });
}

function togglePartForm(event) {
  if (!event.target.classList.contains('change-item')) return;
  var target = event.target.closest('.change-item');
  var name = target.name;
  document.querySelectorAll(".change-item[name=".concat(name, "]")).forEach(function (item) {
    if (item.dataset.label) document.querySelectorAll(item.dataset.label).forEach(function (t) {
      return t.hidden = !item.checked;
    });
  });
}

;