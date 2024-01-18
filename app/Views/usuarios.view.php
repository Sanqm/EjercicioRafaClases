<!--Inicio HTML -->
<div class="row">       
        
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">UsuariosW</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th>Nombre usuario</th>
                            <th>Rol</th>
                            <th>Salario bruto</th>
                            <th>Retención</th>                                                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($usuarios as $u){
                        ?>
                        <tr class="<?php echo $u['activo'] == 0 ? 'table-danger' : ''; ?>">
                            <td><?php echo $u['username']; ?></td>
                            <td><?php echo $u['rol']; ?></td>
                            <td><?php echo number_format($u['salarioBruto'], 2, ',', '.'); ?></td>
                            <td><?php echo $u['retencionIRPF']; ?>%</td>                          
                        </tr>                    
                        <?php
                        }
                        ?>
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>                        
</div>
<!--Fin HTML -->