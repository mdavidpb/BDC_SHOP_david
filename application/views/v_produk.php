<h2>Daftar Produk</h2>
<?= $this->session->flashdata('pesan'); ?>
<center>
  <a href="#tambah" data-toggle="modal" class="btn btn-warning">+Tambah</a>
</center>
<table id="example" class="table table-hover table-striped">
  <thead>
    <tr>
      <td>No</td>
      <td>Foto Cover</td>
      <td>Nama Produk</td>
      <td>Tahun</td>
      <td>Kategori</td>
      <td>Harga</td>
      <td>Pembuat</td>
      <td>Stok</td>
      <td>Aksi</td>
    </tr>
  </thead>
  <tbody>
    <?php $no=0; foreach($tampil_produk as $produk):
    $no++; ?>
    <tr>
      <td><?= $no ?></td>
      <td><img src="<?=base_url('assets/img/'.$produk->foto_cover )?>" style="width: 40px"></td>
      <td><?= $produk->nama_produk ?></td>
      <td><?= $produk->tahun ?></td>
      <td><?= $produk->nama_kategori ?></td>
      <td><?= $produk->harga ?></td>
      <td><?= $produk->pembuat ?></td>
      <td><?= $produk->stok ?></td>
      <td><a href="#edit" onclick="edit('<?= $produk->id_produk ?>')" data-toggle="modal" class="btn btn-success">Ubah</a>
        <a href="<?=base_url('index.php/produk/hapus/'.$produk->id_produk)?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Hapus</a></td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>

<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-titile">Tambah Produk</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/produk/tambah')?>" method="post" enctype="multipart/form-data">
          <table>
            <tr>
              <td><input type="hidden" name="id_produk" class="form-control"></td>
            </tr>
            <tr>
              <td>Nama Produk</td>
              <td><input type="text" name="nama_produk" required class="form-control"></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td><select name="id_kategori" class="form-control">
                <option></option>
                <?php foreach($kategori as $kat): ?>
                <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
                <?php endforeach ?>
              </select></td>
            </tr>
            <tr>
              <td>Tahun</td>
              <td><input type="number" name="tahun" required class="form-control"></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td><input type="number" name="harga" required class="form-control"></td>
            </tr>
            <tr>
              <td>Pembuat</td>
              <td><input type="text" name="pembuat" required class="form-control"></td>
            </tr>
            <tr>
              <td>Stok</td>
              <td><input type="number" name="stok" required class="form-control"></td>
            </tr>
            <tr>
              <td>Foto Cover</td>
              <td><input type="file" name="foto_cover" class="form-control"></td>
            </tr>
          </table>
          <input type="submit" name="create" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-titile">Edit Produk</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/produk/produk_update')?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_produk_lama" id="id_produk_lama">
          <table>
            <tr>
              <td><input type="hidden" name="id_produk" id="id_produk" class="form-control"></td>
            </tr>
            <tr>
              <td>Nama Produk</td>
              <td><input type="text" name="nama_produk" id="nama_produk" required class="form-control"></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td><select name="id_kategori" class="form-control" id="id_kategori">
                <option></option>
                <?php foreach($kategori as $kat): ?>
                <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
                <?php endforeach ?>
              </select></td>
            </tr>
            <tr>
              <td>Tahun</td>
              <td><input type="number" name="tahun" required id="tahun" class="form-control"></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td><input type="number" name="harga" required id="harga" class="form-control"></td>
            </tr>
            <tr>
              <td>Pembuat</td>
              <td><input type="text" name="pembuat" required id="pembuat" class="form-control"></td>
            </tr>
            <tr>
              <td>Stok</td>
              <td><input type="number" name="stok" required id="stok" class="form-control"></td>
            </tr>
            <tr>
              <td>Foto Cover</td>
              <td><input type="file" name="foto_cover" id="foto_cover" class="form-control"></td>
            </tr>
          </table>
          <input type="submit" name="edit" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function edit(a){
    $.ajax({
      type:"post",
      url:"<?=base_url()?>index.php/produk/edit_produk/"+a,
      dataType:"json",
      success:function(data){
        $("#id_produk").val(data.id_produk);
        $("#nama_produk").val(data.nama_produk);
        $("#tahun").val(data.tahun);
        $("#id_kategori").val(data.id_kategori);
        $("#harga").val(data.harga);
        $("#pembuat").val(data.pembuat);
        $("#pembeli").val(data.pembeli);
        $("#stok").val(data.stok);
        $("#id_produk_lama").val(data.id_produk);
      }
    })
  }
</script>
