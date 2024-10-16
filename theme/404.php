<?php get_header(); ?>

<div id="primary" class="container">
   <main id="main" class="site-main" role="main">
       <section class="error-404 not-found">
           <header class="page-header">
               <h1 class="page-title">Oeps! Die pagina kan niet worden gevonden.</h1>
           </header>
           <div class="page-content">
               <p>Het lijkt erop dat er niets is gevonden op deze locatie.</p>
               <p><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Terug naar de Startpagina', 'text-domain' ); ?></a></p>
           </div>
       </section>
   </main>
</div>

<?php get_footer(); ?>
