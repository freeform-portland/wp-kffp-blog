<?php /* start AceIDE restore code */
if ( $_POST["restorewpnonce"] === "7e83c4e74492e0c601db8f7196ea4d8f655318f1f4" ) {
if ( file_put_contents ( "/var/www/html/wp-content/themes/graphy-pro/archive-show.php" ,  preg_replace( "#<\?php /\* start AceIDE restore code(.*)end AceIDE restore code \* \?>/#s", "", file_get_contents( "/var/www/html/wp-content/plugins/aceide/backups/themes/graphy-pro/archive-show_2017-04-13-22.php" ) ) ) ) {
	echo __( "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file." );
}
} else {
echo "-1";
}
die();
/* end AceIDE restore code */ ?><?php
/**
 * @package Graphy
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <header class="entry-header">
      <h1 class="entry-title">
      Show Schedule
      </h1>
    </header>

    <?php
    $loop_day = '';
    $loop_hour = '';

    if(have_posts()) : while(have_posts()) : the_post();
      $id = get_the_ID();
      $custom_fields = get_post_custom();

      $day = $custom_fields['start_day'][0];

      if ($day !== $loop_day ) {
        if ($loop_day !== '') {
          echo '</ul></section>';
        }

        $loop_day = $day;

        if ($day < 7) {
        ?>
        <section class="schedule-block">
          <div class="day">
          <?= display_day_of_week($day, true); ?>
          </div>

          <ul class="schedule">
        <?php
        }
      }

      $hour = $custom_fields['start_hour'][0];

      if ($day < 7 && $hour !== '') {
        if ($hour !== $loop_hour) {
          $loop_hour = $hour;
        ?>
        <li class="hour-<?= $hour ?>">
        <?php } ?>

          <a href="<?php the_permalink() ?>">
          <?= $hour ?>:00 -
          <?php the_title(); ?>
          w/ <?= $custom_fields['dj_name'][0] ?>
          </a>
        <?php if ($hour !== $loop_hour) { ?>
        <li class="hour-<?= $hour ?>">
        </li>
        <?php }
        } ?>
    <?php
    endwhile; endif;
    ?>
    </ul>
    </section>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
