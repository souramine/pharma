@extends('layouts.master', ['titre' => 'Profile', 
                            'nomPage' => 'Profile',
                            'titrePage' => 'Profile' ])

@section('content')
  <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="/img/profile.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                <p class="text-muted text-center">
                	@if(Auth::user()->admin == 1 )
                		Admin
                	@else
                		Vendeur
                	@endif
                </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{Auth::user()->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Téléphone</b> <a class="float-right">{{Auth::user()->numero}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Naissance</b> <a class="float-right">{{Auth::user()->naissance}} Tlemcen</a>
                  </li>
                  <li class="list-group-item">
                    <b>Grade</b> <a class="float-right">{{Auth::user()->grade}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Spécialité</b> <a class="float-right">{{Auth::user()->spe}}</a>
                  </li>
                </ul>
                <p class="text-muted text-center">
                	{{Auth::user()->hopital}}<br>
                	{{Auth::user()->service}}
                </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Plus de détail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="far fa-file-alt mr-1"></i> Ajoutée le : </strong>
                <p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{Auth::user()->created_at}}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Achats</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Ventes</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Mettre a jour</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Shared publicly - 7:30 PM today</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Sent you a message - 3 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <form class="form-horizontal">
                        <div class="input-group input-group-sm mb-0">
                          <input class="form-control form-control-sm" placeholder="Response">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-danger">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Posted 5 photos - 5 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <div class="row mb-3">
                        <div class="col-sm-6">
                          <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                              <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                              <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <div class="row">
        			<div class="col-md-6">
          <div class="card card-primary">
            
            <div class="card-body">
            		<div class="form-group">
                <label for="">Nom Prénom</label>
                <input type="text" name="name" id="" value="{{Auth::user()->name}}" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Adresse mail</label>
                <input type="mail" name="mail" id="" value="{{Auth::user()->email}}"class="form-control">
              </div>

              <div class="form-group">
                <label for="">Numéro de téléphone</label>
                <input type="number" name="numero" id="" value="{{Auth::user()->numero}}" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Date de naissance</label>
                <input type="date" name="naissance" id="" value="{{Auth::user()->naissance}}" class="form-control">
              </div>

              <div class="form-">
                <label for="inputDescription">Adresse</label>
                <textarea id="" name="adresse" class="form-control" value="{{Auth::user()->adresse}}" rows="2"></textarea>
                <br>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-body">
              
             <div class="form-group">
                <label for="">Grade</label>
                <select class="form-control custom-select" name="grade">
                  <option selected disabled>{{Auth::user()->grade}}</option>
                  <option value="je sais pas">je sais pas</option>
                  <option value="Canceled">Canceled</option>
                  <option value="Success">Success</option>
                </select>
              </div>
               <div class="form-group">
                <label for="">Specialité</label>
                <select class="form-control custom-select" name="spe">
                  <option selected disabled>{{Auth::user()->spe}}</option>
                  <option value="Neurologie">Neurologie</option>
                  <option value="Canceled">Canceled</option>
                  <option value="Success">Success</option>
                </select>
              </div>
               <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" name="mdp1" id=""  class="form-control">
              </div>
               <div class="form-group">
                <label for="">Nouveau mot de passe</label>
                <input type="password" name="mdp2" id=""  class="form-control">
              </div>
               <div class="form-group">
                <label for="">Confirmer votre nouveau mot de passe</label>
                <input type="password" name="mdp3" id=""  class="form-control">
              </div>

                    <button class="btn  btn-outline-primary btn-sm">Modifier le profile</button>
       
              

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        		</div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@stop

@section('js')
	<script type="text/javascript">
		function menuApp(){

      document.getElementById("top").className = "nav-item has-treeview";

      document.getElementById("dash").className = "nav-link";
      document.getElementById("management").className = "nav-link";
      document.getElementById("medicaments").className = "nav-link ";
      document.getElementById("fournisseur").className = "nav-link ";
      document.getElementById("pharmacien").className = "nav-link";
      document.getElementById("achats").className = "nav-link ";
      document.getElementById("ventes").className = "nav-link";
      document.getElementById("profile").className = "nav-link active";
      document.getElementById("off").className = "nav-link";
    }
	</script>

@stop