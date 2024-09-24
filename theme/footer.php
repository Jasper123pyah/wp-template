<?php
$phone_number = get_field('phone_number', 'option');
$email = get_field('email', 'option');
$street_name_and_number = get_field('street_name_and_number', 'option');
$postal_code_and_city = get_field('postal_code_and_city', 'option');
$kvk_number = get_field('kvk_number', 'option');
$social_media = get_field('social_media', 'option');
$contact_url = get_field('contact_url', 'option');
$privacy_url = get_field('privacy_url', 'option');
$terms_url = get_field('terms_url', 'option');
$logo = get_field('logo', 'option');
$phone_icon = get_field('icons', 'option')['phone'];
$mail_icon = get_field('icons', 'option')['mail'];
$footer_links = get_field('footer_links', 'option');
$header_links = get_field('header_links', 'option');
?>

<footer class="footer">
	<div class="footer-top">
		<div class="container">
			<div class="footer-top__container">
				<div class="footer-top__logo">
					<?php if ($logo): ?>
						<img src="<?= esc_url($logo['url']); ?>" alt="<?= esc_attr($logo['alt']); ?>" class="footer-logo">
					<?php endif; ?>
				</div>
				<div class="footer-top__contact">
					<h4 class="bold">Contact</h4>
					<?php if ($phone_number): ?>
						<a class="footer__link"
							href="tel:<?= esc_attr($phone_number); ?>"><?= $phone_icon; ?><?= esc_html($phone_number); ?></a>
					<?php endif; ?>
					<?php if ($email): ?>
						<a class="footer__link"
							href="mailto:<?= esc_attr($email); ?>"><?= $mail_icon; ?><?= esc_html($email); ?></a>
					<?php endif; ?>
					<?php if ($street_name_and_number): ?>
						<p><?= esc_html($street_name_and_number); ?></p>
					<?php endif; ?>
					<?php if ($postal_code_and_city): ?>
						<p><?= esc_html($postal_code_and_city); ?></p>
					<?php endif; ?>
					<?php if ($social_media): ?>
						<div class="footer__socials">
							<?php foreach ($social_media as $social): ?>
								<a class="footer__social" href="<?= esc_url($social['url']); ?>" target="_blank"
									rel="noopener noreferrer" aria-label="<?= esc_attr($social['title']); ?>">
									<?= $social['icon']; ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="footer-top__links footer-top__links--menu">
					<h4 class="bold">Menu</h4>
					<?php foreach ($header_links as $link_item): ?>
						<?php $link = $link_item['link']; ?>
						<a href="<?= esc_url($link['url']); ?>" class="navigation__link" <?= $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
							<?= esc_html($link['title']); ?>
						</a>
					<?php endforeach; ?>
				</div>
				<div class="footer-top__links">
					<h4 class="bold">Bekijk ook</h4>
					<?php foreach ($footer_links as $link_item): ?>
						<?php $link = $link_item['link']; ?>
						<a href="<?= esc_url($link['url']); ?>" class="navigation__link" <?= $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
							<?= esc_html($link['title']); ?>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="footer-bottom__container">
				<p class="footer-bottom__text">&copy; <?= date('Y'); ?> <?= get_bloginfo('name'); ?></p>
				<div class="footer-bottom__right">
					<?php if ($privacy_url): ?>
						<a href="<?= esc_url($privacy_url['url']); ?>"><?= esc_html($privacy_url['title']); ?></a>
					<?php endif; ?>
					<?php if ($terms_url): ?>
						<span class="footer-bottom__separator">|</span>
						<a href="<?= esc_url($terms_url['url']); ?>"><?= esc_html($terms_url['title']); ?></a>
					<?php endif; ?>
					<?php if ($kvk_number): ?>
						<span class="footer-bottom__separator">|</span>
						<p class="footer-bottom__text">KVK: <?= esc_html($kvk_number); ?></p>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>

</html>