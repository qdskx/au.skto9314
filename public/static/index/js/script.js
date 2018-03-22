var num = 0;

$(function () {

  // search 反馈结果
  var $search = $('.header-search');
  var $search_text = $search.find('.text');
  var $search_result = $search.find('.result');

  $search_text.focus(function () {
    $search_result.show();
  }).click(function () {
    return false;
  });

  $(document).click(function () {
    $search_result.hide();
  });

  // tab 切换
  $('#newSong').tab();
  $('#mv').tab();

  // 幻灯片切换
  $('#newSong').slider();
   $('#hotSong').slider();


  // 旋转木马
  var $recommend = $('#recommend');
  var $carousel_item = $recommend.find('.carousel-slider').find('.item');
  var $carousel_prev = $recommend.find('.slider-prev');
  var $carousel_next = $recommend.find('.slider-next');
  var $carousel_btn = $recommend.find('.slider-btns').find('span');

  var carouselArr = ['item-pic1', 'item-pic2', 'item-pic3', 'item-pic4', 'item-pic5', 'item-pic6'];
  var b_stop = true;
  var iNum = 0;

  $carousel_prev.click(function () {
    if (b_stop) {
      b_stop = false;

      prevImg();
    }

    return false;
  });

  $carousel_next.click(function () {
    if (b_stop) {
      b_stop = false;

      nextImg();
    }

    return false;
  });

  $carousel_btn.click(function () {
    var cur_index = $(this).index();
    var _num = cur_index - iNum;

    if (iNum === cur_index) {
      return;
    } else if (iNum < cur_index) {
      var newArr = carouselArr.splice(0, _num);

      carouselArr = $.merge(carouselArr, newArr);

      $carousel_item.each(function (i, elem) {
        $carousel_item.removeClass(carouselArr[i]);
        $(elem).addClass(carouselArr[i]);
      });
    } else {
      carouselArr.reverse();
      var newArr = carouselArr.splice(0, -_num);
      carouselArr = $.merge(carouselArr, newArr);
      carouselArr.reverse();

      $carousel_item.each(function (i, elem) {
        $carousel_item.removeClass(carouselArr[i]);
        $(elem).addClass(carouselArr[i]);
      });
    }

    setBtn(cur_index);
    iNum = cur_index;
  });

  $(document).on('click', '#recommend .item-pic2', function () {
    if (b_stop) {
      b_stop = false;

      prevImg();
    }

    return false;
  });

  $(document).on('click', '#recommend .item-pic4', function () {
    if (b_stop) {
      b_stop = false;

      nextImg();
    }

    return false;
  });

  function prevImg() {
    carouselArr.push(carouselArr.shift());

    $carousel_item.each(function (i, elem) {
      $carousel_item.removeClass(carouselArr[i]);
      $(elem).addClass(carouselArr[i]);

      setTimeout(function () {
        b_stop = true;
      }, 300);
    });

    if (iNum === 0) {
      iNum = $carousel_item.length - 1;
    } else {
      iNum --;
    }

    setBtn(iNum);
  };

  function nextImg() {
    carouselArr.unshift(carouselArr.pop());

    $carousel_item.each(function (i, elem) {
      $carousel_item.removeClass(carouselArr[i]);
      $(elem).addClass(carouselArr[i]);

      setTimeout(function () {
        b_stop = true;
      }, 300);
    });

    if (iNum === $carousel_item.length - 1) {
      iNum = 0;
    } else {
      iNum ++;
    }

    setBtn(iNum);
  };

  function setBtn(index) {
    $carousel_btn.removeClass('cur');
    $carousel_btn.eq(index).addClass('cur');
  };

});

