<div class="contacts-list-slider">

		<?php for ($i=0; $i < 5; $i++) { ?>
		<!-- Contact -->
		<li class="">
			<div class="contacts-list-slider-img">
				<div><img src="<? insertImage('bio-thumb.jpg') ?>" class="fluid-img" alt="Persons Name"></div>
			</div>
			<div class="contacts-list-slider-cont">
				<div>
					<div class="contacts-list-list-name">Name of person</div>
					<div class="contacts-list-list-subt">Title of person</div>
					<div class="contacts-list-list-cr">
						<div class="contacts-list-list-c1"><a href="tel:8001234567">(800) 123-4567</a></div>
						<div class="contacts-list-list-c2"><a href="mailto:info@email.com">info@email.com</a></div>
					</div>
				</div>
			</div>
		</li>
		<?php } ?>

</div>
