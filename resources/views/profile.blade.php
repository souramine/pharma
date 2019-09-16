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
                    <h5>List des toutes les achats</h5>
                    @if($list_achats->isEmpty())
                    <br>
                    <div class="alert alert-info alert-dismissible" style="text-align: center">
                      <h5><i class="icon fas fa-info"></i> Médicaments !</h5>
                      Info alert preview. This alert is dismissable.
              </div>
             @else
                  
                  <div class="card card-info">
                    
            <div class="card-header">
              <h3 class="card-title">Médicaments</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body p-0">
              
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 40%">Nom de médicament</th>
                    <th style="width: 10%">Q.acheter</th>
                    <th style="width: 20%">D.acheter</th>
                    <th style="width: 15%">Prix</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($list_achats->sortByDesc('prix') as $achat)
                    <tr>
                        <td>
                            {{DB::table('medicaments')->where('id',$achat->medicament_id)->pluck('nom')->first()}}
                            {{DB::table('medicaments')->where('id',$achat->medicament_id)->pluck('dosage')->first()}}
                            {{DB::table('medicaments')->where('id',$achat->medicament_id)->pluck('unite')->first()}}
                            {{DB::table('medicaments')->where('id',$achat->medicament_id)->pluck('forme')->first()}}
                            {{DB::table('medicaments')->where('id',$achat->medicament_id)->pluck('volume')->first()}}
                            {{DB::table('medicaments')->where('id',$achat->medicament_id)->pluck('unite_volume')->first()}}
                        </td>
                         <td>{{$achat->quantite_acheter}}</td>
                        <td>{{$achat->date_achat}}</td>
                        <td>{{$achat->prix}} DA</td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <button class="btn btn-info" onclick="afficheDetailAchat({{$achat->id}})"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-danger" onclick="deleteLigneAchat({{$achat->id}})"><i class="fas fa-trash"></i></button> 
                          </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          @endif
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                   
                   <h5>List des toutes les ventes</h5>
                      @if($list_achats_vente->isEmpty())
                        <br>
                        <div class="alert alert-info alert-dismissible" style="text-align: center">
                            <h5><i class="icon fas fa-info"></i> Médicaments !</h5>
                            Info alert preview. This alert is dismissable.
                        </div>
                      @else
                      <div class="card card-info">
                    
            <div class="card-header">
              <h3 class="card-title">Médicaments</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body p-0">
              
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 40%" >Nom de médicament</th>
                    <th style="width: 10%">Q.vente</th>
                    <th style="width: 20%">D.vente</th>
                    <th style="width: 15%">Prix</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($list_achats_vente->sortByDesc('prix') as $v)
                    <tr>
                        <td>
                             {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('nom')
                          ->first()
                          }}
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('dosage')
                          ->first()
                          }}
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('unite')
                          ->first()
                          }}
                           {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('forme')
                          ->first()
                          }}
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('volume')
                          ->first()
                          }}
                          {{DB::table('medicaments')
                          ->join('lot','medicaments.id','lot.medicament_id')
                          ->where('lot.id',$v->lot_id)
                          ->pluck('unite_volume')
                          ->first()
                          }}
                        </td>
                        <td>{{$v->quantite_vendu}}</td>
                        <td>{{$v->date_vente}}</td>
                        <td>{{$v->prix}} DA</td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <button class="btn btn-info" onclick="afficheDetailVente({{$v->id}})"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-danger" onclick="deleteLigneVente({{$v->id}})"><i class="fas fa-trash"></i></button> 
                          </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
           @endif
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                     <form action="{{ route('modifProfile') }}" method="post">
                            {{ csrf_field() }}
                    <div class="row">
                     
        			<div class="col-md-6">
          <div class="card card-primary">
            
            <div class="card-body">

            		<div class="form-group">
                <label for="">Nom Prénom</label>
                <input type="text" name="name"  value="{{Auth::user()->name}}" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Adresse mail</label>
                <input type="mail" name="mail"  value="{{Auth::user()->email}}"class="form-control">
              </div>

              <div class="form-group">
                <label for="">Numéro de téléphone</label>
                <input type="number" name="numero"  value="{{Auth::user()->numero}}" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Date de naissance</label>
                <input type="date" name="naissance"  value="{{Auth::user()->naissance}}" class="form-control">
              </div>

              <div class="form-">
                <label for="inputDescription">Adresse</label>
                <textarea  name="adresse" class="form-control" rows="2">{{Auth::user()->adresse}}</textarea>
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
                <input type="password" name="mdp1"   class="form-control">
              </div>
               <div class="form-group">
                <label for="">Nouveau mot de passe</label>
                <input type="password" name="mdp2"   class="form-control">
              </div>
               <div class="form-group">
                <label for="">Confirmer votre nouveau mot de passe</label>
                <input type="password" name="mdp3"   class="form-control">
              </div>

             <input type="submit" class="btn btn-outline-primary btn-sm" value="Modifier le profile">
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      
        		</div>
          </form>
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

      <div class="modal fade" id="modal-default2">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Détail du médicament</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <div class="row">
              <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Détail</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="">Nom du médicament ou nom du DCI</label>
                <input type="text" disabled name="" id="medicament_nom_view" class="form-control">
              </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Prix Total de vente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text"  disabled name="" style="text-align: center" id="prix_view" class="form-control col-md-7">    
                </div>

                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Quantité vendu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" disabled name="" style="text-align: center" id="quantite_vendu_view" class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Date de vente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" disabled name="" style="text-align: center" id="dateV_view" class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Prescription&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" disabled name="id_prescription" style="text-align: center" id="prescription_view" class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Vente ajouter par&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <a href="" disabled style="text-align: center;background-color: #b6fcd5" id="pharmacien_view_2" class="form-control col-md-7"> </a>   
                </div>
                <div class="form-">
                <label for="inputDescription">Remarque</label>
                <textarea id="remarque_view" disabled name="" class="form-control" rows="2"></textarea>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary"  data-dismiss="modal">Quitter</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Détail du médicament</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <div class="row">
              <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Détail</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="">Nom du médicament ou nom du DCI</label>
                <input type="text" id="medicament_nom" class="form-control" disabled>
              </div>
              <div class="form-group">
                <label for="">Nom du Fourniseur</label>
                <a href=""  disabled  id="fournisseur_nom_view" class="form-control" style="text-align: center ;background-color: #99d2fc"></a>
              </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Prix Total du produit&nbsp;&nbsp;</label> 
                    <input type="text" step="0.01" id="prix" style="text-align: center" class="form-control col-md-7" disabled >    
                </div>

                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Quantité acheter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" id="quantite_acheter" style="text-align: center" disabled class="form-control col-md-7">    
                </div>

                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Quantité minimum&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" id="quantite_minimum" style="text-align: center" disabled class="form-control col-md-7">    
                </div>
            
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Date de fabrication&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" id="date_f" style="text-align: center" disabled class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Date de péremption&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" id="date_p" style="text-align: center" disabled class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Date d'achat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="text" id="date_a" style="text-align: center" disabled class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Acheter par&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <a href="" disabled style="text-align: center;background-color: #b6fcd5" id="pharmacien_view" class="form-control col-md-7"> </a>   
                </div>
                <div class="form-group">
                <label for="inputDescription">Remarque</label>
                <textarea id="remarque_view"  disabled name="" class="form-control" rows="2"></textarea>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary"  data-dismiss="modal">Quitter</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


