<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

            <div class="container mx-auto px-4">
                <div class="md:grid grid-cols-2 gap-16">
                    <div class="md:sticky top-0 self-start pr-20">
                        <h1 class="text-5xl font-bold pt-16 text-slate-100">Joey Dunn</h1>
                        <p class="text-2xl text-slate-100 mt-2"><?php echo get_field('homepage_title'); ?></p>
                        <p class="mt-4"><?php echo get_field('homepage_summary'); ?></p>
                        <div class="flex gap-4 mt-8">
                            <div>
                                <a href="https://github.com/nicelydunn/" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-white h-12 w-12" viewBox="0 0 24 24">
                                        <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0 1 12 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a href="https://www.linkedin.com/in/joey-mec-dunn/" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-white h-12 w-12" viewBox="0 0 24 24">
                                        <path d="M19 0H5a5 5 0 0 0-5 5v14a5 5 0 0 0 5 5h14a5 5 0 0 0 5-5V5a5 5 0 0 0-5-5zM8 19H5V8h3v11zM6.5 6.732c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zM20 19h-3v-5.604c0-3.368-4-3.113-4 0V19h-3V8h3v1.765c1.396-2.586 7-2.777 7 2.476V19z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="pt-16"> 
                        <div class="prose text-slate-400">
                            <?php echo get_field('homepage_introduction'); ?>
                        </div>

                        <?php
                            $args = array(
                                'post_type' => 'jobs',
                                'posts_per_page' => -1,
                            );
                            $query = new WP_Query($args);
                        ?>

                        <?php if ($query->have_posts()) : ?>
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <?php if( get_field('jobs_website_url') ) { echo '<a href="' . get_field('jobs_website_url') . '" target="blank">'; } ?>
                                    <div class="grid grid-cols-4 mt-8">
                                        <div class="text-slate-500 text-sm">
                                            <?php if(get_field('jobs_date_period')) { echo get_field('jobs_date_period'); } ?>
                                        </div>
                                        <div class="col-span-3">
                                            <p class="text-slate-100"><?php echo get_the_title(); ?></p>
                                            <p class="text-slate-500">
                                                <?php if(get_field('jobs_company')) { echo get_field('jobs_company'); } ?> - 
                                                <?php if(get_field('jobs_location')) { echo get_field('jobs_location'); } ?>
                                            </p>
                                            <div class="text-sm mt-2">
                                                <?php if(get_field('jobs_description')) { echo get_field('jobs_description'); } ?>
                                            </div>
                                            <div class="flex flex-wrap gap-1 mt-4">
                                                <?php
                                                    $post_id = get_the_ID();
                                                    $terms = get_the_terms($post_id, 'skills');
                                                    if ($terms && !is_wp_error($terms)) {
                                                        foreach ($terms as $term) {
                                                            echo '<div class="inline-block rounded-2xl bg-slate-700 px-2 py-1 text-xs text-teal-500">' . $term->name . '</div>';
                                                        }
                                                    }
                                                ?>
                                            </div> 
                                        </div>
                                    </div>
                                    <?php if( get_field('jobs_website_url') ) { echo '</a>'; } ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <?php endif; ?>
                        
                        <?php
                            $args = array(
                                'post_type' => 'projects',
                                'posts_per_page' => -1,
                            );
                            $query = new WP_Query($args);
                        ?>

                        <?php if ($query->have_posts()) : ?>
                            <p class="text-slate-100 mt-16">Recent Work</p>
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="grid grid-cols-5 mt-8 gap-4">
                                    <?php
                                        if ( has_post_thumbnail() ) {
                                            $thumbnail_id    = get_post_thumbnail_id();
                                            $thumbnail_class = 'your-class';
                                        }
                                    ?>
                                    <div class="col-span-2">
                                        <?php echo wp_get_attachment_image( $thumbnail_id, 'full', false, array( 'class' => $thumbnail_class ) ); ?>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="text-slate-100"><?php echo get_the_title(); ?></p>
                                        <p class="prose-sm">
                                                <?php if(get_field('project_description')) { echo get_field('project_description'); } ?>
                                        </p>
                                        <div class="flex flex-wrap gap-1 mt-4">
                                                <?php
                                                    $post_id = get_the_ID();
                                                    $terms = get_the_terms($post_id, 'skills');
                                                    if ($terms && !is_wp_error($terms)) {
                                                        foreach ($terms as $term) {
                                                            echo '<div class="inline-block rounded-2xl bg-slate-700 px-2 py-1 text-xs text-teal-500">' . $term->name . '</div>';
                                                        }
                                                    }
                                                ?>
                                            </div> 
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                            
                           
                    </div>
                </div>
            </div>

		<?php endwhile; ?>

	</main><!-- #main -->

<?php
get_footer();