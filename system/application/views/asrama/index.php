<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master Asrama</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Master Asrama</li>
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
                  <button type="button" class="btn btn-block btn-primary btn-flat" onclick="tambahAsrama()">Tambah Asrama</button>    
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbl_asrama" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Kode Asrama</th>
                  <th>Lantai</th>
                  <th>Hall</th>
                  <th>Nomor Kamar</th>
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
    <div class="modal fade" id="modalTambahAsrama">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <form id="asrama" method="post" name="asrama">
              <div class="form-group">
                <label for="kode_asrama">Kode Asrama</label>
                <input type="hidden" name="mode" value="tambah" id="mode">
                <input type="hidden" name="id" id="id">
                <select name="kode_asrama" class="form-control" id="kode_asrama"></select>
              </div>
              <div class="form-group">
                <label for="lantai">Lantai</label>
                <select class="form-control" name="lantai" required="" id="lantai">
                  <option value="">-- PILIH --</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
              <div class="form-group">
                <label for="hall">Hall</label>
                <select class="form-control" name="hall" required="" id="hall">
                  <option value="">-- PILIH --</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                </select>
              </div>
              <div class="form-group">
                <label for="nomor_kamar">Nomor Kamar</label>
                <input type="text" class="form-control" id="nomor_kamar" name="nomor_kamar" autocomplete="off" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
            <button type="button" class="btn btn-primary" id="btn_tambah_asrama">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalDeleteAsrama">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p>Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
            <input type="hidden" name="id" id="id_delete_asrama">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_delete_asrama">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->