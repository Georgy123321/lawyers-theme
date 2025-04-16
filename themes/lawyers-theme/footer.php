<?php global $global_options; ?>

<footer class="footer" id="footer">
	<div class="container">
		<div class="footer_top">
			<div class="footer_logo">
				<img src="<?php echo $global_options['footer-Logo']['url'] ?>" alt="logo">
			</div>

			<div class="footer_top-title">
				<p><?php echo $global_options['footer-desck'] ?></p>
			</div>
		</div>

		<span class="footer_border"></span>

		<div class="footer_bottom">
			<div class="footer_info">
				<?php if (!empty($global_options['footer-addres'])): ?>
					<div class="footer_card">
						<div class="footer_img">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/map.svg" alt="map">
						</div>
						<div class="footer_desc">
							<p>Наш адрес</p>
							<a href="#"><?php echo $global_options['footer-addres'] ?></a>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($global_options['footer-Phone'])): ?>
					<div class="footer_card">
						<div class="footer_img">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/phone-footer.svg" alt="map">
						</div>
						<div class="footer_desc">
							<p>Запись на консультанцию</p>
							<a href="tel:+"><?php echo $global_options['footer-Phone'] ?></a>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($global_options['footer-Mail'])): ?>
					<div class="footer_card">
						<div class="footer_img">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/mail-footer.svg" alt="map">
						</div>
						<div class="footer_desc">
							<p>Корреспонденция</p>
							<a href="mailto:"><?php echo $global_options['footer-Mail'] ?></a>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<div class="footer_nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-footer',
						'menu_id'        => 'primary-menu-footer',
						'container'        => 'nav',
						'walker' => new Lawyers_Menu_Walker(),
					)
				);
				?>
			</div>

			<div class="footer_lawyer">
				<div class="footer_lawyer-user">
					<div class="avatar">
						<img src="<?php echo $global_options['footer-avatar']['url']?>" alt="avatar">
					</div>
					<div class="footer_user">
						<h5><?php echo $global_options['footer-name']?></h5>
						<p><?php echo $global_options['footer-post']?></p>
					</div>
				</div>
				<p><?php echo $global_options['footer-user-desc']?></p>

				<?php if(!empty($global_options['footer-button'])):?>
					<button class="button_blue"><?php echo $global_options['footer-button']?></button>
				<?php endif?>
			</div>
		</div>
	</div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>