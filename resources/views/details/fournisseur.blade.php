@extends('layouts.master', ['titre' => 'Détail fournisseur', 
                            'nomPage' => 'Détail fournisseur',
                            'titrePage' => 'Détail fournisseur' ])

@section('content')
	<!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Détails fournisseur</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Achat ce mois-ci</span>
                      <span class="info-box-number text-center text-muted mb-0">{{$nbrAchat_month}} ({{$prix_month}} DA)</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Achat le mois passée</span>
                      <span class="info-box-number text-center text-muted mb-0">{{$nbrAchat_subbMonth}} ({{$prix_subMonth}} DA)<span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Achat Total</span>
                      <span class="info-box-number text-center text-muted mb-0">{{$list_achats->count()}} ({{$list_achats->sum('prix')}} DA)</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
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
                    <th>Nom de médicament</th>
                    <th>Q.acheter</th>
                    <th>D.acheter</th>
                    <th>Prix</th>
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
		                    <td>{{$achat->prix}}</td>
		                    <td class="text-right py-0 align-middle">
		                      <div class="btn-group btn-group-sm">
		                        <button class="btn btn-info"><i class="fas fa-eye"></i></button>
		                        <button class="btn btn-danger" onclick="deleteLigne({{$achat->id}})"><i class="fas fa-trash"></i></button> 
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
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <h3 class="text-primary"><i class="fas  fa-address-card"></i>&nbsp;{{$fourniseur->name}}</h3>
              <p class="text-muted">Remarque</p>
              <br>
              <div class="text-muted">
                <p class="text-sm">Numéro de regiqtre de commerce
                  <b class="d-block">{{$fourniseur->numero_reg}}</b>
                </p>
                <p class="text-sm">Ajoutée le
                  <b class="d-block">{{$fourniseur->created_at}}</b>
                </p>
              </div>

              <h5 class="mt-5 text-muted">Détail information</h5>
              <ul class="list-unstyled">
                <li>
                  <span href="" class="btn-link text-secondary"><i class="fas fa-envelope"></i>&nbsp;{{$fourniseur->mail}}</span>
                </li>
                <li>
                  <span href="" class="btn-link text-secondary"><i class="fas fa-phone-alt"></i>&nbsp;{{$fourniseur->numero_tel}}</span>
                </li>
                
                <li>
                  <span class="btn-link text-secondary"><i class="fas fa-map-marker-alt"></i>&nbsp;{{$fourniseur->naissance}} Tlemcen</span>
                </li>
                
              </ul>
              <div class="text-center mt-4 mb-0">
                <button class="btn btn-sm btn-primary">Modifier</button>
                <button class="btn btn-sm btn-danger" onclick="deleteLignef({{$fourniseur->id}})">Supprimer le fournisseur</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
@stop
@section('css')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('/js/sweetalert2/sweetalert2.min.css') }}">
@stop

@section('js')
<!-- SweetAlert2 -->
  <script src="{{ asset('js/sweetalert2/sweetalert2.min.js')}}"></script>

  <script type="text/javascript">
    function deleteLigne(id){
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
                    url: "/fournisseur/delete/"+id,
                    method : "POST",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){            
                      Swal.fire({
                        title:'Supprimé!',
                        text:'Le fournisseur a été supprimé..',
                        type:'success',
                         onClose :function () {
                            location.href = '{{(route('fournisseur.index'))}}';
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