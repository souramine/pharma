@extends('layouts.master', ['titre' => 'Fournisseurs', 
                            'nomPage' => 'Management / Fournisseurs',
                            'titrePage' => 'Fournisseurs' ])

@section('content')
   <!-- Default box -->
      <div class="card">
        <div class="card-header">
           <h3 class="card-title">List des fournisseurs&nbsp;&nbsp;
            @if(Auth::user()->admin == 1)
            <button type="button" class="btn  btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-default">Ajouter</button>
            @endif
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        @if($fournisseurs->isEmpty())
          <div class="alert alert-info alert-dismissible" style="text-align: center">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-info"></i> Alert!</h5>
                  Info alert preview. This alert is dismissable.
          </div>
        @else
        <div class="card-body p-2">
          <table class="table table-striped projects" id="example1">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Nom - Prénom
                      </th>
                      <th style="width: 20%">
                          Date Naissance
                      </th>
                      <th style="width: 10%">
                          Téléphone
                      </th>
                      <th style="width: 9%">
                          Email
                      </th>
                      <th style="width: 10%" class="text-center">
                          N Registre
                      </th>
                      <th style="width: 30%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($fournisseurs as $f)
                  <tr>
                      <td>
                          {{$f->id}}
                      </td>
                      <td>
                          {{$f->name}}
                      </td>
                      <td>
                          {{$f->naissance}}
                      </td>
                      <td>
                          {{$f->numero_tel}}
                      </td>
                      <td>
                         {{$f->mail}}  
                      </td>
                      <td class="project-state">
                        {{$f->numero_reg}}
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" style="cursor: pointer;" href="{{route('detailF',$f->id)}}">
                              <i class="fas fa-folder"></i>
                              Détail
                          </a>
                          @if(Auth::user()->admin == 1)
                          <span class="btn btn-info btn-sm" style="cursor: pointer;">
                              <i class="fas fa-pencil-alt"></i>
                              Modi
                          </span>
                          @endif
                          @if(Auth::user()->admin == 1)
                          <span class="btn btn-danger btn-sm" style="cursor: pointer;" onclick="deleteLigne({{$f->id}})">
                              <i class="fas fa-trash"></i>
                              Supp
                          </span>
                          @endif
                      </td>
                  </tr>
                  @endforeach

              </tbody>
          </table>
        </div>
        @endif
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
<form action="{{ route('addFournisseur') }}" method="post">
                            {{ csrf_field() }}
           <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajouter un Fournisseur</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <div class="row">
              <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tout les champs sont obligatoire</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                <label for="">Nom Prénom</label>
                <input type="text" name="name" id="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Adresse mail</label>
                <input type="mail" name="mail" id="" class="form-control">
              </div>

              <div class="form-group">
                <label for="">Numéro de téléphone</label>
                <input type="number" name="numero" id="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Date de naissance</label>
                <input type="date" name="naissance" id="" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Numéro de registre de commerce</label>
                <input type="number" name="numero_reg" id="" class="form-control">
              </div>

              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
              <input type="submit" class="btn btn-primary" value="Sauvegarder">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  </form>
@stop

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/js/datatables/dataTables.bootstrap4.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('/js/sweetalert2/sweetalert2.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('/js/toastr/toastr.min.css') }}">
@stop

@section('js')
  <!-- DataTables -->
  <script src="{{ asset('js/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{ asset('js/datatables/dataTables.bootstrap4.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('js/sweetalert2/sweetalert2.min.js')}}"></script>
  <!-- Toastr -->
  <script src="{{ asset('js/toastr/toastr.min.js')}}"></script>

  <!-- page script -->
  <script>
    function menuApp(){

      document.getElementById("top").className = "nav-item has-treeview menu-open";

      document.getElementById("dash").className = "nav-link";
      document.getElementById("management").className = "nav-link active";
      document.getElementById("medicaments").className = "nav-link ";
      document.getElementById("fournisseur").className = "nav-link active";
      document.getElementById("pharmacien").className = "nav-link";
      document.getElementById("achats").className = "nav-link ";
      document.getElementById("ventes").className = "nav-link";
      document.getElementById("profile").className = "nav-link";
      document.getElementById("off").className = "nav-link";
    }

      @if(session('message'))
          toastr.success('Fournisseur Ajoutée');
      @endif
    //data table
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
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
