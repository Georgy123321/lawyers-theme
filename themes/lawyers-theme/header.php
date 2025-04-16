<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<?php global $global_options; ?>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<header class="header">
			<div class="container">
				<div class="header_top">
					<div class="header_contact">
						<?php if (!empty($global_options['Header-Phone'])): ?>
							<div class="header_phone">
								<img src="<?php echo get_template_directory_uri(); ?> /assets/img/phone.svg" alt="phone">
								<p><?php echo $global_options['Header-Phone'] ?></p>
							</div>
						<?php endif; ?>

						<?php if (!empty($global_options['Header-Mail'])): ?>
							<div class="header_mail">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/mail.svg" alt="mail">
								<p><?php echo $global_options['Header-Mail'] ?></p>
							</div>
						<?php endif; ?>
					</div>

					<div class="header_button">
						<?php if (!empty($global_options['Header-Button'])): ?>
							<button><?php echo $global_options['Header-Button'] ?></button>
						<?php endif; ?>
					</div>
				</div>

				<div class="header_bottom">
					<div class="header_logo">
						<a href="#">
							<img src="<?php echo $global_options['Header-Logo']['url'] ?>" alt="logo">
						</a>
					</div>


					<div class="header_nav">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-header-pc',
								'menu_id'        => 'primary-menu',
								'container' => 'nav',
								'walker' => new Lawyers_Menu_Walker()
							)
						);
						?>
					</div>

					<!-- burger start -->

					<div class="header_number">
						<div class="hamburger-menu">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-header-mobile',
									'menu_id'        => 'primary-menu-mobile',
									'container'      => 'div',
									'container_class' => 'off-screen-menu',
									'walker'         => new Lawyers_Menu_Walker(),
								)
							);
							?>

							<nav>
								<div class="ham-menu">
									<span></span>
									<span></span>
									<span></span>
								</div>
							</nav>
						</div>
						<div class="overlay"></div>
					</div>

					<!-- burger end -->
				</div>
			</div>
		</header>