<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master Mahasiswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Master Mahasiswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-3">
                  <button type="button" class="btn btn-block btn-primary btn-flat" onclick="tambahMahasiswa()">Tambah Data Mahasiswa</button>    
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbl_mahasiswa" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Alamat</th>
                  <td>Nomor Telepon</td>
                  <td>Status</td>
                  <td></td>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
    <div class="modal fade" id="modalTambahMahasiswa">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <form id="mahasiswa" method="post" name="mahasiswa">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="hidden" name="mode" value="tambah" id="mode">
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" id="nim" name="nim" autocomplete="off" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required="" maxlength="255">
                  </div>
                  <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required="">
                      <option value="">-- PILIH --</option>
                      <option value="L">Laki Laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" autocomplete="off" required="" maxlength="255">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off" required="">
                  </div>
                  <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" autocomplete="off" required="" maxlength="13" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" maxlength="255"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                      <option value="">-- PILIH --</option>
                      <option value="1">Aktif</option>
                      <option value="0">Tidak Akitf</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_tambah_mahasiswa">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalDeleteMahasiswa">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p>Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
            <input type="hidden" name="id" id="id_delete_mahasiswa">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_delete_mahasiswa">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->