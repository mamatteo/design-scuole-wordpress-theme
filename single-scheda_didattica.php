<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Design_Scuole_Italia
 */
global $post, $autore;
get_header();

$link_schede_materiale_didattico = dsi_get_meta("link_schede_materiale_didattico");
$file_documenti = dsi_get_meta("file_documenti");




?>
    <main id="main-container" class="main-container bluelectric">
        <?php get_template_part("template-parts/common/breadcrumb"); ?>

        <?php while ( have_posts() ) :  the_post();
            if(has_post_thumbnail($post))
                $image_url = get_the_post_thumbnail_url($post, "item-thumb");
            else
                $image_url = get_template_directory_uri() ."/assets/placeholders/logo-service.png";
            $autore = get_user_by("ID", $post->post_author);
            ?>

            <section class="section bg-white py-2 py-lg-3 py-xl-5">
                <div class="container">
                    <div class="row variable-gutters">
                        <div class="col-12 col-sm-3 col-lg-2 d-none d-sm-block">
                            <div class="section-thumb mx-3">
                                <img src="<?php echo $image_url; ?>">
                            </div><!-- /section-thumb -->
                        </div><!-- /col-lg-2 -->
                        <div class="col-12 col-sm-9 col-lg-5 col-md-8">
                            <div class="section-title">
                                <h2 class="mb-3"><?php the_title(); ?></h2>
                                <h4 class="text-bluelectric mb-3"><?php
                                    $percorsi = dsi_get_percorsi_of_scuola($post);
                                    if(is_array($percorsi) && count($percorsi) > 0){
                                        $c=0;
                                        foreach ($percorsi as $percorso){
                                            if($c)
                                                echo ", ";
                                            echo $percorso->name;
                                            $c++;
                                        }
                                    }
                                    ?></h4>
                                <p><?php echo dsi_get_meta("descrizione"); ?></p>
                            </div><!-- /title-section -->
                        </div><!-- /col-lg-5 col-md-8 -->
                        <div class="col-lg-3 col-md-4 offset-lg-1">
                            <aside class="badges-wrapper badges-main mt-0">
                                <h4><?php _e("Insegnante", "design_scuole_italia"); ?></h4>
                                <div class="card card-avatar card-comments mt-3">
                                    <div class="card-body p-0">
                                        <?php get_template_part("template-parts/autore/card", "insegnante"); ?>
                                    </div><!-- /card-body -->
                                </div><!-- /card card-avatar -->
                            </aside>
                            <?php
                            global $badgeclass;
                            $badgeclass = "badge-outline-bluelectric";
                            get_template_part("template-parts/common/badges-argomenti");
                            ?>
                            <?php get_template_part("template-parts/single/actions"); ?>


                        </div><!-- /col-lg-3 col-md-4 offset-lg-1 -->
                    </div><!-- /row -->
                </div><!-- /container -->
            </section><!-- /section -->



            <section class="section bg-white">
                <div class="container container-border-top">
                    <div class="row variable-gutters">
                        <div class="col-lg-3 aside-border px-0">
                            <aside class="aside-main aside-sticky">
                                <div class="aside-title">
                                    <a class="toggle-link-list" data-toggle="collapse" href="#lista-paragrafi" role="button" aria-expanded="true" aria-controls="lista-paragrafi">
                                        <span><?php _e("Indice Scheda Didattica", "design_scuole_italia"); ?></span>
                                        <svg class="icon icon-toggle svg-arrow-down-small"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-down-small"></use></svg>
                                    </a>
                                </div>
                                <div id="lista-paragrafi" class="link-list-wrapper collapse show">
                                    <ul class="link-list">
                                        <li>
                                            <a class="list-item scroll-anchor-offset" href="#art-par-obiettivi" title="Vai al paragrafo <?php _e("Obiettivi", "design_scuole_italia"); ?>"><?php _e("Obiettivi", "design_scuole_italia"); ?></a>
                                        </li>
                                        <li>
                                            <a class="list-item scroll-anchor-offset" href="#art-par-contenuti" title="Vai al paragrafo <?php _e("Il Contenuto", "design_scuole_italia"); ?>"><?php _e("Il Contenuto", "design_scuole_italia"); ?></a>
                                        </li>
                                        <li>
                                            <a class="list-item scroll-anchor-offset" href="#art-par-info" title="Vai al paragrafo <?php _e("Risorse", "design_scuole_italia"); ?>"><?php _e("Risorse", "design_scuole_italia"); ?></a>
                                        </li>

                                    </ul>
                                </div>
                            </aside>

                        </div>
                        <div class="main-content col-lg-6">
                            <article class="article-wrapper pt-4 px-3">
                                <h4 id="art-par-obiettivi"><?php _e("Obiettivo", "design_scuole_italia"); ?></h4>
                                <?php
                                $obiettivi = dsi_get_meta("obiettivi");
                                echo wpautop($obiettivi);


                                $tempo_apprendimento = dsi_get_meta("tempo_apprendimento");
                                if($tempo_apprendimento != "") {
                                    ?>
                                    <h6><?php _e( "Tempo di apprendimento", "design_scuole_italia" ); ?></h6>
                                    <p>
                                        <?php
                                        _e("Apprendimento in: ", "design_scuole_italia");
                                        echo $tempo_apprendimento;
                                        ?>
                                    </p>

                                    <?php
                                }
                                ?>
                                <h4 id="art-par-contenuti"><?php _e("L'argomento", "design_scuole_italia"); ?></h4>
                                <div class="col-lg-12 px-0 wysiwig-text">
                                <?php the_content(); ?>
                                </div>

                                <?php
                                $descrizione_attivita = dsi_get_meta("descrizione_attivita");
                                ?>
                                <h4><?php _e("Attività", "design_scuole_italia"); ?></h4>
                                <div class="col-lg-12 px-0 wysiwig-text">
                                <?php
                                echo wpautop($descrizione_attivita);

                                $attivita = dsi_get_meta("fasi_attivita");
                                if(is_array($attivita) && count($attivita) > 0){
                                    ?>
                                    <?php
                                    foreach ($attivita as $step) {
                                        ?>
                                        <div class="text-border-left">
                                            <p><?php echo wpautop($step); ?></p>
                                        </div><!-- /text-border-left -->
                                        <?php
                                    }
                                }
                                ?>
                                </div>
                                <?php

                                $verifica = dsi_get_meta("fasi_verifica");
                                if(is_array($verifica) && count($verifica) > 0) {

                                    ?>
                                    <h6><?php _e( "Verifica apprendimento", "design_scuole_italia" ); ?></h6>

                                    <?php
                                    foreach ($verifica as $step) {
                                        ?>
                                        <div class="text-border-left wysiwig-text">
                                            <p><?php echo wpautop($step); ?></p>
                                        </div><!-- /text-border-left -->
                                        <?php
                                    }
                                }
                                ?>
                                <h4 id="art-par-info"><?php _e("Risorse", "design_scuole_italia"); ?></h4>
                                <?php if((is_array($link_schede_materiale_didattico) && count($link_schede_materiale_didattico)>0) || (is_array($file_documenti) && count($file_documenti)>0)){ ?>
                                    <div class="card-deck card-deck-spaced">
                                        <?php
                                        if(is_array($link_schede_materiale_didattico) && count($link_schede_materiale_didattico)>0) {
                                            global $documento;
                                            foreach ( $link_schede_materiale_didattico as $link_scheda_documento ) {
                                                $documento = get_post( $link_scheda_documento );
                                                get_template_part( "template-parts/documento/card" );
                                            }
                                        }

                                        global $idfile, $nomefile;
                                        if(is_array($file_documenti) && count($file_documenti)>0) {

                                            foreach ( $file_documenti as $idfile => $nomefile ) {
                                                get_template_part( "template-parts/documento/file" );
                                            }
                                        }
                                        ?>
                                    </div><!-- /card-deck card-deck-spaced -->
                                <?php } ?>



                                <?php get_template_part("template-parts/single/bottom"); ?>
                            </article>
                        </div><!-- /col-lg-6 -->
                        <div class="col-lg-3 ">
                            <div class="aside-sticky">


                            </div>
                        </div><!-- /col-lg-3 -->
                    </div><!-- /row -->
                </div><!-- /container -->
            </section>

            <?php get_template_part("template-parts/single/more-scheda_didattica"); ?>

        <?php  	endwhile; // End of the loop. ?>
    </main><!-- #main -->
<?php
get_footer();
