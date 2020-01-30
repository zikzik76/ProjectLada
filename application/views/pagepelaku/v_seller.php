<br>
    <hr>
    <div class="col-lg-12">
        <p>Seller Profile Form Attachment <br> <small><em>Lampiran Form Profile Penjual</em></small></p>
        <!-- // <hr/> -->
        <div class="form-group class="col-lg-12">
            <label>Participant Name <br> <small><em>Nama Calon Peserta </em></small> :</label>
            <input type="text" class="form-control" id="n_calon_penjual" name="n_calon_seller" required = "required">
        </div>
        <div class="form-group">
            <label>Company Status <br> <small><em>Status Perusahaan</em></small> :</label>
            <select name="st_calon_seller" id="st_calon_seller" class="form-control" required="required">
                <option value="">-</option>
                <!-- // <option value="Perorangan">Perorangan</option> -->
                <option value="Badan Usaha">Badan Usaha</option>
            </select>
        </div>
            <div class="form-group">
            <label>Bank Account Number <br> <small><em>Nomor Akun Bank </em></small> : </label>
            <input type="number" class="form-control" id="no_account_bank_seller" name="no_account_bank_seller" required="required">
        </div>
        <div class="form-group">
            <label>Bank Account Name <br> <small><em> Nama Akun Bank </em></small>: </label>
            <input type="text" class="form-control" id="account_name_seller" name="account_name_seller" required="required" placeholder="BANK ACCOUNT NAME">
        </div>
        <div class="form-group">
            <label>Bank Name <br> <small><em>Nama Bank</em></small> :</label>
                <input type="text" class="form-control" id="bank_name_seller" name="bank_name_seller" required="required">
            <!-- // <select name="bank_name_seller" id="bank_name_seller" class="form-control" required="required" onchange="myfunction()">
            //     <option value="">-</option>
            //     <option value="Mandiri">Bank Mandiri</option>
            //     <option value="BNI">Bank Negara Indonesia</option>
            //     <option value="CCB">CCB</option>
            //     <option value="CIMB">CIMB NIAGA</option>
            //     <option value="BCA">Bank Central Asia</option >
            //     <option value="BAG">Bank Artha Graha</option>
            // </select> -->
        </div>
            <div class="form-group">
            <label>Address <br> <small><em>Alamat</em></small>:</label>
            <input type="text" class="form-control" id="address_seller" name="address_Seller" required="required" placeholder="COMPANY ADDRESS">
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
                                <input type="file" class="custom-file-input" name="ak_pen_seller" id="ak_pen_seller" required="required" accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Amendment Number <br> <small><em>No Akta Perubahan</em></small> <br>(<small>if there is no change then upload with the same document | bila tidak ada perubahan maka upload dengan dokumen akta yang existing / sama </small>)</td>
                    <td>
                        <div class="input-group">
                            <div class="custom-file col-sm-12">
                                <input type="file" class="custom-file-input" name="ak_per_seller" id="ak_per_seller" required="required" accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Firm address <br> <small><em>Domisili Perusahaan</em></small></td>
                    <td>
                        <div class="input-group">
                            <div class="custom-file col-sm-12">
                                <input type="file" class="custom-file-input" name="dom_seller" id="dom_seller" required="required" accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Taxpayer Number <br> <small></em> No Pokok Wajib Pajak (NPWP) </em></small></td>
                    <td>
                        <div class="input-group">
                            <div class="custom-file col-sm-12">
                                <input type="file" class="custom-file-input" name="npwp_seller" id="npwp_seller" required="required" accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Customs Registration Number <br><small><em> No Identitas Kepabean</em></small></td>
                    <td>
                        <div class="input-group">
                            <div class="custom-file col-sm-12">
                                <input type="file" class="custom-file-input" name="id_kep_seller" id="id_kep_seller" required accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Registered Pure TIN bar Exporters that are Still Valid <br></small><em>Eksportir Terdaftar Timah Murni Batang Yang Masih Berlaku</em></small></td>
                    <td>
                        <div class="input-group">
                            <div class="custom-file col-sm-12">
                                <input type="file" class="custom-file-input" name="ekspor_timah" id="ekspor_timah" required accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Licensing Pure Tin Bars Exporters that Are Still valid <br><small><em>Perizinan Ekspor Timah Murni Batangan Yang Masih Berlaku</em></small></td>
                    <td>
                        <div class="input-group">
                            <div class="custom-file col-sm-12">
                                <input type="file" class="custom-file-input" name="peizinan_seller" id="peizinan_seller" required accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Business Registration Number <br> <small><em>Nomor Induk Berusaha (NIB)</em></small></td>
                    <td>
                        <div class="input-group">
                            <div class="custom-file col-sm-12">
                                <input type="file" class="custom-file-input" name="nib_seller" id="nib_seller" required accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>board Identity  <br> <small><em>Identitas Diri Pengurus</em></small></td>
                    <td>
                        <div class="input-group">
                            <div class="custom-file col-sm-12">
                                <input type="file" class="custom-file-input" name="idp_seller" id="idp_seller" required accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Financial statements <br> <small><em>Laporan Keuangan</em></small></td>
                    <td>
                        <div class="input-group">
                            <div class="custom-file col-sm-12">
                                <input type="file" class="custom-file-input" name="lk_seller" id="lk_seller" required accept="application/pdf">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
                <button type="button" class="btn btn-primary" id="DataProses" onclick="post_data(\'S\');">Submit</button>
            <button type="Cancel" class="btn btn-warning">Cancel</button>
        </div>
    </div>