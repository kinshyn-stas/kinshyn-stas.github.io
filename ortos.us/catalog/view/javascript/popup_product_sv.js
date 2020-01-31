function PopupWaitShow() {
  html =  '<div id="product_popup_wait" style="width:100%; min-height:100%; background-color: rgba(0,0,0,0.5); overflow:hidden; position:fixed; top: 0px;	z-index: 10000; display: none; padding: 0;">';
  html += '  <div class="popup-loading" style="position: absolute; width: 76px; height: 76px; left: 50%; margin-left: -38px; top: 50%; margin-top: -38px; border-radius: 10px; background-color: #FFF; text-align: center; line-height: 70px;">';
  html += '    <img src="catalog/view/image/loading_popupwait.gif" style="vertical-align: middle; margin-left: -5px;" />';
  html += '  </div>';
  html += '</div>';
  $('body').append(html);
  $("#product_popup_wait").fadeIn('slow');
}

function PopupWaitHide() {
  $('#product_popup_wait').fadeOut(
    'slow', 
    function () {
      $('#product_popup_wait').remove(); 
    }
  );  
}