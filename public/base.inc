<header class="main-header">
                <a href="../../index2.html" class="logo">
                    <span class="logo-mini"><b>S</b>OFT</span>
                    <span class="logo-lg"><b>Control</b> Asistencia</span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                  <img src="<?php echo base_url();?>public/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                  <span class="hidden-xs"><?php echo $_SESSION["personal"]?></span>
                                </a>
                              <ul class="dropdown-menu">
                                  <li class="user-header">
                                      <img src="<?php echo base_url();?>public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                      <p>
                                          <?php if($_SESSION["tipopersonal"]==1){
                                              echo $_SESSION["personal"]?> - Jefe De Departamento
                                          <?php } ?>
                                          <?php if($_SESSION["tipopersonal"]==2){
                                              echo $_SESSION["personal"]?> - OAA
                                          <?php } ?>
                                          <?php if($_SESSION["tipopersonal"]==4){
                                              echo $_SESSION["personal"]?> - Docente
                                          <?php } ?>
                                          <?php if($_SESSION["tipopersonal"]==3){
                                              echo $_SESSION["personal"]?> - Alumno
                                          <?php } ?>
                                          <small>Fecha Peru : <?php echo date(' d - m - Y') ?></small>
                                      </p>
                                  </li>
                              </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">    
                    <?php 
                      if($_SESSION["tipopersonal"]==1){ ?>
                        <!-- Para JEFE-->
                        <ul class="sidebar-menu">
                          <li class="header">LISTA OPCIONES</li>
                          <li class="treeview active">
                              <a href="<?php echo base_url();?>principal">
                                  <i class="fa fa-dashboard"></i> <span>Principal</span>
                              </a>
                          </li>
                          <li class="treeview">
                              <a href="#">
                                <i class="fa fa-table"></i> <span>Mantenimientos</span>
                                <i class="fa fa-angle-left pull-right"></i>
                              </a>
                              <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>docentes"><i class="fa fa-circle-o"></i> Docentes</a></li>
                                <li><a href="<?php echo base_url();?>cursos"><i class="fa fa-circle-o"></i> Asignaturas</a></li>
                                <li><a href="<?php echo base_url();?>aula"><i class="fa fa-circle-o"></i> Aulas</a></li>
                                <li><a href="<?php echo base_url();?>semestre"><i class="fa fa-circle-o"></i> Semestres</a></li>
                              </ul>
                          </li>
                          <li class="treeview">
                              <a href="#">
                                  <i class="fa fa-folder"></i> <span>Registros</span>
                                  <i class="fa fa-angle-left pull-right"></i>
                              </a>
                              <ul class="treeview-menu">
                                  <li><a href="<?php echo base_url()?>asignarcurso"><i class="fa fa-circle-o"></i> Docente a Asignatura</a></li>
                              </ul>
                          </li>
                          <li class="header">SESION</li>
                          <li><a href="<?php echo base_url();?>login"><i class="fa fa-circle-o text-red"></i> <span>Cerrar Sesion</span></a></li>
                      </ul>
                      <?php }
                    ?>
                    <?php 
                      if($_SESSION["tipopersonal"]==2){ ?>
                        <!-- Para OAA-->
                        <ul class="sidebar-menu">
                        <li class="header">LISTA OPCIONES</li>
                        <li class="treeview active">
                            <a href="<?php echo base_url();?>principal">
                                <i class="fa fa-dashboard"></i> <span>Principal</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                              <i class="fa fa-table"></i> <span>Mantenimientos</span>
                              <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                              <li><a href="<?php echo base_url();?>alumnos"><i class="fa fa-circle-o"></i> Alumnos</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Registros</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>matricula"><i class="fa fa-circle-o"></i> Matricula</a></li>
                            </ul>
                        </li>
                        <li class="header">SESION</li>
                        <li><a href="<?php echo base_url();?>login"><i class="fa fa-circle-o text-red"></i> <span>Cerrar Sesion</span></a></li>
                    </ul>
                      <?php }
                    ?>
                    <?php 
                      if($_SESSION["tipopersonal"]==4){ ?>
                        <ul class="sidebar-menu">
                        <li class="header">LISTA OPCIONES</li>
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Principal</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="<?php echo base_url();?>principal">
                                <i class="fa fa-folder"></i> <span>Registros</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>asistencia"><i class="fa fa-circle-o"></i> Lista De Cursos</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-ban"></i> <span>Reportes</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>reporte/asistencia_asignatura"><i class="fa fa-circle-o"></i> Asistencias x Asignatura</a></li>
                            </ul>
                        </li>
                        <li class="header">SESION</li>
                        <li><a href="<?php echo base_url();?>login"><i class="fa fa-circle-o text-red"></i> <span>Cerrar Sesion</span></a></li>
                    </ul>
                      <?php }
                    ?>
                    <?php 
                      if($_SESSION["tipopersonal"]==3){ ?>
                        <ul class="sidebar-menu">
                        <li class="header">LISTA OPCIONES</li>
                        <li class="treeview active">
                            <a href="<?php echo base_url();?>principal">
                                <i class="fa fa-dashboard"></i> <span>Principal</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Registros</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>alumnos/misnotas"><i class="fa fa-circle-o"></i> Ver Notas</a></li>
                            </ul>
                        </li>
                        <li class="header">SESION</li>
                        <li><a href="<?php echo base_url();?>login"><i class="fa fa-circle-o text-red"></i> <span>Cerrar Sesion</span></a></li>
                    </ul>
                      <?php }
                    ?>

                    <!-- 
                    <ul class="sidebar-menu">
                        <li class="header">LISTA OPCIONES</li>
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Principal</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                              <i class="fa fa-table"></i> <span>Mantenimientos</span>
                              <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                              <li><a href="<?php echo base_url();?>docentes"><i class="fa fa-circle-o"></i> Docentes</a></li>
                              <li><a href="<?php echo base_url();?>alumnos"><i class="fa fa-circle-o"></i> Alumnos</a></li>
                              <li><a href="<?php echo base_url();?>cursos"><i class="fa fa-circle-o"></i> Asignaturas</a></li>
                              <li><a href="<?php echo base_url();?>aula"><i class="fa fa-circle-o"></i> Aulas</a></li>
                              <li><a href="<?php echo base_url();?>Docentes"><i class="fa fa-circle-o"></i> Docentes</a></li>
                              <li><a href="<?php echo base_url();?>Alumnos"><i class="fa fa-circle-o"></i> Alumnos</a></li>
                              <li><a href="<?php echo base_url();?>Cursos"><i class="fa fa-circle-o"></i> Cursos</a></li>
                              <li><a href="simple.html"><i class="fa fa-circle-o"></i> Asignaturas</a></li>
                              <li><a href="<?php echo base_url();?>Aula"><i class="fa fa-circle-o"></i> Aulas</a></li>
                              <li>
                                <a href="<?php echo base_url();?>semestre"><i class="fa fa-circle-o"></i> Semestres</a>
                              </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Registros</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>matricula"><i class="fa fa-circle-o"></i> Matricula</a></li>
                                <li><a href="<?php echo base_url()?>asignarcurso"><i class="fa fa-circle-o"></i> Docente a Asignatura</a></li>
                                <li><a href="<?php echo base_url();?>asistencia"><i class="fa fa-circle-o"></i> Lista De Cursos</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-ban"></i> <span>Reportes</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Asistencias x Asignatura</a></li>
                                <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Notas x Asignatura</a></li>
                                <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Asignatura x Docente</a></li>
                                <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Alumnos x Asignatura</a></li>
                                <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Notas Por Alumno</a></li>
                            </ul>
                        </li>
                        <li class="header">SESION</li>
                        <li><a href="<?php echo base_url();?>login"><i class="fa fa-circle-o text-red"></i> <span>Cerrar Sesion</span></a></li>
                    </ul> -->
                </section>
            </aside>