;(function ($, window, document, undefined) {

  var Plugin = function (elem) {
    this.oWrapper = elem;

    this.$tab_item = this.oWrapper.find('.tab-title').find('.item');
    this.$tab_img = this.oWrapper.find('.tab-cont').find('img');
    this.$slider_wrapper = $('.slider-wrapper');
    this.$slider_btn = $('.slider-btns').find('span');

    this.newSong = {
      1: ['slider_img1.jpg', 'slider_img2.jpg', 'slider_img3.jpg', 'slider_img4.jpg', 'slider_img5.jpg', 'slider_img6.jpg', 'slider_img7.jpg', 'slider_img8.jpg', 'slider_img9.jpg', 'slider_img10.jpg', 'slider_img11.jpg', 'slider_img12.jpg'],
      2: ['slider_img4.jpg', 'slider_img5.jpg', 'slider_img6.jpg', 'slider_img1.jpg', 'slider_img2.jpg', 'slider_img3.jpg', 'slider_img7.jpg', 'slider_img8.jpg', 'slider_img9.jpg', 'slider_img10.jpg', 'slider_img11.jpg', 'slider_img12.jpg'],
      3: ['slider_img10.jpg', 'slider_img4.jpg', 'slider_img11.jpg', 'slider_img12.jpg', 'slider_img5.jpg', 'slider_img6.jpg', 'slider_img1.jpg', 'slider_img2.jpg', 'slider_img3.jpg', 'slider_img7.jpg', 'slider_img8.jpg', 'slider_img9.jpg'],
      4: ['slider_img4.jpg', 'slider_img11.jpg', 'slider_img10.jpg', 'slider_img12.jpg', 'slider_img5.jpg', 'slider_img8.jpg', 'slider_img9.jpg', 'slider_img6.jpg', 'slider_img1.jpg', 'slider_img2.jpg', 'slider_img3.jpg', 'slider_img7.jpg'],
      5: ['slider_img11.jpg', 'slider_img10.jpg', 'slider_img4.jpg', 'slider_img12.jpg', 'slider_img2.jpg', 'slider_img3.jpg', 'slider_img5.jpg', 'slider_img6.jpg', 'slider_img1.jpg', 'slider_img7.jpg', 'slider_img8.jpg', 'slider_img9.jpg']
    };

    this.mv = {
      1: ['mv_img1.jpg', 'mv_img2.jpg', 'mv_img3.jpg', 'mv_img4.jpg', 'mv_img5.jpg', 'mv_img6.jpg', 'mv_img7.jpg', 'mv_img8.jpg'],
      2: ['mv_img8.jpg', 'mv_img5.jpg','mv_img1.jpg', 'mv_img4.jpg', 'mv_img3.jpg', 'mv_img6.jpg', 'mv_img7.jpg', 'mv_img2.jpg'],
      3: ['mv_img1.jpg', 'mv_img5.jpg', 'mv_img6.jpg', 'mv_img2.jpg', 'mv_img3.jpg', 'mv_img4.jpg', 'mv_img7.jpg', 'mv_img8.jpg'],
      4: ['mv_img4.jpg', 'mv_img5.jpg','mv_img1.jpg', 'mv_img2.jpg', 'mv_img3.jpg', 'mv_img6.jpg', 'mv_img7.jpg', 'mv_img8.jpg'],
      5: ['mv_img1.jpg', 'mv_img5.jpg', 'mv_img6.jpg', 'mv_img2.jpg', 'mv_img3.jpg', 'mv_img8.jpg', 'mv_img4.jpg', 'mv_img7.jpg'],
      6: ['mv_img8.jpg', 'mv_img2.jpg', 'mv_img3.jpg', 'mv_img4.jpg', 'mv_img5.jpg', 'mv_img6.jpg', 'mv_img7.jpg', 'mv_img1.jpg']
    };
  };

  Plugin.prototype = {
    inital: function () {
      var self = this;

      this.$tab_item.click(function () {
        self.change($(this).index());

        self.$slider_wrapper.css({left: 0});

        self.$slider_btn.removeClass('cur');
        self.$slider_btn.eq(0).addClass('cur');

        num = 0;
      });
    },

    change: function (index) {
      var self = this;

      this.$tab_item.removeClass('item-cur');
      this.$tab_item.eq(index).addClass("item-cur");

      if (this.oWrapper.attr('id') === 'newSong') {
        $(this.$tab_img).each(function (i) {
          $(self.$tab_img[i]).attr('src', 'images/cont/'+self.newSong[index + 1][i]+'');
        })
      } else if (this.oWrapper.attr('id') === 'mv') {
        $(this.$tab_img).each(function (i) {
          $(self.$tab_img[i]).attr('src', 'images/cont/'+self.mv[index + 1][i]+'');
        })
      }
    },

    constructor: Plugin
  };

  $.fn.tab = function () {
    var plugin = new Plugin(this);

    return plugin.inital();
  };

})(jQuery, window, document);

;(function ($, window, document, undefined) {

  var Plugin = function (elem) {
    this.$oParent = elem;
    this.$slider_wrapper = this.$oParent.find('.slider-wrapper');
    this.$slider_item = this.$slider_wrapper.find('li');
    this.$slider_btn = this.$oParent.find('.slider-btns').find('span');
    this.$slider_prev = this.$oParent.find('.slider-prev');
    this.$slider_next = this.$oParent.find('.slider-next');

    this.dis_w = 1200;
    this.b_stop = true;
  };

  Plugin.prototype = {
    inital: function () {
      var self = this;

      this.eventInfo();

      this.$slider_btn.click(function () {
        var cur_index = $(this).index();

        self.setDot(cur_index);

        self.$slider_wrapper.animate({left: -cur_index * self.dis_w});

        num = cur_index;
      });

      this.$slider_prev.click(function () {
        if (self.b_stop) {
          self.b_stop = false;

          self.prevClick();
        }
      });
      this.$slider_next.click(function () {
        if (self.b_stop) {
          self.b_stop = false;

          self.nextClick();
        }
      });
    },

    eventInfo: function () {
      this.$slider_item.each(function (i) {
        $(this).addClass(i % 2 ? 'info-event' : '')
      });
    },

    setDot: function (index) {
      this.$slider_btn.removeClass('cur');
      this.$slider_btn.eq(index).addClass('cur');
    },

    prevClick: function () {
      var self = this;

      if (num === 0) {
        num = this.$slider_btn.length - 1;
      } else {
        num --;
      }

      this.setDot(num);

      this.$slider_wrapper.animate({left: -num * this.dis_w}, 600, function () {
        self.b_stop = true;
      });
    },

    nextClick: function () {
      var self = this;

      if (num === this.$slider_btn.length - 1) {
        num = 0;
      } else {
        num ++;
      }

      this.setDot(num);

      this.$slider_wrapper.animate({left: -num * this.dis_w}, 600, function () {
        self.b_stop = true;
      });
    },

    constructor: Plugin
  };

   $.fn.slider = function () {
    var plugin = new Plugin(this);

    return plugin.inital();
  };

})(jQuery, window, document);