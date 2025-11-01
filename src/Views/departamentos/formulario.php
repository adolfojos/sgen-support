<!-- Menú lateral izquierdo (plantilla base) -->
<aside id="left-side-menu">
    <ul class="collapsible collapsible-accordion">
        <li class="no-padding">
            <a href="RUTA_1.html" class="waves-effect waves-grey">
                <i class="material-icons">menu</i>Nombre Sección 1
            </a>
        </li>
        <li class="no-padding">
            <a href="RUTA_2.html" class="waves-effect waves-grey">
                <i class="material-icons">menu</i>Nombre Sección 2
            </a>
        </li>
    </ul>
</aside>
<?php 
$is_editing = isset($departamento) && $departamento !== null; 
$action_title = $is_editing ? 'Editar' : 'Crear';
?>
<article>
    <div class="conten-body">
        <div class="card-panel">
            <!-- Título -->
            <div class="card-title">
                <div class="row">
                    <div class="header-title-left col s12">
                        <h5><?php echo $action_title; ?> Departamento</h5>
                    </div>
                </div>
            </div>

            <!-- Formulario -->
            <form action="<?=BASE_URL?>departamentos/guardar" method="POST">
                <?php if ($is_editing): ?>
                    <input type="hidden" name="id" value="<?php echo $departamento->id; ?>">
                <?php endif; ?>

                <div id="pp">
                    <!-- nombre -->
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="nombre" name="nombre" required value="<?php echo $is_editing ? htmlspecialchars($departamento->nombre) : ''; ?>" />
                            <label class="required" for="nombre">Nombre del Departamento:</label>
                        </div>
                    </div>
                <!-- Botones -->
                <div class="row btn-actions">
                    <div class="col l12">
                        <button type="submit" name="action" class="btn waves-effect waves-light btn-first">
                            <?php echo $is_editing ? 'Actualizar' : 'Registrar'; ?> Departamento
                        </button>
                        <a href="<?=BASE_URL?>departamentos" class="btn grey" title="Regresar">Regresar</a>
                    </div>
                </div>
            </form>
        </div> <!-- card-panel -->
    </div> <!-- conten-body -->
</article>