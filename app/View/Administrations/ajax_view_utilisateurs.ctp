    <table id="datatable_utilisateur" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Rôle</th>
            <th>Pseudo</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Mail</th>
            <th>Statut</th>
            <th>Dernière connection</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            <?php
                if($utilisateurs){
                    foreach($utilisateurs as $utilisateur){
                        ?>
                        <tr>
                            <td><span class="<?= $utilisateur['Group']['color']; ?>"><?=
                                    $utilisateur['Group']['role'];?></span></td>
                            <td><a class="edit-utilisateur" data-type="text" data-pk="{userId:<?=
                                $utilisateur['User']['id'];?>, name:'pseudo'}"><?= $utilisateur['User']['pseudo'];
                                ?></a></td>
                            <td><a class="edit-utilisateur" data-type="text" data-pk="{userId:<?=
                                $utilisateur['User']['id'];?>, name:'nom'}"><?= $utilisateur['User']['nom'];
                                    ?></a></span></td>
                            <td><a class="edit-utilisateur" data-type="text" data-pk="{userId:<?=
                                $utilisateur['User']['id'];?>, name:'prenom'}"><?= $utilisateur['User']['prenom'];
                                    ?></a></td>
                            <td><a class="edit-utilisateur" data-type="text" data-pk="{userId:<?=
                                $utilisateur['User']['id'];?>, name:'mail'}"><?= $utilisateur['User']['mail'];
                                    ?></a></td>
                            <td><span class="statut" data-id="<?= $utilisateur['User']['id'];?>"
                                      data-statut="<?= $utilisateur['User']['statut']; ?>"><?=
                                    $utilisateur['User']['statut'] == 1 ?
                                        '<i style="color: green;" class="fa fa-check-square-o"></i>' :
                                    '<i style="color: red;" class="fa fa-window-close-o"</i>'; ?></span></td>
                            <td><?= $utilisateur['User']['last_login']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a class="supprimerUtilisateur" data-id="<?= $utilisateur['User']['id']; ?>">
                                                <i class="fa fa-user-times"></i> <?= 'Supprimer l\'utilisateur'; ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="editRoleUtilisateur" data-id="<?= $utilisateur['User']['id']; ?>">
                                                <i class="fa fa-user-o"></i> <?= 'Changer de rôle'; ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php }
                }?>
        </tbody>
    </table>

