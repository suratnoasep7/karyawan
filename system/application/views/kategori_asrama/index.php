<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master Kategori Asrama</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Master Kategori Asrama</li>
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
                  <button type="button" class="btn btn-block btn-primary btn-flat" onclick="tambahKategoriAsrama()">Tambah Data Kategori Asrama</button>    
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbl_kategori_asrama" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Kode Kategori Asrama</th>
                  <th>Nama Kategori Asrama</th>
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
    <div class="modal fade" id="modalTambahKategoriAsrama">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <form id="kategori_asrama" method="post" name="kategori_asrama">
              <div class="form-group">
                <label for="kode_asrama">Kode Asrama</label>
                <input type="hidden" name="mode" value="tambah" id="mode">
                <input type="hidden" name="id" id="id">
                <input type="text" class="form-control" id="kode_asrama" name="kode_asrama" autocomplete="off" required="" >
              </div>
              <div class="form-group">
                <label for="nama_asrama">Nama Asrama</label>
                <input type="text" class="form-control" id="nama_asrama" name="nama_asrama" autocomplete="off" required="" maxlength="255">
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
            <button type="button" class="btn btn-primary" id="btn_tambah_kategori_asrama">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalDeleteKategoriAsrama">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p>Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
            <input type="hidden" name="id" id="id_delete_kategori_asrama">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_delete_kategori_asrama">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->