<br>
<div class="col-lg-12">
<div>
    <label>Country of origin <br><small><em>Negara Asal</em></small></label>
    <br>
    <small>Fill in if the choice of the above option is Foreign | <em>( Di isikan jika pilihan dari opsi di atas adalah Luar Negeri ) :</em></small>
    <input type="text" class="form-control" id="negara_asal" name="negara_asal" required />
</div>
<div class="row">
<div><input type="HIDDEN" id="optradio_jenis" name="optradio_jenis" value="peserta"></div>
</div>
<br>
<hr>
<div>
<P>Buyer Profile Form Attachment <br><small><em>Lampiran Form Profile Pembeli</em></small> :</p>
<div class="form-group">
    <label>Participant Name <br> <small><em>Nama Calon Peserta </em></small> :</label>
    <input type="text" class="form-control" id="n_calon" name="n_calon" required placeholder="Example : PT CALON TIMAH  (Firm Name)  ">
</div>
<div class="form-group">
<label>Company Status <br> <small><em>Status Perusahaan</em></small> :</label>
    <select name="st_calon" id="st_calon" class="form-control" required="required">
        <option value="">-</option>
        // <option value="Perorangan">Perorangan</option>
        <option value="Badan Usaha"><b>Business Entity</b> | <small><em>Badan Usaha</em></small></option>
    </select>
</div>
<div class="form-group">
    <label>No AccounBank Account Number <br> <small><em>Nomor Akun Bank </em></small> : </label>
    <input type="number" class="form-control" id="no_account_bank" name="no_account_bank" required="required" placeholder=" Example : 123456789012">
</div>
<div class="form-group">
    <label>Bank Account Name <br> <small><em> Nama Akun Bank </em></small>: </label>
    <input type="text" class="form-control" id="account_name" name="account_name" required="required" placeholder=" Example : BANK ACCOUNT NAME">
</div>
<div class="form-group">
    <label>Bank Name <br> <small><em>Nama Bank</em></small> :</label>
        <input type="text" class="form-control" id="bank_name" name="bank_name" required="required">    
</div>
    <div class="form-group">
    <label>Address <br> <small><em>Alamat</em></small>:</label>
    <input type="text" class="form-control" id="address" name="address" required="required" placeholder="Example : COMPANY ADDRESS">
</div>
<label>To upload, the file format file used is .PDF</label><br>
    <small><em>Untuk Upload file format file yang digunakan adalah file .PDF</em></small>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th> About <br> <small><em>Perihal</em></small></th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Number of Deed of Establishment <br> <small><em>No Akta Pendirian</em></small></td>
            <td>
                <div class="input-group">
                    <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" name="ak_pen" id="ak_pen" required="required" accept="application/pdf">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Amendment Number <br> <small><em>No Akta Perubahan</em></small> <br>(<small>if there is no change then upload with the same document | bila tidak ada perubahan maka upload dengan dokumen akta yang existing / sama </small>)</td>
            <td>
                <div class="input-group">
                    <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" name="ak_per" id="ak_per" required="required" accept="application/pdf">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Firm address <br> <small><em>Domisili Perusahaan</em></small></td>
            <td>
                <div class="input-group">
                    <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" name="domi_per" id="domi_per" required="required" accept="application/pdf">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Taxpayer Number <br> <small></em> No Pokok Wajib Pajak (NPWP) </em></small></td>
            <td>
                <div class="input-group">
                    <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" name="npwp" id="npwp" required="required" accept="application/pdf">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Permission from Authorized Agency <br> <small><em>Izin Dari Instansi Yang Berwenang</em></small></td>
            <td>
                <div class="input-group">
                    <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" name="izin_instansi" id="izin_instansi" required="required" accept="application/pdf">
                    </div>
                </div>
            </td>
        </tr>
            <tr>
            <td>board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
            <td>
                <div class="input-group">
                    <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" name="idp" id="idp" required accept="application/pdf">
                    </div>
                </div>
            </td>
        </tr>
            <tr>
            <td>Bank Reference Letter <br> <small><em>Surat Referensi Bank </em></small></td>
            <td>
                <div class="input-group">
                    <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" name="rfbn" id="rfbn" required accept="application/pdf">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Financial statements <br> <small><em>Laporan Keuangan</em></small></td>
            <td>
                <div class="input-group">
                    <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" name="lk" id="lk" required accept="application/pdf">
                    </div>
                </div>
            </td>
        </tr>
            <tr>
            <td>Company Profile <br><small><em>Profil Perusahaan</em></small></td>
            <td>
                <div class="input-group">
                    <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" name="compro" id="compro" required accept="application/pdf">
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    <div>
    <button type="button" class="btn btn-primary" id="DataProses" onclick="post_data(\'PL\');">Submit</button>
    <button type="Cancel" class="btn btn-warning">Cancel</button>
</div>
</div>
</div>