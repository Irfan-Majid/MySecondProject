<?php require_once('../include/header.php') ?>
<div class="container-fluid">
  <div class="row">
    <?php require_once('../include/navbar.php') ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
      </div>

      <a class="btn btn-primary float-end" href="<?= $base_url ?>user/create.php">New User</a>
      <div class="table-responsive" style="clear:both">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>id</th>
              <th>name</th>
              <th>user name</th>
              <th>e-mail</th>
              <th>Contacts</th>
              <th>level</th>
              <th>status</th>
              <th>Created at</th>
              <th>Last log in</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $rs = $crud->common_select("users");
            if ($rs['success'] == 1) {
              foreach ($rs['msg'] as $i => $data) {
            ?>
                <tr>
                  <td><?= ++$i ?></td>
                  <td><?= $data->id ?></td>
                  <td><?= $data->name ?></td>
                  <td><?= $data->user_name ?></td>
                  <td><?= $data->email ?></td>
                  <td><?= $data->contact ?></td>
                  <td><?= $data->level ?></td>
                  <td><?= $data->status ?></td>
                  <td><?= $data->created_at ?></td>
                  <td><?= $data->last_login ?></td>
                  <td><a href="edit.php?id=<?= $data->id  ?>" class="btn btn-outline-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                      </svg></a>
                    <button class="btn btn-sm btn-secondary"></button>
                    <a href="delete.php?id=<?= $data->id ?>" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg></a>
                  </td>
                </tr>
            <?php } //end foreach
            } //end if
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<?php require_once('../include/footer.php') ?>