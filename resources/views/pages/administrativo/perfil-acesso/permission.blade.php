@extends('layouts.app')

@section('content')

    <livewire:administrativo.perfil-acesso.permission-profile :role_id="$role_id" />
@endsection
