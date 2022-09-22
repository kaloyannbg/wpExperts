// single.php in your current theme 
// add this code there

                    <script>
                    function showMapFunction() {
                    document.getElementById("map-acf").style = "none";
                    }
                    </script>
                    //replace this
                    <div class="detail-content">
                        <?php
                            $mapLocation = get_field('map_location'); 
                            
                        ?>
                        <div class="acf-map" id="map-acf" style="overflow:auto">
                            <?php
                                if(!empty($mapLocation['lat']))                  
                                    echo '<div class="marker" data-lat="'.$mapLocation['lat'].'" data-lng="'.$mapLocation['lng'].'">
                                    <div style="color: black;">'.esc_html( $mapLocation['address']).'</div></div>';
                            ?>
                        </div>
                        <div class="map-box" onclick="showMapFunction()">Show Map</div>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/content', 'single'); ?>
                        <?php endwhile; // End of the loop. 
                        ?>
                        <?php comments_template(); ?>

                    </div><!-- /.end of deatil-content -->
