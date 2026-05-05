<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Gestión de Noticias</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmNoticia()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblNoticias">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Título</th>
                                <th>Contenido</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="nuevaNoticia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="title">Nueva Noticia</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmNoticia" onsubmit="registrarNoticia(event)">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="hidden" id="id" name="id">
                        <input id="titulo" class="form-control" type="text" name="titulo" required placeholder="Título corto o Novedad">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen (Opcional)</label>
                        <input id="imagen" class="form-control" type="file" name="imagen" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="contenido">Contenido</label>
                        <textarea id="contenido" class="form-control" name="contenido" rows="4" required placeholder="Descripción de la noticia"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>
