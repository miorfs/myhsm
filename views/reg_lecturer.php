<?php

	require dirname(__FILE__)."/j-folder/php/csrf.php";
	$new_token = new CSRF('register');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration form</title>

	<!-- Your META here -->
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0" name="viewport">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="j-folder/css/demo.css">
	<link rel="stylesheet" href="j-folder/css/font-awesome.min.css">
	<link rel="stylesheet" href="j-folder/css/j-forms.css">

	<!-- Scripts -->
	<script src="j-folder/js/jquery.1.11.1.min.js"></script>
	<script src="j-folder/js/jquery.validate.min.js"></script>
	<script src="j-folder/js/additional-methods.min.js"></script>
	<script src="j-folder/js/jquery.form.min.js"></script>
	<script src="j-folder/js/lect-script.js"></script>

	<!--[if lt IE 10]>
			<script src="j-folder/js/jquery.placeholder.min.js"></script>
		<![endif]-->
	<script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body class="bg-pic">
	<div class="wrapper wrapper-640">

		<form action="j-folder/php/reg_lecturer.php" method="post" class="j-forms" id="j-forms" novalidate>

			<div class="header">
				<p>Lecturer Registration</p>
			</div>
			<!-- end /.header -->
			

			<div class="content">

			<div class="divider-text gap-top-20 gap-bottom-45">
				<span>Personal Details</span>
			</div>

				<!-- start token -->
				<div class="token">
					<?php echo $new_token->get_token();?>
				</div>
				<!-- end token -->

				<div class="unit">
					<div class="input">
						<label class="icon-right" for="username">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="lecturerName" name="lecturerName" placeholder="Lecturer Name">
					</div>
				</div>

				<!-- start name email -->
				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="username">
								<i class="fa fa-user"></i>
							</label>
							<input type="text" id="icNo" name="icNo" placeholder="Ic Number">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="digits">
								<i class="fa fa-phone"></i>
							</label>
							<input type="text" id="lecturerPhoneNo" name="lecturerPhoneNo" placeholder="Phone No.">
						</div>
					</div>
				</div>
				<!-- end name email -->

				<div class="unit">
					<div class="input">
						<label class="icon-right" for="email">
							<i class="fa fa-envelope-o"></i>
						</label>
						<input type="email" id="lecturerEmail" name="lecturerEmail" placeholder="Email">
					</div>
				</div>

				<div class="unit">
					<div class="input">
						<label class="icon-right" for="email">
							<i class="fa fa-file"></i>
						</label>
						<textarea id="address" name="address" placeholder="Address"></textarea>
					</div>
				</div>

				<div class="j-row">
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="postcode">
								<i class="fa fa-file"></i>
							</label>
							<input type="text" id="postcode" name="postcode" placeholder="Postcode">
						</div>
					</div>
					<div class="span6 unit">
						<div class="input">
							<label class="icon-right" for="city">
								<i class="fa fa-file"></i>
							</label>
							<input type="text" id="city" name="city" placeholder="City">
						</div>
					</div>
				</div>

                  <div class="unit">
						<label class="input select">
							<select id="state" name="state">
							  <option value="Pulau Pinang">Pulau Pinang</option>
		                      <option value="Perlis">Perlis</option>
		                      <option value="Perak">Perak</option>
		                      <option value="Kedah">Kedah</option>
		                      <option value="Terengganu">Terengganu</option>
		                      <option value="Kelantan">Kelantan</option>
		                      <option value="Pahang">Pahang</option>
		                      <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>
		                      <option value="Selangor">Selangor</option>
		                      <option value="Negeri Sembilan">Negeri Sembilan</option>
		                      <option value="Johor">Johor</option>
		                      <option value="Sabah">Sabah</option>
		                      <option value="Sarawak">Sarawak</option>
							</select>
							<i></i>
						</label>
					</div>

				<div class="divider-text gap-top-20 gap-bottom-45">
				<span>Affiliate Details</span>
			</div>

				<div class="unit">
					<div class="input">
						<label class="icon-right" for="username">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="position" name="position" placeholder="Position">
					</div>
				</div>

				<div class="unit">
					<label class="input select">
						<select name="faculty" id="faculty">
						  <option value="Kejuruteraan Elektrik">Kejuruteraan Elektrik</option>
						  <option value="Kejuruteraan Mekanikal">Kejuruteraan Mekanikal</option>
						  <option value="Kejuruteraan Kimia">Kejuruteraan Kimia</option>
						  <option value="Kejuruteraan Awam">Kejuruteraan Awam</option>
						  <option value="Farmasi">Farmasi</option>
						  <option value="Perubatan">Perubatan</option>
						  <option value="Pergigian">Pergigian</option>
						  <option value="Sains Kesihatan">Sains Kesihatan</option>
						  <option value="Sains Gunaan">Sains Gunaan</option>
						  <option value="Sains Komputer & Matematik">Sains Komputer & Matematik</option>
						  <option value="Senibina, Perancangan & Ukur">Senibina, Perancangan & Ukur</option>
						  <option value="Sains Sukan & Rekreasi">Sains Sukan & Rekreasi</option>
						  <option value="Perladangan & Agroteknologi">Perladangan & Agroteknologi</option>
						  <option value="Undang-Undang">Undang-Undang</option>
						  <option value="Sains Pentadbiran & Pengajian Polisi">Sains Pentadbiran & Pengajian Polisi</option>
						  <option value="Komunikasi & Pengajian Media">Komunikasi & Pengajian Media</option>
						  <option value="Seni Lukis & Seni Reka">Seni Lukis & Seni Reka</option>
						  <option value="Filem, Teater & Animasi">Filem, Teater & Animasi</option>
						  <option value="Muzik">Muzik</option>
						  <option value="Pendidikan">Pendidikan</option>
						  <option value="Akademik Pengajian Islam Kontemporari (acis)">Akademik Pengajian Islam Kontemporari (acis)</option>
						  <option value="Akademi Pengajian Bahasa (APB)">Akademi Pengajian Bahasa (APB)</option>
						  <option value="Pendidikan">Pendidikan</option>
						  <option value="Perakaunan">Perakaunan</option>
						  <option value="Pengurusan & Perniagaan">Pengurusan & Perniagaan</option>
						  <option value="Pengurusan Hotel & Pelancongan">Pengurusan Hotel & Pelancongan</option>
						  <option value="Pengurusan Maklumat">Pengurusan Maklumat</option>
						  <option value="Pengurusan Hotel & Pelancongan">Arshad Ayub Graduate Business School (AAGBS)</option>
						</select>
						<i></i>
					</label>
				</div>

				<div class="unit">
					<label class="input select">
						<select name="university" id="university">
						  <option value="UiTM Shah Alam">UiTM Shah Alam</option>
						</select>
						<i></i>
					</label>
				</div>

				<div class="unit">
					<div class="input">
						<label class="icon-right" for="username">
							<i class="fa fa-user"></i>
						</label>
						<input type="text" id="speciality" name="speciality" placeholder="Speciality / Expertise">
					</div>
				</div>


				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Academic Level</span>
				</div>

				<!-- start level -->
				<div class="unit">
					<label class="input select">
						<select name="level" id="level">
							<option value="" selected> Academic Level </option>
							<option value="Doctorate"> Doctorate </option>
							<option value="Master"> Master </option>
							<option value="Degree"> Degree </option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end level -->

				<div class="divider-text gap-top-20 gap-bottom-45">
					<span>Teaching Experience</span>
				</div>

				<!-- start level -->
				<div class="unit">
					<label class="input select">
						<select name="experience" id="experience">
							<option value="" selected> Teaching Experience </option>
							<option value="< 5 Years"> < 5 Years </option>
							<option value="< 4 Years"> < 4 Years </option>
							<option value="< 3 Years"> < 3 Years </option>
							<option value="< 2 Years"> < 2 Years </option>
							<option value="< 1 Years"> < 1 Years </option>
						</select>
						<i></i>
					</label>
				</div>
				<!-- end level -->

				<!-- start reCaptcha -->
				<div class="unit">
					<?php
					require "../config/connection.php";


					if ($localhost){
						echo'<div class="g-recaptcha" data-sitekey="6LeQgRgUAAAAAPJs6Oeq_Ps51DTCDMVzZLi29O-U"></div>';
					}
					if ($server){
						echo'<div class="g-recaptcha" data-sitekey="6LcwvBgUAAAAABFKYHX10xuFgN2eOXMGFAox1VxR"></div>';
					}

					?>
				</div>
				<!-- end reCaptcha -->

				<!-- start response from server -->
				<div id="response"></div>
				<!-- end response from server -->

				<p>Note : </p>
				<p>1.	HTP session schedule is subject to changes. </p>
				<p>2.	Pay to UTECHTIUM SDN BHD / CIMB  8602844202. </p>
				<p>3.	RM 4208 per participant inclusive GST. </p>
				<p>4.	Payment term : 14 days before session schedule. </p>

			</div>
			<!-- end /.content -->

			<div class="footer">
				<button type="submit" class="primary-btn">Register</button>
				<a href="index.php"><button type="button" class="primary-btn">Cancel</button></a>
				
				
			</div>
			<!-- end /.footer -->

		</form>
	</div>
	
</body>
</html>