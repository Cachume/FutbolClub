<?php
    require_once 'vistas/layout/user/header.php';
    $total = 0;
?>
    <div class="payplayers-container">
            <h2>Pagar Mensualidad Septiembre</h2>
            <div class="pay-data">
                <!-- <?php var_dump($this->data);
            ?> -->
                <table class="player-tablepay">
                    <thead>
                        <tr>
                            <th>Nombre del Jugador</th>
                            <th>Categoria</th>
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->data as $datos):?>
                        <tr>
                            <td><?=htmlspecialchars($datos['nombres']." ".$datos['apellidos']); ?></td>
                            <td><?=htmlspecialchars($datos['nombre_categoria']); ?></td>
                            <td><?=htmlspecialchars($datos['monto']); ?></td>
                        </tr>
                        <?php $total += intval($datos['monto']); 
                            endforeach; ?>
                        <tr style="border-top: 1px solid black;">
                            <td><strong>TOTAL:</strong></td>
                            <td><?php echo number_format($total*156);?>Bs</td>
                            <td><?php echo number_format($total);?>$</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form class="form-pay" action="/FutbolClub/usuario/pagarPost" method="post" enctype="multipart/form-data">
                <input type="hidden" name="monto_pago" value="<?php echo htmlspecialchars($total); ?>">
                <input type="hidden" name="descripcion_pago" value="Mensualidad Septiembre">
                <input type="hidden" name="id_pago" value="<?php echo htmlspecialchars($this->pago); ?>">
                <div class="method-payments">
                    <h2>¿Como desea Pagar?</h2>
                    <div class="method-payments-group">
                        <label for="metodo_pago">Método de Pago:</label>
                        <select id="metodo_pago" name="metodo_pago">
                            <option value="">-- Selecciona un método --</option>
                            <option value="efectivo">Efectivo</option>
                            <option value="pago_movil">Pago Móvil</option>
                            <option value="transferencia">Transferencia Bancaria</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>
                    <div class="methods-payments">
                        <div class="metodo pago_movil" id="pago_movil" style="display: none;">
                            <h3>Pago Móvil</h3>
                            <p><strong>Teléfono:</strong> <span id="telefono_pm">0414-1234567</span></p>
                            <p><strong>Cédula:</strong> <span id="cedula_pm">V-12345678</span></p>
                            <p><strong>Banco:</strong> <span id="banco_pm">Banco de Venezuela</span></p>
                            <p><strong>Referencia:</strong> <span id="referencia_pm">987654321</span></p>
                        </div>
                        
                        <div class="metodo efectivo" style="display: none;">
                            <h3>Pago en Efectivo</h3>
                            <p>Puede pagar directamente en caja el día del evento.</p>
                        </div>

                        <!-- Pago móvil (ejemplo con 2 bancos distintos) -->
                        <div class="metodo pago_movil" style="display: none;">
                            <h3>Pago Móvil #1</h3>
                            <p><strong>Teléfono:</strong> 0414-1234567</p>
                            <p><strong>Cédula:</strong> V-12345678</p>
                            <p><strong>Banco:</strong> Banco de Venezuela</p>
                            <p><strong>Referencia:</strong> 987654321</p>
                        </div>

                        <div class="metodo pago_movil" style="display: none;">
                            <h3>Pago Móvil #2</h3>
                            <p><strong>Teléfono:</strong> 0424-7654321</p>
                            <p><strong>Cédula:</strong> V-87654321</p>
                            <p><strong>Banco:</strong> Provincial</p>
                            <p><strong>Referencia:</strong> 123456789</p>
                        </div>

                        <!-- Transferencia bancaria (ejemplo con 2 cuentas) -->
                        <div class="metodo transferencia" style="display: none;">
                            <h3>Transferencia #1</h3>
                            <p><strong>Banco:</strong> Banco Mercantil</p>
                            <p><strong>Número de cuenta:</strong> 0105-0012-34-0005678901</p>
                            <p><strong>Titular:</strong> Juan Pérez</p>
                        </div>

                        <div class="metodo transferencia" style="display: none;">
                            <h3>Transferencia #2</h3>
                            <p><strong>Banco:</strong> Banco de Venezuela</p>
                            <p><strong>Número de cuenta:</strong> 0102-0345-67-0012345678</p>
                            <p><strong>Titular:</strong> María González</p>
                        </div>

                        <!-- PayPal -->
                        <div class="metodo paypal" style="display: none;">
                            <h3>PayPal</h3>
                            <p><strong>Correo:</strong> pagos@miempresa.com</p>
                            <p><strong>Nota:</strong> Enviar como "Amigos y Familiares" para evitar comisiones.</p>
                        </div>
                        </div>
                    </div>
                    <h3 id="titlepay" style="display:none;">Completa los datos del pago</h3>
                        <div class="payment-data" id="payment-data">
                            <input type="hidden" name="metodo_pago_hidden" id="metodo_pago_hidden">
                        <div class="form-group">
                            <label for="fecha_pago">Fecha del Pago:</label>
                            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="referencia">Referencia del Pago:</label>
                            <input type="text" name="referencia" id="referencia" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="comprobante">Subir comprobante (imagen):</label>
                            <input type="file" name="comprobante" id="comprobante" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                    <div class="form-buttons" id="form-buttons">
                        <button type="submit" class="btn-submit">Enviar</button>
                        <button type="reset" class="btn-reset">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>    
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/payments.js"></script>
</body>
</html>