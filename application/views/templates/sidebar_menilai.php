                <li class="nav-item">
                    <a href="#" class="nav-link" style="color: #ffffff;">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            Performances
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <?php  if($this->session->userdata('level') !== 'leader')
                           if($this->session->userdata('level') !== 'biasa'){ ?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('performances/penilaiankinerja') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                <p>Penilaian Kinerja</p>
                            </a>
                        </li>
                    </ul>
                    <?php } ?>

                    <?php  if($this->session->userdata('level') !== 'leader')
                           if($this->session->userdata('level') !== 'biasa'){ ?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('performances/penilaiankuesioner') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                <p>Penilaian Kuesioner</p>
                            </a>
                        </li>
                    </ul>
                    <?php } ?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('performances/menilaidirisendiri') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                <p>Menilai Diri Sendiri</p>
                            </a>
                        </li>
                    </ul>
                <?php if($this->session->userdata('level') !== 'hc')
                      if($this->session->userdata('level') !== 'leader')
                      if($this->session->userdata('level') !== 'ceo'){ ?>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('performances/menilaileader') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                <p>Menilai Leader</p>
                            </a>
                        </li>
                    </ul>
                    <?php } ?>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('performances/menilairekan1') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                <p>Menilai Rekan 1</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('performances/menilairekan2') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                <p>Menilai Rekan 2</p>
                            </a>
                        </li>
                    </ul>
                     <?php  if($this->session->userdata('level') !== 'leader'){ ?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('performances/akumulasi') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                <p>Akumulasi Keseluruhan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                    <?php } ?>

                <?php  if($this->session->userdata('level') !== 'leader'){ ?>
                <li class="nav-item">
                    <a href="#" class="nav-link" style="color: #ffffff;">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Training
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview nav-sidebar nav-child-indent">
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color: #ffffff; color: black;">
                                <p>
                                    Pelatihan
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('training/datasoalpre') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                        <p>Pre-Test</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('training/datasoal') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                        <p>Post-Test</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview nav-sidebar nav-child-indent">
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color: #ffffff; color: black;">
                                <p>
                                    Akumulasi jawaban
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Training/Hasil_pretest') ?>" class="nav-link " style="background-color: #ffffff; color: black;">
                                        <p>Jawaban Pre_Test</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link " style="background-color: #ffffff; color: black;">
                                        <p>Jawaban Post_Test</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: #ffffff; color: black;">
                                <p>Nilai</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>