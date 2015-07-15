<div id="offcanvas_container">

	<nav>

		<div id="trigger-mobile" class="close-menu js-close-menu js-collapse-offcanvas reorder-close">x</div>

		<?php
/*		if ( has_nav_menu ( 'primary_navigation' ) ) :

			$defaults = array (
				'theme_location' => 'primary_navigation' ,
				'menu'           => 'primary' ,
				'container'      => '' ,
				'echo'           => TRUE ,
				'before'         => '' ,
				'after'          => '' ,
				'link_before'    => '' ,
				'link_after'     => '' ,
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>' ,
				'depth'          => 4 ,

			);

			wp_nav_menu ( $defaults );

		endif;

		*/?>

        <!-- Demos links -->

		<ul>
			<li><a>Item 1</a></li>
			<li><a>Item 2</a></li>
			<li><a>Item 3</a></li>
			<li><a>Item 4</a></li>
			<li>
                <a>Item 5</a></a>
                <ul>
                    <li><a>Sub-item 5.1</a></li>
                    <li><a>Sub-item 5.2</a></li>
                    <li><a>Sub-item 5.3</a></li>
                    <li>
                        <a>Sub-item 5.4</a>
                        <ul>
                            <li><a>Sub-item 5.4.1</a></li>
                            <li><a>Sub-item 5.4.2</a></li>
                            <li><a>Sub-item 5.4.3</a></li>
                        </ul>
                    </li>
                </ul>

            </li>
		</ul>

        <!-- End Demos links -->

	</nav>

</div>