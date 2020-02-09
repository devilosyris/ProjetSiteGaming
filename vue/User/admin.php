<?php
if(isset($_SESSION['id']) AND $_SESSION['statut'] == 1) {
    
}

?>
<table class="table table-hover mt-5 container pt-5">
  <thead>
    <tr class="table-danger">
      <th scope="col">ID</th>
      <th scope="col">Pseudo</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Email</th>
      <th scope="col">Info</th>
      <th scope="col">Avatar</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($user as $key => $member) {

        ?>
    <tr class="table-active">
      <td><?= htmlentities($member->getId(), ENT_QUOTES) ?></td>
      <td><?= htmlentities($member->getPseudo(), ENT_QUOTES) ?></td>
      <td><?= htmlentities($member->getNom(), ENT_QUOTES) ?></td>
      <td><?= htmlentities($member->getPrenom(), ENT_QUOTES) ?></td>
      <td><?= htmlentities($member->getEmail(), ENT_QUOTES) ?></td>
      <td><?= htmlentities($member->getInfo(), ENT_QUOTES) ?></td>
      <td>
        <div class="container-fluid">
            <img src="<?= WEBROOT.'img/avatar/'.htmlentities($member->getAvatar(), ENT_QUOTES) ?>" alt="" class="mx-auto rounded-circle img-fluid d-block">
        </div>
      </td>
      <td>
      <span>
        <a class="text-info" href="">
            <i class="fas fa-edit fa-2x"></i>
        </a>
      </span>
      <span>
        <a class="text-danger" href="">
          <i class="fas fa-trash fa-2x"></i>
        </a>
      </span>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table> 