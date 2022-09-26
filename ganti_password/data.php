<?php include_once('../_header.php') ?>
  <div class="box">
    <h1>Ganti Password</h1>
    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
    <h4>
      <small>Ganti Password</small>
    </h4>

    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <form action="proses.php" method="post">
          <table class="table">
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Pasword Baru</th>
            </tr>
            <tr>
              <td></td>
              <td>
                <input type="text" name="username" class="form-control" value="<?= $_SESSION['user']; ?>" readonly>
              </td>
              <td>
                <input type="password" name="password" class="form-control" required>
              </td>
            </tr>
          </table>
          <div class="form-group">
            <input type="submit" name="edit" value="Simpan" class="btn btn-success">
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include_once('../_footer.php') ?>