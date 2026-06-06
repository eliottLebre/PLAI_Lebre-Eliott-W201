<nav class="main-nav" aria-label="Menu principal">
    <ul class="main-nav__list">
        <li class="main-nav__item">
            <a href="<?= esc_url(home_url('/')); ?>" class="main-nav__link">
                <svg width="97" height="50" viewBox="0 0 97 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M64.0579 14.09V35.9084H59.4453V14.09H64.0579Z" fill="#292824"/>
                    <path d="M40.7571 35.9084H35.8145L43.3456 14.09H49.2895L56.81 35.9084H51.8674L46.4028 19.0758H46.2323L40.7571 35.9084ZM40.4482 27.3323H52.123V30.9332H40.4482V27.3323Z"
                          fill="#292824"/>
                    <path d="M19.4277 35.9084V14.09H24.0401V32.1051H33.3928V35.9084H19.4277Z" fill="#292824"/>
                    <path d="M0 35.9084V14.09H8.607C10.2616 14.09 11.6713 14.406 12.8359 15.0382C14.0006 15.6632 14.8883 16.5332 15.499 17.6483C16.1168 18.7562 16.4257 20.0346 16.4257 21.4835C16.4257 22.9324 16.1133 24.2108 15.4883 25.3188C14.8634 26.4267 13.958 27.2897 12.772 27.9076C11.5932 28.5255 10.1658 28.8344 8.48982 28.8344H3.00393V25.1377H7.74417C8.63185 25.1377 9.36331 24.985 9.93853 24.6796C10.5208 24.3671 10.954 23.9374 11.2381 23.3905C11.5293 22.8365 11.6748 22.2009 11.6748 21.4835C11.6748 20.7591 11.5293 20.127 11.2381 19.5872C10.954 19.0403 10.5208 18.6177 9.93853 18.3194C9.3562 18.014 8.61765 17.8613 7.72286 17.8613H4.61241V35.9084H0Z"
                          fill="#292824"/>
                    <path d="M76.4774 15.2271C78.1392 14.0144 80.4209 13.6691 82.5133 14.6968L92.7939 19.7465C97.1567 21.8895 97.1567 28.1089 92.7939 30.2518L82.5133 35.3015C80.4365 36.3216 78.1731 35.9892 76.5146 34.7983L75.4907 35.3015C71.663 37.1816 67.2006 34.4684 67.062 30.2509L67.0586 30.0489V19.9494C67.0587 15.6173 71.6023 12.7869 75.4907 14.6968L76.5149 15.1997C76.5023 15.2087 76.4899 15.218 76.4774 15.2271ZM74.9747 15.7472C71.8639 14.2194 68.2291 16.4837 68.229 19.9494V30.0489C68.2291 33.5146 71.8639 35.779 74.9747 34.2511L75.573 33.9568C74.6567 32.9415 74.0812 31.5904 74.0811 30.0489V19.9494C74.0812 18.4078 74.6568 17.0566 75.5733 16.0412L74.9747 15.7472ZM75.8962 34.2874C75.9043 34.2951 75.9124 34.3027 75.9205 34.3103C75.9124 34.3027 75.9043 34.2951 75.8962 34.2874ZM75.7851 34.1794C75.7891 34.1834 75.7933 34.1874 75.7973 34.1914C75.7933 34.1874 75.7891 34.1834 75.7851 34.1794ZM75.6722 34.0637C75.6768 34.0685 75.6813 34.0734 75.6859 34.0782C75.6813 34.0734 75.6768 34.0685 75.6722 34.0637ZM75.6936 15.9118C75.682 15.9239 75.6706 15.9362 75.659 15.9484C75.6706 15.9362 75.682 15.9239 75.6936 15.9118ZM75.8062 15.7978C75.7949 15.8089 75.7837 15.82 75.7725 15.8312C75.7837 15.82 75.7949 15.8089 75.8062 15.7978ZM75.9311 15.6783C75.9193 15.6893 75.9073 15.7001 75.8956 15.7112C75.9073 15.7001 75.9193 15.6893 75.9311 15.6783Z"
                          fill="#F33EAA"/>
                </svg>
            </a>
        </li>

        <li class="main-nav__item main-nav__item--has-overlay">
            <button type="button" class="main-nav__toggle-btn" id="js-main-nav__toggle-btn" aria-expanded="false" aria-controls="overlay-outils">
                Outils
            </button>

            <div id="overlay-outils js-main-nav__overlay" class="main-nav__overlay is-hidden">
                <ul class="main-nav__sublist">

                    <li class="main-nav__sublist__item">
                        <a href="<?= home_url('/tools'); ?>" class="main-nav__sublist__link">Voir tous les outils</a>
                    </li>

                    <?php
                    $args = [
                            'post_type' => 'sensibilisation',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC'
                    ];

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post(); ?>

                            <li class="main-nav__sublist__item">
                                <a href="<?php the_permalink(); ?>"
                                   class="main-nav__sublist__link"><?php the_title(); ?></a>
                            </li>

                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </ul>
            </div>
        </li>

        <li class="main-nav__item">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="main-nav__link">Déroulement d'une demande</a>
        </li>
        <li class="main-nav__item">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="main-nav__link">Introduire une demande</a>
        </li>
        <li class="main-nav__item">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="main-nav__link">Nous contacter</a>
        </li>
    </ul>
</nav>