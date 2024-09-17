<?php
$phone_number           = get_field( 'phone_number', 'option' );
$email                  = get_field( 'email', 'option' );
$street_name_and_number = get_field( 'street_name_and_number', 'option' );
$postal_code_and_city   = get_field( 'postal_code_and_city', 'option' );
$kvk_number             = get_field( 'kvk_number', 'option' );
$social_media           = get_field( 'social_media', 'option' );
$contact_url            = get_field( 'contact_url', 'option' );
$privacy_url            = get_field( 'privacy_url', 'option' );
$terms_url              = get_field( 'terms_url', 'option' );
?>

<footer class="footer">
	<div class="footer-top">
		<div class="container">
			<div class="footer-top__container">
				<div class="footer-top-left">
					<div class="footer-top__logo">
						<img src="<?= get_template_directory_uri(); ?>/assets/images/esther-logo-footer.svg"
								alt="Esther Lases Logo">
					</div>
				</div>
				<div class="footer-top-right">
					<div class="footer-top__contact">
						<h3 class="bold">Contact</h3>
						<a href="tel:<?= esc_html( $phone_number ) ?>">
							<?= esc_html( $phone_number ) ?>
						</a>
						<a href="mailto:<?= esc_html( $email ) ?>">
							<?= esc_html( $email ) ?>
						</a>
						<?php if ( $social_media ) : ?>
							<div class="footer-top__icons">
								<?php foreach ( $social_media as $social_media_item ) : ?>
									<a target="_blank" href="<?= esc_url( $social_media_item['url'] ); ?>">
										<img src="<?= esc_url( $social_media_item['icon'] ); ?>"
												alt="<?= esc_attr( $social_media_item['title'] ); ?>">
									</a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="footer-top__location">
						<h3 class="bold">Locatie</h3>
						<p>
							<?= esc_html( $street_name_and_number ); ?>
						</p>
						<p>
							<?= esc_html( $postal_code_and_city ); ?>
						</p>
					</div>
					<div class="footer-top__cta">
						<h4 class="bold">Benieuwd naar wat ik voor jou kan betekenen?</h4>
						<a href="<?= esc_url( $contact_url ) ?>" class="button button--white">Neem contact op</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="footer-bottom__container">
				<p>© Copyright Esther Lases <?= date( "Y" ); ?></p>
				<div class="footer-bottom__content">
					<a href="<?= esc_url( $privacy_url ) ?>">Privacyverklaring</a>
					|
					<a href="<?= esc_url( $terms_url ) ?>">Algemene voorwaarden</a>
					|
					<p>KVK <?= esc_html( $kvk_number ); ?></p>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>