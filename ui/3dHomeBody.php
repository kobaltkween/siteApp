            <section id="jumbo">
                <div class="imageFull">
                    <img src="<?php echo IMG_DIR . $pageData->mainImg; ?>" alt="Portrait of a woman in African Wear 1 & 2">
                    <h3><?php echo $pageData->name; ?></h3>
                </div>
            </section>
            <div id="text">
                <div class="describe">
                    <?php echo $pageData->description; ?>
                </div>
                <nav class="home3d">
                    <a id="products" href="<?php echo SITE_ROOT; ?>products/">Products</a>
                    <a id="gallery" href="<?php echo SITE_ROOT; ?>galleryImages/">Gallery</a>
                </nav>
            </div>  
