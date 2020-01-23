<?php
	require('template-parts/page-start.php');
	require('template-parts/header-main.php');
?>
  <script>
  function onSubmit(token) {
	document.getElementById("contactform").submit();
  }

  function validate(event) {
    event.preventDefault();
    if (!document.getElementById('tel').value) {
      		var telPattern = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
            var tel = $('#tel').val();

            if (!tel.match(telPattern)) {
                $('#tel').css('border-bottom', '2px solid #FF0000');
				$('#tel').after('<span style="text-align:center;display:block;width:100%;color:#ff1100">Введите корректный телефон</span>')
            }
    } else {
      grecaptcha.execute();
    }
  }

  function onload() {
    var element = document.getElementById('send');
    element.onclick = validate;
  }
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <main class="callbackpage">
		<section class="container-fluid firstblock">
			<div class="row">
				<div class="container">
					<div class="row">
						<div class="col-12 content-part">
							<a href="#" class="backbtn">Назад</a>
							<form id="contactform" class="contactform" action="mail/mail.php" method="POST">
								<div class="row">
									<div class="col-12">
										<input type="text" id="tel" name="phone" value="" pattern="(\+?\d[- .]*){7,21}" placeholder="Phone" title="Пример: +380999876543" required>
										<div id='recaptcha' class="g-recaptcha"
											data-sitekey="6Lc8sbMUAAAAAGV5pQRNcxV4fnNLhL3cZTNU3iXg"
											data-callback="onSubmit"
											data-size="invisible">
										</div>
										<input type="submit" class="btnarrleft" value="Отправить" id="send">
									</div>
									<div class="col-12">
										<p>Мы свяжемся с Вами в течение 30 минут</p>
									</div>
								</div>
							</form>
							<script>onload();</script>
						</div>
					</div>
				</div>
			</div>
    </section>
  </main>
<?php
	require('template-parts/page-end.php');
?>
