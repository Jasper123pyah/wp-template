<?php
$image     = get_sub_field( 'image' );
$title     = get_sub_field( 'title' );
$paragraph = get_sub_field( 'paragraph' );
$sm_title  = get_sub_field( 'sm_title' );


$phone_number = get_field( 'phone_number', 'option' );
$email        = get_field( 'email', 'option' );

$social_media = get_field( 'social_media', 'option' );

?>

<div class="header-contact">
	<img class="header-contact__image" src="<?= $image ?>"/>
	<div class="container">
		<div class="header-contact__container">
			<div class="header-contact__content">
				<h1 class="header-contact__title">
					<?= $title ?>
				</h1>
				<h4 class="header-contact__paragraph">
					<?= $paragraph ?>
				</h4>
				<div class="header-contact__contact">
					<a href="tel:<?= $phone_number ?>" class="header-contact__contact-line">
						<div class="header-contact__contact-icon">
							<img loading="lazy" src="<?= get_template_directory_uri() ?>/assets/images/phone.svg" alt="Telefoon"/>
						</div>
						<h3 class="header-contact__contact-text">
							<?= $phone_number ?>
						</h3>
					</a>
					<a href="mailto:<?= $email ?>" class="header-contact__contact-line">
						<div class="header-contact__contact-icon">
							<img loading="lazy" src="<?= get_template_directory_uri() ?>/assets/images/email.svg" alt="Telefoon"/>
						</div>
						<h3 class="header-contact__contact-text">
							<?= $email ?>
						</h3>
					</a>
				</div>
				<div class="header-contact__social-media">
					<h3 class="header-contact__social-media-title">
						<?= $sm_title ?>
					</h3>
					<div class="header-contact__social-media-icons">
						<?php foreach ( $social_media as $social_media_item ) : ?>
							<a target="_blank" href="<?= $social_media_item['url']; ?>">
								<img loading="lazy" src="<?= $social_media_item['icon']; ?>" alt="<?= $social_media_item['title']; ?>">
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
