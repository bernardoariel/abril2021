<!-- ======= Contact Section ======= -->
    <section id="contacto" class="contact ">

      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contacto</h2>
          <p>Podés llamarnos...Seguirnos en nuestras redes podés escribirnos... Respoderemos a la brevedad</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-6">

            <div class="row">
              
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bx bx-map text-danger"></i>
                  <h3><?php echo ucwords($sucursal["direccion"]); ?></h3>
                  <p> <?php echo ucwords($sucursal["localidad"]); ?></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bx bxl-whatsapp text-success"></i>
                  <h3>WhatsApp</h3>
                  <p> +54 <?php echo $sucursal["wasap"]; ?></p>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call colormedio"></i>
                  <h3>Telefono</h3>
                  <p>+54 <?php echo $sucursal["telefono"]; ?></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope text-primary"></i>
                  <h3>Email</h3>
                  <p><?php echo $sucursal["email"]; ?></p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form action="forms/contacto.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col form-group">
                  <input type="text" name="nombre" class="form-control" id="name" placeholder="Su Nombre" data-rule="minlen:4" data-msg="Por favor ingrese mas de 4 letras." />
                  <div class="validate"></div>
                </div>
                <div class="col form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Su Email" data-rule="email" data-msg="Por favor ingrese un email valido" />
                  <div class="validate"></div>
                </div>
              </div>
           <!--    <div class="form-group">
                <input type="text" class="form-control" name="asunto" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="Por favor ingrese como minimo 4 letras" />
                <div class="validate"></div>
              </div> -->
              <div class="form-group">
                <textarea class="form-control" name="mensaje" rows="5" data-rule="required" data-msg="Por favor escribanos un mensaje" placeholder="Mensaje"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">cargando</div>
                <div class="error-message"></div>
                <div class="sent-message">Su mensaje ha sido recibido. Muchas Gracias!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensaje</button></div>
            </form>
          </div>

        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-md-8 section-title mt-4">

            <?php echo $sucursal["google_maps"]; ?>

          </div>

          <div class="col-md-4 section-title mt-4">

              <img src="<?php echo $carpeta.'/'; ?>vistas/img/sucursales/<?php echo $sucursal['foto']; ?>" class="img-thumbnail">

          </div>

        </div>
        
    </section><!-- End Contact Section -->