@extends('layouts.master', ['titre' => 'Dashboard', 
                            'nomPage' => 'Dashboard',
                            'titrePage' => 'Dashboard' ])

@section('content')
  Dashboard
@stop

@section('js')
	<script type="text/javascript">
		function menuApp(){

      document.getElementById("top").className = "nav-item has-treeview";

      document.getElementById("dash").className = "nav-link active";
      document.getElementById("management").className = "nav-link ";
      document.getElementById("medicaments").className = "nav-link ";
      document.getElementById("fournisseur").className = "nav-link ";
      document.getElementById("pharmacien").className = "nav-link ";
      document.getElementById("achats").className = "nav-link ";
      document.getElementById("ventes").className = "nav-link";
      document.getElementById("profile").className = "nav-link";
      document.getElementById("off").className = "nav-link";
    }
	</script>
@stop