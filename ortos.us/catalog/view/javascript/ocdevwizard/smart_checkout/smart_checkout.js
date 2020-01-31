// @category  : OpenCart
// @module    : Smart Checkout
// @author    : OCdevWizard <ocdevwizard@gmail.com> 
// @copyright : Copyright (c) 2014, OCdevWizard
// @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf

var $smch_modal              = $('#smch-modal-body'),
    smch_name_block_height   = $('#smch-modal-data > .processing > .name').height(),
    smch_totals_block_height = $('#smch-modal-data > .processing > .totals').height(),
    smch_middle_block_height = $('#smch-modal-data').height(),
    smch_bottom_block_height = $('#smch-modal-body > .modal-footer').height(),
    winW_for_smch            = $(window).width();

$(function() { 
  if (smch_name_block_height > smch_totals_block_height) {
    $('#smch-modal-data > .processing > .quantity').height($('#smch-modal-data > .processing > .name').height());
  } else {
    $('#smch-modal-data > .processing > .quantity').height($('#smch-modal-data > .processing > .totals').height());
  };

  // for "slide-description" block
  if (smch_middle_block_height < $('#smch-modal-body > .slide-description > .content').height()) {
    $('#smch-modal-body > .slide-description > .content').height(parseInt(smch_middle_block_height) - parseInt(smch_bottom_block_height) + 'px');
  }
  $("#smch-modal-body > .slide-description > .open").click(function() {
    if ($(this).hasClass("b-hidden") ) {
      if (winW_for_smch < 414) {
        $('#smch-modal-body > .slide-description').stop().animate({ left: '275px' }, 500);
      } else {
        $('#smch-modal-body > .slide-description').stop().animate({ left: '380px' }, 500);
      }         
      $(this).removeClass("b-hidden");
    } else {
      $('#smch-modal-body > .slide-description').stop().animate({ left: 0 }, 500);
      $(this).addClass("b-hidden");
    }
  });

  // for "slide-informer" block
  if ((smch_middle_block_height - 30) < $('#smch-modal-body > .slide-informer > .content').height()) {
    $('#smch-modal-body > .slide-informer > .content').height(parseInt(smch_middle_block_height - 30) - parseInt(smch_bottom_block_height));
  }
  $("#smch-modal-body > .slide-informer > .open").click(function() {
    if ($(this).hasClass("b-hidden") ) {
      if (winW_for_smch < 414) {
        $('#smch-modal-body > .slide-informer').stop().animate({ left: '275px' }, 500);
      } else {
        $('#smch-modal-body > .slide-informer').stop().animate({ left: '380px' }, 500);
      }         
      $(this).removeClass("b-hidden");
    } else {
      $('#smch-modal-body > .slide-informer').stop().animate({ left: 0 }, 500);
      $(this).addClass("b-hidden");
    }
  });

  // for "slide-attributes" block
  if ((smch_middle_block_height - 60) < $('#smch-modal-body > .slide-attributes > .content').height()) {
    $('#smch-modal-body > .slide-attributes > .content').height(parseInt(smch_middle_block_height - 60) - parseInt(smch_bottom_block_height));
  }
  $("#smch-modal-body > .slide-attributes > .open").click(function() {
    if ($(this).hasClass("b-hidden") ) {
      if (winW_for_smch < 414) {
        $('#smch-modal-body > .slide-attributes').stop().animate({ left: '275px' }, 500);
      } else {
        $('#smch-modal-body > .slide-attributes').stop().animate({ left: '380px' }, 500);
      }         
      $(this).removeClass("b-hidden");
    } else {
      $('#smch-modal-body > .slide-attributes').stop().animate({ left: 0 }, 500);
      $(this).addClass("b-hidden");
    }
  });
});
