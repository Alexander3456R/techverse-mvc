<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Elige tu plan</p>

     <div <?php echo aos_animation(); ?> class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratuito</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a TechVerse</li>
            </ul>

            <p class="paquete__precio">$0</p>

            <form method="POST" action="/finalizar-registro/gratis">
                <input class="paquetes__submit" type="submit" value="Inscripción Gratis">
            </form>
        </div>



        <div class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a TechVerse</li>
                <li class="paquete__elemento">Pase por dos días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Accesos a las grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y Bebida</li>
            </ul>

            <p class="paquete__precio">$79,99</p>
            <p class="paquete__elemento">Sin IVA incluido</p>

            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
    
        </div>



        <div class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a TechVerse</li>
                <li class="paquete__elemento">Pase por dos días</li>
                <li class="paquete__elemento">Enlace a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>

            <p class="paquete__precio">$39,99</p>
            <p class="paquete__elemento">Sin IVA incluido</p>

            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container-virtual"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Reemplazar CLIENT_ID por tu client id proporcionado al crear la app desde el developer dashboard) -->
<script src="https://www.paypal.com/sdk/js?client-id=AXRhSsiMrnj8g9lsjGlBwaEafgMxOMKtQjbcHgH3M6WNkxoScp08DKQw7rvehinWrJ7i2gNxpOBniMrW&enable-funding=venmo&currency=USD&locale=es_ES" data-sdk-integration-source="button-factory"></script>

<script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
            // Precio base
            const base = 79.99;
            // Impuesto 15%
            const tax = base * 0.15;
            // Total con impuesto
            const total = (base + tax).toFixed(2);
            
            return actions.order.create({
                    purchase_units: [{
                    description: "1",
                    amount: {
                        currency_code: "USD",
                        value: total,
                        breakdown: {
                        item_total: { value: base.toFixed(2), currency_code: "USD" },
                        tax_total: { value: tax.toFixed(2), currency_code: "USD" }
                        }
                    }
                    }]
                });
            },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
 
                const datos = new FormData();
                datos.append('paquete_id', orderData.purchase_units[0].description);
                datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

                fetch('/finalizar-registro/pagar', {
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(resultado => {
                    if(resultado.resultado) {
                        actions.redirect('http://localhost:3000/finalizar-registro/conferencias');
                    }
                })
            
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');

      // Pase virtual
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'blue',
                layout: 'vertical',
                label: 'pay',
            },

            createOrder: function(data, actions) {
                // Precio base para pase virtual
                const base = 39.99;
                // Impuesto 15%
                const tax = base * 0.15;
                // Total con impuesto
                const total = (base + tax).toFixed(2);

                return actions.order.create({
                    purchase_units: [{
                        description: "2",
                        amount: {
                            currency_code: "USD",
                            value: total,
                            breakdown: {
                                item_total: { value: base.toFixed(2), currency_code: "USD" },
                                tax_total: { value: tax.toFixed(2), currency_code: "USD" }
                            }
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    const datos = new FormData();
                    datos.append('paquete_id', orderData.purchase_units[0].description);
                    datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

                    fetch('/finalizar-registro/pagar', {
                        method: 'POST',
                        body: datos
                    })
                    .then(respuesta => respuesta.json())
                    .then(resultado => {
                        if(resultado.resultado) {
                            actions.redirect('http://localhost:3000/finalizar-registro/conferencias');
                        }
                    })

                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container-virtual');
        
        }
    initPayPalButton();
</script>