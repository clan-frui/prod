<div id="fadeOutAco" class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Rôles</h3>
    </div>
    <table id="datatable_aco" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if($groups){
                foreach($groups as $group){ ?>
                <tr>
                    <td><span class="<?= $group['Group']['color']; ?>"><?= $group['Group']['role']; ?></span></td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a class="editRole" data-id="<?= $group['Group']['id']; ?>">
                                        <i class="fa fa-pencil"></i> <?= 'Editer les droits de ce rôle'; ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="supprimerRole" data-id="<?= $group['Group']['id']; ?>">
                                        <i class="fa fa-user-times"></i> Supprimer le rôle
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>