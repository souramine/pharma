@extends('layouts.master', ['titre' => 'Détail pharmacien', 
                            'nomPage' => 'Détail pharmacien',
                            'titrePage' => 'Détail pharmacien' ])

@section('content')
	<!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Détails pharmacien</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-4" >
                  <div class="info-box bg-light">
                    <div class="info-box-content" >
                      <span class="info-box-text text-center text-muted">Achat ce mois-ci</span>
                      <span class="info-box-number text-center text-muted mb-0">{{$nbrAchat_month}} ({{$prix_month}} DA)</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4" >
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Achat le mois passée</span>
                      <span class="info-box-number text-center text-muted mb-0">{{$nbrAchat_subbMonth}} ({{$prix_subMonth}} DA)<span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4" >
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Achat Total</span>
                      <span class="info-box-number text-center text-muted mb-0">{{$list_achats->count()}} ({{$list_achats->sum('prix')}} DA)</span>
                    </div>
                  </div>
                </div>


                <div class="col-12 col-sm-4" >
                  <div class="info-box bg-light" >
                    <div class="info-box-content"  >
                      <span class="info-box-text text-center text-muted">Vente ce mois-ci</span>
                      <span class="info-box-number text-center text-muted mb-0">{{$nbrVente_month}} ({{$prix_month_vente}} DA)</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4" >
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Vente le mois passée</span>
                      <span class="info-box-number text-center text-muted mb-0">{{$nbrVente_subbMonth}} ({{$prix_subMonth_vente}} DA)<span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4" >
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Vente Total</span>
                      <span class="info-box-number text-center text-muted mb-0">{{$list_achats_vente->count()}} ({{$list_achats_vente->sum('prix')}} DA)</span>
                    </div>
                  </div>
                </div>
               
              </div>
              
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <h3 class="text-primary"><i class="fas  fa-address-card"></i>&nbsp;{{$pharmacien->name}}
                @if($pharmacien->admin == 1 )
                  <span style="color: #7dc008">(ADMIN)</span>
                @endif
              </h3>

              <ul class="list-unstyled">
                <li>
                  <span href="" class="btn-link text-secondary"><i class="fas fa-hospital-alt"></i>&nbsp;&nbsp;{{$pharmacien->hopital}} ( {{$pharmacien->service}} )</span>
                </li>
                <li>
                  <span class="btn-link text-secondary"><i class="fas fa-file-medical"></i>&nbsp;&nbsp;&nbsp;&nbsp;{{$pharmacien->grade}} ( {{$pharmacien->spe}})</span>
                </li>
                <li>
                  <span href="" class="btn-link text-secondary"><i class="fas fa-envelope"></i>&nbsp;&nbsp;&nbsp;{{$pharmacien->email}}</span>
                </li>
                <li>
                  <span href="" class="btn-link text-secondary"><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;&nbsp;{{$pharmacien->numero}}</span>
                </li>
                
                <li>
                  <span class="btn-link text-secondary"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp; {{$pharmacien->naissance}} Tlemcen</span>
                </li>

                
               
                
              </ul>
              <div class="text-center mt-4 mb-0">
                <button class="btn btn-sm btn-primary">Modifier</button>
                <button class="btn btn-sm btn-danger" onclick="deleteLignef({{$pharmacien->id}})">Supprimer le pharmacien</button>
              </div>
            </div>

                

          </div>
          <br>
       <div class="row">
            <div class="col-12 col-md-12 col-lg-6 order-2 order-md-1">
                  <h4>List des toutes les achats</h4>
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

            <div class="col-12 col-md-12 col-lg-6 order-2 order-md-1">
               
                  <h4>List des toutes les ventes</h4>
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
              </div>
           
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
@stop
@section('css')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('/js/sweetalert2/sweetalert2.min.css') }}">
@stop

@section('js')
<!-- SweetAlert2 -->
  <script src="{{ asset('js/sweetalert2/sweetalert2.min.js')}}"></script>

  <script type="text/javascript">

    function menuApp(){

      document.getElementById("top").className = "nav-item has-treeview menu-open";

      document.getElementById("dash").className = "nav-link";
      document.getElementById("management").className = "nav-link active";
      document.getElementById("medicaments").className = "nav-link ";
      document.getElementById("fournisseur").className = "nav-link ";
      document.getElementById("pharmacien").className = "nav-link active";
      document.getElementById("achats").className = "nav-link ";
      document.getElementById("ventes").className = "nav-link";
      document.getElementById("profile").className = "nav-link";
      document.getElementById("off").className = "nav-link";
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


      function deleteLignef(id){
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
                    url: "/pharmacien/delete/"+id,
                    method : "POST",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){            
                      Swal.fire({
                        title:'Supprimé!',
                        text:'Le pharmacien a été supprimé..',
                        type:'success',
                         onClose :function () {
                            location.href = '{{(route('pharmacien.index'))}}';
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
  </script>
@stop