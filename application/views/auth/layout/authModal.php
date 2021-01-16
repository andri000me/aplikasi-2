        <!-- Mahasiswa Modal -->
        <div class="modal fade" id="mhsModal" tabindex="-1" role="dialog" aria-labelledby="mhsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h5 text-black" id="mhsModalLabel" style="text-align: center;">Login Mahasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="mhs_form" method="POST">
                            <div class="form-group">
                                <input type="text" id="nimMhs" name="nimMhs" class="form-control input-feild" placeholder="NIM" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="password" id="passMhs" name="passMhs" class="form-control input-feild" placeholder="Password" autocomplete="off">
                            </div>
                            <div class=" justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-times"></span>&ensp;Close</button>
                                <button type="submit" class="btn btn-primary float-right" ><span class="fas fa-sign-in-alt"></span>&ensp;Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Modal -->
        <div class="modal fade" id="admModal" tabindex="-1" role="dialog" aria-labelledby="admModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h5 text-black" id="admModalLabel" style="text-align: center;">Login Administrator</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="admin_form" method="POST">
                            <div class="form-group">
                                <input type="text" id="usrAdmin" name="usrAdmin" class="form-control" placeholder="Username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="password" id="passAdmin" name="passAdmin" class="form-control" placeholder="Password" autocomplete="off">
                            </div>
                            <div class="justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-times"></span>&ensp;Close</button>
                                <button name="admBtn" id="admBtn" class="btn btn-primary float-right"><span class="fas fa-sign-in-alt"></span>&ensp;Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>