<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master Assign Jabatan Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Master Assign Jabatan Pegawai</li>
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
                <div class="col-md-4">
                  <button type="button" class="btn btn-block btn-primary btn-flat" onclick="tambahAssignJabatanPegawai()">Tambah Data Assign Jabatan Pegawai</button>    
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbl_assign_jabatan_pegawai" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Jabatan</th>
                  <th>NIP</th>
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
    <div class="modal fade" id="modalTambahAssignJabatanPegawai">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <form id="assign_jabatan_pegawai" method="post" name="assign_jabatan_pegawai">
              <div class="form-group">
                <input type="hidden" name="mode" value="tambah" id="mode">
                <input type="hidden" name="id" id="id">
                <label for="id_jabatan">Jabatan</label>
                <select class="form-control" name="id_jabatan" id="id_jabatan" style="width: 100%;">
                </select>
              </div>
              <div class="form-group">
                <label for="nip">NIP</label>
                <select class="form-control select2" name="nomor" id="nomor" style="width: 100%;">
                </select>
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                  <option value="">-- PILIH --</option>
                  <option value="1">Aktif</option>
                  <option value="0">Tidak Akitf</option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_tambah_assign_jabatan_pegawai">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalDeleteAssignJabatanPegawai">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p>Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
            <input type="hidden" name="id" id="id_delete_assign_jabatan_pegawai">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_delete_assign_jabatan_pegawai">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->