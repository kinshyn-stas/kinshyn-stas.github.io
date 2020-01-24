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
					$('#email').after('<span style="text-align:center;display:block;color:#ff1100">Enter correct email</span>')
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
  <main class="tesmpage">
		<section class="container-fluid firstblock">
			<div class="row">
				<h2 class="backblock-heading">Reviews</h2>
				<div class="container">
					<div class="row">
						<div class="col-12 head-part">
							<h3 class="frontblock-heading">Feedback</h3>
						</div>
					</div>
				</div>
			</div>
    </section>
		<div class="container">
			<div class="row tesmimg-list">
				<div class="col-lg-4 col-12 tesmimg_item">
					<div class="item-info">
						<div class="img__part">
							<img src="/en/img/tesmimg/inveria.png" alt="" class="item__img">
						</div>
						<h3 class="item__head">Inveria</h3>
						<p class="item__info">Ecosystem for intellectual and creative development</p>
					</div>
				</div>
				<div class="col-lg-4 col-12 tesmimg_item">
					<div class="item-info">
						<div class="img__part">
							<img src="/en/img/tesmimg/greentechtrade.png" alt="" class="item__img">
						</div>
						<h3 class="item__head">Green Tech Trade</h3>
						<p class="item__info">The official representative of the First Solar and Zorlu Energy solar panels in Ukraine</p>
					</div>
				</div>
				<div class="col-lg-4 col-12 tesmimg_item">
					<div class="item-info">
						<div class="img__part">
							<img src="/en/img/tesmimg/nashformat.png" alt="" class="item__img">
						</div>
						<h3 class="item__head">Наш Формат</h3>
						<p class="item__info">Non-fiction publishing house</p>
					</div>
				</div>
				<div class="col-lg-4 col-12 tesmimg_item">
					<div class="item-info">
						<div class="img__part">
							<img src="/en/img/tesmimg/klitchko.png" alt="" class="item__img">
						</div>
						<h3 class="item__head">Klitschko Expo</h3>
						<p class="item__info">Exhibition and Museum of the Achievements of the Legendary Klitschko Brothers</p>
					</div>
				</div>
				<div class="col-lg-4 col-12 tesmimg_item">
					<div class="item-info">
						<div class="img__part">
							<img src="/en/img/tesmimg/verabrezhneva.png" alt="" class="item__img">
						</div>
						<h3 class="item__head">Vera Brezhneva</h3>
						<p class="item__info">Официальный представитель солнечных панелей First Solar и Zorlu Energy в Украине</p>
					</div>
				</div>
				<div class="col-lg-4 col-12 tesmimg_item">
					<div class="item-info">
						<div class="img__part">
							<img src="/en/img/tesmimg/selfinv.png" alt="" class="item__img">
						</div>
						<h3 class="item__head">Self Invest</h3>
						<p class="item__info">Legal employment of students in Germany during the winter and summer holidays</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12 tesm-item">Татьяна Марченко</div>
				<div class="col-12 tesm-item">Татьяна Марченко</div>
				<div class="col-12 tesm-item">Татьяна Марченко</div>
			</div>
		</div>
		<section class="container-fluid">
			<div class="row">
				<h2 class="backblock-heading">Leave a review</h2>
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h3 class="frontblock-heading">Leave a review</h3>
						</div>
						<div class="col-12 content-part">
							<form id="contactform" class="contactform" action="mail/mail.php" method="POST">
								<div class="row">
									<div class="col-12">
										<input type="text" name="tesmname" value="" id="tesmname" placeholder="Name">
									</div>
									<div class="col-12">
										<input type="text" name="tesmposit" value="" id="tesmposit" placeholder="Position">
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
										<input type="file" name="" value="">
										<input type="submit" class="btnarrleft" value="Send" id="send">
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
	require('template-parts/footer-main.php');
	require('template-parts/page-end.php');
?>
