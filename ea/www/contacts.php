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
    if (!document.getElementById('email').value) {			
      		var emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
            var email = $('#email').val();            

            if (!email.match(emailPattern)) {                
                $('#email').css('border-bottom', '2px solid #FF0000');
				$('#email').after('<span style="text-align:center;display:block;color:#ff1100">Введите корректный email</span>')				
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
  <main class="contactspage">
		<section class="container-fluid firstblock">
			<div class="row">
				<h2 class="backblock-heading">Contacts</h2>
				<div class="container">
					<div class="row">
						<div class="col-12 content-part">
							<form id="contactform" class="contactform" action="mail/mail.php" method="POST">
								<div class="row">
									<div class="col-12">
										<input type="email" name="email" value="" id="email" placeholder="Email">
									</div>
									<div class="col-12">
										<textarea name="message" rows="2" placeholder="Message"></textarea>
									</div>
									<div id='recaptcha' class="g-recaptcha"
										data-sitekey="6Lc8sbMUAAAAAGV5pQRNcxV4fnNLhL3cZTNU3iXg"
										data-callback="onSubmit"
										data-size="invisible">
									</div>									
									<div class="col-12 btn-line">									
										<input type="submit" class="btnarrleft" value="Отправить" id="send">										
									</div>
								</div>
							</form>
							<script>onload();</script>							
						</div>
					</div>
				</div>
			</div>
    </section>
		<section class="container-fluid secondblock">
			<div class="row">
				<div class="container">
					<div class="row work-content-block">
						<div class="col-12 col-lg-6 left-part">
							<h4>Мы находимся</h4>
							<p>
		            Easy-Agency<br>
								Украина, Киев<br>
								<a href="https://goo.gl/maps/vYwZhmkgQAedMqpf6" target="_blank">пр-т. В. Лобановского, 6а</a>
		          </p>
						</div>
						<div class="col-12 col-lg-6 right-part">
							<h4>Наши контакты</h4>
		          <p>
		            <a href="tel:+380934686757">+38 (093) 468-67-57</a><br>
		            <a href="mailto:support@easy-agency.com">support@easy-agency.com</a>
		          </p>
						</div>
					</div>
				</div>
			</div>
    </section>
  </main>
<?php
	// require('template-parts/footer-main.php');
	require('template-parts/page-end.php');
?>