@stop
@section('css')
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('/js/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('/js/sweetalert2/sweetalert2.min.css') }}">
@stop

@section('js')
<!-- Toastr -->
  <script src="{{ asset('js/toastr/toastr.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('js/sweetalert2/sweetalert2.min.js')}}"></script>

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
    @if(session('erreur'))
          toastr.error('Le mot de passe entré est incorrect');
    @endif
    @if(session('erreur2'))
          toastr.error('Le nv mot de passe entrée n est pas identique');
    @endif
    @if(session('message'))
          toastr.success('Profile modifié avec succées');
    @endif


    function afficheDetailVente(id){
    $.ajax({
                    url: "/detail/vente/"+id,
                    method : "get",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){   
                        var myModal = $('#modal-default2');
                        document.getElementById('medicament_nom_view').value = Object.values(data[3])[1] +" "+ Object.values(data[3])[2] +" "+Object.values(data[3])[3] +" "+ Object.values(data[3])[4] +" "+Object.values(data[3])[6] +" "+Object.values(data[3])[7];
                        document.getElementById('prix_view').value = Object.values(data[0])[3] +" DA" ;
                        document.getElementById('quantite_vendu_view').value = Object.values(data[0])[2] ;
                        document.getElementById('dateV_view').value = Object.values(data[0])[1] ;
                        document.getElementById('prescription_view').value = Object.values(data[0])[4] ;
                        document.getElementById('remarque_view').value = Object.values(data[0])[5] ;

                        document.getElementById('pharmacien_view_2').innerHTML = Object.values(data[1])[1] ;
                        document.getElementById("pharmacien_view_2").href = "/detail/pharmacien/"+Object.values(data[1])[0];

                        myModal.modal({ show: true });        
                                
                    },
                    error: function(data){
                        Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Quelque chose a mal tourné!'
                        })
                      }
                  });
        

  }

  function deleteLigneVente(id){
    Swal.fire({
        backdrop: `
        rgba(255,0,0,0.4)
      `,
      title: 'Êtes-vous sûr?',
      text: "Vous ne pourrez pas revenir en arrière!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Oui, supprimez-le!',
      cancelButtonText:'Annuler'

    }).then((result) => {
      if (result.value) {
            $.ajax({
                    url: "/vente/delete/"+id,
                    method : "POST",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){            
                      Swal.fire({
                        title:'Supprimé!',
                        text:'La vente a été supprimé..',
                        type:'success',
                         onClose :function () {
                            window.location.reload();
                          }
                      }                   
                      )           
                    },
                    error: function(data){
                        Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Quelque chose a mal tourné!'
                        })
                      }
                  }); 
      }
    })
      }

      function afficheDetailAchat(id){
    $.ajax({
                    url: "/detail/achat/"+id,
                    method : "get",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){   
                        //alert(Object.keys(data[1])[2]); 
                        var myModal = $('#modal-default');
                        document.getElementById('medicament_nom').value = Object.values(data[2])[1] +" "+ Object.values(data[2])[2] +" "+ Object.values(data[2])[3] +" "+Object.values(data[2])[4] +" "+Object.values(data[2])[6] +" "+Object.values(data[2])[7];

                        document.getElementById('fournisseur_nom_view').innerHTML = Object.values(data[1])[1] ;
                        document.getElementById("fournisseur_nom_view").href = "/detail/fournisseur/"+Object.values(data[1])[0];

                        document.getElementById('prix').value = Object.values(data[0])[7] +" DA" ;
                        document.getElementById('quantite_acheter').value = Object.values(data[0])[4] ;
                        document.getElementById('quantite_minimum').value = Object.values(data[0])[6] ;
                        document.getElementById('date_f').value = Object.values(data[0])[1] ;
                        document.getElementById('date_p').value = Object.values(data[0])[2] ;
                        document.getElementById('date_a').value = Object.values(data[0])[3] ;
                        document.getElementById('remarque_view').value = Object.values(data[0])[8] ;
                        document.getElementById('pharmacien_view').innerHTML = Object.values(data[3])[1] ;
                        document.getElementById("pharmacien_view").href = "/detail/pharmacien/"+Object.values(data[3])[0];

                        myModal.modal({ show: true });        
                                
                    },
                    error: function(data){
                        Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Quelque chose a mal tourné!'
                        })
                      }
                  }); 
        

  }

  function deleteLigneAchat(id){
    Swal.fire({
        backdrop: `
        rgba(255,0,0,0.4)
      `,
      title: 'Êtes-vous sûr?',
      text: "Vous ne pourrez pas revenir en arrière!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Oui, supprimez-le!',
      cancelButtonText:'Annuler'

    }).then((result) => {
      if (result.value) {
            $.ajax({
                    url: "/achat/delete/"+id,
                    method : "POST",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){            
                      Swal.fire({
                        title:'Supprimé!',
                        text:'Le achat a été supprimé..',
                        type:'success',
                         onClose :function () {
                            window.location.reload();
                          }
                      }                   
                      )           
                    },
                    error: function(data){
                        Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Quelque chose a mal tourné!'
                        })
                      }
                  }); 
      }
    })
      }
	</script>

@stop